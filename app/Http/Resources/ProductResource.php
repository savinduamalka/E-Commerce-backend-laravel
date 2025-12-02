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
            'categoryId' => $this->when($this->category, function () {
                return $this->category->id;
            }),
            'categoryName' => $this->when($this->category, function () {
                return $this->category->name;
            }),
            'image' => $this->image,
            'images' => $this->whenLoaded('images'),
        ];
    }
}
