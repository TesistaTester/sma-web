@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('grupos')}}" title="Volver a lista de grupos" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<form id="form-nuevo-grupo" action="{{url('aeronaves')}}" method="POST" enctype="multipart/form-data">
								  @method("PUT")
								  @csrf
								  <section id="seccion-datos-cuenta-grupo">
									<h4 class="card-title"><strong><span class="text-info">
										<i class="fa fa-user"></i>
										Datos de la aeronave
									</span></strong></h4>
									<hr>
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Grupo aereo:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer nombre de grupo aereo"></i>
														</label>
														<select required id="gru_id" name="gru_id" class="form-control @error('gru_id') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															@foreach ($grupos as $item)
															<option value="{{$item->gru_id}}">{{$item->gru_nombre}}</option>
															@endforeach
														</select>
														@error('faa_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Matricula aeronave:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer nombre de grupo aereo"></i>
														</label>
														<input required type="text" value="{{old('ae_matricula')}}" class="form-control @error('ae_matricula') is-invalid @enderror" name="ae_matricula" id="ae_matricula" placeholder="Nombre de grupo">
														@error('ae_matricula')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Estado matricula:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer nombre de grupo aereo"></i>
														</label>
														<select required id="ae_estado_matricula" name="ae_estado_matricula" class="form-control @error('ae_estado_matricula') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															<option value="W">WISKY</option>
															<option value="P">PAPA</option>
															<option value="M">MATENIMIENTO</option>
														</select>
														@error('ae_estado_matricula')
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
															País adquisición:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el pais de adquisición"></i>
														</label>
														<input required type="text" value="{{old('ae_pais_adquisicion')}}" class="form-control @error('ae_pais_adquisicion') is-invalid @enderror" name="ae_pais_adquisicion" id="ae_pais_adquisicion" placeholder="Pais adquisición">
														@error('ae_pais_adquisicion')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Tipo adquisición:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el tipo de adquisicion de la aeronave"></i>
														</label>
														<select required id="ae_tipo_adquisicion" name="ae_tipo_adquisicion" class="form-control @error('ae_tipo_adquisicion') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															<option value="NUEVO">NUEVO</option>
															<option value="MEDIO USO">MEDIO USO</option>
															<option value="INCAUTADO">INCAUTADO</option>
														</select>
														@error('ae_tipo_adquisicion')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Año de fabricación:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer año fabricación de la aeronave"></i>
														</label>
														<input required type="text" value="{{old('ae_anio_fabricacion')}}" class="form-control @error('ae_anio_fabricacion') is-invalid @enderror" name="ae_anio_fabricacion" id="ae_anio_fabricacion" placeholder="Año fabricacion">
														@error('ae_anio_fabricacion')
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
															Fabricante:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el pais de adquisición"></i>
														</label>
														<select required id="faa_id" name="faa_id" class="form-control @error('faa_id') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															@foreach ($fabricantes as $item)
															<option value="{{$item->faa_id}}">{{$item->faa_nombre}}</option>
															@endforeach
														</select>
														@error('faa_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Categoria aeronave:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la categoria de la aeronave"></i>
														</label>
														<select required id="cae_id" name="cae_id" class="form-control @error('cae_id') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															@foreach ($categorias as $item)
															<option value="{{$item->cae_id}}">{{$item->cae_nombre}}</option>
															@endforeach
														</select>
														@error('cae_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Tipo aeronave:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer año fabricación de la aeronave"></i>
														</label>
														<select required id="tia_id" name="tia_id" class="form-control @error('tia_id') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															@foreach ($tipos as $item)
															<option value="{{$item->tia_id}}">{{$item->tia_nombre}}</option>
															@endforeach
														</select>
														@error('tia_id')
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
															Part number:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el part number de la aeronave"></i>
														</label>
														<input required type="text" value="{{old('ae_part_number')}}" class="form-control @error('ae_part_number') is-invalid @enderror" name="ae_part_number" id="ae_part_number" placeholder="Part number">
														@error('ae_part_number')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Serial number:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el serial number del a aeronave"></i>
														</label>
														<input required type="text" value="{{old('ae_serial_number')}}" class="form-control @error('ae_serial_number') is-invalid @enderror" name="ae_serial_number" id="ae_serial_number" placeholder="Serial number">
														@error('ae_serial_number')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Nro componentes:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer numero de componentes que formaran parte de la aeronave"></i>
														</label>
														<input required type="number" value="{{old('ae_nro_componentes')}}" class="form-control @error('ae_nro_componentes') is-invalid @enderror" name="ae_nro_componentes" id="ae_nro_componentes" placeholder="Numero de componentes">
														@error('ae_nro_componentes')
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
															Fotografia aeronave:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la imagen del escudo o insignia del grupo aereo"></i>
															</label>
														<input required type="file" accept="image/*" value="{{old('ae_foto')}}" class="form-control @error('ae_foto') is-invalid @enderror" name="ae_foto" id="ae_foto">
														@error('ae_foto')
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