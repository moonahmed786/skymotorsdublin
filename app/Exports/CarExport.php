<?php

namespace App\Exports;

use App\Models\Car;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CarExport implements FromCollection, WithHeadings, WithMapping
{
    protected $isSample;

    public function __construct($isSample = false)
    {
        $this->isSample = $isSample;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->isSample) {
            return collect([
                new Car([
                    'registration_number' => '12-D-12345',
                    'year_of_manufacture' => 2012,
                    'purchasing_price' => 10000,
                    'selling_price' => 15000,
                    'status' => 'available',
                ])
            ]);
        }
        return Car::with(['brand', 'type'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Registration',
            'Make/Brand',
            'Model/Type',
            'Year',
            'Price (Buying)',
            'Price (Selling)',
            'Status',
            'Created At',
        ];
    }

    public function map($car): array
    {
        if ($this->isSample) {
            return [
                '', // ID
                '12-D-12345',
                'Toyota',
                'Corolla',
                '2012',
                '10000',
                '15000',
                'available',
                '',
            ];
        }

        return [
            $car->id,
            $car->registration_number,
            $car->brand->name ?? $car->make->name ?? '',
            $car->type->name ?? $car->model->name ?? '',
            $car->year_of_manufacture,
            $car->purchasing_price,
            $car->selling_price,
            $car->status,
            $car->created_at ? $car->created_at->format('Y-m-d') : '',
        ];
    }
}
