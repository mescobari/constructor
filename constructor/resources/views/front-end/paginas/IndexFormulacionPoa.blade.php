@extends("back-end.layouts.app")
@include('back-end.includes.mensaje')
@section('styles')
@endsection
@section("scripts")
<script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('content')
<formulacion-poa :institucion_auth="{{auth()->user()->institucion_user_auth()}}"></formulacion-poa>
@endsection