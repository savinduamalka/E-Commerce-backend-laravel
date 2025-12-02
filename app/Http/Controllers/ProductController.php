<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index()
    {
        $page = request()->get('page', 1);
        return Cache::remember('products_page_' . $page, 600, function () {
            return new ProductCollection(
                Product::with(['category'])->paginate(12)
            );
        });
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        // Create the product
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'discounted_price' => $validated['discountedPrice'] ?? null,
            'category_id' => $validated['categoryId'],
            'stock' => $validated['stock'],
            'image' => $validated['image'], 
        ]);

        // Clear cache
        Cache::flush();

        // Load relationships and return response
        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product->load(['category'])
        ], 201);
    }

    public function show(Product $product)
    {
        return new ProductResource(
            $product->load(['category', 'images'])
        );
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        // Update basic product details
        $product->fill([
            'name' => $validated['name'] ?? $product->name,
            'description' => $validated['description'] ?? $product->description,
            'price' => $validated['price'] ?? $product->price,
            'discounted_price' => $validated['discountedPrice'] ?? $product->discounted_price,
            'category_id' => $validated['categoryId'] ?? $product->category_id,
            'stock' => $validated['stock'] ?? $product->stock,
            'image' => $validated['image'] ?? $product->image, 
        ])->save();

        // Clear cache
        Cache::flush();

        return response()->json([
            'message' => 'Product updated successfully',
            'data' =>  new ProductResource($product->load(['category']))
        ]);
    }

    public function destroy(Product $product)
    {
        // Delete the product
        $product->delete();

        // Clear cache
        Cache::flush();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }

    public function byCategory($categoryId)
    {
        return new ProductCollection(
            Product::with(['category'])
                ->where('category_id', $categoryId)
                ->get()
        );
    }
}
