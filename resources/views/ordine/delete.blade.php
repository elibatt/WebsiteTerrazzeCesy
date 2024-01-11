@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>@lang('labels.eliminaOrdine')</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                            <li class="breadcrumb-item active ">@lang('labels.annulla')</li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('content')
   @if($idUtente== $idUtenteOrdine)
    <div class="container">
        <div class="row md-5 mt-4">
            <h1> <b>@lang('labels.annulla')</b></h1>
           
        </div>
        <div class="row md-5 mt-4">
            <h2>@lang('labels.istruzioniEliminaOrdine')</h2>
        </div>

        <div class="row md-5 mt-4 mb-4">
            
            <form id="delete-frm" class="" action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="previous_url" value="{{URL::previous()}}">
                        <button class="btn btn-danger"> @lang('labels.rimuovi') </button>
            </form>
        </div>
        <div class="row md-5 mt-4 mb-4">
            <a href="{{asset('/ordini')}}"><button class="btn btn-info">@lang('labels.tornaOrdini')</button></a>
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