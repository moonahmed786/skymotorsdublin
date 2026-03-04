<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\CarImage;
use App\Models\CarService;
use App\Models\User;
use App\Models\Brand; // Assuming Brand model exists
use App\Models\CarType; // Assuming CarType model exists

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_make_id',
        'car_model_id',
        'brand_id',
        'car_type_id',
        'registration_number',
        'chassis_number',
        'color',
        'year_of_manufacture',
        'engine_size',
        'fuel_type',
        'transmission',
        'body_type',
        'mileage',
        'nct_expiry_date',
        'purchasing_price',
        'vrt_amount',
        'date_vrt_paid',
        'customs_amount',
        'vat_on_customs_amount',
        'selling_price',
        'sold_price',
        'sold_at',
        'nct_status',
        'status',
        'parking_location',
        'collection_date',
        'service_status',
        'service_notes',
        'notes',
        'radio_status',
        'paint_condition',
        'valet_status',
        'tyre_condition',
        'back_camera_status',
        'created_by',
        'updated_by',
        'features',
        'description',
        'is_published',
    ];

    protected $casts = [
        'year_of_manufacture' => 'integer',
        'purchasing_price' => 'decimal:2',
        'vrt_amount' => 'decimal:2',
        'customs_amount' => 'decimal:2',
        'vat_on_customs_amount' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'sold_price' => 'decimal:2',
        'mileage' => 'integer',
        'collection_date' => 'date',
        'nct_expiry_date' => 'date',
        'date_vrt_paid' => 'date',
        'sold_at' => 'datetime',
        'features' => 'array',
        'is_published' => 'boolean',
    ];

    public function make()
    {
        return $this->belongsTo(CarMake::class, 'car_make_id');
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function type()
    {
        return $this->belongsTo(CarType::class, 'car_type_id');
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function mainImage()
    {
        return $this->hasOne(CarImage::class)->where('is_primary', true);
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
