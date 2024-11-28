@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-id-card"></i>
        {{$titulo}}
        @if (Auth::user()->rol->rol_codigo == 3)
        <a href="{{url('personal/nuevo')}}" class="btn btn-sm btn-info float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO PERSONAL</a>
        @endif
    </h3>
    <div class="row">
        <div class="col-12">
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">

                        @if($personal->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tiene personal registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-bordered tabla-datos-clientes">
                                <thead>
                                <tr style="font-size:15px; text-align:center">
                                    <th>CI/CM</th>
                                    <th>GRADO Y NOMBRE COMPLETO</th>
                                    <th>ESPECIALIDAD</th>
                                    <th>NIVEL</th>
                                    <th>CARGO</th>
                                    @if (Auth::user()->rol->rol_codigo == 3)
                                    <th>OPCION</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($personal as $item)
                                <tr>
                                    <td>
                                        {{$item->funcionario->persona->per_ci}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->funcionario->grado->gra_abreviacion}} {{$item->funcionario->persona->per_nombres}} {{$item->funcionario->persona->per_primer_apellido}} {{$item->funcionario->persona->per_segundo_apellido}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->funcionario->especialidad->esp_descripcion}}
                                    </td>
                                    <td class="text-center">
                                        @if ($item->funcionario->fun_nivel == 0)
                                            OFICIAL
                                        @endif
                                        @if ($item->funcionario->fun_nivel == 3)
                                            TECNICO
                                        @endif
                                        @if ($item->funcionario->fun_nivel == 5)
                                            INSPECTOR
                                        @endif
                                        @if ($item->funcionario->fun_nivel == 7)
                                            SUPERVISOR
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{$item->cargo->car_nombre}} <br> 
                                        <small class="text-secondary">{{$item->cargo->unidad->uor_nombre}}</small><br>
                                        <sup class="text-info">{{$item->cargo->unidad->grupo->gru_nombre}}</sup>
                                    </td>
                                    @if (Auth::user()->rol->rol_codigo == 3)
                                    <td>
                                        <div class="dropdown">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            OPCION
                                          </button>
                                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{url('personal/'.Crypt::encryptString($item->unf_id).'/editar')}}"><i class="fa fa-edit"></i> Editar</a>
                                            @if ($item->asignaciones->count() > 0)
                                            <a class="dropdown-item disabled" href="#" title="Esta persona tiene registros asociados. NO es posible eliminarlo."><i class="fa fa-trash"></i> Eliminar</a>
                                            @else
                                            <a class="dropdown-item btn-eliminar-item" data-id="{{Crypt::encryptString($item->unf_id)}}" data-descripcion="{{$item->funcionario->persona->per_nombres}} {{$item->funcionario->persona->per_primer_apellido}} {{$item->funcionario->persona->per_segundo_apellido}}" data-toggle="modal" data-target="#modal-eliminar-personal" href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                            @endif
                                          </div>
                                        </div>
                                    </td>
                                    @endif
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


{{-- INICIO MODAL: ELIMINAR PERSONAL --}}
<div class="modal fade" id="modal-eliminar-personal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <form id="form-eliminar-item" action="{{url('personal')}}" data-simple-action="{{url('personal')}}" method="post">
            @method('delete')
            @csrf
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR PERSONAL --}}


<script type="text/javascript">
$(function(){
    /*
    -------------------------------------------------------------
    * CONFIGURACION DATA TABLES
    -------------------------------------------------------------
    */
    $('.tabla-datos-clientes').DataTable({"language":{url: '{{asset('js/datatables-lang-es.json')}}'}, "order": [[ 5, "desc" ]]});

    //Conf popover
    $('[data-toggle="popover"]').popover()

    /*
    --------------------------------------------------------------
    ELIMINAR PERSONAL
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
