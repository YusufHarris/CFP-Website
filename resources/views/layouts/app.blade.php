<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{asset('js/app.js')}}"></script>

    <script src="{{asset('js/supportFunctions.js')}}"></script>
    <!-- Chart Class for quickly creating resizable D3 charts -->
    <script src="{{asset('js/ChartClass.js')}}"></script>
    <!-- Basic Pie Chart Subclass -->
    <script src="{{asset('js/BasicPieChartClass.js')}}"></script>
    <!-- Basic Bar Chart Subclass -->
    <script src="{{asset('js/BasicBarChartClass.js')}}"></script>
    <!--Light Box-->
    <script src="{{asset('js/lightbox.js')}}"></script>
    <script src="{{asset('js/lightbox-plus-jquery.min.js')}}"></script>



    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/dashboard.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/lightbox.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/lightbox.min.css')}}"/>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="/storage/mainmenu_logo.png" onerror="this.src='https://i.imgur.com/KaRxkxl.png';" alt="CFP Logo" width="30px" height="30px"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if (Request::is('/'))
                        <ul class="navbar-nav ml-auto">
                          <li class="nav-item"><a class="nav-link scroll" href="#about">About</a></li>
                          <li class="nav-item"><a class="nav-link scroll" href="#features">Focus</a></li>
                          <li class="nav-item"><a class="nav-link scroll" href="#galleries">Galleries</a></li>
                          <li class="nav-item"><a class="nav-link scroll" href="#staff">Staff</a></li>
                          <li class="nav-item"><a class="nav-link scroll" href="#beneficiaries">Beneficiaries</a></li>
                          <li class="nav-item"><a class="nav-link scroll" href="#contact">Contact</a></li>
                        </ul>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @auth
                        <li class="nav-item dropdown show">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Indicators <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ Request::is('indicators/agriculture') ? 'active' : '' }}" href="{{ route('indicators.agriculture') }}">{{ __('Agriculture') }}</a>
                                <a class="dropdown-item {{ Request::is('indicators/energy') ? 'active' : '' }}" href="{{ route('indicators.energy') }}">{{ __('Energy') }}</a>
                                <a class="dropdown-item {{ Request::is('indicators/forestry') ? 'active' : '' }}" href="{{ route('indicators.forestry') }}">{{ __('Forestry') }}</a>
                                <a class="dropdown-item {{ Request::is('indicators/water') ? 'active' : '' }}" href="{{ route('indicators.water') }}">{{ __('Water') }}</a>
                                <a class="dropdown-item {{ Request::is('indicators/gender') ? 'active' : '' }}" href="{{ route('indicators.gender') }}">{{ __('Gender') }}</a>
                                <a class="dropdown-item {{ Request::is('indicators/land-rights') ? 'active' : '' }}" href="{{ route('indicators.land') }}">{{ __('Land Rights') }}</a>
                                <a class="dropdown-item {{ Request::is('indicators/gov-links') ? 'active' : '' }}" href="{{ route('indicators.gov') }}">{{ __('Gov Links') }}</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown show">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('edit') }}">{{ __('Profile') }}</a>
                            @if (Auth::user()->admin)
                                <a class="dropdown-item" href="{{ route('users.index') }}">{{ __('Users') }}</a>

                                <a class="dropdown-item" href="{{ route('employees') }}">{{ __('Employees') }}</a>

                                <a class="dropdown-item" href="{{ route('beneficiaries') }}">{{ __('Beneficiaries') }}</a>
                            @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
