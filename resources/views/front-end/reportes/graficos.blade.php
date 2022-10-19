@extends("back-end.layouts.app")
@include('back-end.includes.mensaje')
@section('styles')
@endsection
@section("scripts")
<script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('content')
{{ $contrato_id }}
<graficos :contrato_id="{{json_encode($contrato_id)}}" ></graficos>
@endsection