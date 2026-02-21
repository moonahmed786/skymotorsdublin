<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CarSeeder extends Seeder
{
    public function run()
    {
        // Ensure Brands and Types exist
        if (\App\Models\Brand::count() == 0) {
            $this->call(BrandSeeder::class);
        }

        $brands = \App\Models\Brand::with('carTypes')->get();
        $colors = ['Black', 'White', 'Silver', 'Grey', 'Blue', 'Red', 'Green'];
        $fuelTypes = ['petrol', 'diesel', 'hybrid', 'electric'];
        $transmissions = ['manual', 'automatic'];

        $adminUser = \App\Models\User::first() ?? \App\Models\User::factory()->create();


        for ($i = 0; $i < 50; $i++) {
            $brand = $brands->random();
            $type = $brand->carTypes->isNotEmpty() ? $brand->carTypes->random() : null;

            if (!$type)
                continue;

            DB::table('cars')->insert([
                'brand_id' => $brand->id,
                'car_type_id' => $type->id,
                'registration_number' => rand(181, 251) . '-D-' . rand(1000, 99999),
                'chassis_number' => strtoupper(Str::random(17)),
                'year_of_manufacture' => rand(2018, 2025),
                'color' => $colors[array_rand($colors)],
                'engine_size' => rand(10, 30) / 10 . 'L',
                'fuel_type' => $fuelTypes[array_rand($fuelTypes)],
                'transmission' => $transmissions[array_rand($transmissions)],
                // 'price' removed
                'selling_price' => rand(15000, 85000),
                'purchasing_price' => rand(10000, 70000),
                'mileage' => rand(5000, 150000),
                'status' => 'available',
                'description' => 'A great car directly from the manufacturer.',
                'is_published' => true,
                'number_of_owners' => rand(1, 3),
                'nct_expiry_date' => now()->addMonths(rand(1, 24)),

                // Missing required columns added
                'nct_status' => 'valid',
                'radio_status' => 'working',
                'paint_condition' => 'good',
                'valet_status' => 'completed',
                'tyre_condition' => 'good',
                'back_camera_status' => 'working',
                'created_by' => $adminUser->id,
                'updated_by' => $adminUser->id,

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
