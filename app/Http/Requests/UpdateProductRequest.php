<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Authorization is handled by the admin middleware
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'discountedPrice' => 'nullable|numeric|min:0|lt:price',
            'categoryId' => 'sometimes|exists:categories,id',
            'stock' => 'sometimes|integer|min:0',
            'featured' => 'sometimes|boolean',
            'imageUrls' => 'sometimes|array|min:1',
            'imageUrls.*' => 'required_with:imageUrls|url',
        ];
    }
}
