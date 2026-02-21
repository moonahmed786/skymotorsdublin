<?php

namespace App\Livewire;

use App\Models\Car;
use App\Models\CarMake;
use Livewire\Component;
use Livewire\WithPagination;

class CarListing extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedBrand = '';
    public $selectedCarType = ''; // New filter
    public $minPrice = '';
    public $maxPrice = '';
    public $minYear = '';
    public $maxYear = '';
    public $fuelType = '';
    public $transmission = '';
    public $bodyType = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingSelectedBrand()
    {
        $this->resetPage();
        $this->selectedCarType = ''; // Reset type when brand changes
    }
    public function updatingSelectedCarType()
    {
        $this->resetPage();
    }
    public function updatingMinPrice()
    {
        $this->resetPage();
    }
    public function updatingMaxPrice()
    {
        $this->resetPage();
    }
    public function updatingMinYear()
    {
        $this->resetPage();
    }
    public function updatingMaxYear()
    {
        $this->resetPage();
    }
    public function updatingFuelType()
    {
        $this->resetPage();
    }
    public function updatingTransmission()
    {
        $this->resetPage();
    }
    public function updatingBodyType()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Car::query()
            ->with(['brand', 'type', 'make', 'model', 'images']) // Eager load new and old
            ->where('status', 'available')
            ->where('is_published', true); // Only show published

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('registration_number', 'like', '%' . $this->search . '%')
                    ->orWhereHas('brand', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })->orWhereHas('type', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                    // Legacy fallback
                    ->orWhereHas('make', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })->orWhereHas('model', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        if ($this->selectedBrand) {
            $query->where('brand_id', $this->selectedBrand);
        }

        if ($this->selectedCarType) {
            $query->where('car_type_id', $this->selectedCarType);
        }

        if ($this->minPrice) {
            $query->where('selling_price', '>=', (float) $this->minPrice);
        }
        if ($this->maxPrice) {
            $query->where('selling_price', '<=', (float) $this->maxPrice);
        }

        if ($this->minYear) {
            $query->where('year_of_manufacture', '>=', $this->minYear);
        }
        if ($this->maxYear) {
            $query->where('year_of_manufacture', '<=', $this->maxYear);
        }

        if ($this->fuelType) {
            $query->where('fuel_type', $this->fuelType);
        }
        if ($this->transmission) {
            $query->where('transmission', $this->transmission);
        }
        if ($this->bodyType) {
            $query->where('body_type', 'like', '%' . $this->bodyType . '%');
        }

        $brands = \App\Models\Brand::where('is_active', true)->orderBy('name')->get();

        $carTypes = [];
        if ($this->selectedBrand) {
            $carTypes = \App\Models\CarType::where('brand_id', $this->selectedBrand)->where('is_active', true)->orderBy('name')->get();
        }

        return view('livewire.car-listing', [
            'cars' => $query->latest()->paginate(9),
            'brands' => $brands,
            'carTypes' => $carTypes,
        ]);
    }
}
