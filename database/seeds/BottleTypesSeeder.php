<?php

use Illuminate\Database\Seeder;

class BottleTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bottletypes')->insert([
            'Name' => 'Pet'
        ]);

        DB::table('bottletypes')->insert([
            'Name' => 'Garrafa'
        ]);

        DB::table('bottletypes')->insert([
            'Name' => 'Lata'
        ]);
    }
}
