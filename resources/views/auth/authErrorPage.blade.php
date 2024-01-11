@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>@lang('labels.loginErrato')</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">Login</li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('content')
        <div class="container text-center">
                <div class="row mt-5 mb-5">
                    <div class="col-md-6">
                        <img src="{{asset('immagini/home_4.jpg')}}" alt="img" width=100%>
                    </div>
                    <div class="col-md-4" style="margin: auto;padding: 10px;">
                        <h2>@lang('labels.credenzialiErrate')</h2>
                        <br>
                        <a href="{{asset('/user/login')}}"><button type="button" class="btn btn-warning">@lang('labels.riprova')</button></a>
                        <br>
                        @lang('labels.oppure')
                        <br>
                        <a href="{{asset('/')}}"><button type="button" class="btn btn-info">@lang('labels.vaiHome')</button></a>
                    </div>
                    
                </div>
        </div>        
@endsection