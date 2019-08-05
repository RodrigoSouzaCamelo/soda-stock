<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name'];

    public function soda()
    {
        return $this->belongsTo(Soda::class);
    }

    public function updateBrand($brandId, $data)
    {
        $this->where('id', $brandId)->update($data);
    }

    public function deleteBrandById($brandId)
    {
        $this->where('id', $brandId)->delete();
    }
}
