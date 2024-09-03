@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-eye"></i>
        {{$titulo}}
        <a href="{{url('monitoreo')}}" title="Volver a lista de monitoreo" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
    </h3>
    <div class="row">
        <div class="col-12">
          @php
            $ord_realizar = 0;
            $ord_proceso = 0;
            $ord_concluido = 0;
          @endphp
          @foreach($ordenes as $item)
            @php
              //Determinar si la orden esta en proceso
              $cont_realizar = 0;
              $cont_proceso = 0;
              $cont_concluidos = 0;
              $cont_total = $item->tarjetas_planificadas->count();
              $actividades = $item->tarjetas_planificadas;
              foreach($actividades as $actividad){
                if($actividad->tap_estado == 0){
                  $cont_realizar++;
                }
                if($actividad->tap_estado == 1){
                  $cont_proceso++;
                }
                if($actividad->tap_estado == 2){
                  $cont_concluidos++;
                }
              }
              if($cont_realizar == $cont_total){
                $ord_realizar++;                
              }
              if($cont_proceso > 0 || ($cont_concluidos > 0 && $cont_concluidos < $cont_total)){
                $ord_proceso++;                
              }
              if($cont_concluidos == $cont_total){
                $ord_concluido++;                
              }

            @endphp
          @endforeach
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="alert alert-secondary">
                            <div class="row">
                                <div class="col-md-5">
                                    <h4 class="text-center">
                                        <small class="text-info">INSPECCION: </small>
                                        <br>
                                        {{$inspeccion->ins_nombre}}
                                        <br>
                                        <small class="text-secondary" style="text-transform:capitalize !important;">
                                          {{$inspeccion->ins_descripcion}}
                                        </small>
                                    </h4>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="card card-tablero bg-light hrs-hombre">
                                          <div class="text-center text-info">
                                            ESFUERZO
                                          </div>        
                                              <div class="card-body text-center">
                                                          @php
                                                          //mha Minutos Hombre Acumulado
                                                          $mha = 0;
                                                          foreach($ordenes as $orden){
                                                            $actividades = $orden->tarjetas_planificadas;
                                                            foreach($actividades as $item){
                                                              $mha = $mha + $item->tap_horas_hombre;
                                                            }
                                                          }
                                                          @endphp
                                                          {{intdiv($mha, 60)}}h:{{$mha%60}}m
                                              </div>
                                              <div class="text-center">
                                                <small>HORAS HOMBRE TRABAJADAS </small>
                                              </div>        
                                          </div>                                                                                
                                      </div>
                                      <div class="col-md-6">
                                        <div class="card card-tablero bg-light">
                                          @php
                                          $total = $inspeccion->ordenes->count();
                                          $acumulado = 0;
                                          foreach($inspeccion->ordenes as $orden){
                                              $acumulado = $acumulado + $orden->ort_avance;
                                          }
                                          $avance_orden = round(($acumulado/$total), 0);
                                          @endphp     
                                          <div class="card-body text-center">
                                            <div class="text-center text-info">
                                              AVANCE DE INSPECCIÓN
                                            </div>        
                                            <div role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:{{$avance_orden}}"></div>                                                    
                                          </div>
                                        </div>                                          
                                      </div>
                                    </div>
    
                                </div>
                              <div class="col-md-3">
                                <h4 class="text-center">
                                  <small class="text-info">CANTIDAD ORDENES</small>
                                </h4>        
                                <div class="card card-tablero bg-light">
                                      <div class="card-body">
                                            <div class="row">
                                              <div class="col-md-4">
                                                <h3 class="box-bordered-light text-center" style="height: 100%">
                                                    {{$ordenes->count()}}
                                                </h3>
                                              </div>
                                              <div class="col-md-8">
                                                TOTAL
                                              </div>
                                            </div>
                                      </div>
                                  </div>                                                                                
                                  <div class="card card-tablero bg-secondary">
                                      <div class="card-body">
                                            <div class="row">
                                              <div class="col-md-4">
                                                <h3 class="box-bordered-light text-center" style="height: 100%">
                                                    {{$ord_realizar}}
                                                </h3>
                                              </div>
                                              <div class="col-md-8 text-white">
                                              POR REALIZAR
                                              </div>
                                            </div>
                                      </div>
                                  </div>                                                                                
                                  <div class="card card-tablero bg-info-light">
                                    <div class="card-body">
                                          <div class="row">
                                            <div class="col-md-4">
                                              <h3 class="box-bordered-light text-center" style="height: 100%">
                                                  {{$ord_proceso}}
                                              </h3>
                                            </div>
                                            <div class="col-md-8 text-white">
                                              EN PROCESO
                                            </div>
                                          </div>
                                    </div>
                                  </div>                                                                                
                                  <div class="card card-tablero bg-success">
                                    <div class="card-body">
                                          <div class="row">
                                            <div class="col-md-4">
                                              <h3 class="box-bordered-light text-center" style="height: 100%">
                                                  {{$ord_concluido}}
                                              </h3>
                                            </div>
                                            <div class="col-md-8 text-white">
                                              CONCLUIDAS
                                            </div>
                                          </div>
                                    </div>
                                  </div>                                                                                
                            </div>
                              <div class="col-md-4">
                                <h4 class="text-center">
                                  <small class="text-info">ESTADO DE ORDENES </small>
                                </h4>        
                                <canvas id="grafica-avance-inspeccion"></canvas>
                              </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="text-info text-center">
                                    PROGRAMADO
                                </h5>                                
                                <div class="task-container" id="box-espera">
                                    @foreach($ordenes as $item)
                                    @php
                                      //Determinar si la orden esta en cero
                                      $cont_realizar = 0;
                                      $cont_total = $item->tarjetas_planificadas->count();
                                      $actividades = $item->tarjetas_planificadas;
                                      foreach($actividades as $actividad){
                                        if($actividad->tap_estado == 0){
                                          $cont_realizar++;
                                        }
                                      }
                                    @endphp
                                    @if ($cont_realizar == $cont_total)
                                    @php
                                        // Buscar la tarjeta que corresponde a la orden
                                        $tarjeta = null;
                                        $total = $item->tarjetas_planificadas->count();
                                        $terminados = 0;
                                        foreach($item->tarjetas_planificadas as $item2){
                                            if($item2->tap_estado == 2){
                                                $terminados++;
                                            }
                                            $tarjeta = $item2->tarjeta_capitulo->tarjeta;
                                        }
                                    @endphp
                                    <div class="card card-tablero bg-secondary">
                                      <div class="card-body">
                                            <div class="row">
                                              <div class="col-md-8">
                                                <p class="card-text text-white">
                                                  Nro orden: {{$item->ort_cite}}
                                                <br>
                                                Tarjeta: {{$tarjeta->tar_numero}}     
                                                </p>
                                                <a href="{{url('monitoreo/orden/'.Crypt::encryptString($item->ort_id))}}" class="btn btn-sm btn-light">
                                                  <i class="fa fa-eye"></i> Ver tablero de orden
                                                </a>
                                              </div>
                                              <div class="col-md-4">
                                                <h4 class="box-bordered-light text-center">
                                                  <small>Avance</small><br>
                                                  {{$item->ort_avance}}%
                                                </h4>
                                              </div>
                                            </div>
                                      </div>
                                  </div>                                                                                
                                  @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5 class="text-info text-center">EN PROCESO
                                </h5>                                
                                <div class="task-container" id="box-desarrollo">
                                  @foreach($ordenes as $item)
                                  @php
                                    //Determinar si la orden esta en proceso
                                    $cont_proceso = 0;
                                    $cont_concluidos = 0;
                                    $cont_total = $item->tarjetas_planificadas->count();
                                    $actividades = $item->tarjetas_planificadas;
                                    foreach($actividades as $actividad){
                                      if($actividad->tap_estado == 1){
                                        $cont_proceso++;
                                      }
                                      if($actividad->tap_estado == 2){
                                        $cont_concluidos++;
                                      }
                                    }
                                  @endphp
                                  @if ($cont_proceso > 0 || ($cont_concluidos > 0 && $cont_concluidos < $cont_total))
                                  @php
                                      // Buscar la tarjeta que corresponde a la orden
                                      $tarjeta = null;
                                      $total = $item->tarjetas_planificadas->count();
                                      $terminados = 0;
                                      foreach($item->tarjetas_planificadas as $item2){
                                          if($item2->tap_estado == 2){
                                              $terminados++;
                                          }
                                          $tarjeta = $item2->tarjeta_capitulo->tarjeta;
                                      }
                                  @endphp
                                  <div class="card card-tablero bg-info-light">
                                      <div class="card-body">
                                            <div class="row">
                                              <div class="col-md-8">
                                                <p class="card-text text-white">
                                                  Nro orden: {{$item->ort_cite}}
                                                <br>
                                                Tarjeta: {{$tarjeta->tar_numero}}     
                                                </p>
                                                <a href="{{url('monitoreo/orden/'.Crypt::encryptString($item->ort_id))}}" class="btn btn-sm btn-light">
                                                  <i class="fa fa-eye"></i> Ver tablero de orden
                                                </a>
                                              </div>
                                              <div class="col-md-4">
                                                <h4 class="box-bordered-light text-center">
                                                  <small>Avance</small><br>
                                                  {{$item->ort_avance}}%
                                                </h4>
                                              </div>
                                            </div>
                                      </div>
                                  </div>                                                                                
                                  @endif
                                  @endforeach

                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5 class="text-info text-center">
                                    CONCLUIDO
                                </h5>                                
                                <div class="task-container" id="box-concluido">
                                  @foreach($ordenes as $item)
                                  @php
                                    //Determinar si la orden esta terminada
                                    $cont_concluido = 0;
                                    $cont_total = $item->tarjetas_planificadas->count();
                                    $actividades = $item->tarjetas_planificadas;
                                    foreach($actividades as $actividad){
                                      if($actividad->tap_estado == 2){
                                        $cont_concluido++;
                                      }
                                    }
                                  @endphp
                                  @if ($cont_concluido == $cont_total)
                                  @php
                                      // Buscar la tarjeta que corresponde a la orden
                                      $tarjeta = null;
                                      $total = $item->tarjetas_planificadas->count();
                                      $terminados = 0;
                                      foreach($item->tarjetas_planificadas as $item2){
                                          if($item2->tap_estado == 2){
                                              $terminados++;
                                          }
                                          $tarjeta = $item2->tarjeta_capitulo->tarjeta;
                                      }
                                  @endphp
                                  <div class="card card-tablero bg-success">
                                    <div class="card-body">
                                          <div class="row">
                                            <div class="col-md-8">
                                              <p class="card-text text-white">
                                                Nro orden: {{$item->ort_cite}}
                                              <br>
                                              Tarjeta: {{$tarjeta->tar_numero}}     
                                              </p>
                                              <a href="{{url('monitoreo/orden/'.Crypt::encryptString($item->ort_id))}}" class="btn btn-sm btn-light">
                                                <i class="fa fa-eye"></i> Ver tablero de orden
                                              </a>
                                          </div>
                                            <div class="col-md-4">
                                              <h4 class="box-bordered-light text-center">
                                                <small>Avance</small><br>
                                                {{$item->ort_avance}}%
                                              </h4>
                                            </div>
                                          </div>
                                    </div>
                                  </div>                                                                                
                                  @endif
                                  @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin card  -->
        </div>
    </div>
