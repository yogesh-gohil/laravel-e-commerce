<?php

use App\Http\Controllers\Shop\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class);


// Route::post('forgot-password', ForgotPasswordController::class);

// Route::post('password/reset', ResetPasswordController::class);

// Route::get('/search', SearchController::class);

// Product Routes
//----------------------------------

// Route::get('/products/{product}', ProductController::class);

// Route::get('/products', ProductsController::class);

