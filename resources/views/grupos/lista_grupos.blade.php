@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-users"></i>
        {{$titulo}}
        <a href="{{url('grupos/nuevo')}}" class="btn btn-sm btn-info float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO Grupo</a>
    </h3>
    <div class="row">
        <div class="col-12">              
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        @if($grupos->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tienen grupos registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-bordered tabla-datos-clientes">
                                <thead>
                                <tr>
                                    <th>FOTO GRUPO</th>
                                    <th>NOMBRE</th>
                                    <th>DIRECCION</th>
                                    <th>TELEFONO</th>
                                    <th>FECHA REGISTRO</th>
                                    <th>OPCION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($grupos as $item)
                                <tr>
                                    <td>
                                        @if ($item->gru_foto == null)
                                            <small class="text-secondary">[NO DEFINIDO]</small>
                                        @else
                                        <img style="width:100px !important;" class="img-thumbnail" src="{{asset('storage/'.$item->gru_foto)}}">
                                        @endif
                                    </td>
                                    <td>
                                        {{$item->gru_nombre}}
                                    </td>
                                    <td>
                                        {{$item->gru_direccion}}
                                    </td>
                                    <td>
                                        @if ($item->gru_telefono == null)
                                        <small class="text-secondary">[NO DEFINIDO]</small>                                            
                                        @else
                                        {{$item->gru_telefono}}
                                        @endif
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
                                            <a class="dropdown-item" href="{{url('grupos/'.Crypt::encryptString($item->gru_id).'/editar')}}"><i class="fa fa-edit"></i> Editar</a>
                                            @if (count($item->detalles) > 0 || count($item->unidades) > 0)                                             <a class="dropdown-item btn-eliminar-grupo" data-usu-id="{{Crypt::encryptString($item->gru_id)}}" data-usu-nombre="{{$item->gru_nombre}}" data-toggle="modal" data-target="#modal-eliminar-grupo" href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                            <a class="dropdown-item disabled" title="No es posible eliminar el grupo aereo. Tiene datos asociados." data-usu-id="{{Crypt::encryptString($item->gru_id)}}" data-usu-nombre="{{$item->gru_nombre}}" data-toggle="modal" data-target="#modal-eliminar-grupo" href="#"><i class="fa fa-trash"></i> Eliminar</a>                                               
                                            @else
                                            <a class="dropdown-item btn-eliminar-grupo" data-usu-id="{{Crypt::encryptString($item->gru_id)}}" data-usu-nombre="{{$item->gru_nombre}}" data-toggle="modal" data-target="#modal-eliminar-grupo" href="#"><i class="fa fa-trash"></i> Eliminar</a>
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
<div class="modal fade" id="modal-eliminar-grupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar Grupo
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">NOMBRE Grupo: </span>
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
          <form id="form-eliminar-grupo" action="{{url('grupos')}}" data-simple-action="{{url('grupos')}}" method="post">
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
    ELIMINAR Grupo
    --------------------------------------------------------------
    */
    $('.btn-eliminar-grupo').click(function(){
       let usu_id = $(this).attr('data-usu-id');
       let usu_nombre = $(this).attr('data-usu-nombre');
       $('#txt-usu-nombre').html(usu_nombre);
       //form data
       action = $('#form-eliminar-grupo').attr('data-simple-action');
       action = action+'/'+usu_id;
       $('#form-eliminar-grupo').attr('action',action);
   });



});


</script>




@endsection
