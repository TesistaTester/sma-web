@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-wrench"></i>
        {{$titulo}}
        <a href="{{url('ordenes/nuevo')}}" class="btn btn-sm btn-info float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVA ORDEN DE TRABAJO</a>
    </h3>
    <div class="row">
        <div class="col-12">
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        @if($ordenes->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tiene ordenes registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="table-responsive">
                          <table class="table table-bordered tabla-datos">
                            <thead>
                            <tr style="font-size:15px; text-align:center;">
                                <th>MATRICULA</th>
                                <th>NRO ORDEN</th>
                                <th>HORAS</th>
                                <th>CICLOS</th>
                                <th>TIPO</th>
                                <th># ACTIVIDADES</th>
                                <th>% AVANCE</th>
                                <th>OPCION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ordenes as $item)
                                <tr>                                
                                <td class="text-center">
                                    {{$item->ort_matricula}}
                                </td>
                                <td class="text-center">
                                    {{$item->ort_cite}}
                                </td>
                                <td class="text-center">
                                {{intdiv($item->ort_tiempo_total_aeronave, 60)}}:{{(int)($item->ort_tiempo_total_aeronave)%60}}
                                </td>
                                <td class="text-center">
                                {{($item->ort_ciclos_total_aeronave%60)}}
                                </td>
                                <td class="text-center">
                                    @if($item->ort_tipo == 1)
                                    NORMAL
                                    @endif
                                    @if($item->ort_tipo == 2)
                                    NO RUTINARIA
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{$item->tarjetas_planificadas->count()}}
                                </td>
                                <td class="text-center">
                                    {{$item->ort_avance}}%
                                    <br>
                                    @if($item->ort_avance == 100)
                                        @if($item->ort_documento_ruta == "")
                                        <small>&laquo;Digital no cargado&raquo;</small>
                                        @else
                                        <small>
                                          @if(config('wop.disco') == 'public')
                                          <a class="btn btn-sm btn-link" target="_blank" href="{{asset('storage/'.$item->ort_documento_ruta)}}">
                                          @else    
                                          <a class="btn btn-sm btn-link" target="_blank" href="{{Storage::disk('gcs')->temporaryUrl($item->ort_documento_ruta,  now()->addMinutes(10))}}">
                                          @endif  
                                                <i class="fa fa-download"></i>
                                                Ver archivo
                                            </a>
                                        </small>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        OPCION
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        @if(config('wop.disco') == 'public')
                                        <a class="dropdown-item btn-imprimir-item" data-id="{{Crypt::encryptString($item->ort_id)}}" data-descripcion="{{$item->ort_cite}}" data-toggle="modal" data-target="#modal-imprimir-orden" data-tarjeta-link="{{asset('storage/'.$item->tarjeta->tar_digitalizado)}}" href="#"><i class="fa fa-print"></i> Imprimir orden</a>
                                        @else    
                                        <a class="dropdown-item btn-imprimir-item" data-id="{{Crypt::encryptString($item->ort_id)}}" data-descripcion="{{$item->ort_cite}}" data-toggle="modal" data-target="#modal-imprimir-orden" data-tarjeta-link="{{Storage::disk(config('wop.disco'))->temporaryUrl($item->tarjeta->tar_digitalizado,  now()->addMinutes(10))}}" href="#"><i class="fa fa-print"></i> Imprimir orden</a>
                                        @endif    
                                        @if($item->ort_avance < 100)
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn-eliminar-item" data-id="{{$item->ort_id}}" data-descripcion="{{$item->ort_cite}}" data-toggle="modal" data-target="#modal-eliminar-orden" href="#"><i class="fa fa-trash"></i> Anular orden</a>
                                        @endif
                                        @if($item->ort_avance == 100)
                                            {{-- @if($item->ort_documento_ruta == "") --}}
                                            <a class="dropdown-item btn-subir-orden" data-id="{{$item->ort_id}}" data-descripcion="{{$item->ort_cite}}" data-toggle="modal" data-target="#modal-subir-orden" href="#"><i class="fa fa-upload"></i> Subir digitalizado</a>
                                            {{-- @endif --}}
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


