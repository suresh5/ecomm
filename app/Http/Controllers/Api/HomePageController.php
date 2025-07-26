<?php 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;

class HomePageController extends Controller
{
    public function index()
    {
        // 🔥 Breaking
        $breakingPosts = PostResource::collection(
            Post::with(['author', 'category.parent'])
                ->where('is_featured', 1)
                ->where('status', 'published')
                ->latest('published_at')
                ->take(5)
                ->get()
        );

        // ⭐ Trending
        $trending = [
            'articles' => PostResource::collection(
                Post::with(['author', 'category.parent'])
                    ->where('is_featured', 1)
                    ->where('status', 'published')
                    ->where('content_type', 'article')
                    ->latest('published_at')
                    ->take(10)
                    ->get()
            ),
            'videos' => PostResource::collection(
                Post::with(['author', 'category.parent'])
                    ->where('is_featured', 1)
                    ->where('status', 'published')
                    ->where('content_type', 'video')
                    ->latest('published_at')
                    ->take(10)
                    ->get()
            ),
            'shorts' => PostResource::collection(
                Post::with(['author', 'category.parent'])
                    ->where('is_featured', 1)
                    ->where('status', 'published')
                    ->where('content_type', 'short')
                    ->latest('published_at')
                    ->take(10)
                    ->get()
            ),
        ];

        // 🏠 Homepage Categories with mixed and sorted posts
        $homepageCategories = Category::where('ishomepage', 1)
            ->where('status', 'active')
            ->get()
            ->map(function ($category) {
                $categoryIds = $category->is_parent
                    ? Category::where('parent_id', $category->id)
                        ->pluck('id')
                        ->push($category->id)
                        ->toArray()
                    : [$category->id];

                return [
                    'id' => $category->id,
                    'title' => $category->title,
                    'slug' => $category->slug,
                    'position' => $category->position,

                    'articles' => PostResource::collection(
                        Post::with(['author', 'category.parent'])
                            ->whereIn('category_id', $categoryIds)
                            ->where('content_type', 'article')
                            ->where('status', 'published')
                            ->inRandomOrder()
                            ->take(20)
                            ->get()
                            ->sortByDesc('published_at')
                            ->take(10)
                    ),
                    'videos' => PostResource::collection(
                        Post::with(['author', 'category.parent'])
                            ->whereIn('category_id', $categoryIds)
                            ->where('content_type', 'video')
                            ->where('status', 'published')
                            ->inRandomOrder()
                            ->take(20)
                            ->get()
                            ->sortByDesc('published_at')
                            ->take(10)
                    ),
                    'shorts' => PostResource::collection(
                        Post::with(['author', 'category.parent'])
                            ->whereIn('category_id', $categoryIds)
                            ->where('content_type', 'short')
                            ->where('status', 'published')
                            ->inRandomOrder()
                            ->take(20)
                            ->get()
                            ->sortByDesc('published_at')
                            ->take(10)
                    ),
                ];
            });

        return response()->json([
            'breaking' => $breakingPosts,
            'sidebar_breaking' => $breakingPosts,
            'trending' => $trending,
            'homepage_categories' => $homepageCategories,
        ]);
    }
}
