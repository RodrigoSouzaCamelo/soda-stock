<?php

use Illuminate\Database\Seeder;

class ProductsStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productsstatus')->insert([
            'Name' => 'Disponível'
        ]);

        DB::table('productsstatus')->insert([
            'Name' => 'Indisponível'
        ]);
    }
}
