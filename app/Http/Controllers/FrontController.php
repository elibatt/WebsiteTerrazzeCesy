<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;



class FrontController extends Controller
{
    public function getHome()
    {
        session_start();
       
        if (isset($_SESSION['logged'])) {
            $idUtente=$_SESSION['idUtente'];
            return view('welcome')->with('logged', true)->with('idUtente',$idUtente);
        } else {
            return view('welcome')->with('logged', false);
        }
    }

    public function getAbout()
    {
        session_start();
       
        if (isset($_SESSION['logged'])) {
            $idUtente=$_SESSION['idUtente'];
            return view('about')->with('logged', true)->with('idUtente',$idUtente);
        } else {
            return view('about')->with('logged', false);
        }
    }

    public function getContatti()
    {
        session_start();
        //istanza di agent per capire browser utente; sulla base di quello visualizzo o meno mappa di maps (problemi firefox)
       $agent = new Agent();
        if (isset($_SESSION['logged'])) {
            $idUtente=$_SESSION['idUtente'];
            return view('contatti')->with('logged', true)->with('idUtente',$idUtente)->with('agent',$agent);
        } else {
            return view('contatti')->with('logged', false)->with('agent',$agent);
        }
    }
}
