<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Category extends Model implements HasMedia
{
  use NodeTrait;
  use HasFactory;
  use InteractsWithMedia;


  protected $guarded = ['id'];

  public function getImageAttribute()
  {
      $image = $this->getMedia('categories')->first();

      if (! $image) {
          return null;
      }

      if ($image->disk == 'local') {
          return $image->getPath();
      }

      if ($image->disk == 'public') {
          return $image->getFullUrl();
      }
  }

  public static function createCategory($payload)
  {
    $category = self::create($payload);

    if (request()->hasFile('image') && request()->file('image')->isValid()) {
      $category->addMediaFromRequest('image')->toMediaCollection('categories');
    }

    return $category;
  }

  public function scopePaginateData($query, $limit)
  {
    if ($limit == 'all') {
      return $query->get();
    }

    return $query->paginate($limit);
  }
}
