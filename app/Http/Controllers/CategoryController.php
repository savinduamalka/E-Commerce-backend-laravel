<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|string',
        ]);

        $category = Category::create($data);

        return response()->json([
            'category' => $category
        ], 201);
    }
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }
}
