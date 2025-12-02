<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|string',
        ]);

        $category = Category::create($data);
        Cache::forget('categories_all');

        return response()->json([
            'category' => $category
        ], 201);
    }
    public function index()
    {
        $categories = Cache::remember('categories_all', 3600, function () {
            return Category::all();
        });
        return CategoryResource::collection($categories);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        Cache::forget('categories_all');
        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }
    public function update(Category $category)
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|string',
        ]);

        $category->update($data);
        Cache::forget('categories_all');

        return response()->json([
            'category' => $category
        ]);
    }
}
