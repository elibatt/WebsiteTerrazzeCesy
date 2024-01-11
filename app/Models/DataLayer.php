<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Utente;
use \App\Models\Prodotto;

class DataLayer extends Model
{
    /* INIZIO PARTE LOGIN */ 
    public function validUser($username, $password)
    {
        $users = Utente::where('username', $username)->get(['password']);

            //se non esiste utente
        if (count($users) == 0) {
            return false;
        }
            //se invece eesiste, controlla che l' md5 della sua password corrisponda a quella registrata per quell'utente
        return (md5($password) == ($users[0]->password));
    }

    public function addUser($nome,$cognome,$email,$username, $password, $cellulare)
    {
        $user = new Utente();
        $user->nome = $nome;
        $user->cognome = $cognome;
        $user->email = $email;
        $user->username = $username;
        $user->password = md5($password);
        $user->cellulare=$cellulare;
        
        $user->save();
        
    }

    public function getIstanzaUtente($id){
        $utente=Utente::where('id',$id)->first();
        return $utente;
    }
    public function convertArray($array){
        $arrayProdotti=array();
        foreach($array as $item){
            $prodotto= Prodotto::where('id',$item);
            array_push($arrayProdotti,$prodotto);
        }
        return $arrayProdotti;
    }
    
    /* FINE PARTE LOGIN */ 
    use HasFactory;
}
