<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\DataLayer;
use \App\Models\Utente;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{
    public function authentication() {
        session_start();
        if(isset($_SESSION['logged'])){
            $idUtente=$_SESSION['idUtente'];
            return redirect('/')->with('logged', true)->with('idUtente',$idUtente);
        }else{
            return view('auth.auth')->with('registrazione',false);
        }
        
    }

    public function logout() {

        session_start();
        $utente=Utente::where('id',$_SESSION['idUtente'])->first();
        session_destroy();
        Log::channel('customLogin')->info(nl2br('Utente id: '.$utente->id." ha fatto logout.\n Altre info: ".$utente));
        return Redirect::to(route('home'));
      
    }
    
    public function login(Request $request) {
        
        session_start();
        $dl = new DataLayer();
       
        if ($dl->validUser($request->input('username'), $request->input('password'))) 
        {
            
            $_SESSION['logged'] = true;
            //recupero istanza di utente con username inserito (unico, non ci possono essere duplicati)
            $utente=Utente::where('username',$request->input('username'))->first();
            //salvo in $_SESSION il permesso dell'utente(utente default), l'id, il proprio array carrello e quello delle quantità dei prodotti (array //)
            $_SESSION['permesso']=$utente->permesso;
            $_SESSION['idUtente']=$utente->id;
            $carrello=array();
            $quantita=array();
            $_SESSION['carrello']=$carrello;
            $_SESSION['quantita']=$quantita;
            Log::channel('customLogin')->info(nl2br('Utente id: '.$utente->id." ha fatto login.\n Altre info: ".$utente));
           return  Redirect::to(asset('anagrafica/'.$utente->id))->with('logged',true)->with('idUtente', $utente->id);
          

        }
       
       
        return view('auth.authErrorPage');
    }
    
    public function registration(Request $request) {
        $dl = new DataLayer();
        
        $dl->addUser(
            $request->input('nome'),
            $request->input('cognome'),
            $request->input('email'),
            $request->input('username'),
            $request->input('password'),
            $request->input('cellulare'),
            );
       
     
        return view ('auth.auth')->with('registrazione',true);
    }    

    public function insertRegistration(){
        session_start();
        if(isset($_SESSION['logged'])){
            $idUtente=$_SESSION['idUtente'];
            return redirect('/')->with('logged', true)->with('idUtente',$idUtente);
        }else{
        return view('auth.registration');
        }
    }

    /*public function verificaUsername(Request $request)
    {
        $dl = new DataLayer();

        return $dl->username($request->input('username'));
    }*/
    public function verificaEmail(Request $request)
    {
        $email = $request->email;

        return Utente::where('email', $email)->count();

    }
    public function verificaUsername(Request $request)
    {
        $username = $request->username;
        return Utente::where('username', $username)->count();

    }

    public function checkLanguage(Request $request){
        $lingua= Config::get('app.locale');
        return $lingua;
    }
}
