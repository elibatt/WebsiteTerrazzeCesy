<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Utente;
use \App\Models\Prodotto;
use \App\Models\CodiceSconto;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class CarrelloController extends Controller
{
    public function carrello(Request $request){
        session_start();
        
        $lingua= Config::get('app.locale');
        $lingueArray=['it','en','es'];
        $indiceLingua = array_search($lingua, $lingueArray);
        $elementoPresente=['Elemento già presente nel carrello. Puoi modificarne la quantità direttamente nel carrello','Item already present in the cart. You can change the quantity directly in the cart','Artículo ya presente en el carrito. Puedes cambiar la cantidad directamente en el carrito'];
        $elementoAggiunto=['Elemento correttamente aggiunto nel carrello 🌻','Item successfully added to shopping cart 🌻','Artículo agregado con éxito al carrito de compras 🌻'];
        $loginNecessario=['Per aggiungere elementi al carrello devi prima fare login','To add items to your cart you must first log in','Para agregar artículos a su carrito primero debe iniciar sesión (login)'];
        

        if(isset($_SESSION['logged'])){
            if(in_array($request->idProdotto,$_SESSION['carrello'])){
                //return "Elemento già presente nel carrello. Puoi modificarne la quantità direttamente nel carrello";
                return $elementoPresente[$indiceLingua];
            }else{
                 $_SESSION['carrello'][]=$request->idProdotto;
                 $_SESSION['quantita'][]=$request->quantitaProdotto;
                 $prodotto=Prodotto::where('id',$request->idProdotto)->first();
                 $utente=Utente::where('id',$_SESSION['idUtente'])->first();
                 Log::channel('customOrdini')->info(nl2br('Utente id: '.$_SESSION['idUtente'].' ha aggiunto al carrello il prodotto con id '.$prodotto->id."\n Altre info: ".$prodotto."\n Altre info: ".$utente));
                 //return "Elemento correttamente aggiunto nel carrello 🌻";
                 return $elementoAggiunto[$indiceLingua];
            }
           
        }else{
            //return "Per aggiungere elementi al carrello devi prima fare login";
            return $loginNecessario[$indiceLingua];
        }
        
    }

    public function rimuoviDaCarrello(Request $request){
       session_start();
        
        if(isset($_SESSION['logged'])){
            $key=array_search($request->idsingolo, $_SESSION['carrello']);
            //$arraySessione=$_SESSION['carrello'];
            unset($_SESSION['carrello'][$key]);
            unset($_SESSION['quantita'][$key]);
            $prodotto=Prodotto::where('id',$request->idsingolo)->first();
            $utente=Utente::where('id',$_SESSION['idUtente'])->first();
            Log::channel('customOrdini')->info(nl2br('Utente id: '.$_SESSION['idUtente'].' ha tolto dal carrello il prodotto con id '.$prodotto->id."\n Altre info: ".$prodotto."\n Altre info: ".$utente));

            

            return($_SESSION['carrello']);
        }
     
        
    }

    public function modificaCarrello(Request $request){
       session_start();
        
        if(isset($_SESSION['logged'])){
            $key=array_search($request->idsingolo, $_SESSION['carrello']);
            $nuovaquantita=$request->nuovaquantita;
            $_SESSION['quantita'][$key]=$nuovaquantita;
            return array($_SESSION['quantita'], $_SESSION['carrello']);
        }
    }

    public function myBag(){
        session_start();
        $lingua= Config::get('app.locale');
        if(isset($_SESSION['logged'])){

            $array=$_SESSION['carrello'];
            $idUtente =$_SESSION['idUtente'];
            $utente = Utente::where('id',$idUtente)->first();
            $nuovoarray=array();
           

            foreach($array as $idItem){
                $item=Prodotto::where('id',$idItem)->first();
                array_push($nuovoarray,$item);
            }

            return view('utente.carrello')->with('logged',true)->with('prodotti', $nuovoarray)->with('utente',$utente)->with('idUtente',$idUtente)->with('lingua',$lingua);
        
        }
        else{
            return view('utente.carrello')->with('logged',false);
        }
    }

    public function verificaCodiceSconto(Request $request){
        $return = array(
            'esito' => false,
            'messaggio' => "",
            'percentuale_sconto' => 0
        );

        $testo_codice_sconto = strtoupper(trim($request->testo_codice_sconto));
        $obj_codice_sconto = CodiceSconto::where('testo',$testo_codice_sconto)->first();

        if(empty($obj_codice_sconto)){
            $return['messaggio'] = 'Codice sconto non valido!';
            return $return;
        }

        $utente = Utente::where('id',$request->id_utente)->first();

        $codici_sconto = $utente->codice_sconto_usati()->get();
        foreach($codici_sconto as $codice_sconto){
            if($testo_codice_sconto == $codice_sconto->testo){
                $return['messaggio'] = 'Codice sconto già utilizzato!';
                return $return;
            }
        }
        
        $return['esito'] = true;
        $return['messaggio'] = 'Codice sconto applicato!';
        $return['percentuale_sconto'] = $obj_codice_sconto->percentuale_sconto;

        $utente->codice_sconto_usati()->attach($obj_codice_sconto->id);

        return $return;
    }
}
