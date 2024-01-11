@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        @if($utente->permesso=='amministratore')
                        <h2>Admin - @lang('labels.riepilogoClienti')</h2>
                        @else
                        <h2>@lang('labels.profilo') - @lang('labels.tuoiOrdini')</h2>
                        @endif
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                            @if($utente->permesso=='amministratore')
                            <li class="breadcrumb-item">Admin</li>
                            <li class="breadcrumb-item active">@lang('labels.riepilogoClienti')</li>
                            @else
                            <li class="breadcrumb-item">@lang('labels.profilo')</li>
                            <li class="breadcrumb-item active">@lang('labels.tuoiOrdini')</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('content')
    <div class="container">
        @if($utente->permesso=="amministratore")
            @if(count($ordini)=="0")
                <div class="row mt-5">
                    <p><h2>@lang('labels.nessunOrdine')</h2></p> 
                </div>
                <div class="row md-5 mt-5 mb-5" style="justify-content:center">
                    <div class=" mt-4 " >
                      <a href="{{asset('/prodotti')}}" >  <button type="button" class="btn btn-info" style="color:white">@lang('labels.backProdotti')</button></a>
                    </div>   
                </div>
            @else
                <div class="row mt-5">
                    <p><h2><b>@lang('labels.riepilogoClienti'):</b></h2></p> 
                </div>
                <div class="row mt-2 mb-4" style="text-align:center;" id>
                    <div class="col">
                      <h3> @lang('labels.cercaOrdini')</h3><input type="text" name="ricerca" id="inputOrdine" >
                    </div>
                </div>

                
                    <div class="row md-5 mt-5 mb-5" style="justify-content:center; border:2px solid black;" >
                      
                            <div class="table-main table-responsive"  >
                                <table class="table table-responsive" id="tabellaSorting">
                                    <thead>
                                        <tr>
                                           
                                            <th>@lang('labels.dataOrdine')</th>
                                            <th>@lang('labels.totale')</th>
                                            <th>@lang('labels.statoAccettazione')</th>
                                            <th>@lang('labels.tipologiaPagamento')</th>
                                            <th>@lang('labels.datiUtente')</th>
                                            <th>@lang('labels.prodottiNav')</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="myTableBody">
                                       @foreach($ordini as $ordine)
                                        
                                        <tr>
                                            
                                            <td><h2>{{date('d-m-Y', strtotime($ordine->data));}} </h2></td>
                                            <td><h2>{{number_format((float)$ordine->totale, 2, '.', '')}} € 
                                                <br> @if($ordine->codiceSconto != '') Utilizzato codice sconto: {{$ordine->codiceSconto}} @endif 
                                            </h2></td>
                                            <td><h2>
                                                    @if($ordine->stato_accettazione == 'non accettato')
                                                        @lang('labels.nonAccettato')
                                                    @elseif($ordine->stato_accettazione=='accettato')
                                                        @lang('labels.Accettato')
                                                    @elseif($ordine->stato_accettazione=='annullato')
                                                        @lang('labels.Annullato')
                                                    @else
                                                        @lang('labels.inAttesa')
                                                    @endif
                                                    <h3 >
                                                     @if(str_contains('in attesa',$ordine->motivazione))  
                                                        @lang('labels.motivazioneAttesa')
                                                     @elsif(str_contains('mancata verifica'),$ordine->motivazione)
                                                        @lang('labels.motivazionePagamento')
                                                    @elsif(str_contains('accettato'),$ordine->motivazione)
                                                        @lang('labels.motivazioneAccettato') 
                                                    @elsif(str_contains('mancata disponibilità'))
                                                        @lang('labels.motivazioneMerce')
                                                    @else
                                                        @lang('labels.motivazioneAnnullato')
                                                    @endif
                                                    </h3>
                                                
                                                <form action="{{asset('/ordine/'.$ordine->id.'/cambio_accettazione')}}" method="post">
                                                    @csrf
                                                   <button type="submit" class="btn btn-info" style="background-color: gold; color:black;">Cambia/Gestisci stato accettazione</button>
                                                </form>
                                            </h2></td>

                                            <td>
                                                    <h2>
                                                        @if ($ordine->pagamento == "al ritiro")
                                                            @lang('labels.ritiro')
                                                        @else
                                                            Paypal
                                                        @endif
                                                    </h2>
                                                </td>
                                            <td><h2>{{ucfirst($ordine->utente()->first()->nome)}} {{ucfirst($ordine->utente()->first()->cognome)}}
                                                <br>{{$ordine->utente()->first()->email}} <br>{{$ordine->utente()->first()->cellulare}}
                                            </h2></td>
                                            <td>
                                            @foreach($ordine->prodotti()->get() as $prodotto)
                                                <h2>{{ucfirst($prodotto['nome_'.$lingua]) }},   {{number_format((float)$prodotto->prezzo, 2, '.', '')}} € , @lang('labels.quantita'):  {{$prodotto->pivot->quantita}}</h2>
                                                <br>  
                                            @endforeach
                                            </td>
                                        </tr>
                                            
                                        @endforeach
                                        

                                    </tbody>
                                </table>
                            </div>
                                <br>
                       <!-- </div>-->
                    </div>
                
            @endif
        
        @else
        
            @if($numOrdiniConf==0)
                <div class="row mt-5">
                    <p><h2>@lang('labels.nessunOrdine')</h2></p> 
                </div>
                <div class="row md-5 mt-5 mb-5" style="justify-content:center">
                    <div class=" mt-4 " >
                      <a href="{{asset('/prodotti')}}" >  <button type="button" class="btn btn-info" style="color:white">@lang('labels.backProdotti')</button></a>
                    </div>   
                </div>
            @else
                <div class="row mt-5">
                    <p><h2><b>@lang('labels.tuoiOrdini') :</b></h2></p> 
                </div>
                <div class="row mt-2 mb-4" style="text-align:center;" id>
                    <div class="col">
                      <h3> @lang('labels.cercaOrdini')</h3><input type="text" name="ricerca" id="inputOrdine" >
                    </div>
                </div>

              
                    <div class="row md-5 mt-5 mb-5" style="justify-content:center;" >
                      
                            <div class="table-main table-responsive"  >
                                <table class="table table-responsive" id="tabellaSortingCliente">
                                    <thead>
                                        <tr>
                                            <th>@lang('labels.dataOrdine')</th>
                                            <th>@lang('labels.prodottiNav')</th>
                                            <th>@lang('labels.totale')</th>
                                            <th>@lang('labels.statoAccettazione')</th>
                                            <th>@lang('labels.tipologiaPagamento')</th>
                                            <th>@lang('labels.eliminaOrdine')</th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="myTableBody"  style="justify-content:center; border:2px solid black;">
                                       @foreach($utente->ordini as $ordine)
                                        @if($ordine->stato_conferma=='confermato')
                                            
                                            <tr>
                                                <td><h2>{{date('d-m-Y', strtotime($ordine->data));}} </h2></td>
                                                <td>
                                                @foreach($ordine->prodotti()->get() as $prodotto)
                                                    <h2>{{ucfirst($prodotto['nome_'.$lingua]) }} [ {{number_format((float)$prodotto->prezzo, 2, '.', '')}} € ], @lang('labels.quantita'):  {{$prodotto->pivot->quantita}}</h2>
                                                    <br>  
                                                @endforeach
                                                </td>
                                                <td><h2>{{number_format((float)$ordine->totale, 2, '.', '')}} € 
                                                    <br> @if($ordine->codiceSconto != '') Utilizzato codice sconto: {{$ordine->codiceSconto}} @endif 
                                                </h2></td>
                                                <td><h2>
                                                    @if($ordine->stato_accettazione == 'non accettato')
                                                        @lang('labels.nonAccettato')
                                                    @elseif($ordine->stato_accettazione=='accettato')
                                                        @lang('labels.Accettato')
                                                    @elseif($ordine->stato_accettazione=='annullato')
                                                        @lang('labels.Annullato')
                                                    @else
                                                        @lang('labels.inAttesa')
                                                    @endif
                                                    <h3 >
                                                     @if(str_contains('in attesa',$ordine->motivazione))  
                                                        @lang('labels.motivazioneAttesa')
                                                     @elsif(str_contains('mancata verifica'),$ordine->motivazione)
                                                        @lang('labels.motivazionePagamento')
                                                    @elsif(str_contains('accettato'),$ordine->motivazione)
                                                        @lang('labels.motivazioneAccettato') 
                                                    @elsif(str_contains('mancata disponibilità'))
                                                        @lang('labels.motivazioneMerce')
                                                    @else
                                                        @lang('labels.motivazioneAnnullato')
                                                    @endif
                                                    </h3>
                                                </h2></td>
                                                
                                               
                                                <td>
                                                    <h2>
                                                        @if ($ordine->pagamento == "al ritiro")
                                                            @lang('labels.ritiro')
                                                        @else
                                                            Paypal
                                                        @endif
                                                    </h2>
                                                </td>
                                                @if($ordine->stato_accettazione != 'accettato')
                                                <td><a href="/ordine/{{$ordine->id}}/rimuovi"><button class="btn btn-danger">@lang('labels.eliminaOrdine')</button></a></td>
                                                @else
                                                <td></td>
                                                @endif
                                               
                                            </tr>
                                          @endif
                                        @endforeach
                                        

                                    </tbody>
                                </table>
                            </div>
                                <br>
                       <!-- </div>-->
                    </div>
                
            @endif
            
        @endif
        
    </div>



@endsection