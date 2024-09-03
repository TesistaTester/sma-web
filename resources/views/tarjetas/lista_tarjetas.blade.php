@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-tags"></i>
        {{$titulo}}
        <a href="{{url('tarjetas/nuevo')}}" class="btn btn-sm btn-info float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVA TARJETA</a>
    </h3>
    <div class="row">
        <div class="col-12">
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        @if($tarjetas->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tiene tarjetas registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-bordered tabla-datos">
                                <thead>
                                <tr>
                                    {{-- <th>INSPECCION</th> --}}
                                    <th>NRO TARJETA</th>
                                    <th>DESCRIPCION</th>
                                    <th>ATA</th>
                                    <th>ESPECIALIDAD</th>
                                    <th># ACTIVIDADES</th>
                                    <th>OPCION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tarjetas as $item)
                                <tr>
                                    {{-- <td class="text-center">
                                        {{$item->inspeccion->ins_nombre}}
                                    </td> --}}
                                    <td class="text-center">
                                        {{$item->tar_numero}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->tar_descripcion}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->tar_ata}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->tar_especialidad}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->tarjetas_capitulo->count()}}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            OPCION
                                          </button>
                                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{url('tarjetas/'.Crypt::encryptString($item->tar_id).'/actividades')}}"><i class="fa fa-cog"></i> Gestionar actividades</a>
                                            @if(config('wop.disco') == 'public')
                                            <a class="dropdown-item" target="_blank" href="{{asset('storage/'.$item->tar_digitalizado)}}
                                            @else    
                                            <a class="dropdown-item" target="_blank" href="{{Storage::disk(config('wop.disco'))->temporaryUrl($item->tar_digitalizado,  now()->addMinutes(10))}}">
                                            @endif    
                                                    <i class="fa fa-download"></i>
                                                Ver tarjeta digitalizada
                                            </a>
                                                <a class="dropdown-item" href="{{url('tarjetas/'.Crypt::encryptString($item->tar_id).'/editar')}}"><i class="fa fa-edit"></i> Editar</a>
                                            @if ($item->tarjetas_capitulo->count() > 0)
                                            <a class="dropdown-item disabled" href="#" title="La tarjeta tiene registros asociados. NO es posible eliminarlo."><i class="fa fa-trash"></i> Eliminar</a>
                                            @else
                                            <a class="dropdown-item btn-eliminar-item" data-id="{{$item->tar_id}}" data-descripcion="{{$item->tar_numero}}" data-toggle="modal" data-target="#modal-eliminar-tarjeta" href="#"><i class="fa fa-trash"></i> Eliminar</a>
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


{{-- INICIO MODAL: ELIMINAR TARJETA --}}
<div class="modal fade" id="modal-eliminar-tarjeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar item
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">DESCRIPCION: </span>
                    <span id="txt-descripcion"></span><br>
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
          <form id="form-eliminar-item" action="{{url('tarjetas')}}" data-simple-action="{{url('tarjetas')}}" method="post">
            @method('delete')
            @csrf
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR UNIDAD --}}


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
