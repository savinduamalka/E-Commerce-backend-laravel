<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Cache;


class AdminDashboardController extends Controller
{
    public function getStats()
    {
        try {
            $stats = Cache::remember('admin_stats', 300, function () {
                return [
                    'total_users' => User::count(),
                    'total_categories' => Category::count(),
                    'total_products' => Product::count(),
                    'total_orders' => Order::count(),
                ];
            });

            return response()->json($stats, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch stats'], 500);
        }
    }
}
