<?php

namespace App\Http\Controllers;

use App\Models\Aeronave;
use App\Models\Componente;
use App\Models\RegistroVuelo;
use App\Models\RegistroVueloComponente;
use App\Models\RegistroVueloDiario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class RegistroVueloController extends Controller
{
    private $modulo = "aeronaves";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $id = Crypt::decryptString($id);
        $rvd = RegistroVueloDiario::where('rvd_id', $id)->first();
        $aeronave = $rvd->aeronave;
        $rvus = RegistroVuelo::where('rvd_id', $rvd->rvd_id)->get();      
        return view('registro_vuelos.lista_registro_vuelos', [ 
                                                        'titulo'=>'REGISTROS DE VUELO DIARIO',
                                                        'aeronave' => $aeronave,
                                                        'rvd' => $rvd,
                                                        'rvus' => $rvus,
                                                        'modulo_activo' => $this->modulo
                                                      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $id = Crypt::decryptString($id);
        $rvd = RegistroVueloDiario::where('rvd_id', $id)->first();

        $aeronave = $rvd->aeronave;
        $componentes = DB::table('aeronave')
        ->join('inventario_aeronave', 'aeronave.ae_id', '=', 'inventario_aeronave.ae_id')
        ->join('componente', 'inventario_aeronave.com_id', '=', 'componente.com_id')
        ->select('componente.com_id')
        ->where('aeronave.ae_id', 1)
        ->get();

        return view('registro_vuelos.form_nuevo_registro_vuelo', [ 
                                                                'titulo'=>'NUEVO REGISTRO DE VUELO',
                                                                'aeronave' => $aeronave,
                                                                'rvd' => $rvd,
                                                                'componentes' => $componentes,
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
        $rvu = new RegistroVuelo();
        $rvu->rvd_id = $request->input("rvd_id");
        $rvu->rvu_fecha = $request->input("rvd_fecha");

        $normales_horas = $request->input("rvu_normales_horas");
        $normales_minutos = intval($request->input("rvu_normales_minutos"))+($normales_horas*60);
        $utilitarias_horas = $request->input("rvu_utilitarias_horas");
        $utilitarias_minutos = intval($request->input("rvu_utilitarias_minutos"))+($utilitarias_horas*60);
        $acrobaticas_horas = $request->input("rvu_acrobaticas_horas");
        $acrobaticas_minutos = intval($request->input("rvu_acrobaticas_minutos"))+($acrobaticas_horas*60);

        $rvu->rvu_normales = $normales_minutos;
        $rvu->rvu_utilitarias = $utilitarias_minutos;
        $rvu->rvu_acrobaticas = $acrobaticas_minutos;
        $rvu->rvu_landings = $request->input("rvu_acrobaticas_horas");
        $rvu->rvu_observacion = $request->input("rvu_observacion");
        $rvu->save();

        $ae_id = $request->input("ae_id");

        //obtenemos los componentes
        $componentes = DB::table('aeronave')
        ->join('inventario_aeronave', 'aeronave.ae_id', '=', 'inventario_aeronave.ae_id')
        ->join('componente', 'inventario_aeronave.com_id', '=', 'componente.com_id')
        ->select('componente.com_id')
        ->where('aeronave.ae_id', $ae_id)
        ->get();

        //agregamos los registros de vuelo por componente
        foreach($componentes as $item){
            $rvc = new RegistroVueloComponente();
            $rvc->com_id = $item->com_id;
            $rvc->rvu_id = $rvu->rvu_id;
            $rvc->rvc_normales = $rvu->rvu_normales ;
            $rvc->rvc_acrobaticas = $rvu->rvu_acrobaticas ;
            $rvc->rvc_utilitarias = $rvu->rvu_utilitarias ;
            $rvc->rvc_landings = $rvu->rvu_landings ;
            $rvc->rvc_fecha = $rvu->rvu_fecha;
            $rvc->save();
            //actualizamos los acumulados de cada componente
            $componente = Componente::where('com_id', $item->com_id)->first();
            $componente->com_hv_ac_normales = $componente->com_hv_ac_normales + $rvc->rvc_normales; 
            $componente->com_hv_ac_acrobaticas = $componente->com_hv_ac_acrobaticas + $rvc->rvc_acrobaticas; 
            $componente->com_hv_ac_utilitarias = $componente->com_hv_ac_utilitarias + $rvc->rvc_utilitarias; 
            $componente->com_hv_ac_landings = $componente->com_hv_ac_landings + $rvc->rvc_landings;
            $componente->save(); 

        }

        return redirect('rvds/'.Crypt::encryptString($request->input("rvd_id")).'/rvus');
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
