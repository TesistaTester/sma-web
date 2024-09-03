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
		}
		.check-box-orden{
			border:1px solid #000;
			
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
					<h6>
						<b>FUERZA AEREA BOLIVIANA</b>
						<br>
						<small>
						TRANSPORTES AEREOS BOLIVIANOS
						<br>
						<b>BOLIVIA</b>
						</small>
					</h6>
				</div>
				<div class="col-md-5 text-center">
				</div>
				<div class="col-md-3 text-center"><img style="width:95%" src="{{asset('img/logo_institucion.png')}}" class="card-img-top" alt="Logo Unidad"></div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<h2 class="text-center">
						<b>
							DESIGNACION DE PERSONAL
              <br>
                ORDEN DE TRABAJO No.:
                <span id="txt1_ort_cite">{{$orden->ort_cite}}</span>
						</b>
					</h2>
				</div>
			</div>
      <table class="table table-bordered table-condensed">
        <tr>
          <td><strong>LUGAR Y FECHA:</strong></td>
          <td colspan="3">La Paz, {{$orden->ort_fecha}}</td>
        </tr>
        <tr>
          <td><strong>FECHA INICIO:</strong></td>
          <td style="width: 200px"></td>
          <td><strong>FECHA FINALIZACIÓN:</strong></td>
          <td style="width: 200px"></td>
        </tr>
      </table>
      <h5>PERSONAL TÉCNICO</h5>
      <table class="table table-bordered table-condensed">
        <tr>
          <th class="text-center">ESPECIALIDAD</th>
          <th class="text-center">REALIZADO POR</th>
          <th class="text-center">PID</th>
          <th class="text-center" style="width:25%;">FIRMA</th>
        </tr>
        @foreach($orden->personal as $item)
		{{-- Imprime solo nivel 3 de tabla personal_orden_trabajo --}}
        {{-- @if($item->pot_tipo == 3) --}} 
		{{-- Imprime solo nivel 3 de funcionario --}}
        @if($item->unidad_funcionario->funcionario->fun_nivel == 3) 
			@php
				$funcionario = $item->unidad_funcionario->funcionario;
			@endphp
            <tr>
              <td><strong>{{$funcionario->especialidad->esp_descripcion}}</strong></td>
              <td>{{$funcionario->grado->gra_abreviacion}} {{$funcionario->persona->per_nombres}} {{$funcionario->persona->per_primer_apellido}} {{$funcionario->persona->per_segundo_apellido}}</td>
              <td>{{$funcionario->fun_pid}}</td>
              <td></td>
            </tr>
        @endif    
        @endforeach
      </table>
      <h5>INSPECCIÓN Y SUPERVISIÓN</h5>
      <table class="table table-bordered table-condensed">
        <tr>
          <th class="text-center">CARGO</th>
          <th class="text-center">GRADO Y NOMBRE</th>
          <th class="text-center" style="width:25%;">FIRMA</th>
        </tr>
        @foreach($orden->personal as $item)
        @if($item->pot_tipo == 5)
						@php
							$funcionario = $item->unidad_funcionario->funcionario;
						@endphp
        <tr>
          <td><strong>INSPECTOR DE CALIDAD</strong></td>
          <td>{{$funcionario->grado->gra_abreviacion}} {{$funcionario->persona->per_nombres}} {{$funcionario->persona->per_primer_apellido}} {{$funcionario->persona->per_segundo_apellido}}</td>
          <td></td>
        </tr>
        @endif
        @endforeach

        @foreach($orden->personal as $item)
        @if($item->pot_tipo == 7)
						@php
							$funcionario = $item->unidad_funcionario->funcionario;
						@endphp
        <tr>
          <td><strong>SUPERVISOR DE MANTENIMIENTO</strong></td>
          <td>{{$funcionario->grado->gra_abreviacion}} {{$funcionario->persona->per_nombres}} {{$funcionario->persona->per_primer_apellido}} {{$funcionario->persona->per_segundo_apellido}}</td>
          <td></td>
        </tr>
        @endif
        @endforeach
      </table>
      <table class="table table-bordered table-condensed">
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
	</div>
</div>

</body>
</html>
