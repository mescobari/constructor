@extends("back-end.layouts.app")
@section('titulo')
    Permisos
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
                <h3 class="card-title">Permisos</h3>
                <div class="card-tools">
                    <a href="{{route('crear_permiso')}}" class="btn btn-outline-info btn-sm">
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
                            <th class="width80">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->descripcion}}</td>
                                <td>
                                    <a href="{{route("editar_permiso", ['id' => $data->id])}}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{route("eliminar_permiso",  ['id' => $data->id])}}" class="d-inline form-eliminar" method="POST">
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
@endsection
