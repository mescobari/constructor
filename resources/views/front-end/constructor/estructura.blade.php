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
                        
                        <i class="fa fa-fw fa-plus-circle"></i> Crear Item
                    </a>
                </div>
            </div>

           

            <div class="card-body">

                <div class="container">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">
                            
                                <label>{{$contrato_id}} .- {{$nombre}}</label>

                                                            
                            
                        </div>
                        <div class="col-1"></div>
                    </div>
                </div>
              


                @csrf
                <div class="dd" id="nestable">
                    <ol class="dd-list" >
                        @foreach ($menus as $key => $item)
                            @if ($item["id_padre"] != 0)
                                @break
                            @endif
                            @if ($item["contrato_id"] == $contrato_id)
                                @include("back-end.admin.avan.avan-item",["item" => $item])
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
