<?php

namespace App\Http\Controllers;

use App\Models\Aeronave;
use Illuminate\Http\Request;
use App\Models\Componente;
use App\Models\Destino;
use App\Models\Foja;
use App\Models\Funcionario;
use App\Models\Grupo;
use App\Models\GrupoAereo;
use App\Models\Inspeccion;
use App\Models\OrdenTrabajo;
use App\Models\Personal;
use App\Models\RegistroVuelo;
use App\Models\Salida;
use App\Models\StockComponente;
use App\Models\Subalmacen;
use App\Models\TarjetaPlanificada;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $modulo = "dashboard";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Auth::user();
        $grupos = GrupoAereo::all();
        $aeronaves = Aeronave::all();
        $componentes = Componente::all();
        $registros_vuelo = RegistroVuelo::all();
        $personal = Funcionario::all();
        $inspecciones = Inspeccion::all();
        $ordenes = OrdenTrabajo::all();
        $tarjetas = TarjetaPlanificada::all();
        $titulo = "Panel de inicio";

        //contadores
        $aero_m = 0;
        $aero_w = 0;
        $aero_p = 0;

        //inspecciones proximas y vencidas
        $vencidas = 0;
        $proximas = 0;

        foreach($aeronaves as $witem){
            if($witem->ae_estado_matricula == 'M'){
                $aero_m = $aero_m + 1;
            }
            if($witem->ae_estado_matricula == 'W'){
                $aero_w = $aero_w + 1;
            }
            if($witem->ae_estado_matricula == 'P'){
                $aero_p = $aero_p + 1;
            }

            $aeronave = $witem;
            $componentes = $aeronave->componentes;
    
            $inspecs = collect();
    
            foreach($componentes as $item){
                foreach($item->configuraciones_mantenimiento as $kitem){
                    foreach($kitem->inspecciones as $sitem){
                        $inspecs->push($sitem);
                    }
                }
            }

            //estas son las inspecciones de la aeronave
            $inspecciones = $inspecs->sortBy('ins_hora_componente');        

            //estas son las horas de la aeronave
            $horas = 0;
            foreach($aeronave->horas_diario as $item){
                foreach($item->registros_vuelo as $ritem){
                    // echo $ritem;
                    // echo $ritem->rvu_horas_normales;
                    $horas = $horas + $ritem->rvu_normales;
                }
            }
    
            foreach($inspecciones as $item){
                if((round($horas/60,0) > ($item->ins_hora_componente - 5)) &&(round($horas/60,0) < ($item->ins_hora_componente))){
                    $proximas = $proximas + 1;
                }
                if(round($horas/60,0) > ($item->ins_hora_componente)){
                    $vencidas = $vencidas + 1;
                }
            }

            
        }
        


        return view('dashboard.detalle_tablero', [
                                                    'usuarios'=>$usuarios, 
                                                    'titulo'=>$titulo, 
                                                    'grupos'=> $grupos,
                                                    'aeronaves'=> $aeronaves,
                                                    'componentes'=> $componentes,
                                                    'registros_vuelo'=> $registros_vuelo,
                                                    'personal'=>$personal,
                                                    'tarjetas' => $tarjetas,
                                                    'ordenes' => $ordenes,
                                                    'inspecciones' => $inspecciones,
                                                    'modulo_activo' => $this->modulo,
                                                    'aero_w' => $aero_w,
                                                    'aero_m' => $aero_m,
                                                    'aero_p' => $aero_p,
                                                    'vencidas' => $vencidas,
                                                    'proximas' => $proximas,
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
