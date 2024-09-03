@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-eye"></i>
        {{$titulo}}
    </h3>
    <div class="row">
        <div class="col-12">
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        @if($inspecciones->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tiene inspecciones registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-bordered tabla-datos">
                                <thead>
                                <tr style="font-size:15px; text-align:center;">
                                    <th>INSPECCION</th>
                                    <th># ORDENES</th>
                                    <th>% AVANCE</th>
                                    <th>OPCION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($inspecciones as $item)
                                @if ($item->ordenes->count() > 0)
                                @php
                                $total = $item->ordenes->count();
                                $acumulado = 0;
                                foreach($item->ordenes as $orden){
                                    $acumulado = $acumulado + $orden->ort_avance;
                                }
                                $avance_item = round(($acumulado/$total), 0);
                                @endphp
                                    <tr>                                
                                    <td class="text-center">
                                        {{$item->ins_nombre}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->ordenes->count()}}
                                    </td>
                                    <td class="text-center">
                                        {{$avance_item}}%
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-secondary" href="{{url('monitoreo/'.Crypt::encryptString($item->ins_id))}}"><i class="fa fa-th"></i> Ver tablero de inspección</a>
                                    </td>
                                </tr>
                                    
                                @endif
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
