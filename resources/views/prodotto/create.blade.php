@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Admin - @lang('labels.nuovoProdotto')</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                            <li class="breadcrumb-item ">Admin</li>
                            <li class="breadcrumb-item active ">@lang('labels.nuovoProdotto')</li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('content')
    @if($permesso=='amministratore')
    <div class="container">
        <div class="row md-5 mt-4">
            <h1> <b>@lang('labels.nuovoProdotto')</b></h1>
           
        </div>
        <div class="row md-5 mt-4">
            <h2>@lang('labels.istruzioniCreazione')</h2>
        </div>

        <div class="row md-5 mt-4 mb-4">
            <form action="" id="formCreazione" method="post" enctype="multipart/form-data"> <!-- method post-->
                @csrf
                <div class="form-group">
                <label for="nome"><h3><b>Nome italiano:</b></h3</label>
                <input type="text" class="form-control" id="nome_it"  name="nome_it" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                </div>
                <div class="form-group">
                <label for="nome"><h3><b>Nome inglese:</b></h3></label>
                <input type="text" class="form-control" id="nome_en"  name="nome_en" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                </div>
                <div class="form-group">
                <label for="nome"><h3><b>Nome spagnolo:</b></h3></label>
                <input type="text" class="form-control" id="nome_es" name="nome_es" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                </div>


                <div class="form-group">
                <h3><b>@lang('labels.categoria'):</b> </h3>
                <input type="radio" id="cosmesi" name="categoria"  required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                <label for="cosmesi"><h4>@lang('labels.categoriaCosmesi')</h4></label><br>
                <input type="radio" id="uso_alimentare" name="categoria" value="uso_alimentare">
                <label for="uso_alimentare"><h4>@lang('labels.categoriaAlim')</h4></label><br>
                </div>

                <!--Controllo su formato prezzo-->
                <div class="form-group">
                <label for="prezzo"><h3><b> @lang('labels.costo'):</b> </h3></label>
                <input type="text" class="form-control" id="prezzo" name="prezzo" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                <span id="messagePrezzo"></span>    
                </div>


                <div class="form-group">
                <label for="nota"><h3><b>Nota italiano:</b> </h3></label>
                <textarea rows="2" cols="50" class="form-control" name="nota_it" id="nota_it" form="formCreazione" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')"></textarea>
                </div>
                <div class="form-group">
                <label for="nota"><h3><b>Nota inglese:</b></h3></label>
                <textarea rows="2" cols="50" class="form-control" name="nota_en" id="nota_en" form="formCreazione" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')"></textarea>
                </div>
                <div class="form-group">
                <label for="nota"><h3><b>Nota spagnolo:</b></h3></label>
                <textarea rows="2" cols="50" class="form-control" name="nota_es" id="nota_es" form="formCreazione" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')"></textarea>
                </div>

                <div class="form-group">
                <label for="descrizione"><h3><b> Descrizione ita:</b></h3></label>
                <textarea rows="2" cols="50" class="form-control" name="descrizione_it" id="descrizione_it" form="formCreazione" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')"></textarea>
                </div>
                <div class="form-group">
                <label for="descrizione"><h3><b>Descrizione inglese:</b>  </h3></label>
                <textarea rows="2" cols="50" class="form-control" name="descrizione_en" id="descrizione_en" form="formCreazione" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')"></textarea>
                </div>
                <div class="form-group">
                <label for="descrizione"><h3><b>Descrizione spagnolo:</b> </h3></label>
                <textarea rows="2" cols="50" class="form-control" name="descrizione_es" id="descrizione_es" form="formCreazione" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')"></textarea>
                </div>

                <div class="form-group">
                <label for="immagine"><h3><b>@lang('labels.allegaImmagine'):</b> </h3></label>
                <input type="file" id="immagine" name="immagine" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                </div>

                
                <button type="submit" class="btn btn-default" style="background-color: #60a5a5;">@lang('labels.conferma')</button>
                
            </form>
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