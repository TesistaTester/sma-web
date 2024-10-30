@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('cargos')}}" title="Volver a lista de cargos" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<form id="form-nuevo-personal" action="{{url('cargos')}}" method="POST">
								  @csrf
								  <section id="seccion-datos-generales">
									<div class="row">
										<div class="col-md-6 offset-md-3">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Sección o unidad:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la sección o unidad a la que pertenece el cargo"></i>
														</label>
														<select required class="form-control @error('uor_id') is-invalid @enderror" name="uor_id" id="uor_id">
															<option value="">Seleccione una opción</option>
															@foreach ($unidades as $item)
															<option value="{{$item->uor_id}}" {{ old('uor_id') == $item->uor_id ? 'selected' : '' }}>{{$item->grupo->gru_nombre}} - {{$item->uor_nombre}}</option>
															@endforeach
														</select>
														@error('uor_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="label-blue label-block" for="">
														Nombre del cargo:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer el nombre del cargo"></i>
														</label>
														<input required type="text" value="{{old('car_nombre')}}" class="form-control @error('car_nombre') is-invalid @enderror" name="car_nombre" id="car_nombre" placeholder="Nombre sección o unidad">
														@error('car_nombre')
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