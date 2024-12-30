<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    public function index()
    {
        return new ProductCollection(
            Product::with(['category'])->paginate(12)
        );
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

        // Load relationships and return response
        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product->load(['category'])
        ], 201);
    }

    public function show(Product $product)
    {
        return new ProductResource(
            $product->load(['category'])
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

        return response()->json([
            'message' => 'Product updated successfully',
            'data' =>  new ProductResource($product->load(['category']))
        ]);
    }

    public function destroy(Product $product)
    {
        // Delete the product
        $product->delete();

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
