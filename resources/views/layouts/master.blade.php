<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>CFP Dashboard</title>

    <!-- JQuery -->
    <script src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>

    <!-- Leaflet CSS and Javascript -->
    <link rel="stylesheet" href="{{asset('css/leaflet.css')}}"/>
    <script src="{{asset('js/leaflet.js')}}"></script>

    <!-- Locally created supporting functions -->
    <script src="{{asset('js/supportFunctions.js')}}"></script>

    <!-- D3 core Javascript -->
    <script src="{{asset('js/d3.v5.js')}}"></script>
    <!-- Chart Class for quickly creating resizable D3 charts -->
    <script src="{{asset('js/ChartClass.js')}}"></script>
    <!-- Basic Pie Chart Subclass -->
    <script src="{{asset('js/BasicPieChartClass.js')}}"></script>
    <!-- Basic Bar Chart Subclass -->
    <script src="{{asset('js/BasicBarChartClass.js')}}"></script>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/dashboard.css')}}"/>

  </head>
    <body>
        @include('layouts.nav')

        <div class="container-fluid">
            @yield('content')
        </div>

        @include('layouts.footer')
    </body>
</html>
