<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Ordine;
class Utente extends Model
{
    public $table='utente';
    public $timestamps=false;
    protected $fillable=['nome','cognome','email','username','password','cellulare','permesso'];
    use HasFactory;

    public function ordini(){
        return $this->hasMany(Ordine::class,'id_utente')->orderBy('data','desc');
    }

    public function codice_sconto_usati(){
        return $this->belongsToMany(CodiceSconto::class, 'utente_codice_sconto');
    }
}
