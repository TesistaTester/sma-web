@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('tarjetas')}}" title="Volver a lista de tarjetas" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<form id="form-nuevo-personal" enctype="multipart/form-data" action="{{url('tarjetas')}}" method="POST">
								  @csrf
								  <section id="seccion-datos-generales">
									<h4 class="text-info">DATOS DE LA TARJETA</h4>
									<div class="row">
										<div class="col-md-12">
											{{-- <div class="row">
												<div class="col-md-8">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																INSPECCION:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer la inspeccion a la que pertenece la tarjeta"></i>
															</label>
															<select required class="form-control @error('ins_id') is-invalid @enderror" name="ins_id" id="ins_id">
																<option value="">Seleccione una opción</option>
																@foreach ($inspecciones as $item)
																<option value="{{$item->ins_id}}" {{ old('ins_id') == $item->ins_id ? 'selected' : '' }}>{{$item->ins_nombre}} {{$item->ins_descripcion}}</option>
																@endforeach
															</select>
															@error('ins_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>

											</div> --}}
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																NUMERO TARJETA:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el numero de la tarjeta"></i>
															</label>
														<input required type="text" value="{{old('tar_numero')}}" class="form-control @error('tar_numero') is-invalid @enderror" name="tar_numero" id="tar_numero" placeholder="Numero tarjeta">
														@error('tar_numero')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																DESCRIPCION:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer la descripcion de la tarjeta"></i>
															</label>
														<input required type="text" value="{{old('tar_descripcion')}}" class="form-control @error('tar_descripcion') is-invalid @enderror" name="tar_descripcion" id="tar_descripcion" placeholder="Descripcion tarjeta">
														@error('tar_descripcion')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
															<label class="label-blue label-block" for="">
															ATA:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el ATA de la tarjeta"></i>
															</label>
														<input required type="text" value="{{old('tar_ata')}}" class="form-control @error('tar_ata') is-invalid @enderror" name="tar_ata" id="tar_ata" placeholder="ATA">
														@error('tar_ata')
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
																ESPECIALIDAD:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer la especialidad de la tarjeta"></i>
															</label>
														<input required type="text" value="{{old('tar_especialidad')}}" class="form-control @error('tar_especialidad') is-invalid @enderror" name="tar_especialidad" id="tar_especialidad" placeholder="Especialidad">
														@error('tar_especialidad')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																TECNICAS DE INSPECCIÓN:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer las tecnicas de inspección"></i>
															</label>
														<input required type="text" value="{{old('tar_tecnicas')}}" class="form-control @error('tar_tecnicas') is-invalid @enderror" name="tar_tecnicas" id="tar_tecnicas" placeholder="Tecnicas de inspección">
														@error('tar_tecnicas')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
															<label class="label-blue label-block" for="">
															DIGITALIZADO:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el archivo digitalizado de la tarjeta"></i>
															</label>
														<input required type="file" value="{{old('tar_digitalizado')}}" class="form-control @error('tar_digitalizado') is-invalid @enderror" name="tar_digitalizado" id="tar_digitalizado" accept=".pdf">
														@error('tar_digitalizado')
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