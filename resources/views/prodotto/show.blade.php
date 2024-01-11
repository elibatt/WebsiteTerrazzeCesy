@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>@lang('labels.prodottiIndex')</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                            <li class="breadcrumb-item "><a href="{{asset('/prodotti')}}">@lang('labels.prodottiIndex')</a></li>
                            <li class="breadcrumb-item active">@lang('labels.dettaglio')</li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('content')
    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row mt-2 ml-5" >
                                    <div class="ml-1">
                                    <a href="{{asset('/prodotti')}}">  <button  class="btn btn-info " style="width:250px;color:white;"> @lang('labels.backProdotti')</button></a> 
                                    </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-5">
                    <img src="{{ asset($prodotto->pathImmagine)}}" alt="Img_product" width="100%">
                </div>
                <!-- spazio per carousel -->
                <div class="col-md-1"></div>
                <div class="col-md-6">
                    <div>
                        <h1><b>{{$prodotto['nome_'.$lingua] }}</b></h1>
                        <br>

						<h3> @lang('labels.descrizione'):</h3>
						<h2>{{$prodotto['descrizione_'.$lingua] }}</h2>
                        <br>

                        <h3> @lang('labels.nota'):</h3>
                        <h2>{{$prodotto['nota_'.$lingua] }}</h2>
                        <br>

                        <h3> @lang('labels.costo'):</h3>
                      
                            <h2>{{number_format((float)$prodotto->prezzo, 2, '.', '')}} € </h2>
                        
                       
                        <br>
                            <!--
                            <ul>
                                <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">Quantità</label>
                                        <input class="form-control" value="0" min="0" max="20" type="number" id="quantita_prodotto">
                                    </div>
                                </li>
                            </ul>
                            -->
                        @if($prodotto->disponibilita=='disponibile')
                        <div class="row mt-1">
                            <div class="col-3 float-right">
                                  <h2>Quantità:</h2>
                            </div>
                            <div class="col-1">
                            <select name="scegliQuantita" id="scegliQuantita" class="form-select">
                            @for($i=1; $i<=10; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                            </select>
                            </div>
                          
                        
                        </div>
                        <div class="row mt-3">
                                <div>
                                    <button id="bottoneCarrello" class="btn btn-success" value="{{$prodotto->id}}" style="width:250px;">@lang('labels.aggiungiCarrello')</button>
                                </div>   
					    </div>
                       <br>
                      <span id="messageBottone" class="span-carrello"> </span>
                       <br>
                        @endif
                      

                        <div class="row mt-3">
                                <div>
                                     <a href="{{asset('/carrello')}}" > <button  class="btn btn-info " style="width:250px; color:white;">@lang('labels.vaiCarrello')</button></a> 
                                </div>
                              
                                </form>
                              
                        </div>
                    
                    </div>
                </div>
            </div>
			
			

        </div>
    </div>
@endsection