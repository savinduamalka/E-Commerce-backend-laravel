<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Authorization is handled by the admin middleware
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discountedPrice' => 'nullable|numeric|min:0|lt:price',
            'categoryId' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'featured' => 'boolean',
            'imageUrls' => 'required|array|min:1',
            'imageUrls.*' => 'required|url',
        ];
    }
}
