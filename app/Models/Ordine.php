<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Prodotto;

use \App\Models\Utente;
class Ordine extends Model
{
    public $table='ordine';
    public $timestamps=false;
    protected $fillable=['data','id_utente','totale','codiceSconto','stato_conferma','pagamento','stato_accettazione','motivazione'];
    use HasFactory;

    public function prodotti(){
        return $this->belongsToMany(Prodotto::class,'riga_ordine','ordine_id','prodotto_id')->withPivot('quantita');
    }
    /*public function pagamento(){
        return $this->hasOne(Pagamento::class);
    }*/
    public function utente(){
        return $this->belongsTo(Utente::class,'id_utente');
    }
}
