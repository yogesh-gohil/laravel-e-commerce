<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Category extends Model implements HasMedia
{
  use HasFactory;
  use InteractsWithMedia;

    use NodeTrait, Sluggable {
        NodeTrait::replicate as replicateNodeTrait;
        Sluggable::replicate as replicateSluggable;
    }

    public function replicate(array $except = null)
    {
        $this->replicateNodeTrait();
        $this->replicateSluggable();
    }

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
      $image = $this->getMedia('categories')->first();

      if (! $image) {
          return null;
      }
      return $image;
  }

  public static function createCategory($payload)
  {
    $category = self::create($payload);

    if (request()->hasFile('image') && request()->file('image')->isValid()) {
      $category->addMediaFromRequest('image')->toMediaCollection('categories');
    }

    return $category;
  }

  public function updateCategory($payload)
  {
    $this->update($payload);

    if (isset($payload['image']) && ($payload['image'] === null || $payload['image'] === 'null')) {
      $this->clearMediaCollection('categories');
    }

    if (request()->hasFile('image')) {
        $this->clearMediaCollection('categories');

        $this->addMediaFromRequest('image')
          ->toMediaCollection('categories');
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
