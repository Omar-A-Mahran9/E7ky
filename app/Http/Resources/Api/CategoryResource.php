<?php

namespace App\Http\Resources\Api;

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
            "id" => $this->id,
            "image" => $this->full_image_path,
            "name" => $this->name,
            "products_count" => $this->products_count,
            "subcategories" => SubcategoryResource::collection($this->whenLoaded("subcategories")),
        ];
    }
}
