<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'engname' => $this->engname,
            'photo' => $this->photo,
            'sidebar' => $this->sidebar,
            'position' => $this->position,
            'subcategories' => CategoryChildResource::collection($this->whenLoaded('children')),
        ];
    }
}
