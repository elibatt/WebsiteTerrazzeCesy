@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>@lang('labels.contattiNav')</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">@lang('labels.contattiNav')</li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('content')

    <div class="container">
        <div class="row md-5 mt-4 ml-2">
                <h1> <b>@lang('labels.contattiNav')</b></h1>
        </div>

        <div class="row md-5 mt-4 mb-4">
            
            <div class="col-lg-6 col-sm-6">
                <div class=" text-center">
                    <p><h2>@lang('labels.orariApertura'):</h2></p> 
                    <div class=" text-center ml-5 mr-5 mt-4 ">
                        <ul style="background-color:#b1f2ff;">
                            <li><h2>@lang('labels.sabatoDomenica'): 14.30-18.30</h2></li>
                           
                        </ul>
                         </div>
                        <br><br><br>
                        <p><h2>@lang('labels.disponibilita')</h2></p>
                        <div class=" text-center mt-2">
                        <ul style="background-color:#b1f2ff;">
                            <li><h2>@lang('labels.chiamaci'):<a href="tel:339 648 8687" style="float:none;"  target="_blank"><u> 339 648 8687</u>  </a></h2></li>
                            <li><h2>@lang('labels.scrivici'):<a href="mailto:dipeppe.sara@gmail.com" style="float:none;"  target="_blank"> <u> dipeppe.sara@gmail.com </u> </a></h2></li>
                            <li><a href="{{asset('https://wa.me/393396488687')}}"  target="_blank"><h2><u>@lang('labels.scriviciWhatsapp')</u></h2></a></li>
                          
                          
                        </ul>
                         </div>
                    
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 mt-1">
                 <img src="{{asset('immagini/contatti_1.jpg')}}" alt="contatti" width=100%>
            </div>
                
        </div>
        
        <div class="row md-5 mt-4 mb-4">
                <div class="col-lg-6 col-sm-6">
                    <div class=" text-center mt-3">
                            <p><h2>Dove siamo:</h2></p> 
                            <div class=" text-center mt-3 ">
                                <ul style="background-color:#b1f2ff;">
                                    <li><h2>Via Forcella, 73 Gussago (BS) 25064</h2></li>
                                   
                                   
                                      <li><h2><u><a href="https://g.page/le-terrazze-di-cesy-peppabees?share"  target="_blank">Posizione esatta sulla mappa</a></u> </h2></li>
                                     
                               
                                </ul>
                            </div>
                           
                            
                            
                    </div>
                </div>
               
        </div>
    
    </div>
@endsection