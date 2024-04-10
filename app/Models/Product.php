<?php

namespace App\Models;

use App\Builders\ProductBuilder;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
  use InteractsWithMedia;
  use HasFactory;
  use Sluggable;
  use SoftDeletes;


  protected $guarded = [
    'id'
  ];

  protected $casts = [
    'price' => 'float',
    'compare_price' => 'float',
  ];

  public function sluggable(): array
  {
    return [
        'slug' => [
            'source' => 'name'
        ]
    ];
  }

  public function newEloquentBuilder($builder)
  {
    return new ProductBuilder($builder);
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public static function createProduct($request) {
    $payload = $request->getProductPayload();

  }

}
