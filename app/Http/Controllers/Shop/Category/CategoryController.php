<?php

namespace App\Http\Controllers\Shop\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shop\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __invoke(Request $request)
    {
        $limit = $request->has('limit') ? $request->limit : 'all';

        $categories = Category::all()->paginateData($limit);;

        return CategoryResource::collection($categories);
    }
}
