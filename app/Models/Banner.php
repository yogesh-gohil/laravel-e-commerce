<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Banner extends Model implements HasMedia
{
  use HasFactory;
  use InteractsWithMedia;

  protected $guarded = ['id'];

  protected $casts = [
    'active' => 'boolean',
  ];

  public function getBannerAttribute()
  {
      $banner = $this->getMedia('banner')->first();

      if (! $banner) {
          return null;
      }
      return $banner;
  }

  public static function createBanner($payload)
  {
    $banner = self::create($payload);

    if (request()->hasFile('image') && request()->file('image')->isValid()) {
      $banner->addMediaFromRequest('image')->toMediaCollection('banner');
    }

    return $banner;
  }

  public function updateBanner($payload)
  {
    $this->update($payload);

    if($this->active) {
        Banner::where('id', '<>' , $this->id)->update(['active' => false]);
    }

    if (isset($payload['image']) && ($payload['image'] === null || $payload['image'] === 'null')) {
      $this->clearMediaCollection('banner');
    }

    if (request()->hasFile('image')) {
        $this->clearMediaCollection('banner');

        $this->addMediaFromRequest('image')
          ->toMediaCollection('banner');
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
