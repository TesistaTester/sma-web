@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-wrench"></i>
        {{$titulo}}
        <a href="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes')}}" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-chevron-left"></i> ATRAS</a>
        {{-- @if(is_null($servicio_antiguo) || $servicio_antiguo->sec_activo == false ) --}}
        <a href="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes/'.Crypt::encryptString($componente->com_id).'/mantenimientos/nuevo')}}" class="btn btn-sm btn-info float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO TIPO MANTENIMIENTO</a>
        {{-- @endif --}}
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
                                    </h4>
                                </div>
                            </div>
                        </div>
                        @if($mantenimientos->count() == 0)
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
                                    <th class="hsmall">TIPO MANTENIMIENTO</th>
                                    <th class="hsmall">FRECUENCIA</th>
                                    <th class="hsmall">T. MAX</th>
                                    <th class="hsmall">UNICO</th>
                                    <th class="hsmall">ESPECIAL</th>
                                    <th class="hsmall">OPCION</th>
                                </tr>
                                </thead>                                
                                <tbody>
                                @foreach($mantenimientos as $item)
                                <tr>
                                    <td class="text-center">
                                        {{$item->cma_nombre_tipo_inspeccion}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->cma_horas_frecuencia}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->cma_horas_cota_max}}
                                    </td>
                                    <td class="text-center">
                                        @if ($item->cma_unica_vez)
                                        SI    
                                        @else
                                        NO
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->cma_especial)
                                        SI    
                                        @else
                                        NO
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              OPCION
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes/'.Crypt::encryptString($componente->com_id).'/mantenimientos/'.Crypt::encryptString($item->cma_id).'/inspecciones')}}"><i class="fa fa-check"></i> Inspecciones</a>
                                                {{-- <a class="dropdown-item" href="{{url('mantenimientos/'.Crypt::encryptString($item->cma_id).'/nueva_inspeccion')}}"><i class="fa fa-plus"></i> Crear inspección</a> --}}
                                                <div class="dropdown-divider"></div>
                                                {{-- <a class="dropdown-item" href="{{url('mantenimientos/'.Crypt::encryptString($item->cma_id).'/editar')}}"><i class="fa fa-edit"></i> Editar</a> --}}
                                                <a class="dropdown-item btn-eliminar-mantenimiento" data-usu-id="{{Crypt::encryptString($item->cma_id)}}" data-usu-nombre="{{$item->cma_nombre_tipo_inspeccion}}" data-toggle="modal" data-target="#modal-eliminar-mantenimiento" href="#"><i class="fa fa-trash"></i> Eliminar</a>
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
<div class="modal fade" id="modal-eliminar-mantenimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar tipo de mantenimiento
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
          <form id="form-eliminar-componente" action="{{url('mantenimientos')}}" data-simple-action="{{url('mantenimientos')}}" method="post">
            @method('delete')
            @csrf
                <input type="hidden" name="ae_id" value="{{$aeronave->ae_id}}">
                <input type="hidden" name="com_id" value="{{$componente->com_id}}">
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

    /*
    --------------------------------------------------------------
    ELIMINAR MANTENIMIENTO
    --------------------------------------------------------------
    */
    $('.btn-eliminar-mantenimiento').click(function(){
       let usu_id = $(this).attr('data-usu-id');
       let usu_nombre = $(this).attr('data-usu-nombre');
       $('#txt-usu-nombre').html(usu_nombre);
       //form data
       action = $('#form-eliminar-componente').attr('data-simple-action');
       action = action+'/'+usu_id;
       $('#form-eliminar-componente').attr('action',action);
   });


});


</script>




@endsection
