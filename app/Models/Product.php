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


  public function getCoverPhotoAttribute()
  {
    $cover_photo = $this->getMedia('cover_photo')->first();

    if (! $cover_photo) {
        return null;
    }

    if ($cover_photo->disk == 'local') {
        return $cover_photo->getPath();
    }

    if ($cover_photo->disk == 'public') {
        return $cover_photo->getFullUrl();
    }
  }

  public function getProductPhotosAttribute()
  {
    $photos = $this->getMedia('product_photos');

    if ($photos) {
        foreach ($photos as $image) {
            $image->url = $image->getFullUrl();
        }
    }

    return $photos;
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

    $product = self::create($payload);

    if ($request->hasFile('cover_photo') && request()->file('cover_photo')->isValid()) {
        $product->addMediaFromRequest('cover_photo')->toMediaCollection('cover_photo');
    }

    if ($request->hasFile('photos')) {
        $product->addMultipleMediaFromRequest(['photos'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('product_photos');
            });
    }

    return $product;
  }

}
