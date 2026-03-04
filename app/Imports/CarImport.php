<?php

namespace App\Imports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\ToModel;

class CarImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Mapping based on CarExport column order:
        // 0: ID, 1: Registration, 2: Make/Brand, 3: Model/Type, 4: Year, 
        // 5: Chassis Number, 6: Engine Size, 7: Fuel Type, 8: Transmission, 
        // 9: Mileage, 10: Color, 11: NCT Status, 12: Radio Status, 
        // 13: Service Status, 14: Valet Status, 15: Parking Location, 
        // 16: Collection Date, 17: NCT Expiry, 18: Price (Buying), 
        // 19: Price (Selling), 20: VRT Amount, 21: Date VRT Paid, 
        // 22: Customs Amount, 23: VAT on Customs, 24: Status, 
        // 25: Is Published, 26: Description, 27: Created At

        return new Car([
            'registration_number' => $row[1] ?? null,
            'year_of_manufacture' => $row[4] ?? null,
            'chassis_number' => $row[5] ?? null,
            'engine_size' => $row[6] ?? null,
            'fuel_type' => $row[7] ?? null,
            'transmission' => $row[8] ?? null,
            'mileage' => $row[9] ?? null,
            'color' => $row[10] ?? null,
            'nct_status' => $row[11] ?? null,
            'radio_status' => $row[12] ?? null,
            'service_status' => $row[13] ?? null,
            'valet_status' => $row[14] ?? null,
            'parking_location' => $row[15] ?? null,
            'collection_date' => $row[16] ?? null,
            'nct_expiry_date' => $row[17] ?? null,
            'purchasing_price' => $row[18] ?? null,
            'selling_price' => $row[19] ?? null,
            'vrt_amount' => $row[20] ?? null,
            'date_vrt_paid' => $row[21] ?? null,
            'customs_amount' => $row[22] ?? null,
            'vat_on_customs_amount' => $row[23] ?? null,
            'status' => $row[24] ?? 'available',
            'is_published' => isset($row[25]) && (strtolower($row[25]) === 'yes' || $row[25] == 1),
            'description' => $row[26] ?? null,
            'created_by' => auth()->id(),
        ]);
    }
}
