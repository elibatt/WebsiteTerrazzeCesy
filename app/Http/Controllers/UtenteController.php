<?php

namespace App\Http\Controllers;

use App\Models\Utente;
use App\Models\Prodotto;
use App\Models\Ordine;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class UtenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Utente  $utente
     * @return \Illuminate\Http\Response
     */
    public function show(Utente $utente)
    {
        //account utente
        session_start();
        $lingua= Config::get('app.locale');
        $ordini= Ordine::all();
        if(isset($_SESSION['logged'])){
            $idUtente=$_SESSION['idUtente'];
        return view('utente.account')->with('utente',$utente)->with('logged',true)->with('idUtente',$idUtente)->with('lingua',$lingua)->with('ordini',$ordini);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Utente  $utente
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //mando alla view per cambiare password
        session_start();
        if(isset($_SESSION['logged'])){
            $idUtente=$_SESSION['idUtente'];
            $utente=Utente::where('id',$idUtente)->first();
            return view('utente.cambiopassword')->with('logged',true)->with('utente',$utente)->with('idUtente',$idUtente);
        }
    }

    public function cambiaPassword(Request $request){
        //cambio effettivo della pw
        session_start();
        if(isset($_SESSION['logged'])){
            $idUtente=$_SESSION['idUtente'];
            $utente=Utente::where('id',$idUtente)->first();
            $utente->update([
                'password'=>md5($request->passwordCambiata),
            ]);
            return redirect('/anagrafica'.'/'.$idUtente)->with('utente',$utente)->with('logged',true)->with('idUtente',$idUtente);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Utente  $utente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Utente $utente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Utente  $utente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Utente $utente)
    {
        //
    }


}
