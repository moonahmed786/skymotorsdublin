<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    protected $fillable = [
        'car_id',
        'image_path',
        'is_primary',
        'display_order',
        'caption',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
