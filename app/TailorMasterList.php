<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TailorMasterList extends Model
{
    protected $table = 'tailor_master_list';

    protected $guarded = ['id'];

    public $timestamps = true;
}