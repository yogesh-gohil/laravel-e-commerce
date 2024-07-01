<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $limit = $request->has('limit') ? $request->limit : 10;

      $banners = Banner::latest()->paginateData($limit);

      return BannerResource::collection($banners);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
      $payload = $request->getBannerPayload();

      $banner = Banner::createBanner($payload);

      return new BannerResource($banner);
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
      return new BannerResource($banner);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, Banner $banner)
    {

      $payload = $request->getBannerPayload();

      $banner->updateBanner($payload);

      return new BannerResource($banner);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
      $banner->delete();

      return response()->json([
        'success' => true,
        'message' => 'Banner deleted successfully'
      ]);
    }
}
