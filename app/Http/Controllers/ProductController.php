<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\ProductVariant;
use App\Models\VariantSpecification;
use App\Models\ProductVariantValue;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::getAllProduct();
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::get();

        $brands = Brand::where('status', 'active')->get();
        $attributes = Attribute::with('values')->get(); // eager load attribute values

        $categories = Category::where('is_parent', 1)->get();
        return view('backend.product.create', compact('categories', 'brands', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo "coming";exit;
        DB::beginTransaction();
        echo '<pre>';

        //print_r($request->spec_groups);exit;
        try {
            // 1. Create the main product
            $product = Product::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'summary' => $request->summary,
                'description' => $request->description,
                'photo' => $request->photo,
                'status' => $request->status ?? 'inactive',
                'price' => $request->has('has_variants') ? null : $request->price ?? null,
                'discount' => $request->has('has_variants') ? null : $request->discount ?? null,
                'stock' => $request->has('has_variants') ? null : $request->stock ?? null,
                'sku' => $request->has('has_variants') ? null : $request->sku ?? null,
                'is_featured' => $request->boolean('is_featured'),
                'cat_id' => $request->cat_id,
                'child_cat_id' => $request->child_cat_id,
                'has_variants' => $request->has('has_variants') ? 1 : 0,
                'brand_ids' => 'required|array',
                'brand_ids.*' => 'exists:brands,id',
            ]);
            $product->brands()->attach($request->brand_ids);

            // 2. Handle product variants (if applicable)
            if ($request->has('has_variants') && is_array($request->brand_variants)) {
                foreach ($request->brand_variants as $variant) {
                    //echo $variant['brand_id'];exit;
                    $pv = ProductVariant::create([
                        'product_id' => $product->id,
                        'sku' => $variant['sku'] ?? null,
                        'price' => $variant['price'],
                        'discount' => $variant['discount'] ?? null,
                        'stock' => $variant['stock'] ?? 0,
                        'brand_id' => $variant['brand_id'],
                        'variant_photo' => $variant['variant_photo'] ?? null,
                    ]);

                    // Save attribute-value combinations
                    if (!empty($variant['attributes']) && is_array($variant['attributes'])) {
                        foreach ($variant['attributes'] as $attr) {
                            DB::table('product_variant_values')->insert([
                                'product_variant_id' => $pv->id,
                                'attribute_id' => $attr['attribute_id'],
                                'attribute_value_id' => $attr['value_id'],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }

                    // Save variant-level specifications (if any)
                    if (!empty($variant['specifications']) && is_array($variant['specifications'])) {
                        foreach ($variant['specifications'] as $spec) {
                            if (!empty($spec['name'])) {
                                VariantSpecification::create([
                                    'product_variant_id' => $pv->id,
                                    'spec_name' => $spec['name'],
                                    'spec_value' => $spec['value'] ?? '',
                                ]);
                            }
                        }
                    }
                }
            }

            // 3. Save general specifications (for simple products)
            // if (is_array($request->specifications)) {
            //     foreach ($request->specifications as $spec) {
            //         if (!empty($spec['name'])) {
            //             ProductSpecification::create([
            //                 'product_id' => $product->id,
            //                 'name'       => $spec['name'],
            //                 'value'      => $spec['value'] ?? '',
            //             ]);
            //         }
            //     }
            // }

            if ($request->has('spec_groups')) {
                foreach ($request->spec_groups as $groupData) {
                    $labelName = $groupData['label'];
                    // Save specifications under the group
                    if (!empty($groupData['specifications'])) {
                        foreach ($groupData['specifications'] as $spec) {
                            ProductSpecification::create([
                                'product_id' => $product->id,
                                'label' => $labelName,
                                'name' => $spec['name'],
                                'value' => $spec['value'],
                            ]);
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route('product.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            exit;
            return back()
                ->with('error', 'Failed to create product: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Implement if needed
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = Brand::get();
        $product = Product::findOrFail($id);
        $prospecifications = ProductSpecification::where('product_id', $id)->orderBy('label')->orderBy('name')->get()->groupBy('label'); // group by label column
        $product = Product::with(['variants.specifications', 'variants.attributeValues'])->findOrFail($id);
        $attributes = Attribute::with('values')->get();

        // echo "<pre>";
        // print_r($attributes);exit;

        $categories = Category::where('is_parent', 1)->get();
        $items = Product::where('id', $id)->get();
        $subcategories = Category::where('is_parent', 0)->get();
        return view('backend.product.edit', compact('prospecifications', 'product', 'brands', 'categories', 'subcategories', 'items', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        //echo "<pre>";

        //print_r($request->brand_variants);exit;
        try {
            $product = Product::findOrFail($id);

            // 1. Update main product fields
            $product->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'summary' => $request->summary,
                'description' => $request->description,
                'photo' => $request->photo,
                'status' => $request->status ?? 'inactive',
                'price' => $request->has('has_variants') ? null : $request->price ?? null,
                'discount' => $request->has('has_variants') ? null : $request->discount ?? null,
                'stock' => $request->has('has_variants') ? null : $request->stock ?? null,
                'sku' => $request->has('has_variants') ? null : $request->sku ?? null,
                'is_featured' => $request->boolean('is_featured'),
                'cat_id' => $request->cat_id,
                'child_cat_id' => $request->child_cat_id,
                'has_variants' => $request->has('has_variants') ? 1 : 0,
            ]);

            // Sync brands
            $product->brands()->sync($request->brand_ids ?? []);

            // 2. Handle variants
            $product->variants()->delete(); // Remove old variants

            if ($request->has('has_variants') && is_array($request->brand_variants)) {
                foreach ($request->brand_variants as $brandId => $variants) {
                    foreach ($variants as $variant) {
                        $pv = ProductVariant::create([
                            'product_id' => $product->id,
                            'sku' => $variant['sku'] ?? null,
                            'price' => $variant['price'] ?? 0,
                            'discount' => $variant['discount'] ?? null,
                            'stock' => $variant['stock'] ?? 0,
                            'brand_id' => $brandId,
                            'variant_photo' => $variant['variant_photo'] ?? null,
                        ]);

                        // Attributes
                        if (!empty($variant['attributes']) && is_array($variant['attributes'])) {
                            foreach ($variant['attributes']['attribute_id'] as $i => $attributeId) {
                                DB::table('product_variant_values')->insert([
                                    'product_variant_id' => $pv->id,
                                    'attribute_id' => $attributeId,
                                    'attribute_value_id' => $variant['attributes']['attribute_value_id'][$i] ?? null,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                            }
                        }

                        // Specifications
                        if (!empty($variant['specifications']) && is_array($variant['specifications'])) {
                            foreach ($variant['specifications'] as $spec) {
                                if (!empty($spec['spec_name'])) {
                                    VariantSpecification::create([
                                        'product_variant_id' => $pv->id,
                                        'spec_name' => $spec['spec_name'],
                                        'spec_value' => $spec['spec_value'] ?? '',
                                    ]);
                                }
                            }
                        }
                    }
                }
            }

            // 3. Handle specification groups
            $product->specifications()->delete(); // Remove old specs

            if ($request->has('spec_groups')) {
                foreach ($request->spec_groups as $groupData) {
                    $labelName = $groupData['label'] ?? '';
                    if (!empty($groupData['specifications'])) {
                        foreach ($groupData['specifications'] as $spec) {
                            ProductSpecification::create([
                                'product_id' => $product->id,
                                'label' => $labelName,
                                'name' => $spec['name'],
                                'value' => $spec['value'],
                            ]);
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route('product.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
            DB::rollBack();
            return back()
                ->with('error', 'Failed to update product: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);

            // Delete variants and their attribute values
            foreach ($product->variants as $variant) {
                DB::table('product_variant_values')->where('product_variant_id', $variant->id)->delete();

                $variant->delete();
            }

            // Optionally: delete product images if stored in filesystem
            // if ($product->photo && Storage::exists($product->photo)) {
            //     Storage::delete($product->photo);
            // }

            $product->delete();

            DB::commit();
            return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }

    public function showDetail($slug)
    {
        $product = Product::with([
            'variants.attributeValues.attribute',
            'specifications',
            'cat_info',                           // parent category
            'sub_cat_info'
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.product_detail', compact('product'));
    }
}
