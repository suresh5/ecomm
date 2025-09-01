<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
   public function show($slug)
    {
        $post = Post::with(['author', 'category.parent'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $category = $post->category;
        $parent = $category?->parent;

        // ✅ Related category ID(s)
        $categoryIds = $parent
            ? [$parent->id, $category->id] // subcategory + main
            : [$category->id]; // main only

        // 🔄 Get related posts (exclude current post)
        $relatedPosts = Post::with(['author', 'category.parent'])
            ->where('status', 'published')
            ->whereIn('category_id', $categoryIds)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(6)
            ->get();

        return response()->json([
            'post' => new PostResource($post),
            'related_posts' => PostResource::collection($relatedPosts),
        ]);
    }

     public function index(Request $request)
    {
        $type = $request->get('type', 'article');
        $perPage = $request->get('per_page', 10);
        $groupBy = $request->boolean('group_by_category');

        if ($groupBy) {
            // 🧠 Grouped by category
            $categories = Category::where('status', 'active')
                ->whereHas('posts', function ($query) use ($type) {
                    $query->where('status', 'published')
                          ->where('content_type', $type);
                })
                ->with(['posts' => function ($query) use ($type) {
                    $query->where('status', 'published')
                          ->where('content_type', $type)
                          ->with(['author', 'category.parent'])
                          ->latest('published_at')
                          ->take(10); // limit per category block
                }])
                ->get();

            // 🎯 Transform into structured response
            $data = $categories->map(function ($cat) {
                return [
                    'category' => [
                        'id' => $cat->id,
                        'name' => $cat->title,
                        'slug' => $cat->slug,
                    ],
                    'posts' => PostResource::collection($cat->posts),
                ];
            });

            return response()->json([
                'grouped_by_category' => true,
                'content_type' => $type,
                'data' => $data,
            ]);
        }

        // 🔄 Flat paginated listing
        $posts = Post::with(['author', 'category.parent'])
            ->where('status', 'published')
            ->where('content_type', $type)
            ->latest('published_at') // Or ->inRandomOrder()
            ->paginate($perPage);

        return response()->json(
            PostResource::collection($posts)->response()->getData(true)
        );
    }
}

