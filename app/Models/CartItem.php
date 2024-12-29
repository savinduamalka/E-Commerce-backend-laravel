<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Cart;
use App\Models\Product;

class CartItem extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
        'total'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Accessor to get the discounted price
    public function getPriceAttribute($value)
    {
        return $this->product->discounted_price ?? $this->product->price;
    }
}
