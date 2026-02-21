<?php

namespace App\Exports;

use App\Models\CarType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CarTypeExport implements FromCollection, WithHeadings, WithMapping
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
                new CarType([
                    'name' => 'Corolla',
                    // We can't easily fake the relation in a simple collection without hydrating, 
                    // but for mapping we can handle it.
                ])
            ]);
        }
        return CarType::with('brand')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Brand',
            'Active',
            'Created At',
        ];
    }

    public function map($carType): array
    {
        if ($this->isSample) {
            return ['', 'Corolla', 'Toyota', '1', ''];
        }

        return [
            $carType->id,
            $carType->name,
            $carType->brand->name ?? '',
            $carType->is_active ? '1' : '0',
            $carType->created_at ? $carType->created_at->format('Y-m-d') : '',
        ];
    }
}
