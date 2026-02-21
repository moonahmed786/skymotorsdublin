<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::firstOrCreate(
            ['email' => 'admin@skymotorsdublin.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('admin123'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('Super Admin');

        $sales = \App\Models\User::firstOrCreate(
            ['email' => 'sales@skymotorsdublin.com'],
            [
                'name' => 'Sales Rep',
                'password' => bcrypt('sales123'),
                'email_verified_at' => now(),
            ]
        );
        $sales->assignRole('Sales Rep');
    }
}
