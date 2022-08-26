@extends("back-end.layouts.app")
@section('titulo')
Personas
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
                <h3 class="card-title">Personas</h3>
                <div class="card-tools">
                    <a href="{{route('crear_persona')}}" class="btn btn-outline-secondary btn-sm">
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
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>CI</th>
                                <th>Complemento</th>
                                <th>Extendido en:</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>                    
                        <tbody>
                            @foreach ($datas as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->nombres}}</td>
                                <td>{{$data->paterno}}</td>
                                <td>{{$data->materno}}</td>
                                <td>{{$data->ci}}</td>
                                <td>{{$data->complemento}}</td>
                                <td>{{$data->expedidoLiteral}}</td>                                
                                <td>
                                    <a href="{{route('editar_persona', ['id' => $data->id])}}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
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
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
