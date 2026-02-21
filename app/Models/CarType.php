<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    /** @use HasFactory<\Database\Factories\CarTypeFactory> */
    use HasFactory, Auditable;

    protected $fillable = [
        'name',
        'brand_id',
        'image_path',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
