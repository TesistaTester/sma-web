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
								<form id="form-nuevo-mantenimiento" action="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes/'.Crypt::encryptString($componente->com_id).'/mantenimientos')}}" method="POST" enctype="multipart/form-data">
								  @csrf
								  <section id="seccion-datos-cuenta-componente">
									<div class="row">
										<div class="col-md-10 offset-md-1">

											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															NOMBRE O TIPO DE MANTENIMIENTO:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el nombre o el tipo de mantenimiento"></i>
														</label>
														<input required type="text" value="{{old('cma_nombre_tipo')}}" class="form-control @error('cma_nombre_tipo') is-invalid @enderror" name="cma_nombre_tipo" id="cma_nombre_tipo" placeholder="Nombre o tipo de mantenimiento">
														@error('cma_nombre_tipo')
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
															PERIODO (EN HORAS):
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el tiempo entre mantenimientos del tipo establecido"></i>
														</label>
														<input required type="number" min="0" value="{{old('cma_horas_frecuencia')}}" class="form-control @error('cma_horas_frecuencia') is-invalid @enderror" name="cma_horas_frecuencia" id="cma_horas_frecuencia" placeholder="Periodo en horas">
														@error('cma_horas_frecuencia')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>

												
												<div class="col-md-6">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															TOLERANCIA MAXIMA:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la tolerancia maxima (en horas) del periodo establecido."></i>
														</label>
														<input required type="number" min="0" value="{{old('cma_horas_cota_max')}}" class="form-control @error('cma_horas_cota_max') is-invalid @enderror" name="cma_horas_cota_max" id="cma_horas_cota_max" placeholder="Tolerancia maxima">
														@error('cma_horas_cota_max')
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
															UNICA VEZ:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer si el mantenimiento se realiza por unica vez"></i>
														</label>
														<select required id="cma_unica_vez" name="cma_unica_vez" class="form-control @error('cma_unica_vez') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															<option value="true">SI</option>
															<option value="false">NO</option>
														</select>
														@error('cma_unica_vez')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															ESPECIAL:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer si este mantenimiento es especial o no"></i>
														</label>
														<select required id="cma_especial" name="cma_especial" class="form-control @error('cma_especial') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															<option value="true">SI</option>
															<option value="false">NO</option>
														</select>
														@error('cma_especial')
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