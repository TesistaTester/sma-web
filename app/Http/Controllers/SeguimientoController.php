<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenTrabajo;
use App\Models\TarjetaPlanificada;
use Illuminate\Support\Facades\Crypt;

class SeguimientoController extends Controller
{
    private $modulo = "seguimientos";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $ordenes = OrdenTrabajo::all();      
        return view('seguimientos.lista_ordenes', ['titulo'=>'Seguimiento a ordenes de trabajo',
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

        $titulo = 'TABLERO DE ORDEN DE TRABAJO';
        $id = Crypt::decryptString($id);
        $orden = OrdenTrabajo::where('ort_id', $id)->first();
        $actividades = TarjetaPlanificada::where('ort_id', $id)->get();
        return view('seguimientos.tablero_actividades', ['titulo'=>$titulo, 
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

    public function a_desarrollo(Request $request)
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $id = $request->input('tap_id');
        $actividad = TarjetaPlanificada::where('tap_id', $id)->first();
        $actividad->tap_estado = 1;
        $actividad->save();

        $ort_id = $request->input('ort_id');
        $this->update_avance($ort_id);

        return redirect('seguimientos/'.Crypt::encryptString($ort_id));
    }

    public function back_desarrollo(Request $request)
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $id = $request->input('tap_id');
        $ort_id = $request->input('ort_id');
        $actividad = TarjetaPlanificada::where('tap_id', $id)->first();
        $actividad->tap_estado = 1;
        $actividad->tap_horas_hombre = 0;
        $actividad->save();
        $this->update_avance($ort_id);

        return redirect('seguimientos/'.Crypt::encryptString($ort_id));
    }

    public function back_realizar(Request $request)
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $id = $request->input('tap_id');
        $ort_id = $request->input('ort_id');

        $actividad = TarjetaPlanificada::where('tap_id', $id)->first();
        $actividad->tap_estado = 0;
        $actividad->save();
        $this->update_avance($ort_id);

        return redirect('seguimientos/'.Crypt::encryptString($ort_id));
    }


    public function a_concluido(Request $request)
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $id = $request->input('tap_id');
        $ort_id = $request->input('ort_id');
        $actividad = TarjetaPlanificada::where('tap_id', $id)->first();
        $minutos_hombre = $request->input('tap_horas_hombre')*60;
        $minutos_hombre = $minutos_hombre + $request->input('tap_minutos_hombre');
        $actividad->tap_horas_hombre = $minutos_hombre;
        $actividad->tap_estado = 2;
        $actividad->save();
        $this->update_avance($ort_id);

        return redirect('seguimientos/'.Crypt::encryptString($ort_id));

    }

    public function update_avance($ort_id){
        $orden = OrdenTrabajo::where('ort_id', $ort_id)->first();
        $actividades = TarjetaPlanificada::where('ort_id', $ort_id)->get();
        $total = $actividades->count();
        $terminados = 0;
        foreach($actividades as $item){
            if($item->tap_estado == 2){
                $terminados++;
            }
        }
        $avance = (round($terminados/$total, 2)*100);
        $orden->ort_avance = $avance;
        $orden->save();
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
