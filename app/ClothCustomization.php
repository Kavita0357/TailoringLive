<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClothCustomization extends Model
{
    use HasFactory;

    protected $fillable = ['cloth_id', 'contact_id', 'measurements', 'styles', 'note'];

    protected $casts = [
        'measurements' => 'array',
        'styles' => 'array',
    ];

    public function cloth()
    {
        return $this->belongsTo(Cloth::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class); // or User::class depending on your structure
    }
}
