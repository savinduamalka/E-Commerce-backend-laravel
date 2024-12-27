<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'featured' => $product->featured,
                    'price' => $product->price,
                    'discountedPrice' => $product->discounted_price,
                    'stock' => $product->stock,
                    'categoryName' => $product->category->name,
                    'categoryId' => $product->category->id,
                    'image' => $product->image,
                ];
            }),
        ];
    }
}
