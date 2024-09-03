@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('usuarios')}}" title="Volver a lista de usuarios" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<form id="form-nuevo-usuario" action="{{url('usuarios/'.Crypt::encryptString($usuario->usu_id))}}" method="POST">
									@method('PUT')
									@csrf
								  <section id="seccion-datos-cuenta-usuario">
									<h4 class="card-title"><strong><span class="text-info">
										<i class="fa fa-user"></i>
										Datos de la cuenta de usuario
									</span></strong></h4>
									<hr>
									<div class="row">
										<div class="col-md-10 offset-md-1">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Nombre de usuario:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer nombre de usuario"></i>
															</label>
														<input required type="text" value="{{old('usu_nombre', $usuario->usu_nombre)}}" class="form-control @error('usu_nombre') is-invalid @enderror" name="usu_nombre" id="usu_nombre" placeholder="Nombre de usuario">
														@error('usu_nombre')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Contraseña:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Contraseña del usuario. Autogenerado la primera vez"></i>
															</label>
														<input required type="password" value="asldkfjalskdjflkasjd" class="form-control txt_pwd @error('usu_password') is-invalid @enderror" name="usu_password" id="usu_password" readonly>
														@error('usu_password')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>

											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
															Grado y nombre completo:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el grado y nombre completo de la persona que manejará esta cuenta"></i>
															</label>
															<select required class="form-control @error('fun_id') is-invalid @enderror" name="fun_id" id="fun_id">
																<option value="">Seleccione una opción</option>
																@foreach ($funcionarios as $item)
																<option value="{{$item->fun_id}}" {{ old('fun_id', $usuario->fun_id) == $item->fun_id ? 'selected' : '' }}>{{$item->grado->gra_abreviacion}} {{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}</option>
																@endforeach
																<option value="9999999" {{ old('fun_id', $usuario->fun_id) == '9999999' ? 'selected' : '' }}>SIN RELACION A PERSONAL</option>
															</select>
															@error('fun_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
															E-mail:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el email asociado a la cuenta de usuario"></i>
															</label>
														<input required type="text" value="{{old('usu_email', $usuario->usu_email)}}" class="form-control txt_email @error('usu_email') is-invalid @enderror" name="usu_email" id="usu_email" placeholder="Correo electrónico">
														@error('usu_email')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="label-blue label-block" for="">
														Rol:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer el rol del usuario"></i>
														</label>
														<select required class="form-control @error('rol_id') is-invalid @enderror" name="rol_id" id="rol_id">
															<option value="">Seleccione una opción</option>
															@foreach ($roles as $item)
															@if($item->rol_id > 1)
															<option value="{{$item->rol_id}}" {{ old('rol_id', $usuario->rol_id) == $item->rol_id ? 'selected' : '' }}>{{$item->rol_nombre}}</option>
															@endif
															@endforeach
														</select>
														@error('rol_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<button type="submit" class="btn btn-info">
															<i class="fa fa-save"></i>
															Guardar
													</button>
												</div>
											</div>

										</div>
									</div>

								  </section>


								  
								</form>
							</div>
						</div>
					</div>
				</div>

				<!-- fin card  -->

			</div>
		</div>
	</div>

<script>
$(function(){

});	


	</script>


    @endsection