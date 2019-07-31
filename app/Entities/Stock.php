<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function sodas()
    {
        return $this->hasMany(Soda::class);
    }

    public function productsStatus()
    {
        return $this->hasMany(ProductStatus::class);
    }
}
