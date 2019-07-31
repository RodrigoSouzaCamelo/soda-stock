<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class BottleType extends Model
{
    public function soda()
    {
        return $this->belongsTo(Soda::class);
    }
}
