@extends("front-end.layouts.layout")
@include('front-end.includes.mensaje')
@section('titulo')
    {{$sistemas_ferchos_login}}
@endsection

@section('styles')    
    <link rel="stylesheet" href="{{asset("assets/lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
@endsection


@section('contenido')    
	<div class="container">
		@if ($errors->any())
			<div class="alert alert-warning" id="success-alert">
				<button type="button" class="close" data-dismiss="alert">x</button>
				<strong>Success! </strong> 
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</div>
		@endif
        <br><br><br><br><br><br>
		<div class="d-flex justify-content-left">
			<div class="user_card {{$sistemas_ferchos_color_fondo_formulario}} p-3 rounded-lg  bg-light" style="box-shadow: 2px 2px 10px rgb(46, 26, 139);">
				<div class="d-flex justify-content-center p-3 rounded-lg bg-success" style="margin-top: -35%; box-shadow: 2px 2px 10px rgb(46, 26, 139); 
				background: url({{asset('img/sistema-front-end/background-login.jpeg')}}) no-repeat fixed center;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;">
					<div class="brand_logo_container rounded-circle bg-white m1">
						<img src="{{asset("img/sistema-front-end/logo.png")}}" class="brand_logo rounded-circle p-1" alt="Logo">
					</div>
				</div>
                <br>
				<div class="d-flex justify-content-center form_container">
					<form method="POST" action="{{ route('login') }}">
						@csrf
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="userName" class="form-control input_user" placeholder="Usuario o Alias" value="">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" value="" placeholder="Contraseña">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Recordar mi usuario y contraseña</label>
							</div>
						</div>
						<div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="button" class="btn {{$sistemas_ferchos_boton_guardar}} btn-lg">Login</button>
                        </div>
					</form>
				</div>
		
				<div class="mt-4">
					{{-- <div class="d-flex justify-content-center links">
						¿No tienes una Cuenta? 
					</div>--}}
					{{-- <div class="d-flex justify-content-center links">
						<a href="{{route('crear_usuario')}}" class="ml-2 text-bold">Registrarme</a>
					</div> --}}
					<br> 
					<div class="d-flex justify-content-center links">
						<a href="javascript:abrir_modal_recupera_contraseña();">¿Olvidaste tu contraseña?</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="Recuper_contrasena" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="Recuper_contrasenaTitle" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
		  <div class="modal-content">
			<div class="modal-header {{$sistemas_ferchos_color_cabeceras_formulario}}">
			  <h5 class="modal-title" id="Recuper_contrasenaTitle">Si olvido su Contraseña continue, caso contrario presione cancelar</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>   
			<div class="modal-body" style="height: 700px; width: 100%; overflow-y: auto;">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">{{ __('Reiniciar Contraseña') }}</div>
				
								<div class="card-body">
									@if (session('status'))
										<div class="alert alert-success" role="alert">
											{{ session('status') }}
										</div>
									@endif
				
									<form method="POST" action="{{ route('password.email') }}">
										@csrf
				
										<div class="form-group row">
											<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Dirección de E-Mail') }}</label>
				
											<div class="col-md-6">
												<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
				
												@error('email')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
				
										<div class="form-group row mb-0">
											<div class="col-md-6 offset-md-4">
												<button type="submit" class="btn btn-primary">
													{{ __('Enviar enlace de restablecimiento de contraseña') }}
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		  </div>
		</div>
	</div>
@endsection
@section('scripts')
<script>
	function abrir_modal_recupera_contraseña(){
		$('#Recuper_contrasena').modal('show');
	}
</script>	
@endsection