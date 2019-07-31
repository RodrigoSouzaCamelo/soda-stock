<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductStatus extends Model
{
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
