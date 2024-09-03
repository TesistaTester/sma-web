@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-eye"></i>
        {{$titulo}}
        <a href="#" onclick="history.back()" title="Volver a lista de seguimiento" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
    </h3>
    <div class="row">
        <div class="col-12">
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        @php
                            $tarjeta = null;
                            $total = $actividades->count();
                            $terminados = 0;
                            foreach($actividades as $item){
                                if($item->tap_estado == 2){
                                    $terminados++;
                                }
                                $tarjeta = $item->tarjeta_capitulo->tarjeta;
                            }
                        @endphp
                        <div class="alert alert-secondary">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4 class="text-center">
                                        <small class="text-info">NRO DE ORDEN: </small>
                                        <br>
                                        {{$orden->ort_cite}}
                                    </h4>        
                                </div>
                                <div class="col-md-3">
                                    <h5 class="text-center">
                                        <small class="text-info">DESCRIPCION DEL TRABAJO: </small>
                                        <br>
                                        <small>
                                            {{$orden->ort_descripcion_trabajo}}
                                        </small>
                                    </h5>        
                                </div>
                                <div class="col-md-2">
                                    <h4 class="text-center">
                                        <small class="text-info">TARJETA: </small>
                                        <br>
                                        {{$tarjeta->tar_numero}}
                                    </h4>                                    
                                </div>
                                <div class="col-md-2">
                                    <div class="card bg-light">
                                        <div class="text-center text-info">
                                          AVANCE
                                        </div>        
                                        <div class="card-body">
                                            <h4 class="text-center">
                                            <div class="box-actividad" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:{{(round($terminados/$total, 2)*100)}}"></div>                                                    
                                            </h4>                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="card bg-light hrs-hombre">
                                      <div class="text-center text-info">
                                        HRS - HOMBRE
                                      </div>        
                                      <div class="card-body">
                                          <h2 class="text-center">
                                              @php
                                              //mha Minutos Hombre Acumulado
                                              $mha = 0;
                                              foreach($actividades as $item){
                                                $mha = $mha + $item->tap_horas_hombre;
                                              }
                                              @endphp
                                              {{intdiv($mha, 60)}}h:{{$mha%60}}m
                                            </h2>                                    
                                      </div>
                                  </div>
                                </div>

                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="text-info text-center">
                                    PROGRAMADO
                                </h5>                                
                                <div class="task-container" id="box-espera">
                                    @foreach($actividades as $item)
                                    @if ($item->tap_estado == 0)
                                    <div class="card bg-secondary mb-3">
                                        <div class="card-body">
                                            <p class="card-text text-white">
                                                {{Str::limit($item->tarjeta_capitulo->tac_descripcion, 90, '...') }}
                                            </p>
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
                                    @foreach($actividades as $item)
                                    @if ($item->tap_estado == 1)
                                    <div class="card bg-info-light mb-3">
                                        <div class="card-body">
                                            <p class="card-text text-white">
                                              {{Str::limit($item->tarjeta_capitulo->tac_descripcion, 90, '...') }}
                                          </p>
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
                                    @foreach($actividades as $item)
                                    @if ($item->tap_estado == 2)
                                    <div class="card bg-success mb-3">
                                        <div class="card-body">
                                          <p class="card-text text-white">
                                            {{Str::limit($item->tarjeta_capitulo->tac_descripcion, 90, '...') }}
                                            <br>
                                            <small class="badge badge-light">
                                              Hrs-hombre:
                                              {{intdiv($item->tap_horas_hombre, 60)}}h:{{$item->tap_horas_hombre%60}}m
                                            </small>

                                          </p>
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

