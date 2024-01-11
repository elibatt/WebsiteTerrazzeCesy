@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>@lang('labels.dicituraCambioPw')</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{asset('/anagrafica/'.$idUtente)}}">@lang('labels.profilo')</a></li>
                            <li class="breadcrumb-item active">@lang('labels.dicituraCambioPw')</li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('content')
<div class="container">
    @if($logged)
 
        <div class="row md-5 mt-4 ml-2 mb-3">
           
                <h1> <b>@lang('labels.dicituraCambioPw') - @lang('labels.profiloDi') {{ucfirst($utente->nome)}}</b></h1>
        </div>
    <div class="row mt-5 mb-5">
        <div class="col-sm-7 col-md-7 col-lg-7">
            <h2>@lang('labels.inserisciPw'):</h2>
            <form action="{{asset('/utente/cambiopassword')}}" method="post">
                @csrf
                <input type="password" name="passwordCambiata" id="passwordCambiata" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')" placeholder="@lang('labels.nuovaPassword')">
                <br>
                <span id="messagePasswordNuova"></span><br>
                <h2>@lang('labels.confirmPassword'):</h2>
                <input type="password" name="confermaPasswordCambiata" id="confermaPasswordCambiata" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')" placeholder="@lang('labels.confirmPassword')"><br><hr>
                <span id="messagePasswordCambiata"></span><br><br>
                <button type="submit" class="btn btn-success" id="bottoneCambioPw"  ><h2 style="color:white;">@lang('labels.conferma')</h2></button>
            </form>
        </div>
       
        <div class="col-sm-4 col-md-4 offset-md-1 col-lg-4 ">
           <a href=""> <button class="btn btn-info">@lang('labels.tornaProfilo')</button></a>
        </div>
    </div>
    @else
    <h2>@lang('labels.noaccesso')</h2>
    @endif
</div>
@endsection