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
        // Simple implementation - assumimng row order matches export or header names
        // Ideally use WithHeadingRow for better reliability
        return new Car([
            'registration_number' => $row[1] ?? null,
            // Add other fields as needed, but for now just a placeholder or basic fields
            // Note: Importing complex relationships (Brand, Type) requires looking up IDs by name.
            // For this task, we'll keep it simple or maybe just use ToCollection to handle logic in controller if needed.
            // Let's assume standard columns.
        ]);
    }
}
