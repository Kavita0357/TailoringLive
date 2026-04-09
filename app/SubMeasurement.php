<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMeasurement extends Model
{
    use HasFactory;

    protected $fillable = ['sub_measurement_name', 'serial_no', 'business_id', 'created_by'];

    public function measurements()
    {
        return $this->belongsToMany(Measurement::class);
    }
}
