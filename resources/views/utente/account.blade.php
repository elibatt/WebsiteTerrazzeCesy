@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>@lang('labels.profilo')</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">@lang('labels.profilo')</li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('content')

    <!--controllo che l'utente loggato possa accedere alla sua sola anagrafica -->
    @if($utente->id == $idUtente)
    <div class="container">
       
        <div class="row md-5 mt-4 ml-3">
           
                <h1> <b>@lang('labels.profiloDi') : {{ucfirst($utente->nome)}}</b></h1>
        </div>
        <div class="row md-3 mt-4 mb-4" style="border:2px solid black;">
            
            <div class="col">
                <div class=" text-center ml-2 mr-2 mt-5">
                    <p><h2><b>@lang('labels.datiUtente') :</b></h2></p> 
                    <div class=" text-center ml-5 mr-5 mb-3">
                        <ul class="mt-5">
                            <li><h2> <p>@lang('labels.email') :</p>   {{$utente->email}}</h2></li>
                            <li><h2><p>Username:</p>  {{$utente->username}}</h2></li>
                        </ul>
                        <ul>
                            <li><h2> <p>@lang('labels.nome') :</p>   {{$utente->nome}}</h2></li>
                            <li><h2><p>@lang('labels.cognome') :</p>  {{$utente->cognome}}</h2></li>
                            <li><h2><p>@lang('labels.cellulare') :</p>  {{$utente->cellulare}}</h2></li>
                        </ul>
                        
                        
                    </div>
                </div>
                <div class="text-center mt-5 mb-3">
                    <a href="{{asset('/utente/cambiopassword')}}"><button class="btn btn-warning"><h2>@lang('labels.cambioPassword')</h2></button></a>
                </div>
            </div>

            <div class="col">
              
                <div class=" text-center ml-2 mr-2 mt-5">
                   @if($utente->permesso == 'amministratore')
                    @if(!$ordini->contains('stato_conferma','confermato'))
                        <div class="row md-5 mt-5 mb-5" style="justify-content:center">
                                <div class=" mt-4 ">
                                <p><h2>@lang('labels.nessunOrdine')</h2></p> 
                                </div>
                        </div>
                        <div class="row md-5 mt-5 mb-5" style="justify-content:center">
                                <div class=" mt-4 ">
                                   <a href="{{asset('/ordini')}}" > <button type="button" class="btn btn-success"style="color:white" id="bottoneRiepilogoAmm">@lang('labels.riepilogoClienti')</button></a>
                                </div>   
                        </div>
                    @else
                        <div class="row md-5 mt-5 mb-5" style="justify-content:center">
                                <div class=" mt-4 ">
                                   <a href="{{asset('/ordini')}}" > <button type="button" class="btn btn-success"style="color:white" id="bottoneRiepilogoAmm">@lang('labels.riepilogoClienti')</button></a>
                                </div>   
                        </div>
                    @endif
                   @else 
                        
                        @if(!$utente->ordini()->get()->contains('stato_conferma','confermato'))
                            <p><h2>@lang('labels.futuriOrdini')</h2></p> 
                        @else
                        <div class="row md-5 mt-5 mb-5" style="justify-content:center">
                                <div class=" mt-4 ">
                                   <a href="{{asset('/ordini')}}" > <button type="button" class="btn btn-success" style="color:white" >@lang('labels.tuoiOrdini')</button></a>
                                </div>   
                        </div>
                        @endif
                         
                    @endif
                </div>
            </div>
          
        </div>
                
        
        @if(!$utente->ordini()->get()->contains('stato_conferma','confermato'))
      
        <div class="row md-5 mt-5 mb-5" style="justify-content:center">
                <div class=" mt-4 " >
                    <a href="{{asset('/prodotti')}}" ><button type="button" class="btn btn-info"><h3 style="color:white">@lang('labels.backProdotti')</h3></button></a>
                </div>   
        </div>
        
        @endif
    </div>
    @else
    <div class="container">
        <div class="row mt-5 mb-5">
            <h1>@lang('labels.noaccesso')</h1>
        </div>
    </div>
    @endif
@endsection