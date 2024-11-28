@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-plane"></i>
        {{$titulo}}
        <a href="{{url('aeronaves/nuevo')}}" class="btn btn-sm btn-info float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVA aeronave</a>
    </h3>
    <div class="row">
        <div class="col-12">              
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        @if($aeronaves->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tienen aeronaves registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-bordered tabla-datos-clientes">
                                <thead>
                                <tr>
                                    <th class="hsmall">FOTO</th>
                                    <th class="hsmall">GRUPO</th>
                                    <th class="hsmall">MATRICULA</th>
                                    <th class="hsmall">TIPO</th>
                                    <th class="hsmall">CATEGORIA</th>
                                    <th class="hsmall">FABRICANTE</th>
                                    <th class="hsmall">COMPONENTES</th>
                                    <th class="hsmall">REGISTRO</th>
                                    <th class="hsmall">OPCION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($aeronaves as $item)
                                <tr>
                                    <td class="text-center">
                                        @if ($item->ae_foto == null)
                                            <small class="text-secondary">[NO DEFINIDO]</small>
                                        @else
                                        <img style="width:100px !important;" class="img-thumbnail" src="{{asset('storage/'.$item->ae_foto)}}">
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{$item->detalles[0]->grupo->gru_nombre}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->ae_matricula}}
                                        <br>
                                        <small>(<strong>{{$item->ae_estado_matricula}}</strong>)</small>                                        
                                    </td>
                                    <td class="text-center">
                                        {{$item->tipo->tia_nombre}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->categoria->cae_nombre}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->fabricante->faa_nombre}}
                                    </td>
                                    <td class="text-center">
                                        <small>
                                            <span class="text-success">POR REGISTRAR:</span> {{$item->ae_nro_componentes}}
                                            <br>
                                            <span class="text-success">REGISTRADOS:</span> {{$item->inventarios->count()}}    
                                        </small>
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
                                            <a class="dropdown-item" href="{{url('aeronaves/'.Crypt::encryptString($item->ae_id).'/componentes')}}"><i class="fa fa-th-large"></i> Componentes</a>
                                            <a class="dropdown-item" href="{{url('aeronaves/'.Crypt::encryptString($item->ae_id).'/rvds')}}"><i class="fa fa-clock-o"></i> Horas de vuelo</a>
                                            <a class="dropdown-item" href="{{url('aeronaves/'.Crypt::encryptString($item->ae_id).'/mantenimiento')}}"><i class="fa fa-wrench"></i> Inspecciones mantenimiento</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item" href="{{url('aeronaves/'.Crypt::encryptString($item->ae_id).'/editar')}}"><i class="fa fa-edit"></i> Editar</a>
                                            <a class="dropdown-item" href="{{url('aeronaves/'.Crypt::encryptString($item->ae_id).'/editar_estado')}}"><i class="fa fa-refresh"></i> Cambiar estado W-P-M</a>
                                            @if (count($item->horas_diario) > 0)                                             
                                            <a class="dropdown-item disabled" title="No es posible eliminar el aeronave. Tiene registros." data-usu-id="{{Crypt::encryptString($item->ae_id)}}" data-usu-nombre="{{$item->ae_nombre}}" data-toggle="modal" data-target="#modal-eliminar-aeronave" href="#"><i class="fa fa-trash"></i> Eliminar</a>                                               
                                            @else
                                            <a class="dropdown-item btn-eliminar-aeronave" data-usu-id="{{Crypt::encryptString($item->ae_id)}}" data-usu-nombre="{{$item->ae_nombre}}" data-toggle="modal" data-target="#modal-eliminar-aeronave" href="#"><i class="fa fa-trash"></i> Eliminar</a>
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
<div class="modal fade" id="modal-eliminar-aeronave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar aeronave
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">MATRICULA AERONAVE: </span>
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
          <form id="form-eliminar-aeronave" action="{{url('aeronaves')}}" data-simple-action="{{url('aeronaves')}}" method="post">
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
    ELIMINAR aeronave
    --------------------------------------------------------------
    */
    $('.btn-eliminar-aeronave').click(function(){
       let usu_id = $(this).attr('data-usu-id');
       let usu_nombre = $(this).attr('data-usu-nombre');
       $('#txt-usu-nombre').html(usu_nombre);
       //form data
       action = $('#form-eliminar-aeronave').attr('data-simple-action');
       action = action+'/'+usu_id;
       $('#form-eliminar-aeronave').attr('action',action);
   });



});


</script>




@endsection
