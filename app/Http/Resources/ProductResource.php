<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'discountedPrice' => $this->discounted_price,
            'stock' => $this->stock,
            'featured' => $this->featured,
            'categoryId' => $this->when($this->category, function () {
                return $this->category->id;
            }),
            'categoryName' => $this->when($this->category, function () {
                return $this->category->name;
            }),
            'imageUrls' => $this->whenLoaded('images', function () {
                return $this->images->pluck('url')->toArray();
            }),
        ];
    }
}
