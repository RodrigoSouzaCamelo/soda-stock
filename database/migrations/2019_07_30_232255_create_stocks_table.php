<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Stocks', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->unsignedBigInteger('SodaId');
            $table->unsignedBigInteger('ProductStatusId');
            $table->timestamps();
            
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        Schema::table('Stocks', function (Blueprint $table) {
            $table->foreign('SodaId')->references('Id')->on('Sodas');
            $table->foreign('ProductStatusId')->references('Id')->on('ProductsStatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
