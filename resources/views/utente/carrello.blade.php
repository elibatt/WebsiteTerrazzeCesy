@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>@lang('labels.tuoCarrello')</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                        <li class="breadcrumb-item active ">@lang('labels.tuoCarrello')</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')

    <div class="container">
            <div class=" row md-5 ml-3 mt-5 mb-2 " >
            <a href="{{asset('/prodotti')}}" > <button type="button" class="btn btn-info" style="color:white;">@lang('labels.backProdotti')</button></a>
            </div>
            @if($logged)
                <div class="row md-5 ml-3 mb-4 mt-4">
                    <h1><b>@lang('labels.carrelloDi'): {{ucfirst($utente->nome)}}</b> </h1>
                </div>
            @else
                <div class="row md-5 ml-3 mb-4 mt-4">
                    <h1> <b>@lang('labels.saluto')</b></h1>
                </div>
                <div class="row md-5 mb-4">
                    <div class="col-5" style="text-align:center;">
                        <h2>@lang('labels.istruzioniCarrello')</h2>
                        <hr>
                        <a href="{{asset('/user/login')}}"><button type="button" class="btn btn-info">LOGIN</button></a>
                    </div>
                    <div class="col-7">
                        <img src="{{asset('immagini/lavanda.jpg')}}" alt="img" width=100%>
                    </div>
                </div>
            @endif

            @if($logged)
                <div class="row md-5 ml-3 mb-4 mt-4">
                    <div class="col-6">
                        <h2>@lang('labels.numeroItems'): <b>{{count($prodotti)}}</b> </h2>
                    </div>
                    <div class="col-6">
                        <span id="erroreCarrello"></span>
                    </div>
                    
                </div>
                @if(count($prodotti)==0)
                    <div class="row md-5 ml-3 mb-4 mt-4">
                        <h2>@lang('labels.carrelloVuoto')</h2>
                    </div>
                   
                @else
                    <!-- Start Cart  -->
                    <div class="cart-box-main">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="table-main table-responsive">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <!--<th>Immagine</th>-->
                                                    <th>@lang('labels.nome')</th>
                                                    <th>@lang('labels.costo')</th>
                                                    <th>@lang('labels.quantita')</th>
                                                    <th>@lang('labels.totale')</th>
                                                    <th>@lang('labels.rimuovi')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($prodotti as $item)
                                                    <tr id="riga_{{$item->id}}">
                                                        <td class="name-pr">
                                                            <a href="{{asset('/prodotti/dettaglio/'.$item->id)}}">{{$item['nome_'.$lingua] }}
                                                            </a>
                                                        </td>
                                                        <td >
                                                            <p class="price-box-carrello" id="prezzo_{{$item->id}}">{{number_format((float)$item->prezzo, 2, '.', '')}} € </p>
                                                        </td>
                                                        <td class="quantity-box-carrello">
                                                            <input type="number" size="4" value="{{ $_SESSION['quantita'][array_search($item->id, $_SESSION['carrello'])] }}" min="1" max="10" step="1" class="quantity-box-singola" id="quantity_{{$item->id}}">
                                                        </td>
                                                        <td class="total-pr">
                                                            <p class="singolototale" id="total_{{$item->id}}">{{number_format((float)$item->prezzo, 2, '.', '')}} €</p>
                                                        </td>
                                                        <td class="remove-pr">
                                                            
                                                        <button id="rimuovi_{{$item->id}}" class="buttonRemove"><i class="fas fa-times" ></i></button>
                                                            
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5 mb-5">
                                <div class="col-lg-5 col-sm-5">
                                    <div class="coupon-box">
                                        
                                        <div class="input-group input-group-sm mt-5">
                                            <input class="form-control" placeholder="Qui il codice sconto" aria-label="Coupon code" type="text" id="inputCodiceSconto">
                                            <div class="input-group-append" >
                                                <button class="btn btn-theme" type="button" id="bottoneCodiceSconto" data-utente="{{ $idUtente }}">@lang('labels.codiceSconto')</button>
                                            </div>
                                        </div>
                                        <div class="mt-5">
                                            <span id="erroreCodiceSconto" style="font-weight:bold;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-1"></div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="order-box">
                                        <h3>@lang('labels.valoreCarrello')</h3>
                                        
                                        <div class="d-flex">
                                            <h4>@lang('labels.sconto')</h4>
                                            <div class="ml-auto font-weight-bold"  id="sconto"></div>
                                        </div>
                                        <div class="d-flex">
                                            <h4>@lang('labels.totale')</h4>
                                            <div class="ml-auto font-weight-bold" id="totaleCarrello"> - </div>
                                        </div>
                                        <hr>
                                        <br>
                                        <form action="{{asset('/ordine/nuovo')}}" method="post">
                                            @csrf    
                                            <input type="hidden" name="totaleHidden" id="totaleHidden">
                                            <input type="hidden" name="codiceScontoHidden" id="codiceScontoHidden">
                                                <div class="col-lg-6 col-sm-6" style="text-align:center;">
                                                    <button type="submit" class="btn btn-info" style="color:white;">@lang('labels.procediOrdine')</button>
                                                </div>
                                        
                                        </form>
                                    </div>  
                                    
                                </div>
                            </div>

                            

                        </div>
                    </div>
                    <!-- End Cart -->












            
                @endif
            @endif
        
    </div>
@endsection