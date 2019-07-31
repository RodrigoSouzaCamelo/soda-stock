<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Soda extends Model
{
    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function bottleTypes()
    {
        return $this->hasMany(BottleType::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
