@extends("back-end.layouts.app")
@include('back-end.includes.mensaje')
@section('styles')
{{-- <link rel="stylesheet" href="{{asset("assets/ferdy/dataTables/fer-buttons.bootstrap.min.css")}}">
<link rel="stylesheet" href="{{asset("assets/ferdy/dataTables/fer-dataTables.bootstrap.min.css")}}"> --}}
@endsection
@section("scripts")
<script src="{{ asset('js/app.js') }}"></script>
{{-- <script src="{{asset("assets/ferdy/pages/scripts/admin/index.js")}}" type="text/javascript"></script> --}}
{{-- <script src="{{asset("assets/ferdy/dataTables/bootstrap.bundle.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/ferdy/js/jquery-3.5.1.js")}}"></script>
<script src="{{asset("assets/ferdy/dataTables/datatables.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/ferdy/dataTables/pdfmake.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/ferdy/dataTables/vfs_fonts.js")}}" type="text/javascript"></script> --}}
@endsection
@section('content')
<avance_prog></avance_prog>

@endsection