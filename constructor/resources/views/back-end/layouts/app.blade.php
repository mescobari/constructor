<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$sistemas_ferchos}}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="{{asset("assets/lte/plugins/fontawesome-free/css/all.min.css")}}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('estilos_de_terceros')

    <link rel="stylesheet" href="{{asset("assets/ferdy/css/ionicons.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/lte/dist/css/adminlte.min.css")}}">
    {{-- <link href="{{asset("assets/ferdy/css/css_1.css")}}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{asset("assets/ferdy/css/toastr.min.css")}}">

    @yield("styles")
    <link rel="stylesheet" href="{{asset("assets/ferdy/css/loading-cargando.css")}}">
    <link rel="stylesheet" href="{{asset("assets/lte/css/custom.css")}}">
    <link rel="stylesheet" href="{{asset("assets/ferdy/css/css_background.css")}}">
    {{-- <link rel="stylesheet" href="{{asset("assets/ferdy/css/css.css")}}"> --}}
    <link rel="stylesheet" href="{{asset("assets/ferdy/css/reemplazo-lte.css")}}">
    <link rel="stylesheet" href="{{asset("assets/ferdy/css/reemplazo-bootstrap.css")}}">
    <link rel="icon" href="{{asset('img/sistema-front-end/favicon.ico')}}"> 
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Main Header -->
    @include('back-end.layouts.header')

    <!-- Left side column. contains the logo and sidebar -->
    @include('back-end.layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            <div id="app">
                @yield('content')     
            </div>  
            @can('administracion_administracion_permiso_menu')
                {{-- <h1>prueba de verificacion de permisos</h1> --}}
            @endcan 
        </section>
    </div>

    <!-- Main Footer -->
    @include('back-end.layouts.footer')
</div>


<script src="{{asset("assets/lte/plugins/jquery/jquery.min.js")}}"></script>
<script src="{{asset("assets/lte/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("assets/lte/dist/js/adminlte.min.js")}}"></script>
@yield("scriptsPlugins")
<script src="{{asset("assets/lte/js/jquery-validation/jquery.validate.min.js")}}"></script>
<script src="{{asset("assets/lte/js/jquery-validation/localization/messages_es.min.js")}}"></script>
<script src="{{asset("assets/ferdy/js/sweetalert.min.js")}}"></script>
<script src="{{asset("assets/ferdy/js/toastr.min.js")}}"></script>
<script src="{{asset("assets/lte/js/scripts.js")}}"></script>
<script src="{{asset("assets/lte/js/funciones.js")}}"></script>
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
@yield("scripts")
<script>
    $(document).ready(function() {
    $(".dropdown-toggle").dropdown();
});
</script>
</body>
</html>
