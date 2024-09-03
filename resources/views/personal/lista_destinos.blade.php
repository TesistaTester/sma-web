@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-tags"></i>
        {{$titulo}}
        <a href="{{url('personal')}}" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-arrow-left"></i> ATRÁS</a>
        <a href="{{url('personal/'.Crypt::encryptString($personal->per_id).'/nuevo_destino')}}" class="btn btn-sm btn-info float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO DESTINO</a>
    </h3>
    <div class="row">
        <div class="col-12">              
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        <h5 style="background-color:#ddd; padding:5px; border:1px solid #ccc;">
                            <span class="text-info">NOMBRE COMPLETO:</span> {{$personal->per_nombres}} {{$personal->per_primer_apellido}} {{$personal->per_segundo_apellido}}<br>
                            <span class="text-info">GRADO:</span> {{$personal->grado->gra_abreviacion}}<br>
                            <span class="text-info">ESPECIALIDAD:</span> {{$personal->especialidad->esp_descripcion}}<br>
                        </h5>
                        @if($destinos->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tiene destinos registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <table class="table table-bordered tabla-datos-clientes">
                            <thead>
                            <tr>
                                <th>GRUPO AÉREO</th>
                                <th>FECHA INICIO</th>
                                <th>FECHA FIN</th>
                                <th>MOTIVO</th>
                                <th>CARGO</th>
                                <th>OPCION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($destinos as $item)
                            <tr>
                                <td>
                                    {{$item->grupo->gru_descripcion}}
                                </td>
                                <td class="text-center">
                                    {{$item->des_fecha_inicio}}
                                </td>
                                <td class="text-center">
                                    {{$item->des_fecha_fin}}
                                </td>
                                <td class="text-center">
                                    {{$item->des_motivo}}
                                </td>
                                <td class="text-center">
                                    {{$item->des_cargo}}
                                </td>
                                <td>
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        OPCION
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        @if($item->fojas != null)
                                        <a class="dropdown-item" href="#" title="No es posible eliminar este item, ya que tiene registros asociados"><i class="fa fa-trash"></i> Anular destino</a>
                                        @else
                                        <a class="dropdown-item btn-eliminar-destino" data-des-id="{{Crypt::encryptString($item->des_id)}}" data-des-nombre="DESTINO: {{$item->grupo->gru_descripcion}} FECHA DE INICIO: {{$item->des_fecha_inicio}}" data-toggle="modal" data-target="#modal-eliminar-destino" href="#"><i class="fa fa-trash"></i> Anular destino</a>
                                        @endif
                                      </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
                <!-- fin card  -->



        </div>
    </div>
</div>


{{-- INICIO MODAL: ELIMINAR --}}
<div class="modal fade" id="modal-eliminar-destino" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Anular destino
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">DESTINO: </span>
                    <span id="txt-des-nombre"></span><br>
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
          <form id="form-eliminar-destino" action="{{url('destinos')}}" data-simple-action="{{url('destinos')}}" method="post">
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
    $('.tabla-datos-clientes').DataTable({"language":{url: '{{asset('js/datatables-lang-es.json')}}'}, "order": [[ 1, "desc" ]]});

    //Conf popover
    $('[data-toggle="popover"]').popover()

    /*
    --------------------------------------------------------------
    ELIMINAR PERSONAL
    --------------------------------------------------------------
    */
    $('.btn-eliminar-destino').click(function(){
       let usu_id = $(this).attr('data-des-id');
       let usu_nombre = $(this).attr('data-des-nombre');
       $('#txt-des-nombre').html(usu_nombre);
       //form data
       action = $('#form-eliminar-destino').attr('data-simple-action');
       action = action+'/'+usu_id;
       $('#form-eliminar-destino').attr('action',action);
   });



});


</script>




@endsection
