@extends('layouts.app')

@section('breadcrumb')
    <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Login</h2>
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
                @if($registrazione)
                    <!-- finestra popup coupon -->
                
                
                    <!-- The Modal -->
                    <div id="myModal" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="closePop">&times;</span>
                        <div class="container ">
                                <div class="row ">
                                    <div class="col "> <h2 style="text-align:center;">Congratulazioni per la tua registrazione!</h2></div>
                                
                                
                                </div>
                                <div class="row ">
                                    <div class="col "><h3 style="text-align:center;">Hai vinto un codice sconto del 10% 😊! </h3></div>
                                </div>
                                <div class="row "> 
                                    <div class="col "> <h2 style="text-align:center;"> Il codice è : <b>NEWUSER10</b> </h2>
                                </div>
                                
                                <br><br>
                                </div>
                                
                            </div>
                            
                    
                        </div>

                    </div>
                    <div class="row md-5 mt-4 ml-3">
                        <div style="background-color:#B2FFB2;">@lang('labels.registrazioneBuonFine')</div>
                    </div>
                @endif
                <form class="mt-3" action="{{ route('user.login') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label"><h3>Username</h3></label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"><h3>Password</h3></label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                    </div>
                    <button type="submit" class="btn btn-warning" style="width:100%"><h3>@lang('labels.conferma')</h3></button>
                   
                </form>
                <div class="mt-5">
                        <a href="{{ route('user.register') }}"><button class="btn btn-info" style="color:white;">@lang('labels.register')</button></a>
                    </div>
            </div>   
        </div>
        
    </div>
@endsection