@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes/'.Crypt::encryptString($componente->com_id).'/mantenimientos/'.Crypt::encryptString($mantenimiento->cma_id).'/inspecciones')}}" title="Volver a lista de inspecciones" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
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
											<h4>
												<span class="text-info">MANTENIMIENTO:</span> {{$mantenimiento->cma_nombre_tipo_inspeccion}}
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
											</h4>
											<h4>
												<span class="text-info">TOLERANCIA MAX.:</span> {{$mantenimiento->cma_horas_cota_max}} [HRS]
											</h4>        
										</div>
									</div>
								</div>
		
								</div>
	

								<form id="form-nuevo-inspeccion" action="{{url('inspecciones')}}" method="POST">
								  @csrf
								  <section id="seccion-datos-generales">
									<div class="row">
										<div class="col-md-6 offset-md-3">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
															<label class="label-blue label-block" for="">
															Nombre o titulo de la inspeccion:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el nombre de la inspeccion"></i>
															</label>
														<input required type="text" value="{{old('ins_nombre')}}" class="form-control @error('ins_nombre') is-invalid @enderror" name="ins_nombre" id="ins_nombre" placeholder="Nombre o titulo inspeccion">
														@error('ins_nombre')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
															<label class="label-blue label-block" for="">
															Descripcion de la inspeccion:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la descripcion de la inspeccion"></i>
															</label>
														<textarea required class="form-control @error('uor_nombre') is-invalid @enderror" name="ins_descripcion" id="ins_descripcion" cols="30" rows="10">{{old('uor_nombre')}}</textarea>
														@error('ins_descripcion')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>

											</div>
											<div class="row">
												<div class="col-md-6">
													<input type="hidden" name="cma_id" id="cma_id" value="{{$mantenimiento->cma_id}}">
													<input type="hidden" name="sec_id" id="sec_id" value="{{$servicio->sec_id}}">
													<input type="hidden" name="ae_id" id="ae_id" value="{{$aeronave->ae_id}}">
													<input type="hidden" name="com_id" id="com_id" value="{{$componente->com_id}}">
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