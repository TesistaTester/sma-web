@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-check"></i>
        {{$titulo}}
        <a href="{{url('aeronaves/'.Crypt::encryptString($aeronave->ae_id).'/componentes/'.Crypt::encryptString($componente->com_id).'/mantenimientos/'.Crypt::encryptString($mantenimiento->cma_id).'/nueva_inspeccion')}}" class="btn btn-sm btn-info float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVA INSPECCION</a>
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
                                    <h4>
                                        <span class="text-info">MANTENIMIENTO:</span> {{$mantenimiento->cma_nombre_tipo_inspeccion}}
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
                                    <h4>
                                        <span class="text-info">TOLERANCIA MAX.:</span> {{$mantenimiento->cma_horas_cota_max}} [HRS]
                                    </h4>        
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
                                    {{-- <th>TARJETAS</th> --}}
                                    <th>OPCION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($inspecciones as $item)
                                <tr>
                                    <td class="text-center">
                                        {{$item->ins_nombre}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->ins_descripcion}}
                                    </td>
                                    {{-- <td class="text-center">
                                        {{$item->tarjetas->count()}}
                                    </td> --}}
                                    <td>
                                        <div class="dropdown">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            OPCION
                                          </button>
                                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{url('inspecciones/'.Crypt::encryptString($item->ins_id).'/editar')}}"><i class="fa fa-edit"></i> Editar</a>
                                            @if ($item->ordenes->count() > 0)
                                            <a class="dropdown-item disabled" href="#" title="La inspeccion tiene registros asociados. NO es posible eliminarlo."><i class="fa fa-trash"></i> Eliminar</a>
                                            @else
                                            <a class="dropdown-item btn-eliminar-item" data-id="{{$item->ins_id}}" data-descripcion="{{$item->ins_nombre}}" data-toggle="modal" data-target="#modal-eliminar-inspeccion" href="#"><i class="fa fa-trash"></i> Eliminar</a>
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
