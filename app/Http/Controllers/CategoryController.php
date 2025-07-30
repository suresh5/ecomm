<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
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
    {
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

        // $slug = generateUniqueSlug($request->engname, Category::class);
        // $validatedData['slug'] = $slug;
        $validatedData['is_parent'] = $request->input('is_parent', 0);
        $validatedData['ishomepage'] = $request->has('ishomepage') ? 1 : 0;

        $category = Category::create($validatedData);

        if ($request->has('attribute_values')) {
            $valueIds = collect($request->attribute_values)->flatten()->all(); // [1,2,5,6]
            $category->attributeValues()->sync($valueIds); // Many-to-many relation
        }

        $message = $category
            ? 'Category successfully added'
            : 'Error occurred, Please try again!';

        return redirect()->route('category.index')->with(
            $category ? 'success' : 'error',
            $message
        );
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

        return view('backend.category.edit', compact('category', 'parent_cats','attributeTypes'));
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
}
