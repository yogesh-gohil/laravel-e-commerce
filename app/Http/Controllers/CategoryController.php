<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $limit = $request->has('limit') ? $request->limit : 10;

      $categories = Category::latest()->paginateData($limit);

      return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
      $payload = $request->getCategoryPayload();

      $category = Category::createCategory($payload);

      return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
      return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {

      $payload = $request->getCategoryPayload();

      $category->updateCategory($payload);

      return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
      $category->delete();

      return response()->json([
        'success' => true,
        'message' => 'Category deleted successfully'
      ]);
    }
}
