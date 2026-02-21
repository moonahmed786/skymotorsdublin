<?php

namespace App\Livewire\Admin;

use App\Models\Car;
use App\Models\CarMake;
use App\Models\CarModel;
use Livewire\Component;
use Livewire\WithFileUploads;

class CarForm extends Component
{
    use WithFileUploads;

    public ?Car $car = null;

    // Basic Info
    public $brand_id = '';
    public $car_type_id = '';
    public $registration_number = '';
    public $chassis_number = '';
    public $color = '';
    public $year_of_manufacture = '';
    public $engine_size = '';
    public $fuel_type = '';
    public $transmission = '';
    public $body_type = '';

    // Pricing
    public $purchasing_price = '';
    public $vrt_amount = '';
    public $date_vrt_paid = '';
    public $customs_amount = '';
    public $vat_on_customs_amount = '';
    public $selling_price = '';
    public $sold_price = '';

    // Status & Condition
    public $mileage = '';
    public $nct_status = 'valid';
    public $nct_expiry_date = '';
    public $status = 'available';
    public $collection_date = '';
    public $service_notes = '';
    public $notes = '';
    public $radio_status = 'working';
    public $paint_condition = 'excellent';
    public $valet_status = 'pending';
    public $tyre_condition = 'excellent';
    public $back_camera_status = 'working';

    public $photos = [];

    public function mount($car = null)
    {
        if ($car) {
            $this->car = $car;
            $this->fill($car->toArray());
            $this->brand_id = $car->brand_id;
            $this->car_type_id = $car->car_type_id;
        }
    }

    protected function rules()
    {
        return [
            'brand_id' => 'required|exists:brands,id',
            'car_type_id' => 'required|exists:car_types,id',
            'registration_number' => 'required|string|unique:cars,registration_number,' . ($this->car->id ?? 'NULL'),
            'chassis_number' => 'required|string|unique:cars,chassis_number,' . ($this->car->id ?? 'NULL'),
            'color' => 'required|string',
            'year_of_manufacture' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'engine_size' => 'nullable|string',
            'fuel_type' => 'nullable|in:petrol,diesel,hybrid,electric',
            'transmission' => 'nullable|in:manual,automatic',
            'purchasing_price' => 'required|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0',
            'status' => 'required|in:available,sold,in_service',
            'mileage' => 'required|integer|min:0',
        ];
    }

    public function save()
    {
        $this->validate();

        // Uppercase transformations
        $this->registration_number = strtoupper($this->registration_number);
        $this->chassis_number = strtoupper($this->chassis_number);

        $data = $this->all();

        // Remove photos from data array as it's handled separately if implemented
        unset($data['photos'], $data['car']);

        // Explicitly set brand and type
        $data['brand_id'] = $this->brand_id;
        $data['car_type_id'] = $this->car_type_id;
        // Remove legacy fields if they are in $data but not needed, or ensure they are nullable in DB
        // Assuming database handles nullable car_make_id/model_id

        // Set creators/updaters
        if (!$this->car) {
            $data['created_by'] = auth()->id();
        }
        $data['updated_by'] = auth()->id();

        if ($this->car) {
            $this->car->update($data);
            $car = $this->car;
            session()->flash('message', 'Car updated successfully.');
        } else {
            $car = Car::create($data);
            session()->flash('message', 'Car created successfully.');
        }

        // Handle Photo Uploads
        if ($this->photos) {
            foreach ($this->photos as $photo) {
                // Store file and get path
                $path = $photo->store('car-images', 'public');

                // Create CarImage record
                $car->images()->create([
                    'image_path' => $path,
                    'is_main' => false, // Simplification for now
                ]);
            }
        }

        return redirect()->route('admin.cars.index');
    }

    public function render()
    {
        return view('livewire.admin.car-form', [
            'brands' => \App\Models\Brand::where('is_active', true)->orderBy('name')->get(),
            'carTypes' => \App\Models\CarType::where('is_active', true)
                ->when($this->brand_id, fn($q) => $q->where('brand_id', $this->brand_id))
                ->orderBy('name')
                ->get(),
        ])->layout('layouts.admin');
    }
}