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
									<div class="row">
										<div class="col-md-6">
											<h4 class="">
												<span class="text-info">COMPONENTE:</span> {{$componente->com_descripcion}} 
											</h4>
											<h4>
												<span class="text-info">SN:</span> {{$componente->com_serial_number}}
											</h4>        
										</div>
										<div class="col-md-6">
											<h4 class="">
												<span class="text-info">TIPO COMPONENTE:</span> 
												{{-- SLL Scrap --}}
												@if($componente->com_tipo_componente == 1) 
												SLL Scrap
												@endif
												{{-- SLL Overhaul --}}
												@if($componente->com_tipo_componente == 2)
												SLL Overhaul
												@endif
												{{-- Shelf Life --}}
												@if($componente->com_tipo_componente == 3)
												Shelf Life
												@endif
												{{-- On Condition --}}
												@if($componente->com_tipo_componente == 4)
												On Condition
												@endif
												{{-- Condition Monitoring --}}
												@if($componente->com_tipo_componente == 5)
												Condition Monitoring
												@endif
											</h4>
											<h4>
												<span class="text-info">MANTO. PROGRAMADO:</span> 
												@if($componente->com_principal)
												SI
												@else
												NO
												@endif
												{{$componente->com_serial_number}}
											</h4>
				
										</div>
									</div>
		
								</div>
								<form id="form-nuevo-servicio" action="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes/'.Crypt::encryptString($componente->com_id).'/servicios')}}" method="POST" enctype="multipart/form-data">
								  @csrf
								  <section id="seccion-datos-cuenta-componente">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
											{{-- scrap --}}
											@if($componente->com_tipo_componente == 1)
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															FECHA PRIMERA INSTALACION:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la fecha de la primera instalacion del componente (la primera desde su fabricación, esto para especificar el inicio de uso del componente)"></i>
														</label>
														<input required type="date" value="{{old('sec_primera_instalacion')}}" class="form-control @error('sec_primera_instalacion') is-invalid @enderror" name="sec_primera_instalacion" id="sec_primera_instalacion" placeholder="Primera instalación">
														@error('sec_primera_instalacion')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											@endif
											{{-- overhaul --}}
											@if($componente->com_tipo_componente == 2)
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Fecha ultimo overhaul:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la fecha del último overhaul. Si no tuvo overhaul, entonces la fecha de fabricación"></i>
														</label>
														<input required type="date" value="{{old('sec_fecha_ultimo_overhaul')}}" class="form-control @error('sec_fecha_ultimo_overhaul') is-invalid @enderror" name="sec_fecha_ultimo_overhaul" id="sec_fecha_ultimo_overhaul" placeholder="Fecha overhaul">
														@error('sec_fecha_ultimo_overhaul')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											@endif	
											</div>

											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															CONTROL POR HORAS NORMALES:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer si el control de componente será por horas normales de vuelo"></i>
														</label>
														<select required id="sec_horas_normales_control" name="sec_horas_normales_control" class="form-control @error('sec_horas_normales_control') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															<option value="true">SI</option>
															<option value="false">NO</option>
														</select>
														@error('sec_horas_normales_control')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															LIMITE HORAS NORMALES:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el limite de horas de vuelo normales"></i>
														</label>
														<input required type="number" min="0" value="{{old('sec_horas_normales_tope',0)}}" class="form-control @error('sec_horas_normales_tope') is-invalid @enderror" name="sec_horas_normales_tope" id="sec_horas_normales_tope" placeholder="Limite horas">
														@error('sec_horas_normales_tope')
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
															CONTROL POR HORAS ACROBATICAS:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer si el componente se controlará por horas de vuelo acrobaticas"></i>
														</label>
														<select required id="sec_horas_acrobaticas_control" name="sec_horas_acrobaticas_control" class="form-control @error('sec_horas_acrobaticas_control') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															<option value="true">SI</option>
															<option value="false">NO</option>
														</select>
														@error('sec_horas_acrobaticas_control')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															LIMITE HORAS ACROBATICAS:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el limite de horas de vuelo acrobaticas"></i>
														</label>
														<input required type="number" min="0" value="{{old('sec_horas_acrobaticas_tope', 0)}}" class="form-control @error('sec_horas_acrobaticas_tope') is-invalid @enderror" name="sec_horas_acrobaticas_tope" id="sec_horas_acrobaticas_tope" placeholder="Limite horas">
														@error('sec_horas_acrobaticas_tope')
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
															CONTROL POR HORAS UTILITARIAS:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer si el componente se controlará por horas normales utilitarias"></i>
														</label>
														<select required id="sec_horas_utilitarias_control" name="sec_horas_utilitarias_control" class="form-control @error('sec_horas_utilitarias_control') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															<option value="true">SI</option>
															<option value="false">NO</option>
														</select>
														@error('sec_horas_utilitarias_control')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															LIMITE HORAS UTILITARIAS:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el tipo de componente"></i>
														</label>
														<input required type="number" min="0" value="{{old('sec_horas_utilitarias_tope', 0)}}" class="form-control @error('sec_horas_utilitarias_tope') is-invalid @enderror" name="sec_horas_utilitarias_tope" id="sec_horas_utilitarias_tope" placeholder="Limite horas utilitarias">
														@error('sec_horas_utilitarias_tope')
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
															CONTROL POR LANDINGS:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer si el componente se controlará por landings"></i>
														</label>
														<select required id="sec_landings_control" name="sec_landings_control" class="form-control @error('sec_landings_control') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															<option value="true">SI</option>
															<option value="false">NO</option>
														</select>
														@error('sec_landings_control')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															LIMITE LANDINGS:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el limite de landings"></i>
														</label>
														<input required type="number" min="0" value="{{old('sec_landings_tope', 0)}}" class="form-control @error('sec_landings_tope') is-invalid @enderror" name="sec_landings_tope" id="sec_landings_tope" placeholder="Limite landings">
														@error('sec_landings_tope')
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
															DIAS:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer si el control se realizará mediante días"></i>
														</label>
														<select required id="sec_dias_control" name="sec_dias_control" class="form-control @error('sec_dias_control') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															<option value="true">SI</option>
															<option value="false">NO</option>
														</select>
														@error('sec_dias_control')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															LIMITE DIAS:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el limite de dias para el proximo control"></i>
														</label>
														<input required type="number" min="0" value="{{old('sec_dias_tope', 0)}}" class="form-control @error('sec_dias_tope') is-invalid @enderror" name="sec_dias_tope" id="sec_dias_tope" placeholder="Limite dias">
														@error('sec_dias_tope')
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
															CONTROL POR FECHA VENCIMIENTO:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer si el componente se controlará por fecha de vencimiento"></i>
														</label>
														<select required id="sec_fecha_vencimiento_control" name="sec_fecha_vencimiento_control" class="form-control @error('sec_fecha_vencimiento_control') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															<option value="true">SI</option>
															<option value="false">NO</option>
														</select>
														@error('sec_fecha_vencimiento_control')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															FECHA VENCIMIENTO:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la fecha limite de control"></i>
														</label>
														<input required type="date" value="{{old('sec_fecha_vencimiento_tope', '2000-01-01')}}" class="form-control @error('sec_fecha_vencimiento_tope') is-invalid @enderror" name="sec_fecha_vencimiento_tope" id="sec_fecha_vencimiento_tope" placeholder="Fecha limite">
														@error('sec_fecha_vencimiento_tope')
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