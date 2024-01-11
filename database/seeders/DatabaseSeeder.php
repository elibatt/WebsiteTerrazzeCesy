<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Ordine;
use \App\Models\Prodotto;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        \App\Models\Utente::factory(20)->create();
       \App\Models\Ordine::factory(20)->create();
      
        \App\Models\Prodotto::factory(20)->create();
       

       
        //molti a molti ordine prodotto tramite riga_ordine
        $prodotti=Prodotto::all();
        Ordine::all()->each(function($ordine)use($prodotti){
            $ordine->prodotti()->attach(
                $prodotti->random(rand(1,3))->pluck('id')->toArray()
            );
        });
    }
}
