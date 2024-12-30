<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\EnsureUserIsAdmin;
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

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    // User Routes
    Route::get('/user/me', [RegisteredUserController::class, 'show']); // Get own data
    Route::put('/user/me', [RegisteredUserController::class, 'update']); // Update own data

    // Cart routes
    Route::post('/cart', [CartController::class, 'store']);
    Route::get('/cart', [CartController::class, 'show']);
    Route::delete('/cart/{id}', [CartController::class, 'destroy']);
    Route::delete('/cart', [CartController::class, 'destroyCart']);
    Route::post('/orders', [OrderController::class, 'store']);

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

    // Admin Routes
    Route::middleware(EnsureUserIsAdmin::class)->group(function () {
        Route::get('/user', [RegisteredUserController::class, 'index']);
        Route::delete('/user/{id}', [RegisteredUserController::class, 'destroy']);
        Route::get('/admin/stats', [AdminDashboardController::class, 'getStats']);

        // Category routes
        Route::post('/category', [CategoryController::class, 'store']);
        Route::delete('/category/{category}', [CategoryController::class, 'destroy']);
        Route::put('/category/{category}', [CategoryController::class, 'update']);

        // Product routes
        Route::prefix('products')->group(function () {
            Route::post('/', [ProductController::class, 'store']);
            Route::put('/{product}', [ProductController::class, 'update']);
            Route::delete('/{product}', [ProductController::class, 'destroy']);
        });

        // Order routes

        Route::get('/orders', [OrderController::class, 'index']);
        Route::put('/orders/{orderId}/status', [OrderController::class, 'updateStatus']);
        Route::delete('/orders/{orderId}', [OrderController::class, 'destroy']);
    });
});
