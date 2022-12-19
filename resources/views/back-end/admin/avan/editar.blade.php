@extends("back-end.layouts.app")
@section('titulo')
    Sistema Menús
@endsection

@section("scripts")
<script src="{{asset("assets/ferdy/pages/scripts/admin/avan/crear.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/ferdy/pages/scripts/admin/avan/icons.js")}}" type="text/javascript"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('back-end.includes.form-error')
        @include('back-end.includes.mensaje')
        <div class="card">
            <div class="card-header {{$sistemas_ferchos_color_cabeceras_formulario}}">
                <h3 class="card-title">Editar Item de obra</h3>
                <div class="card-tools">
                    <a href="select_estructura/24" class="btn btn-outline-info btn-sm">
                        <i class="fa fa-fw fa-reply-all"></i> Volver a Estructura
                    </a>
                </div>
            </div>
            <form action="{{route('actualizar_avan')}}" id="form-general" class="form-horizontal form--label-right" method="POST">
                @csrf
                <input type="hidden" name="id_menu" value="{{$data->id}}">
                <div class="card-body">
                    @include('back-end.admin.avan.form')
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn {{$sistemas_ferchos_boton_modificar}}">Actualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_iconos" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="modal_iconosTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header {{$sistemas_ferchos_color_cabeceras_formulario}}">
          <h5 class="modal-title" id="modal_iconosTitle">Seleccion de Iconos Recomendados</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form>
            <div class="modal-body" style="height: 700px; width: 100%; overflow-y: auto;">
                <div class="container">
                    <div class="row" id="contenedor_iconos">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection
