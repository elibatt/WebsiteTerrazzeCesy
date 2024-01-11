@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>@lang('labels.prodottiIndex')</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">@lang('labels.prodottiIndex')</li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('content')
    <div class="product box">
        <div class="container">
                <div class="row md-5 mt-4">
                    <div class="col-lg-12">
                        <div style="text-align:center;">
                            <h1><b>@lang('labels.prodottiIndex')</b></h1>
                            <h3 class="mt-3">@lang('labels.prodottiIndexDidascalia')</h3>
                           
                        </div>
                    </div>
                </div>
                
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="special-menu text-center">
                            <div class="button-group filter-button-group">
                                <button class="active" data-filter="*" id="tuttiProdotti">@lang('labels.categoriaTutti')</button>
                                <button data-filter=".cosmesi" id="tastoCosmesi">@lang('labels.categoriaCosmesi')</button>
                                <button data-filter=".uso_alimentare" id="tastoUsoAlimentare">@lang('labels.categoriaAlim')</button>
                            </div>
                        </div>
                    </div>
                </div>
                @if($logged=='true')
                @if($permesso=='amministratore')
                <div class="row mt-2 mb-4" style="text-align:center;">
                    <div class="col">
                       <a href="{{asset('/prodotti/dettaglio/crea')}}"><button type="button" class="btn btn-success">@lang('labels.nuovoProdotto')</button></a> 
                    </div>
                </div>
                @endif
                @endif

                <div class="row mt-2 mb-4" style="text-align:center;" id>
                    <div class="col-8 offset-2">
                      <h3> @lang('labels.cercaProdotti')</h3><input type="text" name="ricerca" id="inputProdotto" >
                    </div>
                    <div class="col-2" >
                       <button class="btn btn-info" id="tastoReset">Tasto reset</button>
                    </div>
                </div>

                <!-- <div class="row mt-3 mb-3 text-center">
                    <div class="col-4 offset-8">
                        <button class="btn btn-info" style="color:white; background-color: #60a5a5" id="ordinaPrezzo">Ordina per prezzo</button>
                    </div>
                </div> -->
              
                
                <div class="row mt-4 md-4 special-list">
                    @foreach($prodotti as $prodotto)
            
                    <div class="item" id="ricercaProdotti">
                        <div class="col-md-4 special-grid {{$prodotto->categoria}}" data-nome="{{ strtolower($prodotto['nome_'.$lingua]) }}" data-categoria="{{ $prodotto->categoria }}" data-prezzo="{{ $prodotto->prezzo }}">
                            <div class="products-single fix" style="text-align:center;">
                                <div class="why-text">
                                <a href="{{asset('/prodotti/dettaglio/'.$prodotto->id)}}"><img src="{{ asset($prodotto->pathImmagine)}}" alt="Image" width=100% height=100% ></a>                   
                                
                                <div class="why-text" >

                                    <a href="{{asset('/prodotti/dettaglio/'.$prodotto->id)}}"><h3><b>{{ $prodotto['nome_'.$lingua] }}</b> </h3></a>
                                    
                    
                                            
                                        
                                        
                                        @if($logged=='true')
                                        @if($permesso=='amministratore')
                                        <div class="row mt-2" style="text-align:center;" id="comandi_amministratore">
                                            
                                            <div class="col">
                                               <a href="{{asset('/prodotti/dettaglio/'.$prodotto->id.'/modifica')}}"> <button type="button" class="btn btn-info">@lang('labels.modificaProdotto')</button></a>
                                            </div>
                                            <div class="col">
                                               <a href="{{asset('/prodotti/dettaglio/'.$prodotto->id.'/rimuovi')}}"> <button type="button" class="btn btn-danger">@lang('labels.rimuovi')</button></a>
                                            </div>
                                            <div class="col mt-2">
                                                <form action="{{asset('/prodotto/'.$prodotto->id.'/cambio_disponibilita')}}" method="post">
                                                    @csrf
                                                   <button type="submit" class="btn btn-info" style="background-color: gold; color:black;">Cambia disponibilità</button>

                                                </form>
                                               
                                            </div></div>
                                             @endif 
                                            @endif 
                                            <div class="row mt-2" style="text-align:center;" >
                                                <div class="col">
                                                    @if($prodotto->disponibilita=='disponibile')
                                                <h3>{!!nl2br("\n") !!}</h3>
                                                    @else
                                                <h3>@lang('labels.prodottoNonDisponibile')</h3>
                                                    @endif
                                                </div>
                                            </div>
                                        <hr>
                                        
                                        <h5 class="classe_prezzo">{{number_format((float)$prodotto->prezzo, 2, '.', '')}} € </h5>
                                            <h2></h2>
                                            <h4> <a href="{{asset('/prodotti/dettaglio/'.$prodotto->id)}}"><button class="btn btn-info" style="background-color: rgb(169 181 220 / 25%);color: black;" ><h3  style="color:black;"><b>@lang('labels.visualizzaDettagli')</b></h3></button></a></h4>
                                           
                                                 
                                           
                                        
                                        
                                       
                                        
                                </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    @endforeach
                </div>
                
             
    </div>
@endsection