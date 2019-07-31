<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function soda()
    {
        return $this->belongsTo(Soda::class);
    }
}
