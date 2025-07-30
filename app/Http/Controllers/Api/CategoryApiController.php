<?php 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryChildResource;
class CategoryApiController extends Controller
{
    // 1. List all categories with their subcategories
    public function index()
    {
        // $categories = Category::where('is_parent', 1)
        //     ->where('status', 'active')
        //     ->with(['children' => function ($q) {
        //         $q->where('status', 'active');
        //     }])
        //     ->get();

        // return CategoryResource::collection($categories);

            $categories = Category::where('is_parent', 1)
            ->where('status', 'active')
            ->with(['children' => function ($q) {
            $q->where('status', 'active')->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();

            $grouped = [];

            foreach ($categories as $category) {
            $positions = explode(',', $category->menu_position);

            foreach ($positions as $position) {
            $position = trim($position);

            if (!isset($grouped[$position])) {
            $grouped[$position] = [];
            }

            $grouped[$position][] = new CategoryResource($category);
            }
            }

            return response()->json([
            'status' => true,
            'data' => $grouped
            ]);
    }

    // 2. List only subcategories of a given parent category
    public function subcategories($id)
    {
      // Find the main category by slug
    $category = Category::where('slug', $slug)
        ->where('is_parent', 1)
        ->where('status', 'active')
        ->firstOrFail();

    // Get subcategories for the category
    $subcategories = Category::where('parent_id', $category->id)
        ->where('status', 'active')
        ->get();

        return CategoryChildResource::collection($subcategories);
    }

   public function posts(Request $request, $slug)
    {
        $category = Category::with('parent')->where('slug', $slug)->firstOrFail();

        $subcategories = $category->is_parent
            ? Category::where('parent_id', $category->id)
                ->where('status', 'active')
                ->get(['id', 'title', 'slug', 'photo', 'position', 'sidebar'])
            : collect();

        $categoryIds = $category->is_parent
            ? $subcategories->pluck('id')->push($category->id)->toArray()
            : [$category->id];

        $perPage = $request->get('per_page', 10);
        $type = $request->get('type');

        if ($type) {
            // 🔍 Filter by content_type
            $posts = Post::with(['author', 'category.parent'])
                ->whereIn('category_id', $categoryIds)
                ->where('status', 'published')
                ->where('content_type', $type)
                ->latest('published_at')
                ->paginate($perPage);

            return response()->json([
                'category' => [
                    'id' => $category->id,
                    'name' => $category->title,
                    'slug' => $category->slug,
                    'photo' => $category->photo,
                    'parent' => $category->parent_id ? [
                        'id' => $category->parent->id ?? null,
                        'name' => $category->parent->title ?? null,
                        'slug' => $category->parent->slug ?? null,
                    ] : null,
                ],
                'posts' => PostResource::collection($posts)->response()->getData(true),
                'subcategories' => $subcategories,
            ]);
        }

        // No `type` → return all blocks
        $pageArticle = $request->get('page_article', 1);
        $pageVideo = $request->get('page_video', 1);
        $pageShort = $request->get('page_short', 1);
        $pageImage = $request->get('page_image', 1);

        return response()->json([
            'category' => [
                'id' => $category->id,
                'name' => $category->title,
                'slug' => $category->slug,
                'photo' => $category->photo,
                'parent' => $category->parent_id ? [
                    'id' => $category->parent->id ?? null,
                    'name' => $category->parent->title ?? null,
                    'slug' => $category->parent->slug ?? null,
                ] : null,
            ],
            'articles' => PostResource::collection(
                Post::with(['author', 'category.parent'])
                    ->whereIn('category_id', $categoryIds)
                    ->where('status', 'published')
                    ->where('content_type', 'article')
                    ->latest('published_at')
                    ->paginate($perPage, ['*'], 'page_article', $pageArticle)
            )->response()->getData(true),

            'videos' => PostResource::collection(
                Post::with(['author', 'category.parent'])
                    ->whereIn('category_id', $categoryIds)
                    ->where('status', 'published')
                    ->where('content_type', 'video')
                    ->latest('published_at')
                    ->paginate($perPage, ['*'], 'page_video', $pageVideo)
            )->response()->getData(true),

            'shorts' => PostResource::collection(
                Post::with(['author', 'category.parent'])
                    ->whereIn('category_id', $categoryIds)
                    ->where('status', 'published')
                    ->where('content_type', 'short')
                    ->latest('published_at')
                    ->paginate($perPage, ['*'], 'page_short', $pageShort)
            )->response()->getData(true),

            'images' => PostResource::collection(
                Post::with(['author', 'category.parent'])
                    ->whereIn('category_id', $categoryIds)
                    ->where('status', 'published')
                    ->where('content_type', 'image')
                    ->latest('published_at')
                    ->paginate($perPage, ['*'], 'page_image', $pageImage)
            )->response()->getData(true),

            'subcategories' => $subcategories,
        ]);
    }
}
