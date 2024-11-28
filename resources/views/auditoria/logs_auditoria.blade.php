@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-clock-o"></i>
        {{$titulo}}
    </h3>
    <div class="row">
        <div class="col-12">              
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        @if($logs->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tienen logs registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-bordered tabla-datos-clientes"  style="table-layout: fixed; width: 100%;">
                                <thead>
                                <tr>
                                    <th>OPERACION</th>
                                    <th>ID USUARIO</th>
                                    <th style="width: 50%">DESCRIPCION</th>
                                    <th>FECHA Y HORA</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $item)
                                <tr>
                                    <td class="text-center">
                                        {{$item->description}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->subject_id}}
                                    </td>
                                    <td>
                                        <small>
                                            {{$item->properties}}
                                        </small>
                                    </td>
                                    <td>
                                        {{$item->created_at}}
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




<script type="text/javascript">
$(function(){
    /*
    -------------------------------------------------------------
    * CONFIGURACION DATA TABLES
    -------------------------------------------------------------
    */
    $('.tabla-datos-clientes').DataTable({"language":{url: '{{asset('js/datatables-lang-es.json')}}'}, "order": [[ 3, "desc" ]]});

    //Conf popover
    $('[data-toggle="popover"]').popover()


});

</script>

@endsection
