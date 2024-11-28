@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-edit"></i>
			{{$titulo}}
			<a href="{{url('aeronaves')}}" title="Volver a lista de grupos" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<form id="form-nuevo-grupo" action="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/update_estado')}}" method="POST">
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
												<div class="col-md-4 offset-md-4">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Estado matricula:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer nombre de grupo aereo"></i>
														</label>
														<select required id="ae_estado_matricula" name="ae_estado_matricula" class="form-control @error('ae_estado_matricula') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															@if ($aeronave->ae_estado_matricula == 'W')
															<option value="W" selected>WISKY</option>
															@else
															<option value="W">WISKY</option>
															@endif
															@if ($aeronave->ae_estado_matricula == 'P')
															<option value="P" selected>PAPA</option>
															@else
															<option value="P">PAPA</option>
															@endif
															@if ($aeronave->ae_estado_matricula == 'M')
															<option value="M" selected>MATENIMIENTO</option>
															@else
															<option value="M">MATENIMIENTO</option>
															@endif
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
												<div class="col-md-4 offset-md-4">
													<input type="hidden" name="ae_id" value="{{$aeronave->ae_id}}">
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