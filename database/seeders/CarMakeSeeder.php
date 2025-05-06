<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarMakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $makes = [
            ['name' => 'Honda', 'description' => 'Japanese automobile manufacturer'],
            ['name' => 'Volkswagen', 'description' => 'German automobile manufacturer'],
            ['name' => 'Audi', 'description' => 'German automobile manufacturer'],
            ['name' => 'Toyota', 'description' => 'Japanese automobile manufacturer'],
            ['name' => 'Nissan', 'description' => 'Japanese automobile manufacturer'],
        ];

        foreach ($makes as $make) {
            \App\Models\CarMake::create($make);
        }
    }
}
