<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Le Terrazze di Cesy</title>
    
    <link rel="shortcut icon" href="{{ asset('immagini/favicon.ico')}}" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   
    <!--css-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
 
    <!--loader per caricamento pagina-->
    <style>
    #loading {
    position: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: 12;
    background-color: #fff;
    z-index: 99;
    }

    #loading-image {
    z-index: 100;
    }


    </style>
    
   
    <script src="{{asset('js/myScript.js')}}"></script>
    
</head>

<body>

<div id="loading">
  <img id="loading-image" src="{{ asset('spinner.gif')}}" alt="Loading..." />
</div>

    <div class="wrapper">
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
               
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('immagini/provalogo.png')}}" class="logo" alt="" width="400px"></a>
                </div>
            
                @if(Route::currentRouteName()!='user.login' && Route::currentRouteName()!='user.register')
                <div class="collapse navbar-collapse" id="navbar-menu">
                            <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                                <li class="{{ (request()->is('/')) ? 'nav-item active' : 'nav-item' }}"><a class="nav-link" href="{{asset('/')}}">Home</a></li>
                                <li class="{{ (request()->segment(1) == 'about') ? 'nav-item active' : 'nav-item' }}"><a class="nav-link" href="{{asset('/about')}}">@lang('labels.aboutNav')</a></li>
                                <li class="{{ (request()->segment(1) == 'prodotti') ? 'nav-item active' : 'nav-item' }}"><a class="nav-link" href="{{asset('/prodotti')}}">@lang('labels.prodottiNav')</a></li>
                                <li class="{{ (request()->segment(1) == 'contatti') ? 'nav-item active' : 'nav-item' }}"><a class="nav-link" href="{{asset('/contatti')}}">@lang('labels.contattiNav')</a></li>

                                @if($logged)
                                <li class="nav-item" id="ordiniNav" style="display:none;"> <a href="{{asset('/ordini')}}" class="nav-link">@lang('labels.tuoiOrdini')</a>
                                <li class="nav-item" id="logoutNav" style="display:none;"> <a href="{{asset('/user/logout')}}" class="nav-link">Logout</a>
                                <li class="dropdown" id="profiloNav" value="{{$idUtente}}"> <a href="#" class="nav-link">@lang('labels.profilo') <span id="frecciaBassa">▼</span></a>
                                <ul class="dropdown-menu">
                                    
                                    <li > <a href="{{asset('/anagrafica/'.$idUtente)}}" id="profiloDropdown">@lang('labels.accountNav')</a> </li>
                                    @if($_SESSION['permesso']!='amministratore')
                                    <li > <a href="{{asset('/ordini')}}" id="ordiniDropdown">@lang('labels.tuoiOrdini')</a> </li>
                                    @else
                                    <li > <a href="{{asset('/ordini')}}" id="ordiniDropdown">@lang('labels.visualizzaOrdiniClienti')</a> </li>
                                    @endif
                                    <li> <a href="{{asset('/user/logout')}}" id="logoutDropdown">Logout</a> </li>
                                </ul>
                                </li>
                        
                                @else
                                <li class="nav-item"><a class="nav-link" href="{{asset('/user/login')}}">Login</a></li>
                                @endif
                            </ul>
                </div>
                @else
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item"><a class="nav-link" href="{{asset('/')}}">Home</a></li>
                            <li class="nav-item "><a class="nav-link" href="{{asset('/about')}}">@lang('labels.aboutNav')</a></li>
                            <li class="nav-item "><a class="nav-link" href="{{asset('/prodotti')}}">@lang('labels.prodottiNav')</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{asset('/contatti')}}">@lang('labels.contattiNav')</a></li>
                        <li class="nav-item active"><a class="nav-link" href="{{asset('/user/login')}}">Login</a></li>
                    </ul>
                </div>
                @endif

                <div class="attr-nav">
                    <ul>
                        
                        <li>
                            <a href="{{asset('/carrello')}}">
                                <i class="fa fa-shopping-bag"></i>
                            </a>
                        </li>
                    <!-- bandierine-->
                    @if(Session::has('language'))
                 
                    <li><a href="{{ route('setLang', ['lang' => 'en']) }}" class="nav-link" style="{{ (session('language')==('en')) ? 'border-bottom: 3px solid #17a2b8; padding-bottom: 5px;' : 'none' }}"><img src="{{ url('/') }}/immagini/flags/en.png" width="20" class="img-rounded" /></a></li>
                    <li><a href="{{ route('setLang', ['lang' => 'es']) }}" class="nav-link" style="{{ (session('language')==('es')) ? 'border-bottom: 3px solid #17a2b8 ; padding-bottom: 5px;' : 'none' }}"><img src="{{ url('/') }}/immagini/flags/es.png" width="20" class="img-rounded"/></a></li>
                    <!--<li><a href="{{ route('setLang', ['lang' => 'zh']) }}" class="nav-link"><img src="{{ url('/') }}/immagini/flags/zh.png" width="20" class="img-rounded"/></a></li>-->
                    <li><a href="{{ route('setLang', ['lang' => 'it']) }}" class="nav-link" style="{{ (session('language')==('it')) ? 'border-bottom: 3px solid #17a2b8; padding-bottom: 5px;' : 'none' }}"><img src="{{ url('/') }}/immagini/flags/it.png" width="20" class="img-rounded"/></a></li>
                  
                    @else
                    <li><a href="{{ route('setLang', ['lang' => 'en']) }}" class="nav-link"><img src="{{ url('/') }}/immagini/flags/en.png" width="20" class="img-rounded"/></a></li>
                    <li><a href="{{ route('setLang', ['lang' => 'es']) }}" class="nav-link"><img src="{{ url('/') }}/immagini/flags/es.png" width="20" class="img-rounded"/></a></li>
                    <!--<li><a href="{{ route('setLang', ['lang' => 'zh']) }}" class="nav-link"><img src="{{ url('/') }}/immagini/flags/zh.png" width="20" class="img-rounded"/></a></li>-->
                    <li><a href="{{ route('setLang', ['lang' => 'it']) }}" class="nav-link" style="border-bottom: 3px solid #17a2b8; padding-bottom: 5px;"><img src="{{ url('/') }}/immagini/flags/it.png" width="20" class="img-rounded"/></a></li>
                    @endif
                    </ul>
                </div>
    
                
            </div>
           
        </nav>
    
    
    




   
    @yield('breadcrumb')
    @yield('content')



   
    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-top-box">
                            <h3>@lang('labels.orariApertura')</h3>
                            <ul class="list-time">
                            <li>@lang('labels.sabatoDomenica'): 14.30 - 18.30</li>
                               <!-- <li>@lang('labels.sabatoDomenica'): 14.30 - 18.30</li>-->
                                <li>@lang('labels.indirizzo'): <a href="https://g.page/le-terrazze-di-cesy-peppabees?share" style="float:none;">Via Forcella 73, Gussago (BS)</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    
                  <div class="col-lg-4 col-md-12 col-sm-12">
                      <div class="footer-top-box">
                            <h3>Social Media</h3>
                            <ul class="list-time">
                                <li>@lang('labels.seguiSocial')</li>
                            </ul><br>
                            <ul>
                                <li><a href="{{asset('https://www.instagram.com/peppabees/')}}"  target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="{{asset('https://wa.me/393396488687')}}"  target="_blank"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                                <li><a href="{{asset('https://www.facebook.com/peppabees-102349742614156/')}}"  target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12" >
                        <div class="footer-top-box" >
                            <h3>@lang('labels.contattiNav')</h3>
                            <ul class="list-time">
                                <li>@lang('labels.chiamaci'):<a href="tel:339 648 8687" style="float:none;"> 339 648 8687 </a></li>
                                <li>@lang('labels.scrivici'):<a href="mailto:dipeppe.sara@gmail.com" style="float:none;"> dipeppe.sara@gmail.com </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            
            </div>
        </div>
    </footer>
    


    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2022 Le Terrazze di Cesy
            </p>
    </div>
   

   

    
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
   <script src="{{ asset('js/jquery.superslides.min.js') }}"></script>
    <script src="{{ asset('js/bootsnav.js') }}"></script>
    <script src="{{ asset('js/images-loded.min.js') }}"></script>
    <script src="{{ asset('js/isotope.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js" integrity="sha512-qzgd5cYSZcosqpzpn7zF2ZId8f/8CHmFKZ8j7mU4OUXTNRd5g+ZHBPsgKEwoqxCtdQvExE5LprwwPAgoicguNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.widgets.min.js" integrity="sha512-dj/9K5GRIEZu+Igm9tC16XPOTz0RdPk9FGxfZxShWf65JJNU2TjbElGjuOo3EhwAJRPhJxwEJ5b+/Ouo+VqZdQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </div>
</body>

</html>