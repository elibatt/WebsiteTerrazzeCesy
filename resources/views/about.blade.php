@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>@lang('labels.aboutNav') </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">@lang('labels.aboutNav') </li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('content')
   <div class="container">
        <div class="row md-5 mt-4 mb-4 ml-2">
                <h1> <b> @lang('labels.aboutNav') </b> <b>- Le Terrazze di Cesy</b></h1>
        </div>
        <div class="row md-5 mt-4 mb-4">
            <div class="col-lg-6 col-sm-6">
            <img src="{{asset('immagini/chisiamo_2.jpg')}}" alt="chisiamo1" width=100%>
            </div>
            <div class="col-lg-6 col-sm-6 mt-2">
                <div class=" text-center">
                    
                    @lang('labels.testoAbout')
                </div>
            </div>
        </div>
        <div class="row md-5 mt-4 mb-4">
            <div class="col-lg-6 col-sm-6 mt-2">
            <img src="{{asset('immagini/chisiamo_4.jpg')}}" alt="chisiamo1" width=100%>
            </div>
            <div class="col-lg-6 col-sm-6 mt-2">
            <img src="{{asset('immagini/chisiamo_3.jpg')}}" alt="chisiamo1" width=100%>
            </div>
        </div>
        
   </div>
@endsection