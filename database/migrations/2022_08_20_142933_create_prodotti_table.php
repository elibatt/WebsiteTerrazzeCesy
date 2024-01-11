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
        Schema::create('prodotto', function (Blueprint $table) {
            $table->id();
            $table->string('nome_it');
            $table->string('nome_en');
            $table->string('nome_es');
            $table->enum('categoria', ['cosmesi', 'uso_alimentare']);
            $table->float('prezzo');
            $table->string('nota_it');
            $table->string('nota_en');
            $table->string('nota_es');
            $table->string('descrizione_it');
            $table->string('descrizione_en');
            $table->string('descrizione_es');
            $table->enum('disponibilita', ['disponibile', 'non_disponibile']);
            $table->string('pathImmagine');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prodotto');
    }
};
