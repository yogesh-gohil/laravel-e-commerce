<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'name' => $this->name,
          'banner' => $this->banner,
          'heading' => $this->heading,
          'banner_url' => $this->banner->original_url ?? null,
          'action_url' => $this->action_url,
        ];
    }
}
