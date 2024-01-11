<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Ordine;
use Illuminate\Support\Facades\Config;
class Prodotto extends Model
{
    public $table='prodotto';
    public $timestamps=false;
    protected $fillable=['nome_it','nome_en','nome_es','categoria','prezzo','nota_it','nota_en','nota_es','descrizione_it','descrizione_en','descrizione_es','disponibilita','pathImmagine'];
    use HasFactory;

    public function ordini(){
        return $this->belongsToMany(Ordine::class,'riga_ordine','prodotto_id','ordine_id')->withPivot('quantita');
    }
   
}
