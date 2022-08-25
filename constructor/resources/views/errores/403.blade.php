@extends("back-end.layouts.app")
@section('titulo')
    Accesos Restringidos
@endsection
@section('styles')
<style>
    .title {
        text-align: center;
        display: table;
        font-weight: 100;
        color: #B0BEC5;
        font-size: 72px;
        margin-bottom: 40px;
        font-family: 'Lato';
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('back-end.includes.mensaje')

        <div class="container">
			<div class="content">
				<center><div class="title">Error 403.</div><div class="title">No tiene permisos.</div></center>
			</div>
		</div>
    </div>
</div>
@endsection