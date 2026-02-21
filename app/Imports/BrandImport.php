<?php

namespace App\Imports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BrandImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Check if brand exists
        $brand = Brand::where('name', $row['name'])->first();
        if ($brand) {
            return null; // Skip duplicates or update? Let's skip for now
        }

        return new Brand([
            'name' => $row['name'],
            'is_active' => isset($row['active']) ? ($row['active'] == 1 || $row['active'] == 'yes') : true,
        ]);
    }
}
