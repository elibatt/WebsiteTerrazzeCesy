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
        Schema::create('utente_codice_sconto', function (Blueprint $table) {
            $table->id();
            $table->integer('utente_id')->unsigned();
            $table->foreign('utente_id')->references('id')->on('utente')->onDelete('cascade');
            $table->integer('codice_sconto_id')->unsigned();
            $table->foreign('codice_sconto_id')->references('id')->on('codice_sconto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utente_codice_sconto');
    }
};
