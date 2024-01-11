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
        Schema::create('ordine', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data');
            $table->integer('id_utente');
            $table->float('totale');
            $table->string('codiceSconto')->default('');
            $table->enum('stato_conferma',['confermato', 'non confermato'])->default('non confermato');
            $table->enum('pagamento', ['al ritiro', 'paypal'])->default('al ritiro');
            $table->enum('stato_accettazione',['accettato', 'non accettato', 'in attesa di verifica'])->default('in attesa di verifica');
            $table->string('motivazione')->default('Ordine in attesa di conferma da parte dell\'azienda.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordine');
    }
};
