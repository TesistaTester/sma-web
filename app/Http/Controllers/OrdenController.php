<?php

namespace App\Http\Controllers;

use App\Models\Inspeccion;
use App\Models\OrdenTrabajo;
use App\Models\PersonalOrdenTrabajo;
use App\Models\Tarjeta;
use App\Models\TarjetaPlanificada;
use App\Models\UnidadFuncionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\TryCatch;

class OrdenController extends Controller
{
    private $modulo = "ordenes";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //verificar si esta logueado el usuario

        $ordenes = OrdenTrabajo::all();      
        return view('ordenes.lista_ordenes', ['titulo'=>'Gestionar ordenes de trabajo',
                                                          'ordenes' => $ordenes,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //verificar si esta logueado el usuario

        $titulo = 'NUEVA ORDEN DE TRABAJO';
        $inspecciones = Inspeccion::all();
        $tarjetas = Tarjeta::all();
        $personal = UnidadFuncionario::all();
        $supervisores = DB::table('persona')
                          ->join('funcionario', 'persona.per_id', '=', 'funcionario.per_id')
                          ->join('unidad_funcionario', 'funcionario.fun_id', '=', 'unidad_funcionario.fun_id')
                          ->join('grado', 'grado.gra_id', '=', 'funcionario.gra_id')
                          ->select('persona.*', 'funcionario.*', 'unidad_funcionario.*', 'grado.*')
                          ->where('funcionario.fun_nivel', 7)
                          ->get();
        $inspectores = DB::table('persona')
                          ->join('funcionario', 'persona.per_id', '=', 'funcionario.per_id')
                          ->join('unidad_funcionario', 'funcionario.fun_id', '=', 'unidad_funcionario.fun_id')
                          ->join('grado', 'grado.gra_id', '=', 'funcionario.gra_id')
                          ->select('persona.*', 'funcionario.*', 'unidad_funcionario.*', 'grado.*')
                          ->where('funcionario.fun_nivel', 5)
                          ->get();
        $tecnicos = DB::table('persona')
                          ->join('funcionario', 'persona.per_id', '=', 'funcionario.per_id')
                          ->join('unidad_funcionario', 'funcionario.fun_id', '=', 'unidad_funcionario.fun_id')
                          ->join('grado', 'grado.gra_id', '=', 'funcionario.gra_id')
                          ->select('persona.*', 'funcionario.*', 'unidad_funcionario.*', 'grado.*')
                          ->where('funcionario.fun_nivel', 3)
                          ->orWhere('funcionario.fun_nivel', 5)
                          ->orWhere('funcionario.fun_nivel', 7)
                          ->get();

        $tarjetas = Tarjeta::all();

        return view('ordenes.form_nueva_orden', ['titulo'=>$titulo, 
                                                   'inspecciones' => $inspecciones,
                                                   'tarjetas' => $tarjetas,
                                                   'personal' => $personal,
                                                   'supervisores' => $supervisores,
                                                   'inspectores' => $inspectores,
                                                   'tecnicos' => $tecnicos,
                                                   'tarjetas' => $tarjetas,
                                                   'modulo_activo' => $this->modulo
                                                 ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //verificar si esta logueado el usuario

        // try {
        //     //guardar unidad
            $orden = new OrdenTrabajo();
            $orden->ort_matricula = $request->input('ort_matricula');
            $orden->ins_id = $request->input('ins_id');
            $orden->ort_serial_number_aeronave = $request->input('ort_serial_number_aeronave');
            $orden->ort_tiempo_total_aeronave = $request->input('ort_tiempo_total_aeronave');
            $orden->ort_ciclos_total_aeronave = $request->input('ort_ciclos_total_aeronave');
            $orden->ort_descripcion_trabajo = $request->input('ort_descripcion_trabajo');
            $orden->ort_lugar = $request->input('ort_lugar');
            $orden->ort_fecha = $request->input('ort_fecha');
            $orden->ort_fecha_programada = $request->input('ort_fecha_programada');
            $orden->ort_cite = $request->input('ort_cite');
            $orden->ort_tipo = $request->input('ort_tipo');
            $orden->tar_id = $request->input('tar_id');
            $orden->ort_avance = 0;
            $orden->save();

            //supervisor
            $supervisor = new PersonalOrdenTrabajo();
            $supervisor->unf_id = $request->input('ort_supervisor');
            $supervisor->ort_id = $orden->ort_id;
            $supervisor->pot_tipo = "7";
            $supervisor->save();
            //inspectores
            $inspectores_json = json_decode($request->input('ort_inspectores'));
            foreach($inspectores_json as $item){
                $inspector = new PersonalOrdenTrabajo();
                $inspector->unf_id = $item->inp_id;
                $inspector->ort_id = $orden->ort_id;
                $inspector->pot_tipo = "5";
                $inspector->save();    
            }
            //tecnicos
            $tecnicos_json = json_decode($request->input('ort_tecnicos'));
            foreach($tecnicos_json as $item){
                $tecnicos = new PersonalOrdenTrabajo();
                $tecnicos->unf_id = $item->tec_id;
                $tecnicos->ort_id = $orden->ort_id;
                $tecnicos->pot_tipo = "3";
                $tecnicos->save();    
            }

            //tarjetas planificadas
            $tar_id = $request->input('tar_id');
            $tarjeta = Tarjeta::where('tar_id', $tar_id)->first();
            $actividades = $tarjeta->tarjetas_capitulo;
            foreach($actividades as $item){
                $planificada = new TarjetaPlanificada();
                $planificada->tac_id = $item->tac_id;
                $planificada->ort_id = $orden->ort_id;
                $planificada->tap_estado = 0;
                $planificada->tap_tiempo_trabajo = 0;
                $planificada->tap_descripcion = '';
                $planificada->save();
            }

            return response()->json(['status'=>'1','destino'=> url('ordenes')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function imprimir_hoja1($id)
    {
        $id = Crypt::decryptString($id);
        $orden = OrdenTrabajo::where('ort_id', $id)->first();
        $titulo = "Orden de trabajo (Página 1)";
        return view('ordenes.orden_pagina1', ['titulo'=>$titulo, 
                                            'orden' => $orden,
                                            'modulo_activo' => $this->modulo
                                             ]);
    }

    public function imprimir_hoja3($id)
    {
        $id = Crypt::decryptString($id);
        $orden = OrdenTrabajo::where('ort_id', $id)->first();
        $titulo = "Designacion de personal (Página 3)";
        return view('ordenes.orden_pagina3', ['titulo'=>$titulo, 
                                            'orden' => $orden,
                                            'modulo_activo' => $this->modulo
                                             ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    public function subir_digital(Request $request, $id)
    {
        //verificar si esta logueado el usuario

        //Guardar digitalizado       
        if($request->file('ort_documento_ruta')) {
            $ruta_archivo = $request->file('ort_documento_ruta')->store('archivos_ordenes', 'public'); // store encadenado
        }else{
            $ruta_archivo = "-";
        }

        //guardar tarjeta
        $orden = OrdenTrabajo::where('ort_id', $id)->first();
        $orden->ort_documento_ruta = $ruta_archivo;
        $orden->save();
        return redirect('ordenes');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //verificar si esta logueado el usuario
        $orden = OrdenTrabajo::where('ort_id', $id)->first();
        $personal = PersonalOrdenTrabajo::where('ort_id', $orden->ort_id)->get();
        foreach($personal as $item){
            $item->delete();
        }
        $tarjetas = TarjetaPlanificada::where('ort_id', $orden->ort_id)->get();
        foreach($tarjetas as $item){
            $item->delete();
        }   
        $orden->delete();
        return redirect('ordenes');
    }
}
