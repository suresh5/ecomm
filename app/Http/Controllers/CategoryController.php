<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::getAllCategory();
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats = Category::where('is_parent', 1)->orderBy('title', 'ASC')->get();
        $attributeTypes  = Attribute::where('name', 'Type')->get();
        return view('backend.category.create', compact('parent_cats', 'attributeTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //dd($request->all());
        try {
            $validatedData = $request->validate([
                'title' => 'required|string',
                'summary' => 'nullable|string',
                'photo' => 'nullable|string',
                'status' => 'required|in:active,inactive',
                'is_parent' => 'sometimes|in:1',
                'parent_id' => 'nullable|exists:categories,id',
                'attribute_values' => 'nullable|array',
                'engname' => 'required|string|unique:categories,engname',
                'slug' => 'required|string|unique:categories,slug',
                'ishomepage' => 'nullable|boolean',
                'position' => 'required|in:center,side',
                'sort_order' => 'nullable|integer|min:0',
                'menu_position' => 'nullable|in:main,extra,home',
            ]);

            $validatedData['is_parent'] = $request->input('is_parent', 0);
            $validatedData['ishomepage'] = $request->has('ishomepage') ? 1 : 0;

            $category = Category::create($validatedData);

            if ($request->has('attribute_values')) {
                $valueIds = collect($request->attribute_values)->flatten()->all(); // [1,2,5,6]
                $category->attributeValues()->sync($valueIds); // Many-to-many relation
            }

            return redirect()
                ->route('category.index')
                ->with('success', 'Category successfully added');
        } catch (\Throwable $e) {
            // Log the error for debugging
            echo $e->getMessage();
            exit;
            \Log::error('Category Store Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->route('category.index')
                ->with('error', 'An error occurred while adding the category. Please try again.');
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

        $parent_cats = Category::where('is_parent', 1)->get();

        $category = Category::with('attributeValues')->findOrFail($id);
        $attributeTypes = Attribute::with('values')->where('name', 'Type')->get(); // eager load values

        return view('backend.category.edit', compact('category', 'parent_cats', 'attributeTypes'));
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
        $category = Category::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string',
            'summary' => 'nullable|string',
            'photo' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable|exists:categories,id',
            'engname' => 'required|string|max:255|unique:categories,engname,' . $category->id,
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'ishomepage' => 'nullable|boolean',
            'position' => 'required|in:center,side',
            'sort_order' => 'nullable|integer|min:0',
            'menu_position' => 'nullable|in:main,extra,home',
        ]);
        // $slug = generateUniqueSlug($request->engname, Category::class);
        //         $validatedData['slug'] = $slug;
        $validatedData['is_parent'] = $request->input('is_parent', 0);
        $validatedData['ishomepage'] = $request->input('ishomepage', 0);

        $status = $category->update($validatedData);
        $selectedValues = collect($request->input('attribute_values'))->flatten()->filter()->all();
        $category->attributeValues()->sync($selectedValues);
        $message = $status
            ? 'Category successfully updated'
            : 'Error occurred, Please try again!';

        return redirect()->route('category.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $child_cat_id = Category::where('parent_id', $id)->pluck('id');

        $status = $category->delete();

        if ($status && $child_cat_id->count() > 0) {
            Category::shiftChild($child_cat_id);
        }

        $message = $status
            ? 'Category successfully deleted'
            : 'Error while deleting category';

        return redirect()->route('category.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }

    /**
     * Get child categories by parent ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getChildByParent(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $child_cat = Category::getChildByParentID($request->id);

        if ($child_cat->count() <= 0) {
            return response()->json(['status' => false, 'msg' => '', 'data' => null]);
        }

        return response()->json(['status' => true, 'msg' => '', 'data' => $child_cat]);
    }


    public function frontendViewProductsForCategory($slug)
    {
        // Find category with subcategories
        $category = Category::with('children')->where('slug', $slug)->firstOrFail();

        if ($category->children->isNotEmpty()) {
            // Get products from all subcategories
            $subCategoryIds = $category->children->pluck('id')->toArray();

            $product_lists = Product::with([
                'variants.attributeValues.attribute', // variants with attributes
                'specifications'                   // technical specifications                        
            ])->whereIn('child_cat_id', $subCategoryIds)
            ->paginate(3);
        } else {
            // No subcategories → products directly under this category
            $product_lists = Product::with([
                'variants.attributeValues.attribute',
                'specifications'
            ])->where(function($q) use ($category) {
                $q->where('cat_id', $category->id)
                  ->orWhere('child_cat_id', $category->id);
            })->paginate(3);
        }

        $parentCategories = Category::with('children')->whereNull('parent_id')->get();
        return view('frontendtheme.category_products', compact('category', 'parentCategories', 'product_lists'));
    }






    public function productFilter(Request $request, $slug)
    {
        // Get the current category by slug
        $category = Category::with('parent', 'children')->where('slug', $slug)->firstOrFail();

        // Load parent categories (for sidebar tree)
        $parentCategories = Category::with('children')->whereNull('parent_id')->get();

        // Query products under this category (including child categories)
        $categoryIds = $category->children->pluck('id')->push($category->id);
        $productsQuery = Product::with([
            'variants.attributeValues.attribute',
            'specifications'
        ]);

        /**
         * ---- APPLY FILTERS ----
         */
        // Price range
        if ($request->has('min_price') && $request->has('max_price')) {
            $productsQuery->whereBetween('price', [
                $request->min_price,
                $request->max_price
            ]);
        }

        // Attributes (variants filter)
        if ($request->has('filter')) {
            foreach ($request->filter as $attrName => $values) {
                $productsQuery->whereHas('attributes', function ($q) use ($attrName, $values) {
                    $q->where('name', $attrName)
                        ->whereIn('value_id', $values);
                });
            }
        }

        // Sorting
        switch ($request->get('sort')) {
            case 'price_low_high':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'latest':
            default:
                $productsQuery->latest();
                break;
        }

        // Paginate products
        $products = $productsQuery->paginate(12);

        /**
         * ---- BUILD FILTER DATA ----
         * Example: attributes grouped for sidebar
         */
        $filters = [
            'attributes' => Product::getAvailableAttributes($categoryIds) // custom static function
        ];

        return view('frontend.products', compact(
            'category',
            'parentCategories',
            'products',
            'filters'
        ));
    }







    // public function allProductsPage(Request $request)
    // {
    //     // --- 1. Get all categories with children (subcategories) ---
    //     $parentCategories = Category::with('children')->whereNull('parent_id')->get();

    //     // --- 2. Get all attributes with their values ---
    //     $attributes = Attribute::with('values')->get();

    //     // --- 3. Get all products with relationships, paginated ---
    //     $products = Product::with([
    //         'variants.attributeValues.attribute', // variant attribute values
    //         'specifications',                     // product specifications
    //         'cat_info',                           // parent category
    //         'sub_cat_info'                         // child category
    //     ])->paginate(12);

    //     // --- 4. Return view ---
    //     return view('frontendtheme.products', compact('parentCategories', 'attributes', 'products'));
    // }

    public function allProductsPage(Request $request)
{
    $parentCategories = Category::withCount('products')
        ->with('children')
        ->whereNull('parent_id')
        ->get();

    $attributes = Attribute::with('values')->get();

    $query = Product::with(['variants.attributeValues.attribute', 'specifications', 'cat_info', 'sub_cat_info']);

    // Filter by attributes
    if ($request->filled('attributes')) {
        $selectedValues = collect($request->input('attributes'))->flatten()->toArray();
        $query->whereHas('variants.attributeValues', function ($q) use ($selectedValues) {
            $q->whereIn('attribute_value_id', $selectedValues);
        });
    }

    // Filter by category
    if ($request->filled('category')) {
        $query->whereHas('cat_info', function ($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    $products = $query->paginate(6)->appends($request->query());

    return view('frontendtheme.products', compact('parentCategories', 'attributes', 'products'));
}

}
