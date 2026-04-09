<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;
    protected $fillable = [
        'style_name',
        'serial_no',
        'business_id',
        'created_by',
    ];

    public function designs()
    {
        return $this->hasMany(Design::class);
    }

    public function cloths()
    {
        return $this->belongsToMany(Cloth::class, 'cloth_style');
    }
}
