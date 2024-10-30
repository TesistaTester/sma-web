<?php

namespace App\Http\Controllers;

use App\Models\Aeronave;
use App\Models\Componente;
use App\Models\ServicioComponente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ServicioComponenteController extends Controller
{
    private $modulo = "aeronaves";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $id1)
    {
        $id = Crypt::decryptString($id);
        $id1 = Crypt::decryptString($id1);
        $componente = Componente::where('com_id', $id1)->first();
        $aeronave = Aeronave::where('ae_id', $id)->first();
        $servicios = ServicioComponente::where('com_id', $id)->get();
        $servicio_antiguo = ServicioComponente::where('com_id', $id1)->latest()->first();

        return view('componentes.lista_servicios', [
                                                        'titulo'=>'TIEMPOS DE SERVICIO DEL COMPONENTE',
                                                        'aeronave' => $aeronave,
                                                        'componente' => $componente,
                                                        'servicios' => $servicios,
                                                        'servicio_antiguo' => $servicio_antiguo,
                                                        'modulo_activo' => $this->modulo
                                                      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $id1)
    {
        $ae_id = Crypt::decryptString($id);
        $com_id = Crypt::decryptString($id1);
        $aeronave = Aeronave::where('ae_id', $ae_id)->first();
        $componente = Componente::where('com_id', $com_id)->first();

        return view('componentes.form_nuevo_servicio', [ 
                                                      'titulo'=>'NUEVO TIEMPO DE SERVICIO',
                                                      'aeronave' => $aeronave,
                                                      'componente' => $componente,
                                                      'modulo_activo' => $this->modulo
                                                       ]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $ae_id, $com_id)
    {
        $ae_id = Crypt::decryptString($ae_id);
        $com_id = Crypt::decryptString($com_id);

        $servicio_antiguo = ServicioComponente::where('com_id', $com_id)->latest()->first();
        if($servicio_antiguo != null){
            $servicio_antiguo->sec_activo = false;
            $servicio_antiguo->save();
        }

        $servicio = new ServicioComponente();
        $servicio->com_id = $com_id;
        $servicio->sec_fecha_ultimo_overhaul = $request->input("sec_fecha_ultimo_overhaul");
        $servicio->sec_fecha_primera_instalacion = $request->input("sec_fecha_primera_instalacion");
        // $servicio->sec_fecha_fabricacion = $request->input("sec_fecha_fabricacion");
        $servicio->sec_horas_normales_control = $request->input("sec_horas_normales_control");
        $servicio->sec_horas_normales_tope = $request->input("sec_horas_normales_tope");
        $servicio->sec_horas_acrobaticas_control = $request->input("sec_horas_acrobaticas_control");
        $servicio->sec_horas_acrobaticas_tope = $request->input("sec_horas_acrobaticas_tope");
        $servicio->sec_horas_utilitarias_control = $request->input("sec_horas_utilitarias_control");
        $servicio->sec_horas_utilitarias_tope = $request->input("sec_horas_utilitarias_tope");
        $servicio->sec_landings_control = $request->input("sec_landings_control");
        $servicio->sec_landings_tope = $request->input("sec_landings_tope");
        $servicio->sec_dias_control = $request->input("sec_dias_control");
        $servicio->sec_dias_tope = $request->input("sec_dias_tope");
        $servicio->sec_fecha_vencimiento_control = $request->input("sec_fecha_vencimiento_control");
        $servicio->sec_fecha_vencimiento_tope = $request->input("sec_fecha_vencimiento_tope");
        $servicio->save();

        return redirect('aeronaves/'.Crypt::encryptString($ae_id).'/componentes/'.Crypt::encryptString($com_id).'/servicios');
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
