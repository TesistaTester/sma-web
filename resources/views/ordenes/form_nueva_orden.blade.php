@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('ordenes')}}" title="Volver a lista de ordenes" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								{{-- <form id="form-nuevo-personal" action="{{url('ordenes')}}" method="POST"> --}}
									<form id="form-apertura-ot" action="{{url('ordenes')}}" method="POST">
									@csrf
									<section id="orden_trabajo">
									<div class="row">
										<div class="col-md-12">
											<small>Los campos marcados con asterisco (<span class="faster">*</span>) son obligatorios.</small>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<label for="tar_id" class="form-label text-info">Inspección:<span class="faster">*</span> <i class="float-right fa fa-question-circle" title="Inspección a la que corresponde la orden"></i></label>
											<select required id="ins_id" name="ins_id" class="search-box form-control">
												<option value="">Seleccione una opción</option>
												<?php foreach($inspecciones as $item): ?>
													<option value="{{$item->ins_id}}">{{$item->ins_nombre}}</option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-md-4">
											<label for="tar_id" class="form-label text-info">Tarjeta:<span class="faster">*</span> <i class="float-right fa fa-question-circle" title="Tarjeta de inspección"></i></label>
											<select required id="tar_id" name="tar_id" class="search-box form-control">
												<option value="">Seleccione una opción</option>
												<?php foreach($tarjetas as $item): ?>
													<?php if($item->tarjetas_capitulo->count() > 0):?>
													<option value="{{$item->tar_id}}">{{$item->tar_numero}}</option>
													<?php endif;?>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-md-4">
											<label for="ort_tipo" class="form-label text-info">Tipo de orden:<span class="faster">*</span> <i class="float-right fa fa-question-circle" title="Tipo de orden de trabajo"></i></label>
											<select required id="ort_tipo" name="ort_tipo" class="form-control">
												<option value="">Seleccione una opción</option>
												<option value="1">Rutinaria</option>
												<option value="2">No rutinaria</option>
											</select>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-3 box-bordered">
											<label for="ort_cite" class="form-label text-info">Nro. de orden <span class="faster">*</span><i class="float-right fa fa-question-circle" title="Número o CITE de la orden de trabajo"></i></label>
											<input required type="text" id="ort_cite" name="ort_cite" class="form-control">
											<br>	
											<label for="ort_descripcion_trabajo" class="form-label text-info">Descripción del trabajo<span class="faster">*</span> <i class="float-right fa fa-question-circle" title="Descripción del trabajo que se va a realizar."></i></label>
											<textarea required id="ort_descripcion_trabajo" name="ort_descripcion_trabajo" rows="10" class="form-control"></textarea>
											<br>
											<label for="ort_fecha" class="form-label text-info">Fecha de la orden<span class="faster">*</span> <i class="float-right fa fa-question-circle" title="Fecha de registro de la orden de trabajo"></i></label>
											<input required pattern="\d{1,2}/\d{1,2}/\d{4}" type="date" min="2010-01-01" max="<?= date('d-m-Y')?>" id="ort_fecha" name="ort_fecha" class="form-control" value="<?= date('Y-m-d')?>">					
											<br>
											<label for="ort_fecha_programada" class="form-label text-info">Fecha programada de la orden<span class="faster">*</span> <i class="float-right fa fa-question-circle" title="Fecha programada para la orden de trabajo"></i></label>
											<input required pattern="\d{1,2}/\d{1,2}/\d{4}" type="date" min="2010-01-01" max="<?= date('d-m-Y')?>" id="ort_fecha_programada" name="ort_fecha_programada" class="form-control" value="<?= date('Y-m-d')?>">					
											<hr>
											<h5 class="text-info">DESIGNACION DE PERSONAL</h5>
											<label for="ort_supervisor" class="form-label text-info">Supervisor:<span class="faster">*</span> <i class="float-right fa fa-question-circle" title="Supervidor asignado a la orden de trabajo"></i></label>
											<select required id="ort_supervisor" name="ort_supervisor" class="search-box form-control">
												<option value="">Seleccionar supervisor</option>
												<?php foreach($supervisores as $item): ?>
													<option value="{{$item->unf_id}}">{{$item->gra_abreviacion}} {{$item->per_nombres}} {{$item->per_primer_apellido}} {{$item->per_segundo_apellido}}</option>
												<?php endforeach;?>
											</select>
											<br>
											<label for="sel_inspectores" class="form-label text-info">Inspectores:<span class="faster">*</span> <i class="float-right fa fa-question-circle" title="Lista de inspectores asignados a la orden de trabajo"></i></label>
											<select id="sel_inspectores" class="search-box form-control">
												<option value="0">Elegir inspector</option>
												<?php foreach($inspectores as $item): ?>
												<option value="{{$item->unf_id}}">{{$item->gra_abreviacion}} {{$item->per_nombres}} {{$item->per_primer_apellido}} {{$item->per_segundo_apellido}}</option>
												<?php endforeach;?>
											</select>
											<br>
											<button type="button" title="Agregar inspector seleccionado a la lista" id="add_inspectores" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i> Agregar</button>
											<button type="button" title="Borrar lista de inspectores" id="reset_inspectores" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i> Borrar</button>
											<div class="alert alert-secondary" style="padding:3px 7px; margin:5px 0;">
												<small><b>Lista de inspectores</b></small>
												<p id="box_inspectores"></p>
											</div>
											<input id="ort_inspectores" name="ort_inspectores" type="hidden">
											<br>
											<label for="sel_tecnicos" class="form-label text-info">Técnicos:<span class="faster">*</span> <i class="float-right fa fa-question-circle" title="Lista de tecnicos asignados a la orden de trabajo"></i></label>
											<select id="sel_tecnicos" class="search-box form-control">
												<option value="">Elegir técnicos</option>
												<?php foreach($tecnicos as $item): ?>
												<option value="{{$item->unf_id}}">{{$item->gra_abreviacion}} {{$item->per_nombres}} {{$item->per_primer_apellido}} {{$item->per_segundo_apellido}}</option>
												<?php endforeach;?>
											</select>
											<br>
											<button type="button" title="Agregar tecnico seleccionado a la lista" id="add_tecnicos" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i> Agregar</button>
											<button type="button" title="Borrar lista de tecnicos" id="reset_tecnicos" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i> Borrar</button>
											<div class="alert alert-secondary" style="padding:3px 7px; margin:5px 0;">
												<small><b>Lista de tecnicos</b></small>
												<p id="box_tecnicos"></p>
											</div>
											<input id="ort_tecnicos" name="ort_tecnicos" type="hidden">
											<br>
											<button type="submit" id="modal-guardar-ot" class="btn btn-info btn-block"><i class="fa fa-save"></i> GUARDAR DATOS</button>
					
											<!--MODAL CONFIRMAR EL GUARDADO OT-->
											<div class="modal fade" id="box-confirmar-apertura-ot" tabindex="-1" role="dialog" aria-hidden="true">
											  <div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
												  <div class="modal-header">
													<h5 class="modal-title"><i class="fa fa-save"></i> CONFIRMAR APERTURA DE ORDEN DE TRABAJO</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													  <span aria-hidden="true">&times;</span>
													</button>
												  </div>
												  <div class="modal-body">
															<div class="row">
																<div class="col-md-10 offset-md-1">
																	<div class="alert alert-info">
																		<div class="media">
																			<img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
																			<div class="media-body">
																				<h5 class="mt-0">Nota</h5>
																				<p>
																					Revise los datos de la orden de trabajo antes de guardar por favor.
																				</p>
																			</div>
																		</div>
																	</div>
																	<div id="box-validate-ins-tec"></div>
																	<div class="save-success alert alert-success" role="alert">
																		<b>Exito!</b> Los datos se han guardado correctamente.
																	</div>
																	<div class="save-error alert alert-danger" role="alert">
																		<b>Oops!</b> Revise los campos del formulario, hubo un problema al guardar los datos.
																	</div>
																	<div class="save-error-server alert alert-warning" role="alert">
																		<b>Oops!</b> Hubo un error al procesar la peticion en el servidor.
																	</div>					
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<span class="request-loader">
																<img style="width:40px;" src="{{asset('img/loader.gif')}}">
																PROCESANDO
															</span>
																<input type="hidden" id="ae_id" name="ae_id" value="1">
																<input type="hidden" id="ort_matricula" name="ort_matricula" value="{{config('wop.matricula')}}">
																<input type="hidden" id="ort_serial_number_aeronave" name="ort_serial_number_aeronave" value="{{config('wop.serial_number')}}">
																<input type="hidden" id="ort_tiempo_total_aeronave" name="ort_tiempo_total_aeronave" value="{{config('wop.total_horas')}}">
																<input type="hidden" id="ort_ciclos_total_aeronave" name="ort_ciclos_total_aeronave" value="{{config('wop.total_landings')}}">
																<input type="hidden" id="ort_lugar" name="ort_lugar" value="{{config('wop.localidad')}}">
																<input type="hidden" id="pma_id" name="pma_id" value="1">
					
																<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
																<button id="btn-guardar-ot" type="submit" class="btn btn-info"><i class="fa fa-save"></i> Guardar y generar orden</button>
												  </div>
													</div>
											  </div>
											</div>
										</div>
										<div class="col-md-9">
											<div class="box-bordered-light">
												<div class="row">
													<div class="col-md-4 text-center">
														<h6>
															{{-- <b>FUERZA AEREA BOLIVIANA</b>
															<br>
															<small>
															TRANSPORTES AEREOS BOLIVIANOS
															<br>
															<b>BOLIVIA</b>
															</small> --}}
														</h6>
													</div>
													<div class="col-md-5 text-center">
													</div>
													<div class="col-md-3 text-center"><img style="width:95%" src="{{asset('img/logo_institucion.png')}}" class="card-img-top" alt="Logo Unidad"></div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<h3 class=" text-center">
															<b>
																ORDEN DE TRABAJO
																No.
																<span id="txt1_ort_cite"></span>
															</b>
														</h3>
													</div>
												</div>

												<table class="table table-bordered table-condensed">
													<tr>
														<td style="width:50%" colspan="2"><b>1. DESCRIPCION DEL TRABAJO</b></td>
														<td style="width:25%"><b>2. MODELO:</b></td>
														<td>{{config('wop.modelo')}}</td>
													</tr>
													<tr>
														<td colspan="2" rowspan="6" id="txt_desc_trabajo"></td>
														<td><b>3. MSN:</b></td>
														<td>{{config('wop.serial_number')}}</td>
													</tr>
													<tr>
														<td style="width:25%"><b>4. MATRICULA:</b></td>
														<td>{{config('wop.matricula')}}</td>
													</tr>
													<tr>
														<td><b>5. HORAS NAVE:</b></td>
														<td>
															<span id="txt_ae_horas">{{intdiv(config('wop.total_horas'), 60)}}</span>
															:
															<span id="txt_ae_minutos">{{(int)(config('wop.total_horas'))%60}}</span>
														</td>
													</tr>
													<tr>
														<td><b>6. CICLOS NAVE:</b></td>
														<td id="txt_ae_landings">{{config('wop.total_landings')}}</td>
													</tr>
													<tr>
														<td><b>APU S/N:</b></td>
														<td>{{config('wop.apu_sn')}}</td>
													</tr>
													<tr>
														<td><b>ETI:</b></td>
														<td>{{config('wop.eti')}}</td>
													</tr>
													<tr>
														<td style="width:30%;"><b>7. REFERENCIA:</b></td>
														<td colspan="3">{{config('wop.ref_manual')}} <span id="txt_ort_tarjeta"></span></td>
													</tr>
													<tr>
														<td><b>8. LUGAR Y FECHA:</b></td>
														<td colspan="3">La Paz, <span id="txt_ort_fecha"><?= date('d-m-Y')?></span></td>
													</tr>
													<tr>
														<td><b>9. FECHA PROGRAMADA:</b></td>
														<td colspan="3"><span id="txt_ort_fecha_programada"><?= date('d-m-Y')?></span></td>
													</tr>
													<tr>
														<td><b>10. ASIGNADO A:</b></td>
														<td colspan="3" id="txt_ort_supervisor"></td>
													</tr>
													<tr>
														<td><b>11. FECHA DE INICIO:</b></td>
														<td colspan="4"></td>
													</tr>
													<tr>
														<td colspan="5" class="text-center"><b>12. ACCIÓN CORRECTIVA:</b></td>
													</tr>
													<tr><td colspan="5">&nbsp;</td></tr>													<tr>
													<tr><td colspan="5">&nbsp;</td></tr>
													<tr><td colspan="5">&nbsp;</td></tr>
													<tr><td colspan="5">&nbsp;</td></tr>													<tr>
													<tr><td colspan="5">&nbsp;</td></tr>
													<tr><td colspan="5">&nbsp;</td></tr>
													<tr><td colspan="5">&nbsp;</td></tr>
													<tr><td colspan="5">&nbsp;</td></tr>													<tr>
													<tr><td colspan="5">&nbsp;</td></tr>
													<tr><td colspan="5">&nbsp;</td></tr>
													<tr>
														<td><b>13. No DE DISCREPANCIAS:</b></td>
														<td colspan="3"></td>
													</tr>
													<tr>
														<td><b>14. FECHA DE FINALIZACIÓN:</b></td>
														<td colspan="3"></td>
													</tr>
												</table>
												<table class="table table-condensed table-bordered">
													<tr>
														<td colspan="3" class="text-center">
															<b>15. CERTIFICADO DE CONFORMIDAD</b>
														</td>
													</tr>
													<tr>
														<td colspan="3">
															<small>
																<b>CERTIFICAMOS</b>, QUE EL TRABAJO HA SIDO 
																TOTALMENTE EFECTUADO DE ACUERDO A LOS PROCEDIMIENTOS 
																ESTABLECIDOS POR EL FABRICANTE, HA QUEDADO REGISTRADO 
																EN EL FORM FAB-03 ............... 
																NCT ............... <br>Y LA AERONAVE ESTÁ: 
																OPERABLE <span class="alert alert-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> INOPERABLE 
																<span class="alert alert-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
																<br>
															</small>
														</td>
													</tr>
													<tr>
														<td>
															<br><br>
														</td>
														<td>
														</td>
														<td>
														</td>
													</tr>
													<tr>
														<td class="text-center" style="width:33% !important;">
															<small>
																<span id="txt-inspector"></span>
																<br>
																<b>INSPECTOR DE MANTENIMIENTO</b>
															</small>
														</td>
														<td class="text-center" style="width:33% !important;">
															<small>
																<span id="txt-supervisor"></span>
																<br>
																<b>SUPERVISOR CONTROL DE CALIDAD</b>
															</small>
														</td>
														<td></td>
													</tr>
													<tr>
														<td>
														</td>
														<td class="text-center">
															<br><br>
														</td>
														<td>
														</td>
													</tr>
													<tr>
														<td class="text-center" style="width:33% !important;">
															<small>
																<span>{{config('wop.jefe_control_calidad')}}</span>
																<br>
																<b>JEFE DE CONTROL DE CALIDAD</b> 
															</small>
														</td>
														<td class="text-center">
															<small>
																<span>{{config('wop.jefe_mantenimiento')}}</span>
																<br>
																<b>JEFE DE MANTENIMIENTO </b>
															</small>
														</td>
														<td class="text-center">
															<small>
																<span>{{config('wop.jefe_aeronavegabilidad')}}</span>
																<br>
																<b>JEFE DE AERONAVEGABILIDAD</b>																
															</small>
														</td>
													</tr>
												</table>
											</div>
											<br><br>
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
			$('.request-loader').hide();
			$('.save-success').hide();
			$('.save-error').hide();
			$('.save-error-server').hide();
			/*
			*************************************************************************
			ORDENES DE TRABAJO
			*************************************************************************
			*/
			//FORM APERTURA ORDEN DE TRABAJO
			//Datos generales
			$('#ort_descripcion_trabajo').keyup(function(e){
				$('#txt_desc_trabajo').html($(this).val());
			});
			$('#ort_fecha').change(function(e){
				var fecha = $(this).val();
				var nueva = fecha.split(" ")[0].split("-").reverse().join("-");
				$('#txt_ort_fecha').html(nueva);
			});
			$('#ort_fecha_programada').change(function(e){
				var fecha = $(this).val();
				var nueva = fecha.split(" ")[0].split("-").reverse().join("-");
				$('#txt_ort_fecha_programada').html(nueva);
			});
			$('#ort_cite').keyup(function(e){
				$('#txt1_ort_cite').html($(this).val());
			});
			//HORAS Y CICLOS DE VUELO DE AERONAVE Y COMPONENTE (SOLO REGULARIZACION)
			//aeronave
			$('#ae_horas_totales').keyup(function(e){
				$('#txt_ae_horas').html($(this).val());
				var ae_hrs = parseInt($(this).val())*60 + parseInt($('#ae_minutos_totales').val());
				$('#ort_tiempo_total_aeronave').val(ae_hrs);
			});
			$('#ae_minutos_totales').keyup(function(e){
				$('#txt_ae_minutos').html($(this).val());
				var ae_hrs = parseInt($('#ae_horas_totales').val())*60 + parseInt($(this).val());
				$('#ort_tiempo_total_aeronave').val(ae_hrs);
			});
			$('#ae_landings_totales').keyup(function(e){
				$('#txt_ae_landings').html($(this).val());
				$('#ort_ciclos_total_aeronave').val($(this).val());
			});
			//componente
			$('#com_horas_totales').keyup(function(e){
				$('#txt_com_horas').html($(this).val());
				var com_hrs = parseInt($(this).val())*60 + parseInt($('#com_minutos_totales').val());
				$('#ort_tiempo_total_componente').val(com_hrs);
			});
			$('#com_minutos_totales').keyup(function(e){
				$('#txt_com_minutos').html($(this).val());
				var com_hrs = parseInt($('#com_horas_totales').val())*60 + parseInt($(this).val());
				$('#ort_tiempo_total_componente').val(com_hrs);
			});
			$('#com_landings_totales').keyup(function(e){
				$('#txt_com_landings').html($(this).val());
				$('#ort_ciclos_total_componente').val($(this).val());
			});

			//Cambio de tarjetas
			$('#tar_id').change(function(e){
				$('#txt_ort_tarjeta').html($(this).find('option').filter(':selected').text());
			});
			
			//Asignacion de personal
			//SUPERVISOR
			$('#ort_supervisor').change(function(e){
				$('#txt_ort_supervisor').html($(this).find('option').filter(':selected').text());
				$('#txt-supervisor').html($(this).find('option').filter(':selected').text());
			});
			//INSPECTORES
			var inspectores = [];
			var cant_inspectores = 1;
			$('#add_inspectores').click(function(e){
				var txt = $('#sel_inspectores option:selected').text();
				var id = $('#sel_inspectores option:selected').val();
				if(inspectores.length < cant_inspectores){
					if(id > 0){
						inspectores.push({"inp_id":id, "inp_nombre":txt});
						$('#box_inspectores').append('<p style="margin-bottom:2px;">'+txt+'</p>').slideDown();
						$('#ort_inspectores').val(JSON.stringify(inspectores));
						$('#txt-inspector').html(txt);
					}
				}else{
					console.log("Solo esta permitido "+cant_inspectores+" inspector por orden");
				}
			});
			$('#reset_inspectores').click(function(e){
				$('#box_inspectores').html('');
				$('#ort_inspectores').val('');
				inspectores = [];
			});
			//TECNICOS
			var tecnicos = [];
			$('#add_tecnicos').click(function(e){
				var txt = $('#sel_tecnicos option:selected').text();
				var id = $('#sel_tecnicos option:selected').val();
				if(id > 0){
					tecnicos.push({"tec_id":id, "tec_nombre":txt});
					$('#box_tecnicos').append('<p style="margin-bottom:2px;">'+txt+'</p>').slideDown();
					$('#ort_tecnicos').val(JSON.stringify(tecnicos));
				}
			});
			$('#reset_tecnicos').click(function(e){
				$('#box_tecnicos').html('');
				$('#ort_tecnicos').val('');
				tecnicos = [];
			});

			$('#modal-guardar-ot').click(function(e){
				if($("#form-apertura-ot")[0].checkValidity()) {
					e.preventDefault();
					$('#box-validate-ins-tec').html('');
					$('#btn-guardar-ot').attr('disabled',false);
					if(inspectores.length === 0){
						$('#box-validate-ins-tec').append('<div class="alert alert-warning"><div class="media"><img src="{{asset('img/alert-warning.png')}}" class="align-self-center mr-3" alt="..."><div class="media-body"><h5 class="mt-0">Advertencia</h5><p>La orden de trabajo NO tiene inspector(es) asignado(s).</p></div></div></div>');
					}
					if(tecnicos.length === 0){
						$('#box-validate-ins-tec').append('<div class="alert alert-warning"><div class="media"><img src="{{asset('img/alert-warning.png')}}" class="align-self-center mr-3" alt="..."><div class="media-body"><h5 class="mt-0">Advertencia</h5><p>La orden de trabajo NO tiene tecnico(s) asignado(s).</p></div></div></div>');
					}
					if(inspectores.length === 0 || tecnicos.length == 0){
						$('#btn-guardar-ot').attr('disabled',true);
					}
					$('#box-confirmar-apertura-ot').modal('toggle');
				}
			});

			//GUARDAR ORDEN DE TRABAJO
			$("#btn-guardar-ot").click(function(e){
				if($("#form-apertura-ot")[0].checkValidity()) {
					e.preventDefault();
					$(this).attr('disabled','true');
					var csrfName = '_token'; // Value specified in $config['csrf_token_name']
					var csrfHash = $("input[name='_token']").val(); // CSRF hash
					var ae_id = $('#ae_id').val();
					var ort_matricula = $('#ort_matricula').val();
					var ort_serial_number_aeronave = $('#ort_serial_number_aeronave').val();
					var ort_tiempo_total_aeronave = $('#ort_tiempo_total_aeronave').val();
					var ort_ciclos_total_aeronave = $('#ort_ciclos_total_aeronave').val();
					var ort_lugar = $("#ort_lugar").val();
			        var pma_id = $("#pma_id").val();
					var ort_cite = $("#ort_cite").val();
					var ort_descripcion_trabajo = $("#ort_descripcion_trabajo").val();
					var ort_tipo = $("#ort_tipo").val();
					var tar_id = $("#tar_id").val();
					var ins_id = $("#ins_id").val();
					var ort_fecha = $("#ort_fecha").val();
					var ort_fecha_programada = $("#ort_fecha_programada").val();
					var ort_supervisor = $("#ort_supervisor").val();
					var ort_inspectores = $("#ort_inspectores").val();
					var ort_tecnicos = $("#ort_tecnicos").val();
					var route = '{{url('ordenes')}}';
          			$.ajax({
  						type: "POST",
  						url: route,
	 		            data: {
									ae_id: ae_id,
									ort_matricula: ort_matricula,
									ort_serial_number_aeronave: ort_serial_number_aeronave,
									ort_tiempo_total_aeronave: ort_tiempo_total_aeronave,
									ort_ciclos_total_aeronave: ort_ciclos_total_aeronave,
									ort_lugar:ort_lugar,
									pma_id: pma_id,
									ort_cite:ort_cite,
									ort_descripcion_trabajo: ort_descripcion_trabajo,
									ort_tipo: ort_tipo,
									tar_id: tar_id,
									ins_id: ins_id,
									ort_fecha: ort_fecha,
									ort_fecha_programada: ort_fecha_programada,
									ort_supervisor: ort_supervisor,
									ort_inspectores:ort_inspectores,
									ort_tecnicos: ort_tecnicos,
									[csrfName]: csrfHash
								},
  					  dataType: 'json',
  						beforeSend: function(){
								$('.request-loader').show(20);
  						},
  						success: function(data){
  							if(data.status == 1){
									$('.save-success').slideDown(1000);
									setTimeout(function(){ window.location.replace(data.destino); }, 2500);
  							}else{
									$(this).removeAttr('disabled');
									// $('[name="sct"]').val(data.token);
									$('.save-error').slideDown(1000);
									console.log(data);
									setTimeout(function(){$('.save-error').slideUp(1000);}, 5000);
									$('.request-loader').hide();
  							}
  						},
  						error: function(data){
								// $('[name="sct"]').val(data.token);
								$('.request-loader').hide();
								$('.save-error-server').slideDown(1000);
								console.log("Error de servidor");
								$(this).removeAttr('disabled');
								setTimeout(function(){$('.save-error-server').slideUp(1000);}, 5000);
  						}
  				});
        }
			});

});	


	</script>


    @endsection