@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-th-large"></i>
        {{$titulo}}
        <a href="{{url('aeronaves')}}" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-chevron-left"></i> ATRAS</a>
        <a href="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes/nuevo/')}}" class="btn btn-sm btn-info float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO COMPONENTE</a>
    </h3>
    <div class="row">
        <div class="col-12">              
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="alert alert-secondary">
                            <h4 class="text-center"><span class="text-info">MATRICULA AERONAVE:</span> {{$aeronave->ae_matricula}}</h4>
                        </div>
                        @if($componentes->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tienen componentes registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-bordered tabla-datos-clientes">
                                <thead>
                                <tr>
                                    <th class="hsmall">DESCRIPCION</th>
                                    <th class="hsmall">PART NUMBER</th>
                                    <th class="hsmall">SERIAL NUMBER</th>
                                    <th class="hsmall">TIPO COMPONENTE</th>
                                    <th class="hsmall">MASTER</th>
                                    <th class="hsmall">MANTENIMIENTO PROGRAMADO</th>
                                    <th class="hsmall">TIEMPO(S) DE SERVICIO</th>
                                    <th class="hsmall">REGISTRO</th>
                                    <th class="hsmall">OPCION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($componentes as $item)
                                <tr>
                                    <td class="text-center">
                                        {{$item->com_descripcion}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->com_part_number}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->com_serial_number}}
                                    </td>
                                    <td class="text-center">
                                        @if($item->com_tipo_componente == 1)
                                        SLL Scrap
                                        @endif
                                        @if($item->com_tipo_componente == 2)
                                        SLL Overhaul
                                        @endif
                                        @if($item->com_tipo_componente == 3)
                                        Shelf Life
                                        @endif
                                        @if($item->com_tipo_componente == 4)
                                        On Condition
                                        @endif
                                        @if($item->com_tipo_componente == 5)
                                        Condition Monitoring
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->com_master == 1)
                                        SI
                                        @else 
                                        NO
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->com_principal == 1)
                                        SI
                                        @else 
                                        NO
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="badge badge-info">
                                            {{$item->servicios->count()}}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{$item->updated_at}}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            OPCION
                                          </button>
                                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{url('componentes/'.Crypt::encryptString($item->com_id).'/horas')}}"><i class="fa fa-clock-o"></i>  Ver horas vuelo</a>
                                            <a class="dropdown-item" href="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes/'.Crypt::encryptString($item->com_id).'/trazabilidad')}}"><i class="fa fa-list"></i>  Ver trazabilidad</a>
                                            <a class="dropdown-item" href="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes/'.Crypt::encryptString($item->com_id).'/servicios')}}"><i class="fa fa-flag-checkered"></i> Tiempos de servicios</a>
                                            @if($item->com_principal)
                                            <a class="dropdown-item" href="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes/'.Crypt::encryptString($item->com_id).'/mantenimientos')}}"><i class="fa fa-wrench"></i>  Tipos de mantenimiento</a>
                                            @else
                                            <a class="dropdown-item" href="#" title="Este componente no tiene mantenimiento programado"><i class="fa fa-wrench"></i>  Tipos de mantenimiento</a>
                                            @endif
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{url('componentes/'.Crypt::encryptString($item->com_id).'/editar')}}"><i class="fa fa-edit"></i> Editar</a>
                                            @if (count($item->registros_vuelo) > 0)
                                            <a class="dropdown-item disabled" title="No es posible eliminar el componente. Tiene registros asociados." href="#"><i class="fa fa-trash"></i> Eliminar</a>                                               
                                            @else
                                            <a class="dropdown-item btn-eliminar-componente" data-usu-id="{{Crypt::encryptString($item->com_id)}}" data-usu-nombre="{{$item->com_nombre}}" data-toggle="modal" data-target="#modal-eliminar-componente" href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                            @endif
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


{{-- INICIO MODAL: ELIMINAR MODALIDAD --}}
<div class="modal fade" id="modal-eliminar-componente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar componente
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">MATRICULA componente: </span>
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
  {{-- FIN MODAL: ELIMINAR ESTADO --}}


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
    ELIMINAR componente
    --------------------------------------------------------------
    */
    $('.btn-eliminar-componente').click(function(){
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
