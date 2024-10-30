@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes')}}" title="Volver a lista de componentes" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<div class="alert alert-secondary">
									<h4 class="text-center"><span class="text-info">MATRICULA AERONAVE:</span> {{$aeronave->ae_matricula}}</h4>
								</div>
								<form id="form-nuevo-componente" action="{{url('componentes')}}" method="POST" enctype="multipart/form-data">
								  @csrf
								  <section id="seccion-datos-cuenta-componente">
									<h4 class="card-title"><strong><span class="text-info">
										<i class="fa fa-th"></i>
										Datos del componente
									</span></strong></h4>
									<hr>
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Descripción:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la descripcion o nombre del componente"></i>
														</label>
														<input required type="text" value="{{old('com_descripcion')}}" class="form-control @error('com_descripcion') is-invalid @enderror" name="com_descripcion" id="com_descripcion" placeholder="Descripcion o nombre">
														@error('com_descripcion')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Part number:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el part number del componente"></i>
														</label>
														<input required type="text" value="{{old('com_part_number')}}" class="form-control @error('com_part_number') is-invalid @enderror" name="com_part_number" id="com_part_number" placeholder="Part number">
														@error('com_part_number')
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
															<i class="fa fa-question-circle float-right" title="Establecer el serial number del componente"></i>
														</label>
														<input required type="text" value="{{old('com_serial_number')}}" class="form-control @error('com_serial_number') is-invalid @enderror" name="com_serial_number" id="com_serial_number" placeholder="Serial number">
														@error('com_serial_number')
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
															<i class="fa fa-question-circle float-right" title="Establecer el fabricante del componente"></i>
														</label>
														<select required id="fac_id" name="fac_id" class="form-control @error('fac_id') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															@foreach ($fabricantes as $item)
															<option value="{{$item->fac_id}}">{{$item->fac_nombre}}</option>																
															@endforeach
														</select>
														@error('fac_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Tipo componente:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el tipo de componente"></i>
														</label>
														<select required id="com_tipo_componente" name="com_tipo_componente" class="form-control @error('com_tipo_componente') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															<option value="1">SLL Scrap</option>
															<option value="2">SLL Overhaul</option>
															<option value="3">Shelf Life</option>
															<option value="4">OnCondition</option>
															<option value="5">Condition Monitoring</option>
														</select>
														@error('com_tipo_componente')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Programa de mantenimiento:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer si el componente tiene programa de mantenimiento"></i>
														</label>
														<select required id="com_principal" name="com_principal" class="form-control @error('com_principal') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															<option value="0">NO</option>
															<option value="1">SI</option>
														</select>
														@error('com__principal')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
											<h4 class="card-title"><strong><span class="text-info">
												<i class="fa fa-wrench"></i>
												Datos de la instalación de componente
											</span></strong></h4>
											<hr>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Ubicacion:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la ubicacion fisica del componente"></i>
														</label>
														<input required type="text" value="{{old('ina_ubicacion')}}" class="form-control @error('ina_ubicacion') is-invalid @enderror" name="ina_ubicacion" id="ina_ubicacion" placeholder="Ubicacion del componente">
														@error('ina_ubicacion')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Fecha de instalacion:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la fecha de instalacion del componente"></i>
														</label>
														<input required type="date" value="{{old('ina_fecha_instalacion')}}" class="form-control @error('ina_fecha_instalacion') is-invalid @enderror" name="ina_fecha_instalacion" id="ina_fecha_instalacion" placeholder="Fecha de instalacion del componente">
														@error('ina_fecha_instalacion')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Responsable:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el responsable de la instalacion"></i>
														</label>
														<input required type="text" value="{{old('ina_ci_resposable_instalacion')}}" class="form-control @error('ina_ci_resposable_instalacion') is-invalid @enderror" name="ina_ci_resposable_instalacion" id="ina_ci_resposable_instalacion" placeholder="Nombre responsable de instalacion">
														@error('ina_ci_resposable_instalacion')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Observacion:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer observaciones en la instalacion del componente"></i>
														</label>
														<input required type="text" value="{{old('ina_observaciones_instalacion')}}" class="form-control @error('ina_observaciones_instalacion') is-invalid @enderror" name="ina_observaciones_instalacion" id="ina_observaciones_instalacion" placeholder="Observaciones de la instalacion">
														@error('ina_observaciones_instalacion')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<input type="hidden" value="{{$aeronave->ae_id}}" name="ae_id" id="ae_id">
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