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
    <script src="{{asset('js/supportFunctions.js')}}"></script>
    <!-- JQuery -->
    <script src="{{asset('js/jquery.slim.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- D3 core Javascript -->
    <script src="{{asset('js/d3.min.js')}}"></script>
    <!-- Chart Class for quickly creating resizable D3 charts -->
    <script src="{{asset('js/ChartClass.js')}}"></script>
    <!-- Basic Pie Chart Subclass -->
    <script src="{{asset('js/BasicPieChartClass.js')}}"></script>
    <!-- Basic Bar Chart Subclass -->
    <script src="{{asset('js/BasicBarChartClass.js')}}"></script>


    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/dashboard.css')}}"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>



</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="/storage/mainmenu_logo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('indicators/agriculture') ? 'active' : '' }}" href="{{ route('indicators.agriculture') }}">{{ __('Agriculture') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('indicators/energy') ? 'active' : '' }}" href="{{ route('indicators.energy') }}">{{ __('Energy') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('indicators/forestry') ? 'active' : '' }}" href="{{ route('indicators.forestry') }}">{{ __('Forestry') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('indicators/water') ? 'active' : '' }}" href="{{ route('indicators.water') }}">{{ __('Water') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('indicators/gender') ? 'active' : '' }}" href="{{ route('indicators.gender') }}">{{ __('Gender') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('indicators/land-rights') ? 'active' : '' }}" href="{{ route('indicators.land') }}">{{ __('Land Rights') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('indicators/gov-links') ? 'active' : '' }}" href="{{ route('indicators.gov') }}">{{ __('Gov Links') }}</a>
                        </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @else
                        <li class="nav-item dropdown show">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('edit') }}">{{ __('Profile') }}</a>
                            @if (Auth::user()->admin)
                                <a class="dropdown-item" href="{{ route('users.index') }}">{{ __('Users') }}</a>
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
                        @endguest
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
