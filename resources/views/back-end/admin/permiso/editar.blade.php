@extends("back-end.layouts.app")
@section('titulo')
    Permisos
@endsection

@section("scripts")
<script src="{{asset("assets/pages/scripts/admin/permiso/crear.js")}}" type="text/javascript"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('back-end.includes.form-error')
        @include('back-end.includes.mensaje')
        <div class="card">
            <div class="card-header {{$sistemas_ferchos_color_cabeceras_formulario}}">
                <h3 class="card-title">Editar Permisos {{$data->name}}</h3>
                <div class="card-tools">
                    <a href="{{route('permiso')}}" class="btn btn-outline-info btn-sm">
                        <i class="fa fa-fw fa-reply-all"></i> Volver al listado
                    </a>
                </div>
            </div>
            <form action="{{route('actualizar_permiso', ['id' => $data->id])}}" id="form-general" class="form-horizontal form--label-right" method="POST" autocomplete="off">
                @csrf @method("put")
                <div class="card-body">
                    @include('back-end.admin.permiso.form')
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            @include('back-end.includes.boton-form-editar')
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
