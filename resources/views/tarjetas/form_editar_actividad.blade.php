@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-edit"></i>
			{{$titulo}}
			<a href="{{url('tarjetas/'.Crypt::encryptString($tarjeta->tar_id).'/actividades')}}" title="Volver a lista de tarjetas" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<h4 style="padding:10px; background-color:#eee; border:1px solid #ddd; margin:5px 0;">
									<span class="text-info">NUMERO DE TARJETA: </span>{{$tarjeta->tar_numero}}
								</h4>
								<br>
								<form id="form-nueva-actividad" action="{{url('tarjetas/'.$actividad->tac_id.'/editar_actividad')}}" method="POST">
								  @csrf
								  @method('PUT')
								  <section id="seccion-datos-generales">
									<div class="row">
										<div class="col-md-10 offset-md-1">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																TITULO O DESCRIPCION DE LA ACTIVIDAD:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el titulo o descripcion de la actividad"></i>
															</label>
														<input required type="text" value="{{old('tac_descripcion', $actividad->tac_descripcion)}}" class="form-control @error('tac_descripcion') is-invalid @enderror" name="tac_descripcion" id="tac_descripcion" placeholder="Titulo o descripcion">
														@error('tac_descripcion')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
													<input type="hidden" name="tar_id" value="{{$tarjeta->tar_id}}">
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