<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\CarType;
use App\Traits\WithSorting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class CarTypeManager extends Component
{
    use WithFileUploads, WithPagination, WithSorting;

    public $name;
    public $brandId;
    public $image;
    public $existingImage;
    public $isActive = true;
    public $carTypeId;
    public $isEditing = false;
    public $showModal = false;
    public $search = '';
    public $excelFile;

    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\CarTypeExport, 'car_types.xlsx');
    }

    public function downloadSample()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\CarTypeExport(true), 'car_types_sample.xlsx');
    }

    public function import()
    {
        $this->validate([
            'excelFile' => 'required|mimes:xlsx,xls,csv',
        ]);

        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\CarTypeImport, $this->excelFile);

        $this->reset('excelFile');
        session()->flash('message', 'Car Types imported successfully.');
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'brandId' => 'required|exists:brands,id',
            'image' => $this->isEditing ? 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024' : 'required|image|mimes:jpeg,png,jpg,webp|max:1024',
            'isActive' => 'boolean',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset(['name', 'brandId', 'image', 'existingImage', 'isActive', 'carTypeId', 'isEditing']);
        $this->isActive = true;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->resetValidation();
        $carType = CarType::findOrFail($id);
        $this->carTypeId = $carType->id;
        $this->name = $carType->name;
        $this->brandId = $carType->brand_id;
        $this->existingImage = $carType->image_path;
        $this->isActive = (bool) $carType->is_active;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'brand_id' => $this->brandId,
            'is_active' => $this->isActive,
        ];

        if ($this->image) {
            $path = $this->image->store('car-types', 'public');
            $data['image_path'] = $path;
        }

        if ($this->isEditing) {
            $carType = CarType::findOrFail($this->carTypeId);
            if ($this->image && $carType->image_path) {
                Storage::disk('public')->delete($carType->image_path);
            }
            $carType->update($data);
            session()->flash('message', 'Car Type updated successfully.');
        } else {
            CarType::create($data);
            session()->flash('message', 'Car Type created successfully.');
        }

        $this->showModal = false;
        $this->reset(['name', 'brandId', 'image', 'existingImage', 'isActive', 'carTypeId', 'isEditing']);
    }

    public function delete($id)
    {
        $carType = CarType::findOrFail($id);
        if ($carType->image_path) {
            Storage::disk('public')->delete($carType->image_path);
        }
        $carType->delete();
        session()->flash('message', 'Car Type deleted successfully.');
    }

    public function render()
    {
        $query = CarType::query()
            ->with('brand')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('brand', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            });

        // Apply sorting
        if ($this->sortField === 'brand.name') {
            $query->join('brands', 'car_types.brand_id', '=', 'brands.id')
                ->orderBy('brands.name', $this->sortDirection)
                ->select('car_types.*');
        } else {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        return view('livewire.admin.car-type-manager', [
            'carTypes' => $query->paginate(10),
            'brands' => Brand::where('is_active', true)->orderBy('name')->get(),
        ])->layout('layouts.admin');
    }
}
