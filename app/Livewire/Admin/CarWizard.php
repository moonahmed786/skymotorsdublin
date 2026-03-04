<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Brand;
use App\Models\CarType;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CarWizard extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $totalSteps = 6;

    // Step 1: Branding
    public $brandId = '';
    public $carTypeId = '';

    // Step 2: Technical Details
    public $year;
    public $engineSize;
    public $fuelType;
    public $transmission;
    public $mileage;
    public $color;
    public $nctExpiry;
    public $nctStatus;
    public $radioStatus;
    public $valetStatus;
    public $serviceStatus;
    public $parkingLocation;
    public $collectionDate;

    // Step 3: Information & Features
    public $registrationNumber;
    public $chassisNumber;
    public $description;
    public $features = []; // specific features selected
    public $price_buying;
    public $price_selling;
    public $vrtAmount;
    public $dateVrtPaid;
    public $customsAmount;
    public $vatOnCustomsAmount;
    public $isPublished = false;

    // Step 4: Images
    public $images = []; // Temporary storage for newly selected images
    public $pendingImages = []; // Persistent list of images to be saved
    public $mainImage;
    public $existingImages = [];

    // Data Sources
    public $brands;
    public $carTypes = [];

    // Validation Rules
    protected function rules()
    {
        return [
            1 => [
                'brandId' => 'required|exists:brands,id',
                'carTypeId' => 'required|exists:car_types,id',
            ],
            2 => [
                'year' => 'required|integer|min:1900|max:2030',
                'engineSize' => 'required|string',
                'fuelType' => 'required|in:petrol,diesel,hybrid,electric',
                'transmission' => 'required|in:manual,automatic',
                'mileage' => 'required|integer',
                'color' => 'required|string',
            ],
            3 => [
                'nctStatus' => 'nullable|string',
                'nctExpiry' => 'nullable|date',
                'radioStatus' => 'nullable|string',
                'serviceStatus' => 'nullable|string',
                'valetStatus' => 'nullable|string',
                'parkingLocation' => 'nullable|string',
                'collectionDate' => 'nullable|date',
            ],
            4 => [
                'registrationNumber' => 'required|string|unique:cars,registration_number,' . ($this->car->id ?? 'NULL'),
                'chassisNumber' => 'required|string|unique:cars,chassis_number,' . ($this->car->id ?? 'NULL'),
                'price_buying' => 'required|numeric',
                'price_selling' => 'nullable|numeric',
                'vrtAmount' => 'nullable|numeric',
                'dateVrtPaid' => 'nullable|date',
                'customsAmount' => 'nullable|numeric',
                'vatOnCustomsAmount' => 'nullable|numeric',
                'description' => 'nullable|string',
                'isPublished' => 'boolean',
            ],
            5 => [
                'mainImage' => 'nullable|image|max:2048',
                'images.*' => 'image|max:2048',
            ],
        ];
    }

    public $car = null;
    public $isEditMode = false;

    // ... (keep existing properties)

    public function mount(?Car $car = null)
    {
        $this->brands = Brand::where('is_active', true)->orderBy('name')->get();

        if ($car) {
            $this->car = $car;
            $this->isEditMode = true;

            // Step 1
            $this->brandId = $car->brand_id;
            $this->updatedBrandId(); // Load car types
            $this->carTypeId = $car->car_type_id;

            // Step 2
            $this->year = $car->year_of_manufacture;
            $this->engineSize = $car->engine_size;
            $this->fuelType = $car->fuel_type;
            $this->transmission = $car->transmission;
            $this->mileage = $car->mileage;
            $this->color = $car->color;
            $this->nctExpiry = $car->nct_expiry_date ? $car->nct_expiry_date->format('Y-m-d') : null;
            $this->nctStatus = $car->nct_status;
            $this->radioStatus = $car->radio_status;
            $this->valetStatus = $car->valet_status;
            $this->serviceStatus = $car->service_status;
            $this->parkingLocation = $car->parking_location;
            $this->collectionDate = $car->collection_date ? $car->collection_date->format('Y-m-d') : null;

            // Step 3
            $this->registrationNumber = $car->registration_number;
            $this->chassisNumber = $car->chassis_number;
            $this->price_buying = $car->purchasing_price;
            $this->price_selling = $car->selling_price;
            $this->vrtAmount = $car->vrt_amount;
            $this->dateVrtPaid = $car->date_vrt_paid ? $car->date_vrt_paid->format('Y-m-d') : null;
            $this->customsAmount = $car->customs_amount;
            $this->vatOnCustomsAmount = $car->vat_on_customs_amount;
            $this->description = $car->description;
            $this->features = $car->features ?? [];
            $this->isPublished = $car->is_published;
            $this->loadExistingImages();
        }
    }

    public function loadExistingImages()
    {
        if ($this->car) {
            $this->existingImages = $this->car->images()->orderBy('is_primary', 'desc')->get()->toArray();
        }
    }

    public function deleteImage($imageId)
    {
        $image = \App\Models\CarImage::find($imageId);
        if ($image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
            $this->loadExistingImages();
            $this->dispatch('image-deleted');
            session()->flash('message', 'Image deleted successfully.');
        }
    }

    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'image|max:2048',
        ]);

        $count = count($this->pendingImages) + count($this->existingImages);

        foreach ($this->images as $image) {
            if ($count < 4) {
                $this->pendingImages[] = $image;
                $count++;
            }
        }

        $this->images = []; // Clear the temporary input
    }

    public function removePendingImage($index)
    {
        unset($this->pendingImages[$index]);
        $this->pendingImages = array_values($this->pendingImages);
    }

    public function updatedBrandId()
    {
        if ($this->brandId) {
            $this->carTypes = CarType::where('brand_id', $this->brandId)->where('is_active', true)->get();
        } else {
            $this->carTypes = [];
        }
        $this->carTypeId = '';
    }

    public function nextStep()
    {
        $this->validate($this->rules()[$this->currentStep]);
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function submit()
    {
        // Validation for the final step or all steps could go here

        if ($this->isEditMode && $this->car) {
            $car = $this->car;
        } else {
            $car = new Car();
            $car->created_by = auth()->id();
        }

        $car->updated_by = auth()->id();
        $car->brand_id = $this->brandId;
        $car->car_type_id = $this->carTypeId;

        // Ensure legacy fields are handled if constraints exist (assuming nullable now or filled via other means)
        // If not nullable, we might need dummy values, but for now assuming migration fix or nullable

        $car->year_of_manufacture = $this->year;
        $car->engine_size = $this->engineSize;
        $car->fuel_type = $this->fuelType;
        $car->transmission = $this->transmission;
        $car->mileage = $this->mileage;
        $car->color = $this->color;
        $car->nct_expiry_date = $this->nctExpiry;
        $car->nct_status = $this->nctStatus;
        $car->radio_status = $this->radioStatus;
        $car->valet_status = $this->valetStatus;
        $car->service_status = $this->serviceStatus;
        $car->parking_location = $this->parkingLocation;
        $car->collection_date = $this->collectionDate;

        $car->registration_number = $this->registrationNumber;
        $car->chassis_number = $this->chassisNumber;
        $car->purchasing_price = $this->price_buying;
        $car->selling_price = $this->price_selling;
        $car->vrt_amount = $this->vrtAmount;
        $car->date_vrt_paid = $this->dateVrtPaid;
        $car->customs_amount = $this->customsAmount;
        $car->vat_on_customs_amount = $this->vatOnCustomsAmount;
        $car->description = $this->description;
        $car->features = $this->features;
        $car->is_published = $this->isPublished;
        $car->status = $car->status ?? 'available';

        $car->save();

        if ($this->mainImage) {
            if ($this->isEditMode) {
                $car->images()->where('is_primary', true)->update(['is_primary' => false]);
            }
            $path = $this->mainImage->store('cars/' . $car->id, 'public');
            $car->images()->create(['image_path' => $path, 'is_primary' => true]);
        }

        foreach ($this->pendingImages as $image) {
            $path = $image->store('cars/' . $car->id, 'public');
            $car->images()->create(['image_path' => $path, 'is_primary' => false]);
        }

        $this->mainImage = null;
        $this->images = [];
        $this->pendingImages = [];
        $this->loadExistingImages();

        session()->flash('message', $this->isEditMode ? 'Car updated successfully!' : 'Car created successfully!');
        return redirect()->route('admin.cars.index');
    }

    public function render()
    {
        return view('livewire.admin.car-wizard')->layout('layouts.admin');
    }
}
