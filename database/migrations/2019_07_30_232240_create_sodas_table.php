<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSodasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Sodas', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->unsignedBigInteger('BrandId');
            $table->unsignedBigInteger('BottleTypeId');
            $table->string('Flavor', 45)->nullable();
            $table->decimal('Liters', 5, 3)->nullable();
            $table->decimal('UnitaryValue', 4,2)->nullable();
            $table->timestamps();
            
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        Schema::table('Sodas', function (Blueprint $table) {
            $table->foreign('BrandId')->references('Id')->on('Brands').onDelete('cascade');
            $table->foreign('BottleTypeId')->references('Id')->on('BottleTypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sodas');
    }
}
