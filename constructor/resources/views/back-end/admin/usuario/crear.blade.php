@extends("back-end.layouts.app")
@section('titulo')
    Usuarios
@endsection

@section("scripts")
<script src="{{asset("assets/ferdy/pages/scripts/admin/usuario/crear.js")}}" type="text/javascript"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('back-end.includes.form-error')
        @include('back-end.includes.mensaje')
        <div class="card">
            <div class="card-header {{$sistemas_ferchos_color_cabeceras_formulario}}">
                <h3 class="card-title">Crear usuario</h3>
                <div class="card-tools">
                    <a href="{{route('usuario')}}" class="btn btn-outline-info btn-sm">
                        <i class="fa fa-fw fa-reply-all"></i> Volver al listado de Usuarios
                    </a>
                </div>
            </div>
            <form action="{{route('guardar_usuario')}}" id="form-general" class="form-horizontal form--label-right" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('back-end.admin.usuario.form')
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <button type="submit" class="btn text-bold {{$sistemas_ferchos_boton_guardar}}">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