</div>


<script type="text/javascript">
$(function(){
    /*
    -------------------------------------------------------------
    * CONFIGURACION DATA TABLES
    -------------------------------------------------------------
    */
    $('.tabla-datos').DataTable({"language":{url: '{{asset('js/datatables-lang-es.json')}}'}, "order": [[ 1, "desc" ]]});

    /*
    --------------------------------------------------------------
    ELIMINAR ITEM
    --------------------------------------------------------------
    */
    $('.btn-eliminar-item').click(function(){
   });



});

/*
----------------------------------------
GRAFICA DE AVANCE DE LA INSPECCION
----------------------------------------
*/
const ctx = document.getElementById('grafica-avance-inspeccion');

new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ['Programado', 'En proceso', 'Concluido'],
    datasets: [{
      label: 'Porcentaje',
      data: [{{$ord_realizar}}, {{$ord_proceso}}, {{$ord_concluido}}],
      borderWidth: 1,
      backgroundColor: [
      'rgb(108, 117, 125)',
      'rgba(23, 162, 184, 0.6)',
      'rgb(95, 174, 65)'
      ],      
      hoverOffset: 5      
    }]
  },
  options: {
    // scales: {
    //   y: {
    //     beginAtZero: true
    //   }
    // }
  }
});
</script>




@endsection
