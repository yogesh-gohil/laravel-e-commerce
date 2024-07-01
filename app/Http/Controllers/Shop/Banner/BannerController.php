<?php

namespace App\Http\Controllers\Shop\Banner;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shop\BannerResource;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __invoke(Request $request)
    {
        $banner = Banner::where('active', 1)->get();

        return BannerResource::collection($banner);
    }
}
