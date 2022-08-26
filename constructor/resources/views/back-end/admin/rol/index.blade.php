@extends("back-end.layouts.app")
@section('titulo')
Roles
@endsection

@section('styles')
<link rel="stylesheet" href="{{asset("assets/ferdy/dataTables/fer-buttons.bootstrap.min.css")}}">
<link rel="stylesheet" href="{{asset("assets/ferdy/dataTables/fer-dataTables.bootstrap.min.css")}}">
@endsection
@section("scripts")
<script src="{{asset("assets/ferdy/pages/scripts/admin/index.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/ferdy/dataTables/bootstrap.bundle.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/ferdy/js/jquery-3.5.1.js")}}"></script>
<script src="{{asset("assets/ferdy/dataTables/datatables.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/ferdy/dataTables/pdfmake.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/ferdy/dataTables/vfs_fonts.js")}}" type="text/javascript"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('back-end.includes.mensaje')
        <div class="card">
            <div class="card-header {{$sistemas_ferchos_color_cabeceras_formulario}}">
                <h3 class="card-title">Roles</h3>
                <div class="card-tools">
                    <a href="{{route('crear_rol')}}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-fw fa-plus-circle"></i> Nuevo registro
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-bordered table-hover" id="tabla-data">
                    <thead>
                        <tr>
                            <th class="width20">ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Asignar Permisos</th>
                            <th class="width80"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->descripcion}}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#permisos" onclick="abrir_modal_permisos_rol({{$data->id}})">
                                    Actualizar Permisos
                                </button>
                            </td>
                            <td>
                                <a href="{{route('editar_rol', ['id' => $data->id])}}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{route('eliminar_rol', ['id' => $data->id])}}" class="d-inline form-eliminar" method="POST">
                                    @csrf @method("delete")
                                    <button type="submit" class="btn-accion-tabla eliminar tooltipsC" title="Eliminar este registro">
                                        <i class="fa fa-times-circle text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="permisos" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="permisosTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header {{$sistemas_ferchos_color_cabeceras_formulario}}">
          <h5 class="modal-title" id="permisosTitle">Favor de seleccionar los permisos que asignara al ROL</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('actualizar_permisos_roles')}}" method="POST">
            @csrf
            <input type="hidden" name="id_rol" id="id_rol" value="">        
            <div class="modal-body" style="height: 700px; width: 100%; overflow-y: auto;">
                <div id="tabla_permisos2"></div>
                <div class="container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" width="10%">#</th>
                                <th scope="col" width="15%">Selección</th>
                                <th scope="col" width="30%">Nombre</th>
                                <th scope="col" width="45%">Descripción</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_permisos">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn {{$sistemas_ferchos_boton_modificar}}">Actualizar</button>
            </div>
        </form>
      </div>
    </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection