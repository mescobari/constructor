@extends("back-end.layouts.app")
@section("titulo")
Menú
@endsection

@section("styles")
<link href="{{asset("assets/lte/js/jquery-nestable/jquery.nestable.css")}}" rel="stylesheet" type="text/css" />
@endsection

@section("scriptsPlugins")
<script src="{{asset("assets/lte/js/jquery-nestable/jquery.nestable.js")}}" type="text/javascript"></script>
@endsection

@section("scripts")
<script src="{{asset("assets/ferdy/pages/scripts/admin/avan/index.js")}}" type="text/javascript"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('back-end.includes.mensaje')                
        <div class="card">
            <div class="card-header {{$sistemas_ferchos_color_cabeceras_formulario}}">
                <h3 class="card-title">Estructura de Obra</h3>
                <div class="card-tools">
                    <a href="{{route('crear_avan')}}" class="btn btn-outline-secondary btn-sm">
<<<<<<< Updated upstream

                        <i class="fa fa-fw fa-plus-circle"></i> Crear Item

=======
<<<<<<< HEAD
                        <i class="fa fa-fw fa-plus-circle"></i> Crear Item
=======
                        <i class="fa fa-fw fa-plus-circle"></i> Crear Concepto
>>>>>>> 61f74d70ffc68bd2551ad0db3734c341186835ea
>>>>>>> Stashed changes
                    </a>
                </div>
            </div>
            <div class="card-body">
                @csrf
                <div class="dd" id="nestable">
                    <ol class="dd-list">
                        @foreach ($menus as $key => $item)
                            @if ($item["id_padre"] != 0)
                                @break
                            @endif
<<<<<<< Updated upstream

                            @include("back-end.admin.avan.avan-item",["item" => $item])

=======
<<<<<<< HEAD
                            @include("back-end.admin.avan.avan-item",["item" => $item])
=======
                            @include("Front-end.constructor.avan-item",["item" => $item])
>>>>>>> 61f74d70ffc68bd2551ad0db3734c341186835ea
>>>>>>> Stashed changes
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
