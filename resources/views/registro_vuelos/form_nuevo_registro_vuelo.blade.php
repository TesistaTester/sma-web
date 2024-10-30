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
								<form id="form-nuevo-rvu" action="{{url('rvus')}}" method="POST">
								  @csrf
								  <section id="seccion-datos-cuenta-rvu">
									<h4 class="card-title"><strong><span class="text-info">
										<i class="fa fa-clock-o"></i>
										Datos del registro de vuelo
									</span></strong></h4>
									<hr>
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															HORAS NORMALES:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la descripcion o nombre del rvu"></i>
														</label>
														<div class="row">
															<div class="col-md-6">
																<input required type="number" min="0" max="59" value="{{old('rvu_normales_horas', 0)}}" class="form-control @error('rvu_normales_horas') is-invalid @enderror" name="rvu_normales_horas" id="rvu_normales_horas" placeholder="HRS">
															</div>
															<div class="col-md-6">
																<input required type="number" min="0" max="59" value="{{old('com_descripcion', 00)}}" class="form-control @error('rvu_normales_minutos') is-invalid @enderror" name="rvu_normales_minutos" id="rvu_normales_minutos" placeholder="MIN">
															</div>
														</div>
														@error('rvu_normales_minutos')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															HORAS ACROBATICAS:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer las horas normales de vuelo si corresponde"></i>
														</label>
														<div class="row">
															<div class="col-md-6">
																<input required type="number" min="0" max="59" value="{{old('rvu_acrobaticas_horas', 0)}}" class="form-control @error('rvu_acrobaticas_horas') is-invalid @enderror" name="rvu_acrobaticas_horas" id="rvu_normales_horas" placeholder="HRS">
															</div>
															<div class="col-md-6">
																<input required type="number" min="0" max="59" value="{{old('rvu_acrobaticas_minutos', 00)}}" class="form-control @error('rvu_acrobaticas_minutos') is-invalid @enderror" name="rvu_acrobaticas_minutos" id="rvu_normales_minutos" placeholder="MIN">
															</div>
														</div>
														@error('rvu_acrobaticas_minutos')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															HORAS UTILITARIAS:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer las horas de vuelo utilitarias (si corresponde)"></i>
														</label>
														<div class="row">
															<div class="col-md-6">
																<input required type="number" min="0" max="59" value="{{old('rvu_utilitarias_horas', 0)}}" class="form-control @error('rvu_utilitarias_horas') is-invalid @enderror" name="rvu_utilitarias_horas" id="rvu_utilitarias_horas" placeholder="HRS">
															</div>
															<div class="col-md-6">
																<input required type="number" min="0" max="59" value="{{old('rvu_utilitarias_minutos', 00)}}" class="form-control @error('rvu_utilitarias_minutos') is-invalid @enderror" name="rvu_utilitarias_minutos" id="rvu_utilitarias_minutos" placeholder="MIN">
															</div>
														</div>
														@error('rvu_utilitarias_minutos')
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
															LANDINGS:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer los landings"></i>
														</label>
														<input required type="number" min="0" value="{{old('rvu_landings', 00)}}" class="form-control @error('rvu_landings') is-invalid @enderror" name="rvu_landings" id="rvu_landings" placeholder="MIN">
														@error('rvu_landings')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															OBSERVACION:
															<i class="fa fa-question-circle float-right" title="Establecer la descripcion o nombre del rvu"></i>
														</label>
														<input required type="text" value="{{old('rvu_observacion')}}" class="form-control @error('rvu_observacion') is-invalid @enderror" name="rvu_observacion" id="rvu_observacion" placeholder="ALGUNA OBSERVACION">
														@error('rvu_observacion')
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