<?php

namespace App\Http\Controllers;

use App\Models\Aeronave;
use App\Models\Componente;
use App\Models\ConfiguracionMantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ConfiguracionMantenimientoController extends Controller
{
    private $modulo = "aeronaves";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ae_id, $com_id)
    {
        $ae_id = Crypt::decryptString($ae_id);
        $com_id = Crypt::decryptString($com_id);
        $componente = Componente::where('com_id', $com_id)->first();
        $aeronave = Aeronave::where('ae_id', $ae_id)->first();
        $mantenimientos = ConfiguracionMantenimiento::where('com_id', $com_id)->get();

        return view('componentes.lista_mantenimientos', [
                                                        'titulo'=>'TIPOS DE MANTENIMIENTO',
                                                        'aeronave' => $aeronave,
                                                        'componente' => $componente,
                                                        'mantenimientos' => $mantenimientos,
                                                        'modulo_activo' => $this->modulo
                                                      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($ae_id, $com_id)
    {
        $ae_id = Crypt::decryptString($ae_id);
        $com_id = Crypt::decryptString($com_id);
        $aeronave = Aeronave::where('ae_id', $ae_id)->first();
        $componente = Componente::where('com_id', $com_id)->first();

        return view('componentes.form_nuevo_mantenimiento', [ 
                                                      'titulo'=>'NUEVO TIPO DE MANTENIMIENTO',
                                                      'aeronave' => $aeronave,
                                                      'componente' => $componente,
                                                      'modulo_activo' => $this->modulo
                                                       ]);
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

        $mantenimiento = new ConfiguracionMantenimiento();
        $mantenimiento->com_id = $com_id;
        $mantenimiento->cma_nombre_tipo_inspeccion = $request->input("cma_nombre_tipo");
        $mantenimiento->cma_horas_control = true;
        $mantenimiento->cma_horas_frecuencia = $request->input("cma_horas_frecuencia");
        $mantenimiento->cma_horas_cota_max = $request->input("cma_horas_cota_max");
        $mantenimiento->cma_unica_vez = $request->input("cma_unica_vez");
        $mantenimiento->cma_especial = $request->input("cma_especial");
        $mantenimiento->save();

        return redirect('aeronaves/'.Crypt::encryptString($ae_id).'/componentes/'.Crypt::encryptString($com_id).'/mantenimientos');
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
    public function destroy(Request $request, $id)
    {
        $id = Crypt::decryptString($id);
        $com_id = $request->input("com_id");
        $ae_id =  $request->input("ae_id");

        $mantenimiento = ConfiguracionMantenimiento::where('cma_id', $id)->first();
        $mantenimiento->delete();

        return redirect('aeronaves/'.Crypt::encryptString($ae_id).'/componentes/'.Crypt::encryptString($com_id).'/mantenimientos');
    }
}
