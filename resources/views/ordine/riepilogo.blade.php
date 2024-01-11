@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Completamento ordine</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                        <li class="breadcrumb-item ">Riepilogo ordine</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row mt-5 ml-3">
            <p><h1><b>@lang('labels.riepilogoOrdine')</b>   </h1></p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('labels.nome')</th>
                                <th>@lang('labels.costo')</th>
                                <th>@lang('labels.quantita')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ordine->prodotti()->get() as $prodotto)
                            <tr>
                                <td><h2>{{ucfirst($prodotto['nome_'.$lingua])}}</h2></td>
                                <td><h2>{{number_format((float)$prodotto->prezzo, 2, '.', '')}} € </h2></td>
                                <td><h2>{{$prodotto->pivot->quantita}}</h2></td>
                            </tr>
                            @endforeach
                            

                        </tbody>
                    </table>
                    

                 
                    
                   
                </div>
            </div>
        </div>
        <div class="row mt-2 ml-3">
             <div class="me-auto" style="text-align:right;">
                               <h2 style="background-color:#8aecff;">@lang('labels.totale'):  {{$totale}} €</h2>                    
                </div>
              
        </div>
        <div class="row mt-2 ml-3">
        @if($codiceSconto=='20%')
                    <div class="me-auto" style="text-align:right;">
                               <h2 style="background-color:#8aecff;">@lang('labels.utilizzoCS')   {{$codiceSconto}} </h2>                    
                </div>
                @endif
        </div>
        <div class="row mt-5 ml-3 mb-5">
             <div class="col">
            
                <a href="{{asset('/ordine/'.$ordine->id.'/rimuovi')}}"> <button type="button" class="btn btn-danger">@lang('labels.annulla')</button></a>
            </div>
               
             
  
             <!-- Bottone di conferma ordine che manda mail a mailtrap -->
             <div class="col">
                <form action="{{asset($ordine->id.'/apply-two')}}" method="post" class="form-inline">
                    {{ csrf_field() }}
                    <button class="btn btn-success" style="color:white;" id="alRitiroOrdineButton" value="{{$ordine->id}}" width=300 heigth=300> @lang('labels.confermaOrdineStandard')</button>
                </form>   
                <div class="mt-2">
                    <p>@lang('labels.oppure')</p>

                </div>
             
             
             
            <!-- Bottone per il pagamento con paypal sandbox. Attualmente intestato a sb-idk5q15358710@business.example.com -->   
              
    
      
          <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="mailprovaazienda@gmail.com">
                <input type="hidden" name="item_name"
                value="totale_{{$ordine->id}}">
                <input type="hidden" name="item_number"
                value="Numero articolo">
                <input type="hidden" name="amount" value="{{$totale}}">
                <input type="hidden" name="Ic" value="IT">
                <input type="hidden" name="currency_code" value="EUR">
                <input type="hidden" name="bn" value="IC_Esempio">
                <input type="hidden" name="return" value="{{asset('https://provaazienda.online/'.$ordine->id.'/apply-two-paypal')}}">
                
                <input type="image" src="{{asset('immagini/paypalbutton.png')}}"
        name="submit" alt="PayPal, il modo sicuro di pagare e farsi pagare online!"
        width=250 heigth=400>
            </form>
            </div>
        </div>
    </div>

@endsection