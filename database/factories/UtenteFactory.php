<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utente>
 */
class UtenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'username'=>$this->faker->firstName(),
            'password'=>$this->faker->password(),
            'email'=>$this->faker->email(),
            'nome'=>$this->faker->firstName(),
            'cognome'=>$this->faker->lastName(),
            'cellulare'=>$this->faker->randomNumber(),
            'permesso'=>$this->faker->randomElement(['utente','utente']),

        ];
    }
}
