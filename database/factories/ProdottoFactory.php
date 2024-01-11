<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prodotto>
 */
class ProdottoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(){

        return [
            'nome_it'=>$this->faker->word(),
            'nome_en'=>$this->faker->word(),
            'nome_es'=>$this->faker->word(),
            'categoria'=>$this->faker->randomElement(['cosmesi','uso_alimentare']),
            'prezzo'=>$this->faker->randomElement(['10.50','18.30']),
            'nota_it'=>$this->faker->sentence(),
            'nota_en'=>$this->faker->sentence(),
            'nota_es'=>$this->faker->sentence(),
            'descrizione_it'=>$this->faker->sentence(),
            'descrizione_en'=>$this->faker->sentence(),
            'descrizione_es'=>$this->faker->sentence(),
            'disponibilita'=>$this->faker->randomElement(['disponibile','non_disponibile']),
            'pathImmagine'=>$this->faker->randomElement(['immagini/miele.jpg','immagini/miele.jpg']),
        ];
    }
}
