@extends('layouts.noautenticado')
@section('titulo', $titulo)

@section('contenido')

<div id="container">
	<div class="row">
		<div class="col-md-5 offset-md-7">
			<div class="login-box">
				<div class="row">
					<div class="col-md-12 text-center">
						<div style="text-align: center;">
							<img style="width:80%; margin:auto;" src="{{asset('img/logo_pp.png')}}">
						</div>
						<br>
						<h4 class="text-white font-weight-bold">FORMULARIO DE ACCESO</h4>
						<form action="{{url('auth/')}}" method="POST" autocomplete="off">
                          @csrf
                          <input style="display:none">
                          <input type="text" style="display:none">
                          <input autocomplete="false" name="hidden" type="text" style="display:none;">
                          <div class="form-group">
						    <label class="text-light">Usuario: </label>
						    <input required type="text" class="form-control form-control-lg" name="uuo" id="uuo" placeholder="Escriba el nombre de usuario." autocomplete="false" autofocus>
							@error('uuo')
							<div class="invalid-feedback">
								{{$message}}
							</div>											
							@enderror
						  </div>
						  <div class="form-group">
						    <label class="text-light">Contraseña: </label>
						    <input required type="password" class="form-control form-control-lg" name="ovc" id="ovc" placeholder="Escriba la contraseña" autocomplete="false">
							@error('ovc')
							<div class="invalid-feedback">
								{{$message}}
							</div>											
							@enderror
						  </div>
						  {!! RecaptchaV3::initJs() !!}
						  {!! RecaptchaV3::field('captcha') !!}

						  <button type="submit" class="btn btn-lg btn-block btn-info">
								<i class="fa fa-lock"></i>
								Acceder
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection