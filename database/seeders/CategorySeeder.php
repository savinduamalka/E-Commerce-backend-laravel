<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'SUV',
                'description' => 'Sport Utility Vehicles suitable for Sri Lankan roads and off-road adventures.',
                'image' => 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'name' => 'Sedan',
                'description' => 'Comfortable and stylish sedans for city driving and long-distance travel.',
                'image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'name' => 'Hatchback',
                'description' => 'Compact and fuel-efficient cars, perfect for Colombo traffic.',
                'image' => 'https://images.unsplash.com/photo-1503376763036-066120622c74?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'name' => 'Kei Car',
                'description' => 'Small, economical Japanese cars highly popular in Sri Lanka.',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Suzuki_Wagon_R_Hybrid_FX_%28MH55S%29_front.jpg/640px-Suzuki_Wagon_R_Hybrid_FX_%28MH55S%29_front.jpg',
            ],
            [
                'name' => 'Crossover',
                'description' => 'A mix of SUV and Hatchback features, offering style and practicality.',
                'image' => 'https://images.unsplash.com/photo-1550355291-bbee04a92027?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'name' => 'Van',
                'description' => 'Spacious vehicles for tourism, staff transport, and large families.',
                'image' => 'https://images.unsplash.com/photo-1532623034135-41c6d54ac824?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'name' => 'Pickup Truck',
                'description' => 'Rugged vehicles for commercial use and rough terrains.',
                'image' => 'https://images.unsplash.com/photo-1566008885218-90abf9200ddb?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'name' => 'Luxury',
                'description' => 'Premium vehicles for the ultimate driving experience and status.',
                'image' => 'https://images.unsplash.com/photo-1563720223185-11003d516935?q=80&w=800&auto=format&fit=crop',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'description' => $category['description'],
                'image' => $category['image'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
