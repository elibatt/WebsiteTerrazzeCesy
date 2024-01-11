@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Admin - Accettazione Ordini</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                            <li class="breadcrumb-item ">Admin</li>
                            <li class="breadcrumb-item active ">Accettazione Ordini</li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('content')
@if($utente->permesso=='amministratore')
    <div class="container">
        <div class="row md-5 mt-4">
            <h1> <b> Cambio "stato accettazione" ordine '{{lcfirst($ordine->id)}}'</b></h1>
           
        </div>
        <div class="row md-5 mt-4">
            <h3>Questa pagina serve per gestire lo stato di accettazione di un ordine. Ordine accettato significa che la merce richiesta nell'ordine può essere reperita (non sono finite le scorte) e, inoltre, in caso l'ordine sia stato fatto con paypal, deve essere anche stata verificata la ricevuta di avvenuto pagamento sul nostro conto Paypal.</h3>
            <br>
            <h3>Possibili stati: accettato, non accettato, in attesa di verifica (default)</h3>
            <br>
            <h3>Nella parte inferiore della pagine si può scegliere la motivazione da dare all'utente per lo stato di accettazione. </h3>
            
        </div>



        <div class="row md-5 mt-4" style="border-style: ridge;">
            <form action="/ordini/{{$ordine->id}}/statoAccettazione" method="post">
                @csrf
                <div class="col">
                    <h2>Scegli il nuovo stato di accettazione:</h2>
                    <select id='scegliStatoAccettazione' name="statoAccettazioneSelect">
                        <option value="accettato" >Accettato.</option>
                        <option value="non accettato">Non accettato.</option>
                        <option value="in attesa di verifica" >In attesa verifica.</option>
                    </select>
                    <br>
                </div>
        
           

                <div class="col">
                    <h2>Scegli la motivazione adeguata relativa allo stato di conferma:</h2>
                    <select id='motivazioneOrdine' name="motivazioneAccettazioneSelect">
                        <option value="In attesa di verifica da parte dell'azienda." >In attesa.</option>
                        <option value="Ordine accettato.">Accettato.</option>
                        <option value="Ordine non accettato per mancanza merce disponibile.">Mancanza merce.</option>
                        <option value="Ordine non accettato per mancata verifica pagamento."  >Mancata verifica Paypal.</option>
                    </select>
                    <br>
                </div>
            </div>   
                <div class="row mt-5">
                    <h2></h2>
                    <button class="btn btn-success" id="buttonConfermaAcc" type="submit"> Conferma</button>
                                <br>
                    <!-- <h3 id="avvenutaConfermaMotivazione"></h3> -->
                </div>

            </form>
            

           
           
            
        
     
        <div class="row md-5 mt-4">
            
                <a href="/ordini"><button type="submit" class="btn btn-info">Torna agli ordini</button></a>
           
        </div>
    </div>
    @else
    <div class="container">
            <div class="row mt-5 mb-5">
                <h1>@lang('labels.noaccesso')</h1>
            </div>
        </div>
    @endif
@endsection