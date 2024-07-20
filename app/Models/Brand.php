<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Brand extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getImageAttribute()
    {
        $image = $this->getMedia('brands')->first();

        if (! $image) {
            return null;
        }
        return $image;
    }

    public static function createBrand($payload)
    {
        $brand = self::create($payload);

        if (request()->hasFile('image') && request()->file('image')->isValid()) {
            $brand->addMediaFromRequest('image')->toMediaCollection('brands');
        }

        return $brand;
    }

    public function updateCategory($payload)
    {
      $this->update($payload);

      if (isset($payload['image']) && ($payload['image'] === null || $payload['image'] === 'null')) {
        $this->clearMediaCollection('brands');
      }

      if (request()->hasFile('image')) {
          $this->clearMediaCollection('brands');

          $this->addMediaFromRequest('image')
            ->toMediaCollection('brands');
      }

      return $this;
    }

    public function scopePaginateData($query, $limit)
    {
      if ($limit == 'all') {
        return $query->get();
      }

      return $query->paginate($limit);
    }

}
