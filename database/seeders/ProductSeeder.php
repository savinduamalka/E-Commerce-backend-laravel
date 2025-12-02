<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch Categories
        $categories = Category::all()->pluck('id', 'name');

        $products = [
            // Kei Cars
            [
                'name' => 'Suzuki Spacia Custom XS Turbo 2025',
                'category' => 'Kei Car',
                'price' => 12.2,
                'discounted_price' => null,
                'stock' => 5,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/Suzuki_Spacia_Custom_Hybrid_XS_Turbo_%28MK53S%29_front.jpg/640px-Suzuki_Spacia_Custom_Hybrid_XS_Turbo_%28MK53S%29_front.jpg',
                'description' => "Suzuki Spacia XS Custom Turbo 2025\n\nYear of Manufacture 2025\nBrand new\nAuction Grade S\nUnregistered\nLeather heated Steering\nCruise Control\nHead up Display\n4Way Camera\nAuto LED Headlights\nLED Daytime Running Lights\nLED Fog Lights\nOriginal 16” Alloys\nPush Start (Two Smart Keys)\nHalf Leather Seats\nFront Seat Heaters\nDual Climate Control A/C\nArm Rest\n8 Airbags\nCity Active Brake System\nLane Departure Warning System",
                'images' => [
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Suzuki_Spacia_Custom_Hybrid_XS_Turbo_%28MK53S%29_rear.jpg/640px-Suzuki_Spacia_Custom_Hybrid_XS_Turbo_%28MK53S%29_rear.jpg',
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f6/Suzuki_Spacia_Custom_Hybrid_XS_Turbo_%28MK53S%29_interior.jpg/640px-Suzuki_Spacia_Custom_Hybrid_XS_Turbo_%28MK53S%29_interior.jpg'
                ]
            ],
            [
                'name' => 'Suzuki WagonR FZ Premium 2019',
                'category' => 'Kei Car',
                'price' => 9.5,
                'discounted_price' => 9.2,
                'stock' => 10,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Suzuki_Wagon_R_Hybrid_FX_%28MH55S%29_front.jpg/640px-Suzuki_Wagon_R_Hybrid_FX_%28MH55S%29_front.jpg',
                'description' => "Suzuki WagonR FZ Premium 2019\n\nYear of Manufacture 2019\nRegistered 2019\n1st Owner\nSafety Package\nHead Up Display\nPush Start\nKeyless Entry\nAlloy Wheels\nMultifunction Steering\nSeat Heaters\nAuto Brake System\nLane Departure Warning\nRetractable Mirrors\nDVD Reverse Camera\nExcellent Condition",
                'images' => [
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Suzuki_Wagon_R_Hybrid_FZ_%28MH55S%29_rear.jpg/640px-Suzuki_Wagon_R_Hybrid_FZ_%28MH55S%29_rear.jpg'
                ]
            ],

            // Hatchbacks
            [
                'name' => 'Toyota Vitz F Safety 2018',
                'category' => 'Hatchback',
                'price' => 10.5,
                'discounted_price' => null,
                'stock' => 8,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/02/Toyota_Vitz_F_1.0_%28KSP130%29_front.jpg/640px-Toyota_Vitz_F_1.0_%28KSP130%29_front.jpg',
                'description' => "Toyota Vitz F Safety Edition 2018\n\nYear of Manufacture 2018\nUnregistered\n1000cc Engine\nSafety Sense C\nLane Departure Alert\nAutomatic High Beam\nPush Start\nSmart Key\nBeige Interior\nPower Shutters\nPower Mirrors\nWinker Mirrors\nRear Wiper\nOriginal Carpets",
                'images' => [
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Toyota_Vitz_Jewela_1.0_%28KSP130%29_rear.jpg/640px-Toyota_Vitz_Jewela_1.0_%28KSP130%29_rear.jpg'
                ]
            ],
            [
                'name' => 'Toyota Aqua S Grade 2015',
                'category' => 'Hatchback',
                'price' => 11.8,
                'discounted_price' => null,
                'stock' => 12,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/Toyota_Aqua_S_%28NHP10%29_front.jpg/640px-Toyota_Aqua_S_%28NHP10%29_front.jpg',
                'description' => "Toyota Aqua S Grade 2015\n\nYear of Manufacture 2015\nRegistered 2015\nPush Start\nMultifunction Steering\nScoop Lights\nFog Lights\nOriginal Alloy Wheels\nDual Multifunction\nCruise Control\nNanoe Climate Control\nReverse Camera\nDVD Player\nNew Tyres\nHybrid Battery Good",
                'images' => [
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Toyota_Aqua_G_%28NHP10%29_rear.jpg/640px-Toyota_Aqua_G_%28NHP10%29_rear.jpg'
                ]
            ],

            // Sedans
            [
                'name' => 'Toyota Premio G Superior 2018',
                'category' => 'Sedan',
                'price' => 18.5,
                'discounted_price' => null,
                'stock' => 4,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3d/Toyota_Premio_1.8X_L_Package_%28ZRT260%29_front.jpg/640px-Toyota_Premio_1.8X_L_Package_%28ZRT260%29_front.jpg',
                'description' => "Toyota Premio G Superior 2018\n\nYear of Manufacture 2018\nUnregistered\nElectric Seats\nBeige Interior\nTeak Steering\nSafety Sense\nLane Departure Alert\nAuto Braking\nBi-Beam LED Headlights\nFog Lights\nOriginal Alloys\nPush Start\nDual Multifunction\nRear Wiper\nWelcome Lights",
                'images' => [
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/6/63/Toyota_Premio_1.8X_L_Package_%28ZRT260%29_rear.jpg/640px-Toyota_Premio_1.8X_L_Package_%28ZRT260%29_rear.jpg'
                ]
            ],
            [
                'name' => 'Toyota Axio WxB 2017',
                'category' => 'Sedan',
                'price' => 14.5,
                'discounted_price' => 14.2,
                'stock' => 6,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Toyota_Corolla_Axio_Hybrid_G_%28NKE165%29_front.jpg/640px-Toyota_Corolla_Axio_Hybrid_G_%28NKE165%29_front.jpg',
                'description' => "Toyota Axio WxB 2017\n\nYear of Manufacture 2017\nRegistered 2017\nWxB Grade\nBlack Interior\nHalf Leather Seats\nSafety Sense\nLane Departure Alert\nAuto High Beam\nLED Headlights\nFog Lights\nOriginal WxB Alloys\nPush Start\nMultifunction Steering\nClimate Control A/C",
                'images' => [
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/2/22/Toyota_Corolla_Axio_Hybrid_G_%28NKE165%29_rear.jpg/640px-Toyota_Corolla_Axio_Hybrid_G_%28NKE165%29_rear.jpg'
                ]
            ],

            // Crossovers
            [
                'name' => 'Honda Vezel RS Sensing 2016',
                'category' => 'Crossover',
                'price' => 16.5,
                'discounted_price' => null,
                'stock' => 7,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Honda_Vezel_Hybrid_Z_%28RU3%29_front.jpg/640px-Honda_Vezel_Hybrid_Z_%28RU3%29_front.jpg',
                'description' => "Honda Vezel RS Sensing 2016\n\nYear of Manufacture 2016\nRegistered 2016\nRS Grade\nHonda Sensing\nPaddle Shift\nCruise Control\nHalf Leather Seats\nSeat Heaters\nDual Climate Control\n18 Inch RS Alloys\nLED Headlights\nFog Lights\nRoof Rails\nOriginal Setup\nReverse Camera",
                'images' => [
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Honda_Vezel_Hybrid_Z_%28RU3%29_rear.jpg/640px-Honda_Vezel_Hybrid_Z_%28RU3%29_rear.jpg'
                ]
            ],
            [
                'name' => 'Toyota C-HR GT Turbo 2018',
                'category' => 'Crossover',
                'price' => 17.5,
                'discounted_price' => null,
                'stock' => 5,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/Toyota_C-HR_Hybrid_G_%28ZYX10%29_front.jpg/640px-Toyota_C-HR_Hybrid_G_%28ZYX10%29_front.jpg',
                'description' => "Toyota C-HR GT Turbo 2018\n\nYear of Manufacture 2018\nRegistered 2018\n1.2L Turbo Engine\nGT Grade\nTwo Tone Leather Interior\nSafety Sense\nBlind Spot Monitor\nRear Cross Traffic Alert\nLED Headlights\nSequential Turn Signals\nOriginal 18 Inch Alloys\nPush Start\nDual Zone Climate Control",
                'images' => [
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Toyota_C-HR_Hybrid_G_%28ZYX10%29_rear.jpg/640px-Toyota_C-HR_Hybrid_G_%28ZYX10%29_rear.jpg'
                ]
            ],

            // SUVs
            [
                'name' => 'Toyota Land Cruiser Prado TX-L 2018',
                'category' => 'SUV',
                'price' => 65.0,
                'discounted_price' => null,
                'stock' => 2,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/76/Toyota_Land_Cruiser_Prado_%28J150%29_--_08-25-2019.jpg/640px-Toyota_Land_Cruiser_Prado_%28J150%29_--_08-25-2019.jpg',
                'description' => "Toyota Land Cruiser Prado TX-L 2018\n\nYear of Manufacture 2018\nDiesel Turbo\nSunroof\nBeige Leather Interior\nElectric Seats\n7 Seater\nModellista Body Kit\n360 Camera\nCool Box\nHeight Control\nLED Headlights\nHeadlight Washers\n19 Inch Alloys\nPush Start\nSmart Key",
                'images' => [
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/Toyota_Land_Cruiser_Prado_%28J150%29_rear_--_08-25-2019.jpg/640px-Toyota_Land_Cruiser_Prado_%28J150%29_rear_--_08-25-2019.jpg'
                ]
            ],
            [
                'name' => 'Mitsubishi Montero Sport 2016',
                'category' => 'SUV',
                'price' => 38.0,
                'discounted_price' => null,
                'stock' => 3,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/2015_Mitsubishi_Montero_Sport_GLS_V_2.5_Front.jpg/640px-2015_Mitsubishi_Montero_Sport_GLS_V_2.5_Front.jpg',
                'description' => "Mitsubishi Montero Sport 2016\n\nYear of Manufacture 2016\nRegistered 2016\nDiesel Turbo\nPaddle Shift\nLeather Seats\nElectric Seats\nSunroof\nCruise Control\nMultifunction Steering\nReverse Camera\nParking Sensors\nLED Daytime Running Lights\nFog Lights\nSide Steps\nRoof Rails",
                'images' => [
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3e/2015_Mitsubishi_Montero_Sport_GLS_V_2.5_Rear.jpg/640px-2015_Mitsubishi_Montero_Sport_GLS_V_2.5_Rear.jpg'
                ]
            ],

            // Vans
            [
                'name' => 'Toyota Hiace KDH 201 Super GL 2016',
                'category' => 'Van',
                'price' => 24.0,
                'discounted_price' => null,
                'stock' => 5,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Toyota_HiAce_Van_Super_GL_%28H200%29_front.jpg/640px-Toyota_HiAce_Van_Super_GL_%28H200%29_front.jpg',
                'description' => "Toyota Hiace KDH 201 Super GL 2016\n\nYear of Manufacture 2016\nRegistered 2016\nDark Prime\nDiesel Turbo\nDual A/C\nPush Start\nSmart Key\nPower Shutters\nPower Mirrors\nRetractable Mirrors\nReverse Camera\nAlloy Wheels\nAdjustable Seats\nOriginal Carpets",
                'images' => [
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Toyota_HiAce_Van_Super_GL_%28H200%29_rear.jpg/640px-Toyota_HiAce_Van_Super_GL_%28H200%29_rear.jpg'
                ]
            ],

            // Pickups
            [
                'name' => 'Toyota Hilux Revo Rocco 2019',
                'category' => 'Pickup Truck',
                'price' => 26.0,
                'discounted_price' => null,
                'stock' => 4,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/2020_Toyota_Hilux_Invincible_X_D-4D_4WD_Automatic_2.8_Front.jpg/640px-2020_Toyota_Hilux_Invincible_X_D-4D_4WD_Automatic_2.8_Front.jpg',
                'description' => "Toyota Hilux Revo Rocco 2019\n\nYear of Manufacture 2019\nRegistered 2019\n2.8L Diesel Turbo\n4WD\nAutomatic Transmission\nLeather Interior\nElectric Seats\nPush Start\nSmart Key\nCruise Control\nMultifunction Steering\nLED Headlights\nFog Lights\nRoll Bar\nBed Liner",
                'images' => [
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/2/28/2020_Toyota_Hilux_Invincible_X_D-4D_4WD_Automatic_2.8_Rear.jpg/640px-2020_Toyota_Hilux_Invincible_X_D-4D_4WD_Automatic_2.8_Rear.jpg'
                ]
            ],

            // Luxury
            [
                'name' => 'Mercedes-Benz C200 AMG Line 2019',
                'category' => 'Luxury',
                'price' => 42.0,
                'discounted_price' => null,
                'stock' => 2,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Mercedes-Benz_C_200_Avantgarde_%28W_205%29_%E2%80%93_Frontansicht%2C_26._April_2014%2C_D%C3%BCsseldorf.jpg/320px-Mercedes-Benz_C_200.jpg',
                'description' => "Mercedes-Benz C200 AMG Line 2019\n\nYear of Manufacture 2019\nRegistered 2019\nAMG Line\nPanoramic Sunroof\nBurmester Sound System\nElectric Memory Seats\nLeather Interior\nHead Up Display\n360 Camera\nActive Park Assist\nLED High Performance Headlights\n19 Inch AMG Alloys\nAmbient Lighting\n9G-Tronic Gearbox",
                'images' => [
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f7/Mercedes-Benz_C_200_Avantgarde_%28W_205%29_%E2%80%93_Heckansicht%2C_26._April_2014%2C_D%C3%BCsseldorf.jpg/320px-Mercedes-Benz_C_200_rear.jpg'
                ]
            ],
            [
                'name' => 'BMW 520d M Sport 2018',
                'category' => 'Luxury',
                'price' => 45.0,
                'discounted_price' => 43.5,
                'stock' => 2,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/BMW_520d_Luxury_Line_%28G30%29_%E2%80%93_Frontansicht%2C_12._M%C3%A4rz_2017%2C_D%C3%BCsseldorf.jpg/320px-BMW_520d_Luxury_Line.jpg',
                'description' => "BMW 520d M Sport 2018\n\nYear of Manufacture 2018\nRegistered 2018\nM Sport Package\nDiesel Turbo\nSunroof\nHarman Kardon Sound System\nGesture Control\nDigital Key\nSoft Close Doors\nElectric Memory Seats\nLeather Interior\n19 Inch M Alloys\nAdaptive LED Headlights\nHead Up Display",
                'images' => [
                    'https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/BMW_520d_Luxury_Line_%28G30%29_%E2%80%93_Heckansicht%2C_12._M%C3%A4rz_2017%2C_D%C3%BCsseldorf.jpg/320px-BMW_520d_Luxury_Line_rear.jpg'
                ]
            ],
        ];

        foreach ($products as $data) {
            $product = Product::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'discounted_price' => $data['discounted_price'],
                'category_id' => $categories[$data['category']],
                'stock' => $data['stock'],
                'image' => $data['image'],
            ]);

            if (isset($data['images'])) {
                foreach ($data['images'] as $img) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $img
                    ]);
                }
            }
        }
    }
}
