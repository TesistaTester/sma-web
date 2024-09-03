@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-line-chart"></i>
        {{$titulo}}
    </h3>
    <div class="row">
        <div class="col-12">
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        @if($ordenes->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tiene ordenes registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-bordered tabla-datos">
                                <thead>
                                <tr style="font-size:15px; text-align:center;">
                                    <th>MATRICULA</th>
                                    <th>NRO ORDEN</th>
                                    <th>NRO TARJETA</th>
                                    <th>TIPO</th>
                                    <th># ACTIVIDADES</th>
                                    <th>% AVANCE</th>
                                    <th>OPCION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ordenes as $item)
                                    @if($item->ort_avance < 20)
                                    <tr>                                
                                    @endif
                                    @if($item->ort_avance >= 20 && $item->ort_avance < 40)
                                    <tr class="bg-avance-30">                                
                                    @endif
                                    @if($item->ort_avance >= 40 && $item->ort_avance < 60)
                                    <tr class="bg-avance-50">                                
                                    @endif
                                    @if($item->ort_avance >= 60 && $item->ort_avance < 80)
                                    <tr class="bg-avance-70">                                
                                    @endif
                                    @if($item->ort_avance >= 80 && $item->ort_avance <= 100)
                                    <tr class="bg-avance-90">                                
                                    @endif
                                    <td class="text-center">
                                        {{$item->ort_matricula}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->ort_cite}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->tarjeta->tar_numero}}
                                    </td>
                                    <td class="text-center">
                                        @if($item->ort_tipo == 1)
                                        NORMAL
                                        @endif
                                        @if($item->ort_tipo == 2)
                                        NO RUTINARIA
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{$item->tarjetas_planificadas->count()}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->ort_avance}}%
                                    </td>
                                    <td>
                                        <a class="btn btn-secondary" href="{{url('seguimientos/'.Crypt::encryptString($item->ort_id))}}"><i class="fa fa-th"></i> Ver tablero</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>    
                        </div>
                        @endif
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
       let usu_id = $(this).attr('data-id');
       let usu_nombre = $(this).attr('data-descripcion');
       $('#txt-descripcion').html(usu_nombre);
       //form data
       action = $('#form-eliminar-item').attr('data-simple-action');
       action = action+'/'+usu_id;
       $('#form-eliminar-item').attr('action',action);
   });



});


</script>




@endsection
