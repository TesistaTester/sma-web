@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('unidades')}}" title="Volver a lista de unidades" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<form id="form-nuevo-personal" action="{{url('unidades')}}" method="POST">
								  @csrf
								  <section id="seccion-datos-generales">
									<div class="row">
										<div class="col-md-6 offset-md-3">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Grupo aéreo:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el grupo aereo"></i>
														</label>
														<select required class="form-control @error('gru_id') is-invalid @enderror" name="gru_id" id="gru_id">
															<option value="">Seleccione una opción</option>
															@foreach ($grupos as $item)
															<option value="{{$item->gru_id}}" {{ old('gru_id') == $item->gru_id ? 'selected' : '' }}>{{$item->gru_nombre}}</option>
															@endforeach
														</select>
														@error('gru_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Sección o unidad superior:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la sección o unidad superior a la registrada actualmente"></i>
														</label>
														<select required class="form-control @error('uor_superior') is-invalid @enderror" name="uor_superior" id="uor_superior">
															<option value="">Seleccione una opción</option>
															<option value="9999999">Ninguna</option>
															@foreach ($unidades as $item)
															<option value="{{$item->uor_id}}" {{ old('uor_superior') == $item->uor_id ? 'selected' : '' }}>{{$item->grupo->gru_nombre}} - {{$item->uor_nombre}}</option>
															@endforeach
														</select>
														@error('uor_superior')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
															<label class="label-blue label-block" for="">
															Nombre de la sección o unidad:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el nombre de la sección o unidad"></i>
															</label>
														<input required type="text" value="{{old('uor_nombre')}}" class="form-control @error('uor_nombre') is-invalid @enderror" name="uor_nombre" id="uor_nombre" placeholder="Nombre sección o unidad">
														@error('uor_nombre')
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