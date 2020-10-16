<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
 
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Creepster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.css" type="text/css" media="all" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utility.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
            <div class="container">
                @if($errors->first('title'))
                    <p style="font-size: 0.7rem; color: red; padding: 0 2rem;">※{{$errors->first('title')}}</p>
                @endif
                <a class="navbar-brand" href="{{ action('TopController@index' )}}">
                    <i class="fas fa-plane-departure faa-wrench animated"></i>
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse mr10" id="navbarSupportedContent">
                    @if(Auth::check())
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <form action="{{ route('post') }}" class="mb0" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <a class="nav-link" data-toggle="modal" data-target=".bd-example-modal-xl">
                                        <i class="fas fa-edit"></i>{{ __('messages.new_post') }}
                                    </a>
                                    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark" id="exampleModalLabel">{{ __('messages.memory') }}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                      <div class="form-group">
                                                        <label for="title-name" class="col-form-label text-dark">{{ __('messages.spot') }}:</label>
                                                        <input type="text" name="title" class="form-control" id="title-name" placeholder="{{ __('messages.spot_post') }}">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="message-text" class="col-form-label text-dark">{{ __('messages.intro') }}:</label>
                                                        <textarea class="form-control" style=" height:220px; resize: none;" name="post" id="message-text" placeholder="{{ __('messages.intro_post') }}"></textarea>
                                                      </div>
                                                      <button type="button" id="add" class=" btn-floating btn-primary" ><i class="fas fa-plus"></i></button>
                                                      <div class="form-group-file">
                                                        <label for="message-text" class="col-form-label text-dark">{{ __('messages.file') }}</label>
                                                        <input type="file" class="form-control-file text-dark"  name="image[]" id="File"  multiple="multiple">
                                                      </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
                                                    <button type="submit" class="btn btn-primary">{{ __('messages.post') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($errors->first('post'))
                                        <p style="font-size: 0.7rem; color: red; padding: 0 2rem;">※{{$errors->first('post')}}</p>
                                    @endif
                                </form>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('search') }}" method="GET" class= "form-inline my-2 my-md-0">
                                    <a class="nav-link" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-search"></i>{{ __('messages.search') }}</a>
                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myHugeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark" id="exampleModalLabel">{{ __('messages.search') }}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                      <div class="form-group">
                                                        <input type="text" name="keyword" style="width:100%;" class="form-control" id="title-name"  placeholder="{{ __('messages.search_post') }}">
                                                      </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
                                                    <button type="submit" class="btn btn-primary">{{ __('messages.search') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ action('User\PagesController@show',Auth::id() )}}"> <i class="fas fa-user"></i>{{ __('messages.mypage') }}</a>
                            </li>
                        </ul>
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if(Auth::check())
                            <li class="dropdown" id="nav-lang" style="margin-top:8px">
                            <a href="#" class="dropdown-toggle text-white" data-toggle="dropdown" style="margin-left:5px">
                               <i class="fas fa-sort"></i>{{ __('messages.sort') }}
                            <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a style="margin-left:50px" class="text-dark" href="{{ action('User\TimelineController@index',['sort'=>'asc']) }}">{{ __('messages.asc') }}</a>
                                    </li>
                                    <li>
                                        <a style="margin-left:50px" class="text-dark" href="{{ action('User\TimelineController@index',['sort'=>'desc']) }}">{{ __('messages.desc') }}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ action('User\TimelineController@index' )}}"><i class="fas fa-stream"></i>{{ __('messages.timeline') }}</a>
                            </li>
                        @else
                            <li class="dropdown" id="nav-lang" style="margin-top:8px">
                            <a href="#" class="dropdown-toggle text-white" data-toggle="dropdown" style="margin-left:5px">
                               <i class="fas fa-sort"></i>{{ __('messages.sort') }}
                            <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a style="margin-left:50px" class="text-dark" href="{{ action('Guest\TimelineController@index',['sort'=>'asc']) }}">{{ __('messages.asc') }}</a>
                                    </li>
                                    <li>
                                        <a style="margin-left:50px" class="text-dark" href="{{ action('Guest\TimelineController@index',['sort'=>'desc']) }}">{{ __('messages.desc') }}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ action('Guest\TimelineController@index' )}}"><i class="fas fa-stream"></i>{{ __('messages.timeline') }}</a>
                            </li>
                        @endif
                        <li class="dropdown" id="nav-lang" style="margin-top:8px">
                            <a href="#" class="dropdown-toggle text-white" data-toggle="dropdown" style="margin-left:5px">
                                <i class="fas fa-language text-white"></i>{{ Config::get('languages')[App::getLocale()] }}
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @foreach (Config::get('languages') as $lang => $language)
                                    @if ($lang != App::getLocale())
                                        <li>
                                            <a style="margin-left:50px" class="text-dark" href="{{ route('lang.switch', $lang) }}">{{ $language }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('messages.register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('messages.logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    @if(isset(Auth::user()->user_icon_image))
                        <div class="col-1">
                            <img class="rounded-circle img-fluid" src="{{ Storage::disk('s3')->url('public/images/' .Auth::user()->user_icon_image) }}"  alt="Circle image">
                        </div>
                    @elseif(!Auth::check())
                    
                    @else
                        <div class="col-1">
                            <img class="rounded-circle img-fluid" src="{{ asset('images/nonuser.png') }}"  alt="Circle image">
                        </div>
                    @endif
                </div>
            </div>
        </nav>
        <main class="main">
            @yield('breadcrumbs')
            @if (session('flash_message'))
                <div class="flash_message bg-success text-center py-3 my-0">
                    {{ session('flash_message') }}
                </div>
            @endif
            @yield('content')
        </main>
        <footer class='footer p20 '>
          <small class='copyright'>Wanderlust 2020 copyright</small>
        </footer>
    </div>
</body>
</html>
