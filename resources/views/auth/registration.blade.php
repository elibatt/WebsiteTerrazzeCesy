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
                <form action="{{ route('user.register') }}" method="post" enctype="multipart/form-data" id="formRegistrazione">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputUser" class="form-label">@lang('labels.nome') <br></label>
                        <input type="text" name="nome" class="form-control" id="nome" placeholder="@lang('labels.nome')" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputUser" class="form-label">@lang('labels.cognome') <br></label>
                        <input type="text" name="cognome" class="form-control" id="cognome" placeholder="@lang('labels.cognome')" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">@lang('labels.email')</label>
                        <input type="text" id="email" class="form-control" placeholder="Email" name="email" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                        <span id='messaggioEmailFormato'></span>
                        <span id='messageEmail'></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputUser" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                        <span id='messageUsername'></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                        <span id='messageFormatoPw'></span>
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">@lang('labels.confirmPassword')</label>
                    <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="@lang('labels.confirmPassword')" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                    <span id='messagePassword'></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">@lang('labels.cellulare')</label>
                        <input type="text" name="cellulare" id="cellulare" class="form-control" placeholder="@lang('labels.cellulare')" required oninvalid="this.setCustomValidity('@lang('labels.compilaCampo')')" oninput="this.setCustomValidity('')">
                        <span id='messageCellulare'></span>
                    </div>
                    <button type="submit" id="submit" class="btn btn-warning mt-2" style="width:100%" >@lang('labels.registerNow')</button>
                    
                </form>
            
            </div>  
        </div>  
        <div class="row justify-content-center mt-2 mb-2">
            <a href="{{ route('home') }}"><button type="button" class="btn btn-info">@lang('labels.vaiHome')</button></a>
        </div>
  
    </div>
@endsection