{{-- INICIO MODAL: A DESARROLLO --}}
<div class="modal fade" id="modal-to-desarrollo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-arrow-right"></i>
              Mover un item a DESARROLLO
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-mover-a-desarrollo" action="{{url('seguimientos/a_desarrollo')}}" method="post">
        @csrf
        <div class="modal-body">
            <label for="" class="form-label text-info">Actividad: <span class="faster">*</span> <i class="float-right fa fa-question-circle" title="Mover actividad al area de desarrollo"></i></label>
            <select required name="tap_id" class="form-control">
                <option value="">Seleccionar</option>
                <?php foreach($actividades as $item): ?>
                @if($item->tap_estado == 0)
                <option value="{{$item->tap_id}}">{{$item->tarjeta_capitulo->tac_descripcion}}</option>
                @endif
                <?php endforeach;?>
            </select>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="ort_id" value="{{$orden->ort_id}}">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <button type="submit" class="btn btn-info"><i class="fa fa-arrow-right"></i> Mover a desarrollo</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR A DESARROLLO --}}

{{-- INICIO MODAL: A CONCLUIDAS --}}
<div class="modal fade" id="modal-to-concluido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-arrow-right"></i>
              Mover un item a CONCLUIDO
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-mover-a-concluido" action="{{url('seguimientos/a_concluido')}}" method="post">
        @csrf
        <div class="modal-body">
            <label for="" class="form-label text-info">Actividad: <span class="faster">*</span> <i class="float-right fa fa-question-circle" title="Mover actividad al area de concluido"></i></label>
            <select required name="tap_id" class="form-control">
                <option value="">Seleccionar</option>
                <?php foreach($actividades as $item): ?>
                @if($item->tap_estado == 1)
                <option value="{{$item->tap_id}}">{{$item->tarjeta_capitulo->tac_descripcion}}</option>
                @endif
                <?php endforeach;?>
            </select>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="ort_id" value="{{$orden->ort_id}}">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <button type="submit" class="btn btn-info"><i class="fa fa-arrow-right"></i> Mover a concluido</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR A CONCLUIDAS --}}

{{-- INICIO MODAL: BACK DESARROLLO --}}
<div class="modal fade" id="modal-back-desarrollo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-arrow-right"></i>
              Mover un item a DESARROLLO
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-mover-back-desarrollo" action="{{url('seguimientos/back_desarrollo')}}" method="post">
        @csrf
        <div class="modal-body">
            <label for="" class="form-label text-info">Actividad: <span class="faster">*</span> <i class="float-right fa fa-question-circle" title="Mover actividad al area de concluido"></i></label>
            <select required name="tap_id" class="form-control">
                <option value="">Seleccionar</option>
                <?php foreach($actividades as $item): ?>
                @if($item->tap_estado == 2)
                <option value="{{$item->tap_id}}">{{$item->tarjeta_capitulo->tac_descripcion}}</option>
                @endif
                <?php endforeach;?>
            </select>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="ort_id" value="{{$orden->ort_id}}">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <button type="submit" class="btn btn-info"><i class="fa fa-arrow-right"></i> Mover a desarrollo</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: BACK DESARROLLO --}}

{{-- INICIO MODAL: BACK REALIZAR --}}
<div class="modal fade" id="modal-back-realizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-arrow-right"></i>
              Mover un item a REALIZAR
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-mover-back-realizar" action="{{url('seguimientos/back_realizar')}}" method="post">
        @csrf
        <div class="modal-body">
            <label for="" class="form-label text-info">Actividad: <span class="faster">*</span> <i class="float-right fa fa-question-circle" title="Mover actividad al area de concluido"></i></label>
            <select required name="tap_id" class="form-control">
                <option value="">Seleccionar</option>
                <?php foreach($actividades as $item): ?>
                @if($item->tap_estado == 1)
                <option value="{{$item->tap_id}}">{{$item->tarjeta_capitulo->tac_descripcion}}</option>
                @endif
                <?php endforeach;?>
            </select>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="ort_id" value="{{$orden->ort_id}}">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <button type="submit" class="btn btn-info"><i class="fa fa-arrow-right"></i> Mover a desarrollo</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: BACK REALIZAR --}}

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


</script>




@endsection
