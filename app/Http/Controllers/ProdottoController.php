<?php

namespace App\Http\Controllers;

use App\Models\Prodotto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\File;
use Carbon\Carbon;
class ProdottoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lingua= Config::get('app.locale');
        $prodotti=Prodotto::all();
        session_start();
        if(isset($_SESSION['logged'])){
            $idUtente=$_SESSION['idUtente'];
            return view('prodotto.index')->with('logged',true)->with('permesso',$_SESSION['permesso'])->with('prodotti',$prodotti)->with('idUtente',$idUtente)->with('lingua',$lingua);
        }
        else{
            return view('prodotto.index')->with('logged',false)->with('prodotti',$prodotti)->with('lingua',$lingua);
        }
         
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session_start();
        if(isset($_SESSION['logged'])){
            $idUtente=$_SESSION['idUtente'];
            $permesso=$_SESSION['permesso'];
            
            return view('prodotto.create')->with('logged',true)->with('idUtente',$idUtente)->with('permesso',$permesso);
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
        $prodottoNuovo= new Prodotto();
        $prodottoNuovo->nome_it=$request->nome_it;
        $prodottoNuovo->nome_en=$request->nome_en;
        $prodottoNuovo->nome_es=$request->nome_es;
        $prodottoNuovo->categoria=$request->categoria;
        $prodottoNuovo->prezzo=floatval($request->prezzo);
        $prodottoNuovo->nota_it=$request->nota_it;
        $prodottoNuovo->nota_en=$request->nota_en;
        $prodottoNuovo->nota_es=$request->nota_es;
        $prodottoNuovo->descrizione_it=$request->descrizione_it;
        $prodottoNuovo->descrizione_en=$request->descrizione_en;
        $prodottoNuovo->descrizione_es=$request->descrizione_es;
        $prodottoNuovo->pathImmagine='immagini/';
        

        $prodottoNuovo->save();

        $imageName = $prodottoNuovo->nome_it.'.'.$request->immagine->getClientOriginalExtension();
        $request->immagine->move(public_path('immagini/'), $imageName);
       
        $prodottoNuovo->update([
          "pathImmagine"=>'immagini/'.$imageName,
        ]);

        Log::channel('customAmministratore')->info(nl2br('Amministratore  ha creato prodotto: '.$prodottoNuovo->nome_it.', id: '.$prodottoNuovo->id."\n Altre info: ".$prodottoNuovo));
        return redirect('/prodotti');
    }





    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prodotto  $prodotto
     * @return \Illuminate\Http\Response
     */
    public function show(Prodotto $prodotto)
    {
        $lingua= Config::get('app.locale');
        session_start();
        if(isset($_SESSION['logged'])){
        $idUtente=$_SESSION['idUtente'];
        return view('prodotto.show')->with('prodotto',$prodotto)->with('logged',true)->with('idUtente',$idUtente)->with('lingua',$lingua); 
        }else{
            return view('prodotto.show')->with('prodotto',$prodotto)->with('logged',false)->with('lingua',$lingua);  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prodotto  $prodotto
     * @return \Illuminate\Http\Response
     */
    public function edit(Prodotto $prodotto)
    {
        
        session_start();
        if(isset($_SESSION['logged'])){
            $idUtente=$_SESSION['idUtente'];
            $permesso=$_SESSION['permesso'];
            return view('prodotto.edit')->with('logged',true)->with('prodotto',$prodotto)->with('idUtente',$idUtente)->with('permesso',$permesso);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prodotto  $prodotto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prodotto $prodotto)
    {
              
             /* $imageName = $request->nome_it.'.'.$request->immagine->getClientOriginalExtension();
              $request->immagine->move(public_path('/immagini'), $imageName);*/

              if($request->immagine == null){
                if(File::exists(public_path().'/'.$prodotto->pathImmagine)){
                $str_arr = explode ("/", $prodotto->pathImmagine); 
                  $imageName=$str_arr[1];
                  
                }else{
                  //imposto immagine default
                  $imageName='Crema nutriente.png';
                }
              }else{
              $current_timestamp = Carbon::now()->timestamp;
               $imageName = $prodotto->nome_it.'_'.$current_timestamp.'.'.$request->immagine->getClientOriginalExtension();
              $request->immagine->move(public_path('/immagini'), $imageName);
              }

        $prodotto->update([
            
            'nome_it'=>$request->nome_it,
            'nome_en'=>$request->nome_en,
            'nome_es'=>$request->nome_es,
            'categoria'=>$request->categoria,
            'prezzo'=>floatval($request->prezzo),
            'nota_it'=>$request->nota_it,
            'nota_en'=>$request->nota_en,
            'nota_es'=>$request->nota_es,
            'descrizione_it'=>$request->descrizione_it,
            'descrizione_en'=>$request->descrizione_en,
            'descrizione_es'=>$request->descrizione_es,
            'pathImmagine' => 'immagini/'.$imageName,

        ]);
        Log::channel('customAmministratore')->info(nl2br('Amministratore  ha modificato prodotto: '.$prodotto->nome_it.', id: '.$prodotto->id."\n Altre info: ".$prodotto));
        return redirect('/prodotti/dettaglio/'.$prodotto->id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prodotto  $prodotto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prodotto $prodotto)
    {
        
        $prodotto->delete();
        Log::channel('customAmministratore')->info(nl2br('Amministratore  ha eliminato prodotto: '.$prodotto->nome_it.', id: '.$prodotto->id."\n Altre info: ".$prodotto));
        return redirect('/prodotti');
    }

    public function confermaDestroy(Prodotto $prodotto)
    {
        //prima di eliminare prodotto definitivamente chiedo conferma
        session_start();
        if(isset($_SESSION['logged'])){
            $idUtente=$_SESSION['idUtente'];
            $permesso=$_SESSION['permesso'];
        
        
        return view('prodotto.delete')->with('prodotto',$prodotto)->with('logged',true)->with('idUtente',$idUtente)->with('permesso',$permesso);
        }
    }

    public function cambiaDisponibilita(Prodotto $prodotto)
    {
        if($prodotto->disponibilita=='disponibile'){
            $prodotto->update([
                        'disponibilita'=>'non_disponibile'
                    ]);
                    Log::channel('customAmministratore')->info(nl2br('Amministratore ha modificato la disponibilità del prodotto: '.$prodotto->nome_it.', id: '.$prodotto->id." Da disponibile a non disponibile.\n Altre info: ".$prodotto));
        }else{
            $prodotto->update([
                'disponibilita'=>'disponibile'
            ]);
            Log::channel('customAmministratore')->info(nl2br('Amministratore ha modificato la disponibilità del prodotto: '.$prodotto->nome_it.', id: '.$prodotto->id." Da non disponibile a disponibile.\n Altre info: ".$prodotto));
        }
        
        return redirect('/prodotti');

    }
   
   
}
