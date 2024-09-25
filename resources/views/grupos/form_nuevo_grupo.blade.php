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
								<form id="form-nuevo-grupo" action="{{url('grupos')}}" method="POST" enctype="multipart/form-data">
								  @csrf
								  <section id="seccion-datos-cuenta-grupo">
									<h4 class="card-title"><strong><span class="text-info">
										<i class="fa fa-user"></i>
										Datos del grupo aereo
									</span></strong></h4>
									<hr>
									<div class="row">
										<div class="col-md-10 offset-md-1">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Nombre del grupo aereo:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer nombre de grupo aereo"></i>
														</label>
														<input required type="text" value="{{old('gru_nombre')}}" class="form-control @error('gru_nombre') is-invalid @enderror" name="gru_nombre" id="gru_nombre" placeholder="Nombre de grupo">
														@error('gru_nombre')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Dirección:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer nombre de grupo aereo"></i>
														</label>
														<input required type="text" value="{{old('gru_direccion')}}" class="form-control @error('gru_direccion') is-invalid @enderror" name="gru_direccion" id="gru_direccion" placeholder="Direccion del grupo aereo">
														@error('gru_direccion')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>

											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="label-blue label-block" for="">
														Telefono de contacto:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer telefono de contacto con el grupo aereo"></i>
													</label>
													<input required type="text" value="{{old('gru_telefono')}}" class="form-control @error('gru_telefono') is-invalid @enderror" name="gru_telefono" id="gru_telefono" placeholder="Telefono">
													@error('gru_telefono')
													<div class="invalid-feedback">
														{{$message}}
													</div>											
													@enderror
												</div>
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
															Escudo o insignia:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la imagen del escudo o insignia del grupo aereo"></i>
															</label>
														<input required type="file" accept="image/*" value="{{old('gru_foto')}}" class="form-control @error('gru_foto') is-invalid @enderror" name="gru_foto" id="gru_foto">
														@error('gru_foto')
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