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
                <h3 class="card-title">Editar Persona {{$persona->nombres}}</h3>
                <div class="card-tools">
                    <a href="{{route('persona')}}" class="btn btn-outline-info btn-sm">
                        <i class="fa fa-fw fa-reply-all"></i> Volver al listado de Personas
                    </a>
                </div>
            </div>
            <form action="{{route('actualizar_persona')}}" class="form-horizontal form--label-left" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$persona->id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('back-end.admin.persona.form')
                        </div>
                        {{-- <div class="col-md-6">
                            @include('back-end.admin.usuario.permisos')
                        </div> --}}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-10"></div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn {{$sistemas_ferchos_boton_modificar}}">Actualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function llamar_fer(){
        var valor = $("input[name='roles[]']").val();
        console.log(valor);
        alert(valor);
    }
    function checkAllff(){
        if (document.getElementById('checkAll').checked) {
            $("input[name='roles[]']").prop('checked', true);
        } else {
            $("input[name='roles[]']").prop('checked', false);
        }
    }
    // $("#checkAll").change(function () {
    //     alert();
    //     if ($(this).is(':checked')) {
    //         $("input[name='roles[]']").prop('checked', true);
    //         $(this).prop('title', 'Deseleccionar todos');
    //     } else {
    //         $("input[name='roles[]']").prop('checked', false);
    //         $(this).prop('title', 'Seleccionar todos');
    //     }
    // });
</script>
@endsection
