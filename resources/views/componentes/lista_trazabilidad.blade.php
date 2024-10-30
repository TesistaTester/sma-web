@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-th-list"></i>
        {{$titulo}}
        <a href="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes')}}" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-chevron-left"></i> ATRAS</a>
    </h3>
    <div class="row">
        <div class="col-12">              
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="alert alert-secondary">
                            <h4 class="text-center"><span class="text-info">COMPONENTE:</span> {{$componente->com_descripcion}} &emsp;&emsp;&emsp;<span class="text-info">SN:</span> {{$componente->com_serial_number}}</h4>
                        </div>
                        @if($historial->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tienen registros hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-bordered tabla-datos-clientes">
                                <thead>
                                <tr>
                                    <th>UBICACION</th>
                                    <th>FECHA INSTALACION</th>
                                    <th>RESPONSABLE INSTALACION</th>
                                    <th>OBSERVACIONES DE INSTALACION</th>
                                    <th>FECHA ACTUALIZACION</th>
                                </tr>
                                </thead>                                
                                <tbody>
                                @foreach($historial as $item)
                                <tr>
                                    <td class="text-center">
                                        {{$item->ina_ubicacion}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->ina_fecha_instalacion}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->ina_ci_responsable_instalacion}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->ina_observaciones_instalacion}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->updated_at}}
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
    $('.tabla-datos-clientes').DataTable({"language":{url: '{{asset('js/datatables-lang-es.json')}}'}, "order": [[ 4, "desc" ]]});

    //Conf popover
    $('[data-toggle="popover"]').popover()


});


</script>




@endsection
