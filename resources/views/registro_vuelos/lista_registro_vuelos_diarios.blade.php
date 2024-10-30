@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-th-large"></i>
        {{$titulo}}
        <a href="{{url('aeronaves')}}" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-chevron-left"></i> ATRAS</a>
        <a class="btn btn-sm btn-info float-right" style="margin-left:10px;"  data-toggle="modal" data-target="#modal-crear-rvd" href="#"><i class="fa fa-plus"></i> ABRIR REGISTRO DIARIO</a>
    </h3>
    <div class="row">
        <div class="col-12">              
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="alert alert-secondary">
                            <h4 class="text-center"><span class="text-info">MATRICULA AERONAVE:</span> {{$aeronave->ae_matricula}}</h4>
                        </div>
                        @if($rvds->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tienen registros de vuelo hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="table-responsive">
                            @php
                            $hv_ac_normales = 0;
                            $hv_ac_utilitarias = 0;
                            $hv_ac_acrobaticas = 0;
                            $hv_ac_landings = 0;
                            foreach ($rvds as $it) {
                                $rvus = $it->registros_vuelo;
                                foreach($rvus as $item){
                                    $hv_ac_normales = $hv_ac_normales + $item->rvu_normales;
                                    $hv_ac_acrobaticas = $hv_ac_acrobaticas + $item->rvu_acrobaticas;
                                    $hv_ac_utilitarias = $hv_ac_utilitarias + $item->rvu_utilitarias;
                                    $hv_ac_landings = $hv_ac_landings + $item->rvu_landings;
                                    // echo "N: ".$hv_ac_normales." A: ".$hv_ac_acrobaticas." U: ".$hv_ac_utilitarias." L: ".$hv_ac_landings."<br>";
                                }
                            }

                            $hna = intval($hv_ac_normales / 60);
                            $mna = $hv_ac_normales % 60;                                            
                            $haa = intval($hv_ac_acrobaticas / 60);
                            $maa = $hv_ac_acrobaticas % 60;                                            
                            $hua = intval($hv_ac_utilitarias / 60);
                            $mua = $hv_ac_utilitarias % 60;                                            
                            @endphp
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th colspan="4" class="text-center">ACUMULADOS DE LA AERONAVE</th>
                                </tr>
                                <tr>
                                    <th class="text-center">
                                        <small class="text-success">HRS NORMALES</small>                                        
                                        <br>
                                        <strong>{{$hna}}hrs {{$mna}}min</strong>
                                    </th>
                                    <th class="text-center">
                                        <small class="text-success">HRS ACROBATICAS</small>                                        
                                        <br>
                                        <strong>{{$haa}}hrs {{$maa}}min</strong>
                                    </th>
                                    <th class="text-center">
                                        <small class="text-success">HRS UTILITARIAS</small>                                        
                                        <br>
                                        <strong>{{$hua}}hrs {{$mua}}min</strong>
                                    </th>
                                    <th class="text-center">
                                        <small class="text-success">LANDINGS</small>                                        
                                        <br>
                                        <strong>{{$hv_ac_landings}}</strong>
                                    </th>
                                </tr>
                                </thead>                                
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered tabla-datos-clientes">
                                <thead>
                                <tr>
                                    <th>FECHA</th>
                                    <th># REGISTROS VUELO</th>
                                    <th>DIGITALIZADO</th>
                                    <th>FECHA REGISTRO</th>
                                    <th>OPCION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rvds as $item)
                                <tr>
                                    <td class="text-center">
                                        {{$item->rvd_fecha}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->registros_vuelo->count()}}
                                    </td>
                                    <td class="text-center">
                                        @if ($item->rvd_digitalizado == null)
                                        <small>[No cargado]</small>
                                        @else
                                        <a class="btn btn-info btn-sm" target="_blank" href="{{asset('storage/'.$item->rvd_digitalizado)}}"> <i class="fa fa-file"></i> Ver archivo</a>
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
                                            <a class="dropdown-item" href="{{url('rvds/'.Crypt::encryptString($item->rvd_id).'/rvus')}}"><i class="fa fa-clock-o"></i>  Ver registros de vuelo</a>
                                            <a class="dropdown-item" href="{{url('rvds/'.Crypt::encryptString($item->rvd_id).'/rvus/nuevo')}}"><i class="fa fa-plus"></i>  Agregar registro de vuelo</a>
                                            <a class="dropdown-item" href="{{url('rvds/'.Crypt::encryptString($item->rvd_id).'/nuevo_digitalizado')}}"><i class="fa fa-upload"></i>  Cargar digitalizado</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{url('rvds/'.Crypt::encryptString($item->rvd_id).'/editar')}}"><i class="fa fa-edit"></i> Editar</a>
                                            @if (count($item->registros_vuelo) > 0)
                                            <a class="dropdown-item disabled" title="No es posible eliminar este item. Tiene registros asociados." href="#"><i class="fa fa-trash"></i> Eliminar</a>                                               
                                            @else
                                            <a class="dropdown-item btn-eliminar-rvd" data-usu-id="{{Crypt::encryptString($item->rvd_id)}}" data-usu-nombre="{{$item->rvd_nombre}}" data-toggle="modal" data-target="#modal-eliminar-rvd" href="#"><i class="fa fa-trash"></i> Eliminar</a>
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


{{-- INICIO MODAL: NUEVO REGISTRO DE VUELO DIARIO --}}
<div class="modal fade" id="modal-crear-rvd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-plus"></i>
              ABRIR REGISTRO DIARIO
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-crear-rvd" action="{{url('rvds')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="alert alert-secondary">
                <h4 class="text-center"><span class="text-info">MATRICULA AERONAVE:</span> {{$aeronave->ae_matricula}}</h4>
            </div>

            <div class="form-group">
                <label class="label-blue label-block" for="">
                    Aperturar para fecha:
                    <span class="text-danger">*</span>
                    <i class="fa fa-question-circle float-right" title="Establecer la fecha del registro de vuelo diario"></i>
                </label>
                <input required type="date" value="{{old('rvd_fecha')}}" class="form-control @error('rvd_fecha') is-invalid @enderror" name="rvd_fecha" id="rvd_fecha" placeholder="Fecha del registro diario">
                @error('rvd_fecha')
                <div class="invalid-feedback">
                    {{$message}}
                </div>											
                @enderror
            </div>

        </div>
        <div class="modal-footer">
          <input type="hidden" id="ae_id" name="ae_id" value="{{$aeronave->ae_id}}">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Guardar datos</button>
        </div>
        </form>
    </div>
    </div>
  </div>
  {{-- FIN MODAL: NUEVO REGISTRO DE VUELO DIARIO --}}


{{-- INICIO MODAL: ELIMINAR MODALIDAD --}}
<div class="modal fade" id="modal-eliminar-rvd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar rvd
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">MATRICULA rvd: </span>
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
          <form id="form-eliminar-rvd" action="{{url('rvds')}}" data-simple-action="{{url('rvds')}}" method="post">
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
    ELIMINAR rvd
    --------------------------------------------------------------
    */
    $('.btn-eliminar-rvd').click(function(){
       let usu_id = $(this).attr('data-usu-id');
       let usu_nombre = $(this).attr('data-usu-nombre');
       $('#txt-usu-nombre').html(usu_nombre);
       //form data
       action = $('#form-eliminar-rvd').attr('data-simple-action');
       action = action+'/'+usu_id;
       $('#form-eliminar-rvd').attr('action',action);
   });



});


</script>




@endsection
