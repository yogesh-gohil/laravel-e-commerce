<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
          'name' => $this->name,
          'slug' => $this->slug,
          'description' => $this->description,
          'cover_photo' => $this->cover_photo,
          'cover_url' => $this->cover_photo->original_url ?? null,
          'photos' => $this->product_photos,
          'price' => $this->price,
          'sale_price' => $this->sale_price,
          'stock' => $this->stock,
          'unavailable' => $this->unavailable,
          'is_featured' => $this->is_featured,
          'category' => $this->category,
          'category_id' => $this->category_id,
          'created_at' => $this->created_at,
        ];
    }
}
