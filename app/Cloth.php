<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cloth extends Model
{
    use HasFactory;
    protected $fillable = ['cloth_name', 'serial_no', 'wages', 'cloth_image', 'business_id', 'created_by'];

    public function measurements()
    {
        return $this->belongsToMany(Measurement::class, 'cloth_measurement');
    }

    public function styles()
    {
        return $this->belongsToMany(Style::class, 'cloth_style');
    }

    public function customizations()
    {
        return $this->hasMany(ClothCustomization::class);
    }
}
