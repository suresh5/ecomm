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
// echo "<pre>";

 //print_r($request->brand_variants);exit;
    try {
        // 1. Create the main product
        $product = Product::create([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'summary'       => $request->summary,
            'description'   => $request->description,
            'photo'         => $request->photo,
            'status'        => $request->status ?? 'inactive',
              'price' => $request->has('has_variants') ? null : ($request->price ?? null),
        'discount' => $request->has('has_variants') ? null : ($request->discount ?? null),
        'stock' => $request->has('has_variants') ? null : ($request->stock ?? null),
        'sku' => $request->has('has_variants') ? null : ($request->sku ?? null),
            'is_featured'   => $request->boolean('is_featured'),
            'cat_id'        => $request->cat_id,
            'child_cat_id'  => $request->child_cat_id,
            'has_variants'  => $request->has('has_variants')? 1: 0,
            'brand_ids' => 'required|array',
        'brand_ids.*' => 'exists:brands,id',
        ]);
         $product->brands()->attach($request->brand_ids);

        // 2. Handle product variants (if applicable)
        if ($request->has('has_variants') && is_array($request->brand_variants)) {
            foreach ($request->brand_variants as $variant) {
                $pv = ProductVariant::create([
                    'product_id'     => $product->id,
                    'sku'            => $variant['sku'] ?? null,
                    'price'          => $variant['price'],
                    'discount'       => $variant['discount'] ?? null,
                    'stock'          => $variant['stock'] ?? 0,
                    'brand_id'       => $variant['brand_id'],
                    'variant_photo'  => $variant['variant_photo'] ?? null,
                ]);

                // Save attribute-value combinations
                if (!empty($variant['attributes']) && is_array($variant['attributes'])) {
                    foreach ($variant['attributes'] as $attr) {
                        DB::table('product_variant_values')->insert([
                            'product_variant_id' => $pv->id,
                            'attribute_id'       => $attr['attribute_id'],
                            'attribute_value_id' => $attr['value_id'],
                            'created_at'         => now(),
                            'updated_at'         => now(),
                        ]);
                    }
                }

                // Save variant-level specifications (if any)
                if (!empty($variant['specifications']) && is_array($variant['specifications'])) {
                    foreach ($variant['specifications'] as $spec) {
                        if (!empty($spec['name'])) {
                            VariantSpecification::create([
                                'product_variant_id' => $pv->id,
                                'spec_name'               => $spec['name'],
                                'spec_value'              => $spec['value'] ?? '',
                            ]);
                        }
                    }
                }
            }
        }

        // 3. Save general specifications (for simple products)
        if (is_array($request->specifications)) {
            foreach ($request->specifications as $spec) {
                if (!empty($spec['name'])) {
                    ProductSpecification::create([
                        'product_id' => $product->id,
                        'name'       => $spec['name'],
                        'value'      => $spec['value'] ?? '',
                    ]);
                }
            }
        }

        DB::commit();
        return redirect()->route('product.index')->with('success', 'Product created successfully.');
        
    } catch (\Exception $e) {
        DB::rollBack();
        //echo $e->getMessage();exit;
        return back()->with('error', 'Failed to create product: ' . $e->getMessage())->withInput();
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

        $product = Product::with(['variants.specifications', 'variants.attributeValues','specifications'])->findOrFail($id);
        $attributes = Attribute::with('values')->get();
        




        $categories = Category::where('is_parent', 1)->get();
        $items = Product::where('id', $id)->get();
$subcategories = Category::where('is_parent', 0)
                         ->get();
        return view('backend.product.edit', compact('product', 'brands', 'categories', 'subcategories','items','attributes'));
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

    echo "<pre>";

 print_r($request->specifications);exit;
    DB::beginTransaction();
    try {
        // 1. Find existing product
        $product = Product::findOrFail($id);

        // 2. Update product fields
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->summary = $request->summary;
        $product->description = $request->description;
        $product->status = $request->status ?? 'inactive';
        $product->cat_id = $request->cat_id;
        $product->child_cat_id = $request->child_cat_id;
        $product->has_variants = $request->has('has_variants') ? 1 : 0;

           if (!$request->has('has_variants')) {
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->stock = $request->stock;
        $product->sku = $request->sku;
    }else {
        $product->price = null;
        $product->discount = null;
        $product->stock = null;
        $product->sku = null;
    }
        $product->save();

        // 3. Delete existing variants and their attribute values
        foreach ($product->variants as $oldVariant) {
            DB::table('product_variant_values')
                ->where('product_variant_id', $oldVariant->id)
                ->delete();
            $oldVariant->delete();
        }

        // 4. Re-create variants if enabled
        if ($request->has('has_variants') && $request->variant_data) {
            foreach ($request->variant_data as $variant) {
                // Create product variant
                $pv = new ProductVariant();
                $pv->product_id = $product->id;
                $pv->sku = $variant['sku'] ?? null;
                $pv->price = $variant['price'];
                $pv->discount = $variant['discount'] ?? null;
                $pv->stock = $variant['stock'] ?? 0;
                $pv->brand_id = $variant['brand_id'];
                $pv->variant_photo = $variant['variant_photo'] ?? null;
                $pv->save();

                // Save attribute-value pairs for this variant
                if (isset($variant['attributes'])) {
                    foreach ($variant['attributes'] as $attribute_id => $attribute_value_id) {
                        DB::table('product_variant_values')->insert([
                            'product_variant_id' => $pv->id,
                            'attribute_id' => $attribute_id,
                            'attribute_value_id' => $attribute_value_id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
                 if (!empty($variant['specifications']) && is_array($variant['specifications'])) {
                    foreach ($variant['specifications'] as $spec) {
                        if (!empty($spec['name'])) {
                            VariantSpecification::create([
                                'product_variant_id' => $pv->id,
                                'spec_name'               => $spec['spec_name'],
                                'spec_value'              => $spec['spec_value'] ?? '',
                            ]);
                        }
                    }
                }
            }
        }

        $existingSpecIds = [];
    if ($request->has('specifications')) {
        foreach ($request->input('specifications') as $spec) {
            if (isset($spec['id'])) {
                // Update existing
                $existing = ProductSpecification::find($spec['id']);
                if ($existing) {
                    $existing->update([
                        'name' => $spec['name'],
                        'value' => $spec['value'],
                    ]);
                    $existingSpecIds[] = $existing->id;
                }
            } else {
                // Create new
                if (!empty($spec['name'])) {
                    $newSpec = ProductSpecification::create([
                        'product_id' => $product->id,
                        'name' => $spec['name'],
                        'value' => $spec['value'] ?? '',
                    ]);
                    $existingSpecIds[] = $newSpec->id;
                }
            }
        }
    }

    // Delete removed specifications
    $product->specifications()
        ->whereNotIn('id', $existingSpecIds)
        ->delete();

       $product->brands()->sync($request->brand_ids);
        
        DB::commit();
        return redirect()->route('product.index')->with('success', 'Product updated successfully.');

    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Failed to update product: ' . $e->getMessage());
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
            DB::table('product_variant_values')
                ->where('product_variant_id', $variant->id)
                ->delete();

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
}
