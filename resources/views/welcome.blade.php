@extends('layouts.app')

@section('content')
 
 <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            <li class="text-center">
                <img src="{{asset('immagini/home_1.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>@lang('labels.benvenutiHome') <br> Terrazze di Cesy</strong></h1>
                            <p class="m-b-40">@lang('labels.motto')</p>
                            <p><a class="btn btn-info" href="{{asset('/prodotti')}}">@lang('labels.prodottiIndex')</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="{{asset('immagini/home_2.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                    <div class="col-md-12">
                            <h1 class="m-b-20"><strong>@lang('labels.benvenutiHome') <br> Terrazze di Cesy</strong></h1>
                            <p class="m-b-40">@lang('labels.motto')</p>
                            <p><a class="btn btn-info" href="{{asset('/prodotti')}}">@lang('labels.prodottiIndex')</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="{{asset('immagini/home_3.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                    <div class="col-md-12">
                            <h1 class="m-b-20"><strong>@lang('labels.benvenutiHome') <br> Terrazze di Cesy</strong></h1>
                            <p class="m-b-40">@lang('labels.motto')</p>
                            <p><a class="btn btn-info" href="{{asset('/prodotti')}}">@lang('labels.prodottiIndex')</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="{{asset('immagini/home_4.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                           <div class="col-md-12">
                            <h1 class="m-b-20"><strong>@lang('labels.benvenutiHome') <br> Terrazze di Cesy</strong></h1>
                            <p class="m-b-40">@lang('labels.motto')</p>
                            <p><a class="btn btn-info" href="{{asset('/prodotti')}}">@lang('labels.prodottiIndex')</a></p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
     
                            
    </div>
    
    @endsection