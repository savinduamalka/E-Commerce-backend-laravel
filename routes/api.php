<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminDashboardController;

// Authentication Routes
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Product Routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{product}', [ProductController::class, 'show'])
        ->missing(fn() => response()->json(['message' => 'Product not found'], 404));
    Route::get('/category/{categoryId}', [ProductController::class, 'byCategory'])
        ->missing(fn() => response()->json(['message' => 'Category not found'], 404));
});


// Category Routes
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
});


Route::get('/featured-products', [ProductController::class, 'featured']);

//  Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    // User Routes
    Route::get('/user', [RegisteredUserController::class, 'index']);
    Route::get('/user/me', [RegisteredUserController::class, 'show']); // Get own data
    Route::put('/user/me', [RegisteredUserController::class, 'update']); // Update own data
    Route::delete('/user/{id}', [RegisteredUserController::class, 'destroy']);

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

    // Admin Routes
    Route::get('/admin/stats', [AdminDashboardController::class, 'getStats']);

     // category
    Route::post('/category', [CategoryController::class, 'store']);
    Route::delete('/category/{category}', [CategoryController::class, 'destroy']);
    Route::put('/category/{category}', [CategoryController::class, 'update']);

    // product
    Route::middleware(EnsureUserIsAdmin::class)->prefix('products')->group(function () {
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{product}', [ProductController::class, 'update']);
        Route::delete('/{product}', [ProductController::class, 'destroy']);
    });
});
