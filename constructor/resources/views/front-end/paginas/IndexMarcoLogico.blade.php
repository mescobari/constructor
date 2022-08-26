@extends("back-end.layouts.app")
@include('back-end.includes.mensaje')
@section('styles')
@endsection
@section("scripts")
<script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('content')
{{-- <netstable></netstable> --}}

<marco-logico :institucion_auth="{{auth()->user()->institucion_user_auth()}}"></marco-logico>
@endsection