@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('personal')}}" title="Volver a lista de personal" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<form id="form-nuevo-personal" action="{{url('personal')}}" method="POST">
								  @csrf
								  <section id="seccion-datos-personales">
									<h4 class="card-title"><strong><span class="text-info">
										<i class="fa fa-user"></i>
										Datos personales
									</span></strong></h4>
									<hr>
									<div class="row">
										<div class="col-md-10 offset-md-1">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Nro. CI o Carnet militar:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el nro de cedula de identidad o nro de carnet de militar"></i>
															</label>
														<input required type="text" value="{{old('per_ci')}}" class="form-control @error('per_ci') is-invalid @enderror" name="per_ci" id="per_ci" placeholder="Nro ci o nro de Carnet de Militar">
														@error('per_ci')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
															<label class="label-blue label-block" for="">
															Nombres:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer los nombres de la persona"></i>
															</label>
														<input required type="text" value="{{old('per_nombres')}}" class="form-control @error('per_nombres') is-invalid @enderror" name="per_nombres" id="per_nombres" placeholder="Nombres">
														@error('per_nombres')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Primer Apellido:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el primer apellido de la persona"></i>
														</label>
														<input required type="text" value="{{old('per_primer_apellido')}}" class="form-control @error('per_primer_apellido') is-invalid @enderror" name="per_primer_apellido" id="per_primer_apellido" placeholder="Primer apellido">
														@error('per_primer_apellido')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>

											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Segundo Apellido:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el segundo apellido de la persona"></i>
														</label>
														<input required type="text" value="{{old('per_segundo_apellido')}}" class="form-control @error('per_segundo_apellido') is-invalid @enderror" name="per_segundo_apellido" id="per_segundo_apellido" placeholder="Segundo apellido">
														@error('per_segundo_apellido')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
															<label class="label-blue label-block" for="">
															Grado:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el grado del militar"></i>
															</label>
															<select required class="form-control @error('gra_id') is-invalid @enderror" name="gra_id" id="gra_id">
																<option value="">Seleccione una opción</option>
																@foreach ($grados as $item)
																<option value="{{$item->gra_id}}" {{ old('gra_id') == $item->gra_id ? 'selected' : '' }}>{{$item->gra_descripcion}}</option>
																@endforeach
															</select>
															@error('gra_id')
															<div class="invalid-feedback">
																{{$message}}
															</div>											
															@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
														Especialidad:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer la especialidad del militar"></i>
														</label>
															<select required class="form-control @error('esp_id') is-invalid @enderror" name="esp_id" id="esp_id">
																<option value="">Seleccione una opción</option>
																@foreach ($especialidades as $item)
																<option value="{{$item->esp_id}}" {{ old('esp_id') == $item->esp_id ? 'selected' : '' }}>{{$item->esp_descripcion}}</option>
																@endforeach
															</select>
														@error('esp_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>

											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
														Nivel:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer el nivel del militar"></i>
														</label>
															<select required class="form-control @error('per_nivel') is-invalid @enderror" name="per_nivel" id="per_nivel">
																<option value="">Seleccione una opción</option>
																<option value="1" {{ old('per_nivel') == 1 ? 'selected' : '' }}>OFICIAL</option>
																<option value="3" {{ old('per_nivel') == 3 ? 'selected' : '' }}>TECNICO</option>
																<option value="5" {{ old('per_nivel') == 5 ? 'selected' : '' }}>INSPECTOR</option>
																<option value="7" {{ old('per_nivel') == 7 ? 'selected' : '' }}>SUPERVISOR</option>
															</select>
														@error('esp_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															PID:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el PID del personal"></i>
														</label>
														<input required type="text" value="{{old('fun_pid')}}" class="form-control @error('fun_pid') is-invalid @enderror" name="fun_pid" id="fun_pid" placeholder="PID">
														@error('fun_pid')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>

											</div>

										</div>
									</div>
								  </section>
								  <br>
								  <section id="seccion-datos-ingreso-personal">
									<h4 class="card-title"><strong><span class="text-info">
										<i class="fa fa-suitcase"></i>
										Datos de la incorporación
									</span></strong></h4>
									<hr>
									<div class="row">
										<div class="col-md-10 offset-md-1">
											<div class="row">
												<div class="col-md-8">
													<div class="form-group">
														<label class="label-blue label-block" for="">
														Cargo:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer el nivel del militar"></i>
														</label>
														<select required class="form-control @error('car_id') is-invalid @enderror" name="car_id" id="car_id">
															<option value="">Seleccione una opción</option>
															@foreach ($cargos as $item)
															<option value="{{$item->car_id}}" {{ old('car_id') == $item->car_id ? 'selected' : '' }}>{{$item->car_nombre}} - {{$item->unidad->uor_nombre}} ({{$item->unidad->grupo->gru_nombre}})</option>
															@endforeach
														</select>
														@error('car_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Fecha de ingreso:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la fecha de ingreso o incorporación a la unidad"></i>
														</label>
														<input required type="date" value="{{old('unf_fecha_inicio', date('Y-m-d'))}}" class="form-control @error('unf_fecha_inicio') is-invalid @enderror" name="unf_fecha_inicio" id="unf_fecha_inicio">
														@error('unf_fecha_inicio')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Motivo de la incoporación:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el motivo de la incorporación"></i>
														</label>
														<input required type="text" value="{{old('unf_motivo_designacion')}}" class="form-control @error('unf_motivo_designacion') is-invalid @enderror" name="unf_motivo_designacion" id="unf_motivo_designacion">
														@error('unf_motivo_designacion')
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