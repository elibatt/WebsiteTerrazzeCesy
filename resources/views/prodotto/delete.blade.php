@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Admin - @lang('labels.eliminaProdotto')</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                            <li class="breadcrumb-item ">Admin</li>
                            <li class="breadcrumb-item active "> @lang('labels.eliminaProdotto')</li>
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
            <h1> <b> @lang('labels.eliminaProdotto') '{{lcfirst($prodotto->nome_it)}}'</b></h1>
           
        </div>
        <div class="row md-5 mt-4">
            <h2>@lang('labels.istruzioniElimina')</h2>
        </div>

        <div class="row md-5 mt-4 mb-4">
            <form id="delete-frm" class="" action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger"> @lang('labels.rimuovi') {{$prodotto->nome_it}}</button>
            </form>
        </div>
        <div class="row md-5 mt-4 mb-4">
            <a href="{{asset('/prodotti')}}"><button class="btn btn-info">@lang('labels.tornaProdotti')</button></a>
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