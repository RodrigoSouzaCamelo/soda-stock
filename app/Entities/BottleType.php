<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class BottleType extends Model
{
    protected $table = "BottleTypes";

    public function soda()
    {
        return $this->belongsTo(Soda::class);
    }
}
