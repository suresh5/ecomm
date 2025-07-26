<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $category = $this->category;

        $isMainCategory = $category && is_null($category->parent_id);

        $main = $isMainCategory
            ? $category
            : optional($category->parent);

        $sub = $isMainCategory
            ? null
            : $category;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'thumbnail' => $this->thumbnail,
            'cover' => $this->cover,
            'asset_url'=>$this->asset_url,
            'short_description' => $this->short_description,
            'content_type' => $this->content_type,
            'article_type' => $this->article_type,
            'views' => $this->views,
            'likes' => $this->likes,
            'shares' => $this->shares,
            'published_at' => $this->published_at,
            'author' => new UserResource($this->whenLoaded('author')),
             'main_category' => $main ? [
                'name' => $main->title,
                'slug' => $main->slug,
            ] : null,

            'subcategory' => $sub ? [
                'name' => $sub->title,
                'slug' => $sub->slug,
            ] : null,
        ];
    }
}
