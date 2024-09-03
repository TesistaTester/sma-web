<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspeccion;
use App\Models\OrdenTrabajo;
use App\Models\TarjetaPlanificada;
use Illuminate\Support\Facades\Crypt;

class MonitoreoController extends Controller
{
    private $modulo = "monitoreo";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $inspecciones = Inspeccion::all();      
        return view('monitoreo.lista_inspecciones', ['titulo'=>'Monitoreo de inspecciones',
                                                          'inspecciones' => $inspecciones,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $titulo = 'TABLERO DE INSPECCIÓN';
        $id = Crypt::decryptString($id);
        $inspeccion = Inspeccion::where('ins_id', $id)->first();
        $ordenes = OrdenTrabajo::where('ins_id', $id)->get();
        return view('monitoreo.tablero_inspeccion', ['titulo'=>$titulo, 
                                                   'inspeccion' => $inspeccion,
                                                   'ordenes' => $ordenes,
                                                   'modulo_activo' => $this->modulo
                                                 ]);
    }

    public function tablero_orden($id){
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $titulo = 'TABLERO DE ORDEN DE TRABAJO';
        $id = Crypt::decryptString($id);
        $orden = OrdenTrabajo::where('ort_id', $id)->first();
        $actividades = TarjetaPlanificada::where('ort_id', $id)->get();
        return view('monitoreo.tablero_actividades', ['titulo'=>$titulo, 
                                                   'orden' => $orden,
                                                   'actividades' => $actividades,
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
        //
    }
}
