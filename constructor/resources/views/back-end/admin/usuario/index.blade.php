@extends("back-end.layouts.app")
@section('titulo')
Usuarios
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
                <h3 class="card-title">Usuarios</h3>
                <div class="card-tools">
                    <a href="{{route('crear_usuario')}}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-fw fa-plus-circle"></i> Nuevo registro
                    </a>
                </div>
            </div>
            <br>
            <div class="card-body">          
                <div class="table-responsive">
                    <table class="table table-striped table-bordered-responsive table-hover" id="tabla-data" style="width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Email</th>
                                <th>Estado</th>
                                <th>Roles</th>
                                <th>Permisos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>                    
                        <tbody>
                            @foreach ($datas as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->userName}}</td>
                                <td>{{$data->email}}</td>
                                <td><?php if($data->estado == 'ACT'){echo '<span class="badge badge-success">';}else{echo '<span class="badge badge-danger">';}?>{{$data->estadoLiteral}}</span></td>
                                <td>
                                    @if (auth()->user()->check_roles(['administrador', 'super_administrador']))     
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#roles" onclick="abrir_modal_roles_usuario({{$data->id}})">
                                            Actualizar Roles
                                        </button>
                                    @else
                                        <span class="badge badge-danger">Sin permisos</span>
                                    @endif        
                                </td>
                                <td>
                                    @if (auth()->user()->check_roles(['administrador', 'super_administrador']))  
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#permisos" onclick="abrir_modal_permisos_usuario({{$data->id}})">
                                            Actualizar Permisos
                                        </button>
                                    @else
                                        <span class="badge badge-danger">Sin permisos</span>
                                    @endif       
                                </td>
                                <td>
                                    <a href="{{route('editar_usuario', ['id' => $data->id])}}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                        <i class="fa fa-edit fa-2x"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="permisos" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="permisosTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header {{$sistemas_ferchos_color_cabeceras_formulario}}">
          <h5 class="modal-title" id="permisosTitle">Favor de seleccionar los Permisos que asignara al Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('actualizar_permisos_usuario')}}" method="POST">
            @csrf
            <input type="hidden" name="id_usuario" id="id_usuario" value="">        
            <div class="modal-body" style="height: 700px; width: 100%; overflow-y: auto;">
                <div id="tabla_permisos2"></div>
                <div class="container">
                    <input type="checkbox" name="todospermisos" id="todospermisos" style='width: 30px; height: 30px'  onclick="seleccionar_todos(this, 'checks_permisos')">
                    <span> Marque para Seleccionar TODOS</span>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" width="10%">#</th>
                                <th scope="col" width="15%">Selección</th>
                                <th scope="col" width="30%">Nombre</th>
                                <th scope="col" width="45%">Descripción</th>
                            </tr>
                            <tr id="todos_permisos"></tr>
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

<div class="modal fade" id="roles" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="rolesTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header {{$sistemas_ferchos_color_cabeceras_formulario}}">
          <h5 class="modal-title" id="rolesTitle">Favor de seleccionar los Roles que asignara al Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('actualizar_roles_usuario')}}" method="POST">
            @csrf
            <input type="hidden" name="id_usuario2" id="id_usuario2" value="">        
            <div class="modal-body" style="height: 700px; width: 100%; overflow-y: auto;">
                <div id="tabla_roles2"></div>
                <div class="container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" width="10%">#</th>
                                <th scope="col" width="15%">Selección</th>
                                <th scope="col" width="30%">Nombre</th>
                                <th scope="col" width="45%">Descripción</th>
                            </tr>
                            <tr id="todos_roles">

                            </tr>
                        </thead>
                        <tbody id="tabla_roles">
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
