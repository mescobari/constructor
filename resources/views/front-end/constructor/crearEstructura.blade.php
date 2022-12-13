@extends("back-end.layouts.app")
@section('titulo')
    Sistema Menús
@endsection

@section("scripts")
<script src="{{asset("assets/ferdy/pages/scripts/admin/menu/crear.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/ferdy/pages/scripts/admin/menu/icons.js")}}" type="text/javascript"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('back-end.includes.form-error')
        @include('back-end.includes.mensaje')
        <div class="card">
            <div class="card-header {{$sistemas_ferchos_color_cabeceras_formulario}}">
                <h3 class="card-title">Crear Concepto Estructura de Obra</h3>
                <div class="card-tools">
                    <a href="{{route('menu')}}" class="btn btn-outline-info btn-sm">
                        <i class="fa fa-fw fa-reply-all"></i> Volver al listado
                    </a>
                </div>
            </div>
            <form action="{{route('guardar_menu')}}" id="form-general" class="form-horizontal form--label-right" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    @include('back-end.admin.menu.form')
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn {{$sistemas_ferchos_boton_guardar}}">Guardar</button>
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
