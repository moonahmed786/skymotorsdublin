<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BrandExport implements FromCollection, WithHeadings, WithMapping
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
            return collect([new Brand(['name' => 'Toyota', 'is_active' => true])]);
        }
        return Brand::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Active',
            'Created At',
        ];
    }

    public function map($brand): array
    {
        if ($this->isSample) {
            return ['', 'Toyota', '1', ''];
        }

        return [
            $brand->id,
            $brand->name,
            $brand->is_active ? '1' : '0',
            $brand->created_at ? $brand->created_at->format('Y-m-d') : '',
        ];
    }
}
