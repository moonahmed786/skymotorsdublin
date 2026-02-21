<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Traits\WithSorting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class BrandManager extends Component
{
    use WithFileUploads, WithPagination, WithSorting;

    public $name;
    public $logo;
    public $existingLogo;
    public $isActive = true;
    public $brandId;
    public $isEditing = false;
    public $showModal = false;
    public $search = '';
    public $excelFile;

    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\BrandExport, 'brands.xlsx');
    }

    public function downloadSample()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\BrandExport(true), 'brands_sample.xlsx');
    }

    public function import()
    {
        $this->validate([
            'excelFile' => 'required|mimes:xlsx,xls,csv',
        ]);

        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\BrandImport, $this->excelFile);

        $this->reset('excelFile');
        session()->flash('message', 'Brands imported successfully.');
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('brands')->ignore($this->brandId)],
            'logo' => $this->isEditing ? 'nullable|image|max:1024' : 'required|image|max:1024',
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
        $this->reset(['name', 'logo', 'existingLogo', 'isActive', 'brandId', 'isEditing']);
        $this->isActive = true;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->resetValidation();
        $brand = Brand::findOrFail($id);
        $this->brandId = $brand->id;
        $this->name = $brand->name;
        $this->existingLogo = $brand->logo_path;
        $this->isActive = (bool) $brand->is_active;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'is_active' => $this->isActive,
        ];

        if ($this->logo) {
            $path = $this->logo->store('brands', 'public');
            $data['logo_path'] = $path;
        }

        if ($this->isEditing) {
            $brand = Brand::findOrFail($this->brandId);
            if ($this->logo && $brand->logo_path) {
                Storage::disk('public')->delete($brand->logo_path);
            }
            $brand->update($data);
            session()->flash('message', 'Brand updated successfully.');
        } else {
            Brand::create($data);
            session()->flash('message', 'Brand created successfully.');
        }

        $this->showModal = false;
        $this->reset(['name', 'logo', 'existingLogo', 'isActive', 'brandId', 'isEditing']);
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        // Check if brand has related car types or cars before deleting? 
        // For now, let's allow soft delete.
        $brand->delete();
        session()->flash('message', 'Brand deleted successfully.');
    }

    public function render()
    {
        $query = Brand::query()
            ->where('name', 'like', '%' . $this->search . '%');

        $query->orderBy($this->sortField, $this->sortDirection);

        return view('livewire.admin.brand-manager', [
            'brands' => $query->paginate(10),
        ])->layout('layouts.admin');
    }
}
