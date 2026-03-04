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
                    'chassis_number' => 'ABC123XYZ',
                    'engine_size' => '2.0L',
                    'fuel_type' => 'diesel',
                    'transmission' => 'automatic',
                    'mileage' => 120000,
                    'color' => 'Space Grey',
                    'nct_status' => 'Done',
                    'radio_status' => 'Not Changed',
                    'service_status' => 'Done',
                    'valet_status' => 'Done',
                    'parking_location' => 'New Garage',
                    'collection_date' => '2024-05-15',
                    'nct_expiry_date' => '2024-05-20',
                    'purchasing_price' => 10000,
                    'selling_price' => 15000,
                    'vrt_amount' => 500.00,
                    'date_vrt_paid' => '2023-01-01',
                    'customs_amount' => 200.00,
                    'vat_on_customs_amount' => 46.00,
                    'status' => 'available',
                    'is_published' => true,
                    'description' => 'Excellent condition, fuel efficient.',
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
            'Chassis Number',
            'Engine Size',
            'Fuel Type',
            'Transmission',
            'Mileage (km)',
            'Color',
            'NCT Status',
            'Radio Status',
            'Service Status',
            'Valet Status',
            'Parking Location',
            'Collection Date',
            'NCT Expiry',
            'Price (Buying)',
            'Price (Selling)',
            'VRT Amount',
            'Date VRT Paid',
            'Customs Amount',
            'VAT on Customs',
            'Status',
            'Is Published',
            'Description',
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
                'ABC123XYZ',
                '2.0L',
                'diesel',
                'automatic',
                '120000',
                'Space Grey',
                'Done',
                'Not Changed',
                'Done',
                'Done',
                'New Garage',
                '2024-05-15',
                '2024-05-20',
                '10000',
                '15000',
                '500.00',
                '2023-01-01',
                '200.00',
                '46.00',
                'available',
                'Yes',
                'Excellent condition, fuel efficient.',
                '',
            ];
        }

        return [
            $car->id,
            $car->registration_number,
            $car->brand->name ?? $car->make->name ?? '',
            $car->type->name ?? $car->model->name ?? '',
            $car->year_of_manufacture,
            $car->chassis_number,
            $car->engine_size,
            $car->fuel_type,
            $car->transmission,
            $car->mileage,
            $car->color,
            $car->nct_status,
            $car->radio_status,
            $car->service_status,
            $car->valet_status,
            $car->parking_location,
            $car->collection_date ? $car->collection_date->format('Y-m-d') : '',
            $car->nct_expiry_date ? $car->nct_expiry_date->format('Y-m-d') : '',
            $car->purchasing_price,
            $car->selling_price,
            $car->vrt_amount,
            $car->date_vrt_paid ? $car->date_vrt_paid->format('Y-m-d') : '',
            $car->customs_amount,
            $car->vat_on_customs_amount,
            $car->status,
            $car->is_published ? 'Yes' : 'No',
            $car->description,
            $car->created_at ? $car->created_at->format('Y-m-d') : '',
        ];
    }
}
