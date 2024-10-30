<?php

namespace App\Http\Controllers;

use App\Models\Aeronave;
use App\Models\Componente;
use App\Models\FabricanteComponente;
use App\Models\InventarioAeronave;
use App\Models\RegistroVueloComponente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ComponenteController extends Controller
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
        $aeronave = Aeronave::where('ae_id', $id)->first();
        $componentes = Componente::all();
        return view('componentes.lista_componentes', [
                                                        'titulo'=>'INVENTARIO DE COMPONENTES',
                                                        'aeronave' => $aeronave,
                                                        'componentes' => $componentes,
                                                        'modulo_activo' => $this->modulo
                                                      ]);
    }


    public function trazabilidad($id, $id2)
    {
        $id = Crypt::decryptString($id);
        $id2 = Crypt::decryptString($id2);
        $aeronave = Aeronave::where('ae_id', $id)->first();
        $componente = Componente::where('com_id', $id2)->first();
        $historial = InventarioAeronave::where('com_id', $id2)->get();
        return view('componentes.lista_trazabilidad', [
                                                        'titulo'=>'TRAZABILIDAD DEL COMPONENTE',
                                                        'aeronave' => $aeronave,
                                                        'componente' => $componente,
                                                        'historial' => $historial,
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
        $aeronave = Aeronave::where('ae_id', $id)->first();

        $titulo = 'NUEVA COMPONENTE';
        $fabricantes = FabricanteComponente::all();

        return view('componentes.form_nuevo_componente', ['titulo'=>$titulo, 
                                                      'aeronave' => $aeronave,
                                                      'fabricantes' => $fabricantes,
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
        $componente = new Componente();
        $componente->fac_id = $request->input("fac_id");
        $componente->com_part_number = $request->input("com_part_number");
        $componente->com_serial_number = $request->input("com_serial_number");
        $componente->com_descripcion = $request->input("com_descripcion");
        //1=SLL Scrap, 2=SLL Overhaul, 3=shelf life, 4=OnCondition, 5=Condition Monitoring 
        $componente->com_tipo_componente = $request->input("com_tipo_componente"); 
        $componente->com_master = 0;
        $componente->com_principal = $request->input("com_principal");
        $componente->com_hv_ac_normales = 0;
        $componente->com_hv_ac_acrobaticas = 0;
        $componente->com_hv_ac_utilitarias = 0;
        $componente->com_hv_ac_landings = 0;
        $componente->save();

        $inventario = new InventarioAeronave();
        $inventario->com_id = $componente->com_id;
        $inventario->ae_id = $request->input("ae_id");
        $inventario->ina_ubicacion = $request->input("ina_ubicacion");
        $inventario->ina_ci_responsable_instalacion = $request->input("ina_ci_resposable_instalacion");
        $inventario->ina_fecha_instalacion = $request->input("ina_fecha_instalacion");
        $inventario->ina_observaciones_instalacion = $request->input("ina_observaciones_instalacion");
        $inventario->save();

        return redirect('aeronaves/'.Crypt::encryptString($request->input("ae_id")).'/componentes');
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

    public function horas_vuelo($id)
    {
        $id = Crypt::decryptString($id);
        $rvcs = RegistroVueloComponente::where('com_id', $id)->get();
        $componente = Componente::where('com_id', $id)->first();
        return view('componentes.lista_registro_vuelos', [ 
                                                        'titulo'=>'REGISTROS DE VUELO DEL COMPONENTE',
                                                        'componente' => $componente,
                                                        'rvcs' => $rvcs,
                                                        'modulo_activo' => $this->modulo
                                                      ]);
    }


}
