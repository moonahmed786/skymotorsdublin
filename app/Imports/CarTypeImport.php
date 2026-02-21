<?php

namespace App\Imports;

use App\Models\CarType;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Brand;

class CarTypeImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!isset($row['name']) || !isset($row['brand'])) {
            return null;
        }

        // Find brand by name
        $brand = Brand::where('name', $row['brand'])->first();

        if (!$brand) {
            // Optional: Create brand if not exists? Or skip?
            // Let's create it for seamless experience
            $brand = Brand::create(['name' => $row['brand'], 'is_active' => true]);
        }

        return new CarType([
            'name' => $row['name'],
            'brand_id' => $brand->id,
            'is_active' => isset($row['active']) ? ($row['active'] == 1 || $row['active'] == 'yes') : true,
        ]);
    }
}
