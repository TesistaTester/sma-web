@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('rvds/'.Crypt::encryptString($rvd->rvd_id).'/rvus')}}" title="Volver a lista de rvus" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
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
									<h4 class="text-center"><span class="text-info">VUELOS DE FECHA:</span> {{$rvd->rvd_fecha}}</h4>
								</div>
								<form id="form-nuevo-rvd-digitalizado" action="{{url('rvds/'.$rvd->rvd_id.'/store_digitalizado')}}" method="POST" enctype="multipart/form-data">
								  @csrf
								  <section id="seccion-datos-cuenta-rvu">
									<div class="row">
										<div class="col-md-6 offset-md-3">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															CARGAR REGISTRO DE VUELO DIGITALIZADO:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer los landings"></i>
														</label>
														<input required type="file" min="0" value="{{old('rvd_digitalizado', 00)}}" class="form-control @error('rvd_digitalizado') is-invalid @enderror" name="rvd_digitalizado" id="rvd_digitalizado">
														@error('rvd_digitalizado')
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
													<input type="hidden" value="{{$rvd->rvd_id}}" name="rvd_id" id="rvd_id">
													<input type="hidden" value="{{$rvd->rvd_fecha}}" name="rvd_fecha" id="rvd_fecha">
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