@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('inspecciones')}}" title="Volver a lista de inspecciones" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
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