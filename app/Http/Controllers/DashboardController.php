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
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

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
