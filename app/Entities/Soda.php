<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Mockery\Undefined;

class Soda extends Model
{
    protected $fillable = ['id', 'brandid', 'bottletypeid', 'flavor', 'liters', 'unitaryvalue'];

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

    public function getAll()
    {
        $columns = [
            'sodas.Id as id',
            'sodas.Flavor as flavor',
            'sodas.Liters as liters',
            'sodas.UnitaryValue as unitary_value',
            'b.Name as brand',
            'bt.Name as bottle_type',
        ];

        return $this->select($columns)
                    ->join('Brands as b', 'b.Id', '=', 'sodas.BrandId')
                    ->join('BottleTypes as bt', 'bt.Id', '=', 'sodas.BottleTypeId')
                    ->paginate(10);
    }

    public function createSoda($entity)
    {
        $sodaExists = $this->where([
            ['brandid', '=', $entity['brands']],
            ['liters', '=', $entity['liters']],
        ])->count();

        if($sodaExists == 0){
            $soda = new Soda();
            $soda->brandid = $entity['brands'];
            $soda->bottleTypeid = $entity['bottleTypes'];
            $soda->flavor = $entity['flavor'];
            $soda->liters = $entity['liters'];
            $soda->unitaryvalue = $entity['unitaryValue'];
            $soda->save();

            return true;
        } else {
            return false;
        }
    }

    public function updateSoda($sodaId, $soda)
    {
        $this->where('id', $sodaId)->update($soda);
    }

    public function deleteSodaById($sodaId)
    {
        $this->where('id', $sodaId)->delete();
    }
}
