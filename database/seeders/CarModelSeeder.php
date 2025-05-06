<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $honda = \App\Models\CarMake::where('name', 'Honda')->first();
        $vw = \App\Models\CarMake::where('name', 'Volkswagen')->first();
        $audi = \App\Models\CarMake::where('name', 'Audi')->first();
        $toyota = \App\Models\CarMake::where('name', 'Toyota')->first();
        $nissan = \App\Models\CarMake::where('name', 'Nissan')->first();

        $models = [
            // Honda Models
            ['car_make_id' => $honda->id, 'name' => 'Fit', 'variant' => 'F'],
            ['car_make_id' => $honda->id, 'name' => 'Fit', 'variant' => 'L'],
            ['car_make_id' => $honda->id, 'name' => 'Fit', 'variant' => 'S'],

            // VW Models
            ['car_make_id' => $vw->id, 'name' => 'Golf', 'variant' => '1.2'],
            ['car_make_id' => $vw->id, 'name' => 'Golf', 'variant' => '1.4'],
            ['car_make_id' => $vw->id, 'name' => 'Golf', 'variant' => 'Variant'],

            // Audi Models
            ['car_make_id' => $audi->id, 'name' => 'A1', 'variant' => null],
            ['car_make_id' => $audi->id, 'name' => 'A3', 'variant' => null],

            // Toyota Models
            ['car_make_id' => $toyota->id, 'name' => 'Prius', 'variant' => null],

            // Nissan Models
            ['car_make_id' => $nissan->id, 'name' => 'Note', 'variant' => null],
        ];

        foreach ($models as $model) {
            \App\Models\CarModel::create($model);
        }
    }
}
