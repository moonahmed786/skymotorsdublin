<?php

namespace App\Livewire\Admin;

use App\Models\Car;
use App\Traits\WithSorting;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CarManager extends Component
{
    use WithPagination, WithSorting, WithFileUploads;

    public $search = '';
    public $excelFile; // For import

    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\CarExport, 'cars.xlsx');
    }

    public function downloadSample()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\CarExport(true), 'cars_sample.xlsx');
    }

    public function import()
    {
        $this->validate([
            'excelFile' => 'required|mimes:xlsx,xls,csv',
        ]);

        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\CarImport, $this->excelFile);

        $this->reset('excelFile');
        session()->flash('message', 'Cars imported successfully.');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updateStatus($id, $status)
    {
        $car = Car::findOrFail($id);
        $oldStatus = $car->status;

        $data = ['status' => $status];

        if ($status === 'sold' && $oldStatus !== 'sold') {
            $data['sold_at'] = now();
        } elseif ($status !== 'sold') {
            $data['sold_at'] = null;
        }

        $car->update($data);
        session()->flash('message', 'Car status updated to ' . str_replace('_', ' ', $status) . '.');
    }

    public function delete($id)
    {
        Car::find($id)->delete();
        session()->flash('message', 'Car deleted successfully.');
    }

    public function render()
    {
        $query = Car::query()
            ->with(['brand', 'type', 'make', 'model', 'mainImage'])
            ->where(function ($query) {
                $query->where('registration_number', 'like', '%' . $this->search . '%')
                    ->orWhereHas('brand', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('type', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('make', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('model', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            });

        // Apply sorting
        if ($this->sortField === 'brand.name') {
            $query->join('brands', 'cars.brand_id', '=', 'brands.id')
                ->orderBy('brands.name', $this->sortDirection)
                ->select('cars.*');
        } else {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        $cars = $query->paginate(10);

        return view('livewire.admin.car-manager', [
            'cars' => $cars,
        ])->layout('layouts.admin');
    }
}