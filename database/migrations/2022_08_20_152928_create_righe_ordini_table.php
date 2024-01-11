<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riga_ordine', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ordine_id');
             $table->unsignedBigInteger('prodotto_id'); 
             $table->integer('quantita')->default('1');
             $table->foreign('ordine_id')->references('id')->on('ordine')->onDelete('cascade');;
             $table->foreign('prodotto_id')->references('id')->on('prodotto')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riga_ordine');
    }
};
