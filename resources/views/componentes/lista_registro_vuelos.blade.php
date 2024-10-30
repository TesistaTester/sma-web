@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-th-large"></i>
        {{$titulo}}
        <a href="{{url('aeronaves')}}" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-chevron-left"></i> ATRAS</a>
    </h3>
    <div class="row">
        <div class="col-12">              
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="alert alert-secondary">
                            <h4 class="text-center"><span class="text-info">COMPONENTE:</span> {{$componente->com_descripcion}} &emsp;&emsp;&emsp;<span class="text-info">SN:</span> {{$componente->com_serial_number}}</h4>
                        </div>
                        @if($rvcs->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tienen registros de vuelo hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="table-responsive">
                            @php
                            $hna = intval($componente->com_hv_ac_normales / 60);
                            $mna = $componente->com_hv_ac_normales % 60;                                            
                            $haa = intval($componente->com_hv_ac_acrobaticas / 60);
                            $maa = $componente->com_hv_ac_acrobaticas % 60;                                            
                            $hua = intval($componente->com_hv_ac_utilitarias / 60);
                            $mua = $componente->com_hv_ac_utilitarias % 60;                                            
                            @endphp
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th colspan="4" class="text-center">ACUMULADOS</th>
                                </tr>
                                <tr>
                                    <th class="text-center">
                                        <small class="text-success">HRS NORMALES</small>                                        
                                        <br>
                                        <strong>{{$hna}}hrs {{$mna}}min</strong>
                                    </th>
                                    <th class="text-center">
                                        <small class="text-success">HRS ACROBATICAS</small>                                        
                                        <br>
                                        <strong>{{$haa}}hrs {{$maa}}min</strong>
                                    </th>
                                    <th class="text-center">
                                        <small class="text-success">HRS UTILITARIAS</small>                                        
                                        <br>
                                        <strong>{{$hua}}hrs {{$mua}}min</strong>
                                    </th>
                                    <th class="text-center">
                                        <small class="text-success">LANDINGS</small>                                        
                                        <br>
                                        <strong>{{$componente->com_hv_ac_landings}}</strong>
                                    </th>
                                </tr>
                                </thead>                                
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered tabla-datos-clientes">
                                <thead>
                                <tr>
                                    <th>AERONAVE</th>
                                    <th>HRS NORMALES</th>
                                    <th>HRS ACROBATICAS</th>
                                    <th>HRS UTILITARIAS</th>
                                    <th>LANDINGS</th>
                                    <th>OBSERVACION</th>
                                    <th>FECHA</th>
                                </tr>
                                </thead>                                
                                <tbody>
                                @foreach($rvcs as $item)
                                @php
                                $hn = intval($item->rvc_normales / 60);
                                $mn = $item->rvc_normales % 60;                                            
                                $ha = intval($item->rvc_acrobaticas / 60);
                                $ma = $item->rvc_acrobaticas % 60;                                            
                                $hu = intval($item->rvc_utilitarias / 60);
                                $mu = $item->rvc_utilitarias % 60;                                            
                                @endphp
                                <tr>
                                    <td class="text-center">
                                        {{$item->registro_vuelo->registro_vuelo_diario->aeronave->ae_matricula}}
                                    </td>
                                    <td class="text-center">
                                        {{$hn}}hrs {{$mn}}min
                                    </td>
                                    <td class="text-center">
                                        {{$ha}}hrs {{$ma}}min
                                    </td>
                                    <td class="text-center">
                                        {{$hu}}hrs {{$mu}}min
                                    </td>
                                    <td class="text-center">
                                        {{$item->rvc_landings}}
                                    </td>
                                    <td class="text-center">
                                        @if ($item->rvc_observacion == '' || $item->rvc_observacion == null)
                                        <small>[NO DEFINIDO]</small>
                                        @else                                            
                                        {{$item->rvc_observacion}}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{$item->rvc_fecha}}
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
