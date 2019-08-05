<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['sodaId', 'productStatusId'];
    public function sodas()
    {
        return $this->hasMany(Soda::class);
    }

    public function productsStatus()
    {
        return $this->hasMany(ProductStatus::class);
    }

    public function getAvailableStockItems()
    {
        $columns = [
            'so.Flavor as flavor', 
            'so.Liters as liters', 
            'so.UnitaryValue as unitary_value',
            \DB::raw("count(*) as amount"),
            'b.Name as brand',
            'bt.Name as bottle_type',
        ];

        return $this->select($columns)
                    ->join('sodas as so', 'so.Id', '=', 'stocks.SodaId')
                    ->join('ProductsStatus as ps', 'ps.Id', '=', 'stocks.ProductStatusId')
                    ->join('Brands as b', 'b.Id', '=', 'so.BrandId')
                    ->join('BottleTypes as bt', 'bt.Id', '=', 'so.BottleTypeId')
                    ->where('ps.Id', 1)
                    ->groupBy('so.Flavor', 'b.Id', 'so.Liters')->paginate(15);
    }

    public function addSodaInStock($sodaId)
    {
        $stock = new Stock();
        $stock->sodaId = $sodaId;
        $stock->productStatusId = 1;
        $stock->save();
    }
}