{{-- INICIO MODAL: IMPRIMIR ORDEN --}}
<div class="modal fade" id="modal-imprimir-orden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-print"></i>
              Imprimir orden de trabajo
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">DESCRIPCION: </span>
                    <span id="txt-descripcion-imprimir"></span><br>
                </h5>
            </div>
            <hr>
            <div class="row text-center">
              <div class="col-md-10 offset-md-1">
                <a target="_blank" id="link-1" class="btn btn-sm btn-info btn-block" data-simple-action="{{url('ordenes/print1/')}}" href="{{url('ordenes/print1/')}}"> <i class="fa fa-print"></i> Imprimir Orden (pág. 1)</a>
                <div style="margin-bottom:7px;"></div>
                <a target="_blank" id="link-2" class="btn btn-sm btn-info btn-block" href="{{asset('pdf/reverso_ot_tab-ea-nuevo.pdf')}}"> <i class="fa fa-print"></i> Imprimir Reverso (pag. 2)</a>
                <div style="margin-bottom:7px;"></div>
                <a target="_blank" id="link-3" class="btn btn-sm btn-info btn-block" data-simple-action="{{url('ordenes/print3/')}}" href="{{url('ordenes/print3/')}}"> <i class="fa fa-print"></i> Imprimir Designacion de Personal (pág. 3)</a>
                <div style="margin-bottom:7px;"></div>
                <a target="_blank" id="link-4" class="btn btn-sm btn-info btn-block" href=""> <i class="fa fa-print"></i> Imprimir Tarjeta de Inspeccion</a>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>
{{-- FIN MODAL: IMPRIMIR ORDEN --}}


{{-- INICIO MODAL: ELIMINAR orden --}}
<div class="modal fade" id="modal-eliminar-orden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <small>
                                Esta operación es irreversible y se eliminarán todos los registros del personal y actividades planificadas asociadas a la orden de trabajo.
                            </small>
                            <br>
                            ¿Está seguro que desea eliminar éste registro?
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <form id="form-eliminar-item" action="{{url('ordenes')}}" data-simple-action="{{url('ordenes')}}" method="post">
            @method('delete')
            @csrf
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
{{-- FIN MODAL: ELIMINAR orden --}}

{{-- INICIO MODAL: CARGAR ORDEN DIGITALIZADO --}}
<div class="modal fade" id="modal-subir-orden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-upload"></i>
              Subir orden digitalizada
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-subir-orden" enctype="multipart/form-data" action="{{url('ordenes/subir_digital')}}" data-simple-action="{{url('ordenes/subir_digital')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">ORDEN: </span>
                    <span id="txt-descripcion-subir"></span><br>
                </h5>
            </div>
            <br>
			<div class="form-group">
				<label class="label-blue label-block" for="">
				Cargar orden digitalizada en PDF:
				<span class="text-danger">*</span>
				<i class="fa fa-question-circle float-right" title="Establecer el archivo digitalizado de la orden"></i>
				</label>
				<input required type="file" value="{{old('ort_documento_ruta')}}" class="form-control @error('ort_documento_ruta') is-invalid @enderror" name="ort_documento_ruta" id="ort_documento_ruta" accept=".pdf">
				@error('ort_documento_ruta')
				<div class="invalid-feedback">
					{{$message}}
				</div>											
				@enderror
			</div>            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
            <button type="submit" class="btn btn-info"><i class="fa fa-upload"></i> Subir archivo</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: CARGAR ORDEN DIGITALIZADO --}}


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
    $('.btn-imprimir-item').click(function(){
       let usu_id = $(this).attr('data-id');
       let usu_nombre = $(this).attr('data-descripcion');
       let tarjeta_link = $(this).attr('data-tarjeta-link');
       $('#txt-descripcion-imprimir').html(usu_nombre);
       //generate links
       action1 = $('#link-1').attr('data-simple-action');
    //    action2 = $('#link-2').attr('data-simple-action');
       action3 = $('#link-3').attr('data-simple-action');
       action1 = action1+'/'+usu_id;
    //    action2 = action2+'/'+usu_id;
       action3 = action3+'/'+usu_id;
       $('#link-1').attr('href',action1);
    //    $('#link-2').attr('href',action2);
       $('#link-3').attr('href',action3);
       $('#link-4').attr('href',tarjeta_link);
   });
    $('.btn-eliminar-item').click(function(){
       let usu_id = $(this).attr('data-id');
       let usu_nombre = $(this).attr('data-descripcion');
       $('#txt-descripcion').html(usu_nombre);
       //form data
       action = $('#form-eliminar-item').attr('data-simple-action');
       action = action+'/'+usu_id;
       $('#form-eliminar-item').attr('action',action);
   });

   $('.btn-subir-orden').click(function(){
       let usu_id = $(this).attr('data-id');
       let usu_nombre = $(this).attr('data-descripcion');
       $('#txt-descripcion-subir').html(usu_nombre);
       //form data
       action = $('#form-subir-orden').attr('data-simple-action');
       action = action+'/'+usu_id;
       $('#form-subir-orden').attr('action',action);
   });


});


</script>




@endsection
