<?php

namespace App\Http\Controllers;

use App\Models\Ordine;
use App\Models\Utente;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;


class OrdineController extends Controller
{
   
    public function getIstanzaUtente($id){
        $utente=Utente::where('id',$id)->first();
        return $utente;
    }
    
    public function index()
    {
        //elenco/gestionale di tutti gli ordini effettuati dai clienti, pensato per amministratore
        session_start();
        $lingua= Config::get('app.locale');
        if(isset($_SESSION['logged'])){
        $ordini=Ordine::where('stato_conferma','confermato')->orderBy('data','desc')->get();
        
      
        $idUtente=$_SESSION['idUtente'];
        $utente= $this->getIstanzaUtente($_SESSION['idUtente']);
        $matchThese = ['id_utente' => $idUtente, 'stato_conferma' => 'confermato'];
        $numeroOrdiniConfermati = Ordine::where($matchThese)->count();
        return view('ordine.index')->with('ordini',$ordini)->with('utente',$utente)->with('idUtente',$idUtente)->with('logged',true)->with('lingua',$lingua)->with('numOrdiniConf', $numeroOrdiniConfermati);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        session_start();
        $lingua= Config::get('app.locale');
        if($_SESSION['logged']){
            //salvo totale dell'ordine
            $totale=$request->totaleHidden;
            $codiceSconto=$request->codiceScontoHidden;
            $utente= $this->getIstanzaUtente($_SESSION['idUtente']);
            //Creo istanza ordine (e quindi associato con utente loggato)
            $idUtente=$_SESSION['idUtente'];
            $mytime = Carbon::now();
            $data=$mytime->toDateTimeString();
            $ordineNuovo= new Ordine;
            $ordineNuovo->id_utente=$idUtente;
           $ordineNuovo->data=$data;
           $ordineNuovo->totale=$totale;
           if($codiceSconto != ''){
            $ordineNuovo->codiceSconto=$codiceSconto;
            }   
            $ordineNuovo->save();

            //metto ogni prodotto di $_SESSION['carrello'] e relativa qtà in $_SESSION['quantita'] 
            //all'interno della relazione Ordine->prodotti() (1:molti), tramite attach

            foreach($_SESSION['carrello'] as $item){
                $key=array_search($item, $_SESSION['carrello']);
                $ordineNuovo->prodotti()->attach($item,['quantita'=>$_SESSION['quantita'][$key]]);
            }

            Log::channel('customOrdini')->info(nl2br('Utente id: '.$_SESSION['idUtente'].' ha generato l\'ordine '.$ordineNuovo->id. " (che potrà essere confermato o annullato).\n Altre info: ".$ordineNuovo."\n Altre info: ".$utente));
            //ritorno la view di riepilogo ordine (dove si potrà cancellare ordine o pagare/confermare)
           return view('ordine.riepilogo')->with('logged',true)->with('idUtente',$idUtente)->with('ordine',$ordineNuovo)->with('totale',$totale)->with('codiceSconto',$codiceSconto)->with('lingua',$lingua);
        }
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ordine  $ordine
     * @return \Illuminate\Http\Response
     */
    // public function pagamento(Ordine $ordine)
    // {
        
    //     session_start();
    //     if(isset($_SESSION['logged'])){
    //         $idUtente=$_SESSION['idUtente'];
    //         //mi assicuro che l'id utente associato a $ordine parametro sia lo stesso loggato
    //         if($ordine->id_utente==$idUtente){
    //              $ordine->update([
    //             'pagamento'=>'paypal'
    //         ]);
            
            
            
    //         return redirect($ordine->id.'/apply-two-paypal');
    //         }
           
    //     }
       
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ordine  $ordine
     * @return \Illuminate\Http\Response
     */
    public function edit(Ordine $ordine)
    {
       /* $prodottoId=3;
        $ordine->prodotti()->attach($prodottoId,['quantita'=>22]);*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ordine  $ordine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ordine $ordine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ordine  $ordine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ordine $ordine, Request $request)
    {
        session_start();
       
        if(isset($_SESSION['logged'])){
             $idUtente=$_SESSION['idUtente'];
             $utente= $this->getIstanzaUtente($_SESSION['idUtente']);
            if($ordine->id_utente == $idUtente){
               
               
                if(strpos($request->previous_url, 'ordini')>-1){
                    $ordine->update([
                        'stato_accettazione'=>'annullato',
                        'motivazione'=> 'Ordine annullato dal cliente',
                    ]);
                    Log::channel('customOrdini')->info(nl2br('Utente id: '.$_SESSION['idUtente'].' ha cancellato l\'ordine DOPO averlo confermato '.$ordine->id."\n Altre info: ".$ordine."\n Altre info: ".$utente));
                    return redirect('/ordini');
                }else{
                    $ordine->delete();
                    Log::channel('customOrdini')->info(nl2br('Utente id: '.$_SESSION['idUtente'].' ha cancellato l\'ordine PRIMA di confermarlo '.$ordine->id."\n Altre info: ".$ordine."\n Altre info: ".$utente));
                    return redirect('/carrello');
                }
            }else{
                return redirect()->back();
            }
       
        }
       
    }
  

    public function confermaDestroy(Ordine $ordine)
    {
        //prima di eliminare ordine definitivamente chiedo conferma
        session_start();
        if(isset($_SESSION['logged'])){
            $idUtente=$_SESSION['idUtente'];
            $idUtenteOrdine=$ordine->id_utente;
            
            
        }
        
        return view('ordine.delete')->with('logged',true)->with('idUtente',$idUtente)->with('idUtenteOrdine',$idUtenteOrdine);
        
    }

    public function conferma(Request $request){
        $idOrdine = $request->idOrdine;
        $ordine= Ordine::where('id',$idOrdine)->first();
        $ordine->update([
            'stato_conferma' => 'confermato',
             
        ]);
        
        
    }

    public function confermaPaypal(Request $request){
        $idOrdine = $request->idOrdine;
        $ordine= Ordine::where('id',$idOrdine)->first();
        $ordine->update([
            'stato_conferma' => 'confermato',
            'pagamento' => 'paypal', 
        ]);
        
        
    }

    public function view_accettazione(Ordine $ordine){
        session_start();
        if(isset($_SESSION['logged'])){
             $idUtente=$_SESSION['idUtente'];
             $utente= $this->getIstanzaUtente($_SESSION['idUtente']);
        return view('ordine.accettazione')->with('ordine',$ordine)->with('utente',$utente)->with('logged',true)->with('idUtente',$idUtente);
        }
    }
    public function accettazione(Ordine $ordine){
        session_start();
        $lingua= Config::get('app.locale');
        $ordini=Ordine::where('stato_conferma','confermato')->get();

        if(isset($_SESSION['logged'])){
            $idUtente=$_SESSION['idUtente'];
            $utente= $this->getIstanzaUtente($_SESSION['idUtente']);
            if($utente->permesso == 'amministratore'){
                 if($ordine->stato_accettazione == 'non accettato'){
                    $ordine->update([
                        'stato_accettazione' => 'accettato',
                
                    ]);
                }else{
                    $ordine->update([
                        'stato_accettazione' => 'non accettato',
                
                    ]);
                }
            }
            return redirect('/ordini')->with('ordini',$ordini)->with('utente',$utente)->with('idUtente',$idUtente)->with('logged',true)->with('lingua',$lingua);
       
    }
      
        
        
    }

    public function gestioneAccettazione(Request $request, Ordine $ordine){
      
        session_start();
        $lingua= Config::get('app.locale');
        $ordini=Ordine::where('stato_conferma','confermato')->get();

        if(isset($_SESSION['logged'])){
            $idUtente=$_SESSION['idUtente'];
            $utente= $this->getIstanzaUtente($_SESSION['idUtente']);


            if($utente->permesso == 'amministratore'){
                $statoAccettazione = $request->statoAccettazioneSelect;
                $motivazione = $request->motivazioneAccettazioneSelect;
                
                $ordine->update([
                    'motivazione'=>$motivazione,
                    'stato_accettazione'=>$statoAccettazione,
                ]);
                return redirect('/ordini')->with('ordini',$ordini)->with('utente',$utente)->with('idUtente',$idUtente)->with('logged',true)->with('lingua',$lingua);
            }
            
        }       
    
    }

}
