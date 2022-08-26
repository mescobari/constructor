@extends("back-end.layouts.app")
@section('titulo')
    Personas
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
                <h3 class="card-title">Crear Persona</h3>
                <div class="card-tools">
                    <a href="{{route('persona')}}" class="btn btn-outline-info btn-sm">
                        <i class="fa fa-fw fa-reply-all"></i> Volver al listado de Personas
                    </a>
                </div>
            </div>
            <form action="{{route('guardar_persona')}}" id="form-general" class="form-horizontal form--label-right" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('back-end.admin.persona.form')
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
