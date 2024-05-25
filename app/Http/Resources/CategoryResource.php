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
          'name' => $this->name,
          'image' => $this->image,
          'cover_url' => $this->image->original_url ?? null,
          'parent_id' => $this->parent_id,
          'created_at' => $this->created_at,
        ];
    }
}
