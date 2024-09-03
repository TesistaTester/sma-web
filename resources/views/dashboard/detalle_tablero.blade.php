@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-home"></i>
        {{$titulo}}
    </h3>
    <div class="row">
        <div class="col-12">
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                            <div class="row">
                              <div class="col-md-3">
                                <div class="box-result">
                                    @php
                                      $cont_inspecciones_abiertas = 0;
                                      foreach($inspecciones as $item){
                                        if($item->ordenes->count() > 0){
                                          $cont_inspecciones_abiertas++;
                                        }
                                      }
                                    @endphp
                                    <h1>{{$cont_inspecciones_abiertas}}</h1>
                                    INSPECCIONES EN PROCESO
                                </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="box-result">
                                      <h1>{{$ordenes->count()}}</h1>
                                      TOTAL ORDENES
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="box-result">
                                      <h1>{{$ordenes->where('ort_avance', '<', 100)->count()}}</h1>
                                      ORDENES ABIERTAS
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="box-result">
                                      <h1>{{$ordenes->where('ort_avance', 100)->count()}}</h1>
                                      ORDENES CONCLUIDAS
                                  </div>
                                </div>
                            </div>
                            <div class="row">                            
                              <div class="col-md-3">
                                  <div class="box-result">
                                      <h1>{{$tarjetas->count()}}</h1>
                                      TARJETAS PLANIFICADAS
                                  </div>
                              </div>
                              <div class="col-md-3">
                                <div class="box-result">
                                    <h1>{{$tarjetas->where('tap_estado', 0)->count()}}</h1>
                                    TARJETAS EN ESPERA
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="box-result">
                                    <h1>{{$tarjetas->where('tap_estado', 1)->count()}}</h1>
                                    TARJETAS EN PROCESO
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="box-result">
                                    <h1>{{$tarjetas->where('tap_estado', 2)->count()}}</h1>
                                    TARJETAS TERMINADAS
                                </div>
                              </div>
                          </div>
                          {{-- <div class="row">
                            <div class="col-md-3">
                              <div class="box-result">
                                  <h1>{{$personal->count()}}</h1>
                                  PERSONAL REGISTRADO
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="box-result">
                                  <h1>{{$usuarios->count()}}</h1>
                                  USUARIOS REGISTRADOS
                              </div>
                          </div> --}}

                          </div>
                            <hr>
                            <hr>
                            <div class="row">
                            </div>
    
                    </div>
                </div>
                <!-- fin card  -->



        </div>
    </div>
</div>




<script type="text/javascript">
$(function(){


});


</script>




@endsection