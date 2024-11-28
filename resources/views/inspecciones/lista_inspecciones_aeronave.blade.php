@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-check"></i>
        {{$titulo}}
        <a href="{{url('aeronaves/')}}" class="btn btn-sm btn-dark float-right" style="margin-left:10px;"><i class="fa fa-arrow-left"></i> ATRAS</a>
    </h3>
    <div class="row">
        <div class="col-12">
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        <ul>
                                            <li>
                                                Las inspecciones proximas a cumplirse se marcan en color <span class>NARANJA</span>. Con 5 horas de antelación.
                                            </li>
                                            <li>
                                                Las inspecciones vencidas se marcan en color ROJO.
                                            </li>
                                            <li>
                                                Las inspecciones con orden abierta o cumplidas se marcan en color VERDE.
                                            </li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
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
                                <tr>
                                    <th>NOMBRE DE LA INSPECCION</th>
                                    <th>DESCRIPCION</th>
                                    <th>HORA PROGRAMADA</th>
                                    <th>OPCION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($inspecciones as $item)
                                @if($item->ordenes->count() > 0)
                                    <tr class="bg-success">
                                @else
                                    @if((round($horas/60,0) > ($item->ins_hora_componente - 5)) &&(round($horas/60,0) < ($item->ins_hora_componente)))
                                    <tr class="bg-warning">
                                    @endif
                                    @if(round($horas/60,0) > ($item->ins_hora_componente))
                                    <tr class="bg-danger">
                                    @endif
                                @endif
                                    <td class="text-center">
                                        {{$item->ins_nombre}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->ins_descripcion}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->ins_hora_componente}}
                                    </td>
                                    <td class="text-center">
                                        @if((round($horas/60,0) > ($item->ins_hora_componente - 5)) &&(round($horas/60,0) < ($item->ins_hora_componente)) || round($horas/60,0) > ($item->ins_hora_componente))
                                            @if($aeronave->ae_estado_matricula == 'M')
                                            <a class="btn btn-sm btn-success" href="{{url('ordenes/'.Crypt::encryptString($aeronave->ae_id).'/apertura')}}"><i class="fa fa-folder-open"></i> ABRIR ORDEN</a>
                                            @else
                                            <small>Para abrir la orden, debe cambiar el estado de la aeronave a M</small>
                                            <a class="btn btn-sm btn-secondary" href="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/editar_estado')}}"><i class="fa fa-refresh"></i> CAMBIAR ESTADO</a>
                                            @endif
                                        @endif
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


{{-- INICIO MODAL: ELIMINAR inspeccion --}}
<div class="modal fade" id="modal-eliminar-inspeccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <form id="form-eliminar-item" action="{{url('inspecciones')}}" data-simple-action="{{url('inspecciones')}}" method="post">
            @method('delete')
            @csrf
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR inspeccion --}}


<script type="text/javascript">
$(function(){
    /*
    -------------------------------------------------------------
    * CONFIGURACION DATA TABLES
    -------------------------------------------------------------
    */
    $('.tabla-datos').DataTable({"language":{url: '{{asset('js/datatables-lang-es.json')}}'}, "order": [[ 2, "asc" ]]});

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
