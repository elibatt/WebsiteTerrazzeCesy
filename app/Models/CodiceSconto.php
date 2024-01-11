<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Utente;

class CodiceSconto extends Model
{
    public $table='codice_sconto';
    public $timestamps=false;
    protected $fillable=['testo', 'percentuale_sconto'];

    public function utenti(){
        return $this->hasMany(Utente::class,'utente_codice_sconto');
    }
    
    use HasFactory;
}
