<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/dashboard.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/leaflet.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}"/>

    <!-- Scripts -->
    <script src="{{asset('js/vendors.js')}}"></script>

    <script src="{{asset('js/supportFunctions.js')}}"></script>
    <!-- Chart Class for quickly creating resizable D3 charts -->
    <script src="{{asset('js/ChartClass.js')}}"></script>
    <!-- Basic Pie Chart Subclass -->
    <script src="{{asset('js/BasicPieChartClass.js')}}"></script>
    <!-- Basic Bar Chart Subclass -->
    <script src="{{asset('js/BasicBarChartClass.js')}}"></script>

</head>
<body>
    <div id="app">
        @if (Request::is('/'))
        <nav id="welcome" class="navbar fixed-top navbar-expand-md navbar-dark nav-welcome-bg">
        @else
        <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark">
        @endif
            <div class="container">
                @if (Request::is('/'))
                <a class="navbar-brand scroll" href="#app">
                @else
                <a class="navbar-brand" href="{{ url('/') }}">
                @endif
                    <img id="cfp-logo" src="/storage/mainmenu_logo.png" alt="CFP" width="30px" height="30px">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if (Request::is('/'))
                        <ul class="navbar-nav ml-auto">
                          <li class="nav-item"><a class="nav-link scroll" href="#about">ABOUT</a></li>
                          <li class="nav-item"><a class="nav-link scroll" href="#features">FOCUS</a></li>
                          <li class="nav-item"><a class="nav-link scroll" href="#galleries">LATEST</a></li>
                          <li class="nav-item"><a class="nav-link scroll" href="#beneficiaries">BENEFICIARIES</a></li>
                          <li class="nav-item"><a class="nav-link scroll" href="#donors">DONORS</a></li>
                          <li class="nav-item"><a class="nav-link scroll" href="#staff">STAFF</a></li>
                          <li class="nav-item"><a class="nav-link scroll" href="#contact">CONTACT</a></li>
                        </ul>
                        @endif
                        @auth
                            @if (Auth::user()->admin)
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Front Page<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('employees') }}">{{ __('Employees') }}</a>
                                    <a class="dropdown-item" href="{{ route('galleries') }}">{{ __('Galleries') }}</a>
                                <a class="dropdown-item" href="{{ route('beneficiaries') }}">{{ __('Beneficiaries') }}</a>
                                <a class="dropdown-item" href="{{ route('donors') }}">{{ __('Donors') }}</a>
                            </div>
                        </li>
                            @endif
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @auth
                        <li class="nav-item dropdown">
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
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('edit') }}">{{ __('Profile') }}</a>
                            @if (Auth::user()->admin)
                                <a class="dropdown-item" href="{{ route('users') }}">{{ __('Users') }}</a>
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
                        @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        @if (Request::is('/'))
        <main role="main">
        @else
        <main id="main" role="main">
        @endif
            <!-- Notifications -->
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
            @endif
            @if (\Session::has('info'))
            <div class="alert alert-info">
                <p>{{ \Session::get('info') }}</p>
            </div>
            @endif
            @if (\Session::has('warning'))
            <div class="alert alert-warning">
                <p>{{ \Session::get('warning') }}</p>
            </div>
            @endif
            @if (\Session::has('error'))
            <div class="alert alert-danger">
                <p>{{ \Session::get('error') }}</p>
            </div>
            @endif

            @yield('content')

        </main>
    </div>
</body>
</html>
