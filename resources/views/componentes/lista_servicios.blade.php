@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-flag-checkered"></i>
        {{$titulo}}
        <a href="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes')}}" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-chevron-left"></i> ATRAS</a>
        @if(is_null($servicio_antiguo) || $servicio_antiguo->sec_activo == false )
        <a href="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes/'.Crypt::encryptString($componente->com_id).'/servicios/nuevo')}}" class="btn btn-sm btn-info float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO TIEMPO DE SERVICIO</a>
        @endif
    </h3>
    <div class="row">
        <div class="col-12">              
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="alert alert-secondary">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="">
                                        <span class="text-info">COMPONENTE:</span> {{$componente->com_descripcion}} 
                                    </h4>
                                    <h4>
                                        <span class="text-info">SN:</span> {{$componente->com_serial_number}}
                                    </h4>        
                                </div>
                                <div class="col-md-6">
                                    <h4 class="">
                                        <span class="text-info">TIPO COMPONENTE:</span> 
                                        {{-- SLL Scrap --}}
                                        @if($componente->com_tipo_componente == 1) 
                                        SLL Scrap
                                        @endif
                                        {{-- SLL Overhaul --}}
                                        @if($componente->com_tipo_componente == 2)
                                        SLL Overhaul
                                        @endif
                                        {{-- Shelf Life --}}
                                        @if($componente->com_tipo_componente == 3)
                                        Shelf Life
                                        @endif
                                        {{-- On Condition --}}
                                        @if($componente->com_tipo_componente == 4)
                                        On Condition
                                        @endif
                                        {{-- Condition Monitoring --}}
                                        @if($componente->com_tipo_componente == 5)
                                        Condition Monitoring
                                        @endif
                                    </h4>
                                    <h4>
                                        <span class="text-info">MANTO. PROGRAMADO:</span> 
                                        @if($componente->com_principal)
                                        SI
                                        @else
                                        NO
                                        @endif
                                        {{-- {{$componente->com_serial_number}} --}}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        @if($servicios->count() == 0)
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
                                    {{-- scrap --}}
                                    @if($componente->com_tipo_componente == 1)
                                    <th class="hsmall">FECHA PRIMERA INSTALACION</th>
                                    @endif
                                    {{-- overhaul --}}
                                    @if($componente->com_tipo_componente == 2)
                                    <th class="hsmall">FECHA ULTIMO OVERHAUL</th>
                                    @endif
                                    <th class="hsmall">HRS NORMALES LIMITE</th>
                                    <th class="hsmall">HRS ACROBATICAS LIMITE</th>
                                    <th class="hsmall">HRS UTILITARIAS LIMITE</th>
                                    <th class="hsmall">LANDINGS LIMITE</th>
                                    <th class="hsmall">DIAS LIMITE</th>
                                    <th class="hsmall">VENCIMIENTO</th>
                                    <th class="hsmall">OPCION</th>
                                </tr>
                                </thead>                                
                                <tbody>
                                @foreach($servicios as $item)
                                @if($item->sec_activo)
                                <tr class="bg-success">
                                @else
                                <tr>
                                @endif
                                    {{-- scrap --}}
                                    @if($componente->com_tipo_componente == 1)
                                    <th>{{$item->sec_fecha_primera_instalacion}}</th>
                                    @endif
                                    {{-- overhaul --}}
                                    @if($componente->com_tipo_componente == 2)
                                    <th>{{$item->sec_fecha_ultimo_overhaul}}</th>
                                    @endif
                                    <td class="text-center">
                                    @if($item->sec_horas_normales_control)
                                        {{$item->sec_horas_normales_tope}} HRS
                                    @else 
                                        <button class="btn btn-secondary btn-sm">NO</button>
                                    @endif
                                    </td>
                                    <td class="text-center">
                                    @if($item->sec_horas_acrobaticas_control)
                                        {{$item->sec_horas_acrobaticas_tope}} HRS
                                    @else 
                                        <button class="btn btn-secondary btn-sm">NO</button>
                                    @endif
                                    </td>
                                    <td class="text-center">
                                    @if($item->sec_horas_utilitarias_control)
                                        {{$item->sec_horas_utilitarias_tope}} HRS
                                    @else 
                                        <button class="btn btn-secondary btn-sm">NO</button>
                                    @endif
                                    </td>
                                    <td class="text-center">
                                    @if($item->sec_landings_control)
                                        {{$item->sec_landings_tope}} <br><small>landings</small>
                                    @else 
                                        <button class="btn btn-secondary btn-sm">NO</button>
                                    @endif
                                    </td>
                                    <td class="text-center">
                                    @if($item->sec_dias_control)
                                        {{$item->sec_dias_tope}} <br> <small>días</small>
                                    @else 
                                        <button class="btn btn-secondary btn-sm">NO</button>
                                    @endif
                                    </td>
                                    <td class="text-center">
                                    @if($item->sec_fecha_vencimiento_control)
                                        {{$item->sec_fecha_vencimiento_tope}}
                                    @else 
                                        <button class="btn btn-secondary btn-sm">NO</button>
                                    @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              OPCION
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                              <a class="dropdown-item btn-eliminar-servicio" data-usu-id="{{Crypt::encryptString($item->sec_id)}}" data-usu-nombre="{{$item->com_nombre}}" data-toggle="modal" data-target="#modal-eliminar-servicio" href="#"><i class="fa fa-trash"></i> Anular tiempo de servicio</a>
                                            </div>
                                          </div>
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

{{-- INICIO MODAL: ELIMINAR SERVICIO --}}
<div class="modal fade" id="modal-eliminar-servicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Anular tiempo de servicio
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">DESCRIPCION: </span>
                    <span id="txt-usu-nombre"></span><br>
                </h5>
            </div>
            <div class="alert alert-danger">
                <div class="media">
                    <img src="{{asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Cuidado.-</h5>
                        <p>
                            ¿Está seguro que desea eliminar éste registro?
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <form id="form-eliminar-componente" action="{{url('componentes')}}" data-simple-action="{{url('componentes')}}" method="post">
            @method('delete')
            @csrf
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR SERVICIO --}}


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
