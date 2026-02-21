<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Car;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalCars' => Car::count(),
            'totalBrands' => Brand::count(),
            'totalUsers' => User::count(),
            'totalSales' => Car::where('status', 'sold')->sum('selling_price'),
            'recentCars' => Car::with('brand', 'model')->latest()->take(5)->get(),
        ])->layout('layouts.admin');
    }
}
