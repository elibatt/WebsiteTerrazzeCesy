<?php

namespace App\Http\Controllers;
use App\Mail\NuovoOrdine;
use Illuminate\Http\Request;
use App\Models\Email;
use Illuminate\Support\Facades\Log;
use App\Models\Ordine;
use App\Models\Utente;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    
    public function mailOrdine(Ordine $ordine)
    {
      
        session_start();
        //se si arriva qui è perchè è stato fatto un ordine e si vuole inviare mail ad amministratore
        if(isset($_SESSION['logged'])){
            
            $idUtente=$_SESSION['idUtente'];
            $utente = Utente::where('id',$idUtente)->first();

            //svuoto carrello post ordine effettuato
            $_SESSION['carrello']=array();
            $_SESSION['quantita']=array();
            
            $ordine->update([
                'stato_conferma'=>'confermato',
                ]);
            //mando mail notifica ad amministratore
            $email= new Email();
            Mail::to('mailprovaazienda@gmail.com')->send(new NuovoOrdine($email));
            //salvo in log
            Log::channel('customOrdini')->info(nl2br('Utente id: '.$_SESSION['idUtente'].' ha confermato l\'ordine '.$ordine->id. ' con pagamento:'.$ordine->pagamento."\n Altre info: ".$ordine."\n Altre info: ".$utente));
           return redirect('/ordini');
        }
        
        
    }
    
    public function mailOrdinePaypal(Ordine $ordine)
    {
      
        session_start();
        //se si arriva qui è perchè è stato fatto un ordine e si vuole inviare mail ad amministratore
        if(isset($_SESSION['logged'])){
            
            $idUtente=$_SESSION['idUtente'];
            $utente = Utente::where('id',$idUtente)->first();

            //svuoto carrello post ordine effettuato
            $_SESSION['carrello']=array();
            $_SESSION['quantita']=array();
            
            $ordine->update([
                'stato_conferma'=>'confermato',
                'pagamento'=>'paypal',
                ]);
            //mando mail notifica ad amministratore
            $email= new Email();
            Mail::to('mailprovaazienda@gmail.com')->send(new NuovoOrdine($email));
            //salvo in log
            Log::channel('customOrdini')->info(nl2br('Utente id: '.$_SESSION['idUtente'].' ha confermato l\'ordine '.$ordine->id. ' con pagamento:'.$ordine->pagamento."\n Altre info: ".$ordine."\n Altre info: ".$utente));
           return redirect('/ordini');
        }
        
        
    }

   
}
