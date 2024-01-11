<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Utente;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ordine>
 */
class OrdineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $utenti=Utente::all();
        return [
            'data' => \Carbon\Carbon::parse($this->faker->dateTime($max = 'now', $timezone = null))->format('Y-m-d H:i:s'),
            //'data'=>$this->faker->dateTime(),
            'id_utente'=>$utenti->random(1)->pluck('id')->first(),
            'totale'=>$this->faker->randomNumber(2,true),
            'codiceSconto'=>$this->faker->randomElement(['','']),
            'stato_conferma'=>$this->faker->randomElement(['confermato','non confermato']),
            'pagamento'=>$this->faker->randomElement(['al ritiro','paypal']),
            'stato_accettazione'=>$this->faker->randomeElement(['accettato','non accettato','in attesa di verifica']),
            'motivazione'=>$this->faker->randomElement(['Ordine in attesa di conferma da parte dell\'azienda.','Ordine in attesa di conferma da parte dell\'azienda.']),

        ];
    }
}
