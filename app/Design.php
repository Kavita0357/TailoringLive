<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;
    protected $fillable = ['style_id', 'serial_no', 'design_name', 'design_image'];

    public function style()
    {
        return $this->belongsTo(Style::class);
    }
}
