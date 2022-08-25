<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('titulo', 'Inicio') | {{$sistemas_ferchos}}</title>
    <link rel="stylesheet" href="{{asset("assets/lte/plugins/fontawesome-free/css/all.min.css")}}">
    {{-- <link rel="stylesheet" href="{{asset("assets/ferdy/css/ionicons.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/lte/dist/css/adminlte.min.css")}}">
    <link href="{{asset("assets/ferdy/css/css_1.css")}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("assets/ferdy/css/toastr.min.css")}}"> --}}

    @yield("styles")
    {{-- <link rel="stylesheet" href="{{asset("assets/ferdy/css/loading-cargando.css")}}">
    <link rel="stylesheet" href="{{asset("assets/lte/css/custom.css")}}">
    <link rel="stylesheet" href="{{asset("assets/ferdy/css/css_background.css")}}">
    <link rel="stylesheet" href="{{asset("assets/ferdy/css/css.css")}}">
    <link rel="stylesheet" href="{{asset("assets/ferdy/css/reemplazo-lte.css")}}"> --}}
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{asset('img/sistema-front-end/favicon.ico')}}"> 
</head>
<style>
    body {
        background: url("/img/sistema-front-end/body.jpeg") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>

<body class="">
    
    @include("front-end.layouts.header")
    <div class="container-fluid" style="min-height: 85vh">
        {{-- contenido --}}
        @yield('contenido')
        <div id="app">
            
        </div>
    </div>
        {{-- footer --}}
    {{-- @include("front-end.layouts.footer")             --}}
    </div>
    <script>       
        
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>    
    @yield('scripts')    
    </body>
    </html>
