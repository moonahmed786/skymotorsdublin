<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\CarMake;
use App\Models\Car;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_make_id',
        'name',
        'variant',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function make()
    {
        return $this->belongsTo(CarMake::class, 'car_make_id');
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function getFullNameAttribute()
    {
        return $this->variant ? "{$this->name} {$this->variant}" : $this->name;
    }
}
