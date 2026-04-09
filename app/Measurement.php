<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;

    protected $fillable = ['measurement_name', 'serial_no', 'business_id', 'created_by'];

    public function subMeasurements()
    {
        return $this->belongsToMany(SubMeasurement::class)->withPivot('serial_no');
    }

    public function cloths()
    {
        return $this->belongsToMany(Cloth::class, 'cloth_measurement');
    }
}
