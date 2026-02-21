<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory, Auditable;

    protected $fillable = [
        'name',
        'logo_path',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    public function carTypes()
    {
        return $this->hasMany(CarType::class);
    }
}
