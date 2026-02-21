<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\CarType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'BMW' => ['Sedan', 'SUV', 'Coupe', 'Convertible'],
            'Audi' => ['Sedan', 'SUV', 'Hatchback'],
            'Mercedes-Benz' => ['Sedan', 'SUV', 'Coupe', 'Convertible'],
            'Toyota' => ['Sedan', 'SUV', 'Hatchback', 'Hybrid'],
            'Volkswagen' => ['Hatchback', 'SUV', 'Sedan'],
            'Ford' => ['Hatchback', 'SUV', 'Pickup'],
            'Tesla' => ['Sedan', 'SUV'],
            'Hyundai' => ['SUV', 'Hatchback', 'Sedan'],
            'Kia' => ['SUV', 'Hatchback', 'Sedan'],
            'Nissan' => ['SUV', 'Hatchback'],
        ];

        foreach ($brands as $brandName => $types) {
            $brand = Brand::firstOrCreate(
                ['name' => $brandName],
                [
                    'is_active' => true,
                    // 'logo_path' => null, // Can add dummy logo path if needed
                ]
            );

            foreach ($types as $typeName) {
                CarType::firstOrCreate(
                    [
                        'name' => $typeName,
                        'brand_id' => $brand->id,
                    ],
                    [
                        'is_active' => true,
                        // 'image_path' => null,
                    ]
                );
            }
        }
    }
}
