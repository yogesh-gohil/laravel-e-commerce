<?php

use App\Http\Controllers\Shop\Auth\LoginController;
use App\Http\Controllers\Shop\Banner\BannerController;
use App\Http\Controllers\Shop\Brand\BrandController;
use App\Http\Controllers\Shop\Category\CategoryController;
use App\Http\Controllers\Shop\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class);


// Route::post('forgot-password', ForgotPasswordController::class);

// Route::post('password/reset', ResetPasswordController::class);

// Route::get('/search', SearchController::class);

// Product Routes
//----------------------------------

Route::get('/products/{product:slug}', [ProductController::class, 'show']);

Route::get('/products', [ProductController::class, 'index']);

// Category Routes
Route::get('/categories', CategoryController::class);

// Brand Routes
Route::get('/brands', BrandController::class);

// Banner Routes
Route::get('/banner', BannerController::class);

