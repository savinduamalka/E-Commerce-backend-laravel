<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function getStats()
    {
        try {
            $stats = [
                'total_users' => User::count(),
                'total_categories' => Category::count(),
                'total_products' => Product::count(),
                'total_cart_items' => Cart::count(),
            ];

            return response()->json($stats, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch stats'], 500);
        }
    }
}
