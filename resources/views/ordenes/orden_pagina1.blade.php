<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv=“Pragma” content=”no-cache”>
		<meta http-equiv=“Expires” content=”-1″>
		<meta http-equiv=“CACHE-CONTROL” content=”NO-CACHE”>
    <!-- CSS -->
    {{-- HOJAS DE ESTILO --}}
    <link rel="shortcut icon" href="{{url('img/favicon.ico')}}" type="image/x-icon">
	<link rel="icon" href="{{url('img/favicon.ico')}}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">

	<title>{{$titulo}} - {{env('APP_NAME')}}</title>
		<style>
	
		table, th, td {
		  border: 1px solid #000 !important;
		}
		td{
			padding:3px !important;
			font-size:1.1em;
		}
		.check-box-orden{
			border:1px solid #333;
			
		}

		@media print{
			.table-bordered th,
			.table-bordered td {
				border: 1px solid #000 !important;
			}
		}

		</style>
		<script>
		window.onload = function () {
		    window.print();
		}
		</script>
  </head>
  <body style="background:#fff !important;background-image:none;">
    <!-- HEADER FIN -->
<br><br>
<div class="row">
	<div class="col-md-12">

		<div class="box-bordered-light">
			<div class="row">
				<div class="col-md-4 text-center">
					<h5>
						<b>FUERZA AEREA BOLIVIANA</b>
						<br>
						<small>
						TRANSPORTES AEREOS BOLIVIANOS
						<br>
						<b>BOLIVIA</b>
						</small>
					</h5>
				</div>
				<div class="col-md-5 text-center">
				</div>
				<div class="col-md-3 text-center"><img style="width:98%" src="{{asset('img/logo_institucion.png')}}" class="card-img-top" alt="Logo Unidad"></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-center">
						<b>
							ORDEN DE TRABAJO
							No.:
							<span id="txt1_ort_cite">{{$orden->ort_cite}}</span>
						</b>
					</h2>
				</div>
			</div>

			<table class="table table-bordered table-condensed table-bordered-print">
				<tr>
					<td class="text-center" style="width:50%" colspan="2"><b>1. DESCRIPCION DEL TRABAJO</b></td>
					<td style="width:25%"><b>2. MODELO:</b></td>
					<td>{{config('wop.modelo')}}</td>
				</tr>
				<tr>
					<td colspan="2" rowspan="6" id="txt_desc_trabajo">{{$orden->ort_descripcion_trabajo}}</td>
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
					@php
						$tarjeta = null;
						$tap = $orden->tarjetas_planificadas;
						foreach($tap as $item){
							$tac = $item->tarjeta_capitulo;
							$tarjeta = $tac->tarjeta;
							break;
						}

					@endphp
					<td colspan="3">{{config('wop.ref_manual')}} <span id="txt_ort_tarjeta">{{$tarjeta->tar_numero}}</span></td>
				</tr>
				<tr>
					<td><b>8. LUGAR Y FECHA:</b></td>
					<td colspan="3">La Paz, <span id="txt_ort_fecha">{{$orden->ort_fecha}}</span></td>
				</tr>
				<tr>
					<td><b>9. FECHA PROGRAMADA:</b></td>
					<td colspan="3"><span id="txt_ort_fecha_programada">{{$orden->ort_fecha_programada}}</span></td>
				</tr>
				<tr>
					<td><b>10. ASIGNADO A:</b></td>
					@foreach($orden->personal as $item)
					@if($item->pot_tipo == 7)
					@php
						$funcionario = $item->unidad_funcionario->funcionario;
					@endphp
					<td colspan="3" id="txt_ort_supervisor">{{$funcionario->grado->gra_abreviacion}} {{$funcionario->persona->per_nombres}} {{$funcionario->persona->per_primer_apellido}} {{$funcionario->persona->per_segundo_apellido}}</td>
					@endif
					@endforeach
				</tr>
				<tr>
					<td><b>11. FECHA DE INICIO:</b></td>
					<td colspan="4"></td>
				</tr>
				<tr>
					<td colspan="5" class="text-center"><b>12. ACCIÓN CORRECTIVA</b></td>
				</tr>
				<tr><td colspan="5">&nbsp;</td></tr>
				<tr><td colspan="5">&nbsp;</td></tr>
				<tr><td colspan="5">&nbsp;</td></tr>
				<tr><td colspan="5">&nbsp;</td></tr>
				<tr><td colspan="5">&nbsp;</td></tr>
				<tr><td colspan="5">&nbsp;</td></tr>
				<tr><td colspan="5">&nbsp;</td></tr>
				<tr><td colspan="5">&nbsp;</td></tr>
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
							NCT ...............Y LA AERONAVE ESTÁ: 
							OPERABLE <span class="check-box-orden">&nbsp;&nbsp;&nbsp;&nbsp;</span> INOPERABLE 
							<span class="check-box-orden">&nbsp;&nbsp;&nbsp;&nbsp;</span>
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
							@foreach($orden->personal as $item)
							@if($item->pot_tipo == 5)
							@php
								$funcionario = $item->unidad_funcionario->funcionario;
							@endphp
							<span id="txt-inspector">{{$funcionario->grado->gra_abreviacion}} {{$funcionario->persona->per_nombres}} {{$funcionario->persona->per_primer_apellido}} {{$funcionario->persona->per_segundo_apellido}}</span>
							@endif
							@endforeach
							<br>
							<b>INSPECTOR DE MANTENIMIENTO</b>
						</small>
					</td>
					<td class="text-center" style="width:33% !important;">
						<small>
							@foreach($orden->personal as $item)
							@if($item->pot_tipo == 7)
							@php
								$funcionario = $item->unidad_funcionario->funcionario;
							@endphp
							<span id="txt-supervisor">{{$funcionario->grado->gra_abreviacion}} {{$funcionario->persona->per_nombres}} {{$funcionario->persona->per_primer_apellido}} {{$funcionario->persona->per_segundo_apellido}}</span>
							@endif
							@endforeach
		
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
			<small>
				FORM. FAB-M-01 "ORDEN DE TRABAJO"
			</small>
		</div>


	</div>
</div>

</body>
</html>
