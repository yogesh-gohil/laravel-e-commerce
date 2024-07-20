<?php

namespace App\Http\Controllers\Shop\Brand;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shop\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __invoke(Request $request)
    {
        $limit = $request->has('limit') ? $request->limit : 'all';

        $categories = Brand::paginateData($limit);

        return BrandResource::collection($categories);
    }
}
