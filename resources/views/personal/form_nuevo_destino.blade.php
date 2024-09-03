@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('personal/'.Crypt::encryptString($personal->per_id))}}" title="Volver a lista de personal" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<h5 style="background-color:#ddd; padding:5px; border:1px solid #ccc;">
									<span class="text-info">NOMBRE COMPLETO:</span> {{$personal->per_nombres}} {{$personal->per_primer_apellido}} {{$personal->per_segundo_apellido}}<br>
									<span class="text-info">GRADO:</span> {{$personal->grado->gra_abreviacion}}<br>
									<span class="text-info">ESPECIALIDAD:</span> {{$personal->especialidad->esp_descripcion}}<br>
								</h5>
		
								<form id="form-nuevo-personal" action="{{url('destinos')}}" method="POST">
								  @csrf
								  <section id="seccion-datos-personales">
									<div class="row">
										<div class="col-md-10 offset-md-1">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="label-blue label-block" for="">
														Grupo aéreo destino:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer el grupo aereo destino"></i>
														</label>
														<select required class="form-control @error('gru_id') is-invalid @enderror" name="gru_id" id="gru_id">
															<option value="">Seleccione una opción</option>
															@foreach ($grupos as $item)
															<option value="{{$item->gru_id}}" {{ old('gru_id') == $item->gru_id ? 'selected' : '' }}>{{$item->gru_descripcion}}</option>
															@endforeach
														</select>
														@error('gru_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="label-blue label-block" for="">
														Motivo:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer el motivo del destino"></i>
														</label>
														<input required type="text" value="{{old('des_motivo')}}" class="form-control @error('des_motivo') is-invalid @enderror" name="des_motivo" id="des_motivo" placeholder="Motivo">
														@error('des_motivo')
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
															Fecha de inicio:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la fecha de inicio del destino"></i>
														</label>
														<input required type="date" value="{{old('des_fecha_inicio')}}" class="form-control @error('des_fecha_inicio') is-invalid @enderror" name="des_fecha_inicio" id="des_fecha_inicio" placeholder="Fecha de inicio">
														@error('des_fecha_inicio')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Fecha de finalización:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la fecha de finalización del destino"></i>
														</label>
														<input required type="date" value="{{old('des_fecha_fin')}}" class="form-control @error('des_fecha_fin') is-invalid @enderror" name="des_fecha_fin" id="des_fecha_fin" placeholder="Fecha de finalización">
														@error('des_fecha_fin')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Cargo:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el cargo que ocupará en este destino"></i>
														</label>
														<input required type="text" value="{{old('des_cargo')}}" class="form-control @error('des_cargo') is-invalid @enderror" name="des_cargo" id="des_cargo" placeholder="Cargo">
														@error('des_cargo')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>

											</div>
											<div class="row">
												<div class="col-md-6">
													<input type="hidden" name="per_id" value="{{$personal->per_id}}">
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