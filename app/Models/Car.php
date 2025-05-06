<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\CarImage;
use App\Models\CarService;
use App\Models\User;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_make_id',
        'car_model_id',
        'registration_number',
        'chassis_number',
        'color',
        'year_of_manufacture',
        'purchasing_price',
        'selling_price',
        'sold_price',
        'mileage',
        'nct_status',
        'nct_expiry_date',
        'status',
        'collection_date',
        'service_notes',
        'radio_status',
        'paint_condition',
        'valet_status',
        'tyre_condition',
        'back_camera_status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'year_of_manufacture' => 'integer',
        'purchasing_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'sold_price' => 'decimal:2',
        'mileage' => 'integer',
        'collection_date' => 'date',
        'nct_expiry_date' => 'date',
    ];

    public function make()
    {
        return $this->belongsTo(CarMake::class, 'car_make_id');
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function services()
    {
        return $this->hasMany(CarService::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
