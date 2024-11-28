<?php

namespace App\Http\Controllers;

use App\Models\Aeronave;
use App\Models\CategoriaAeronave;
use App\Models\FabricanteAeronave;
use App\Models\aeronaveAereo;
use App\Models\Componente;
use App\Models\DetalleGrupoAeronave;
use App\Models\GrupoAereo;
use App\Models\InventarioAeronave;
use App\Models\TipoAeronave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class AeronaveController extends Controller
{
    private $modulo = "aeronaves";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('gru_id') == -1){
            $aeronaves = Aeronave::all();      
        }else{
            $grupo = GrupoAereo::where('gru_id', session('gru_id'))->first();
            $aeronaves = $grupo->aeronaves;
        }

        return view('aeronaves.lista_aeronaves', ['titulo'=>'ADMINISTRAR AERONAVES',
                                                          'aeronaves' => $aeronaves,
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
        $titulo = 'NUEVA AERONAVE';
        $grupos = GrupoAereo::all();
        $fabricantes = FabricanteAeronave::all();
        $tipos = TipoAeronave::all();
        $categorias = CategoriaAeronave::all();

        return view('aeronaves.form_nuevo_aeronave', ['titulo'=>$titulo, 
                                                      'grupos' => $grupos,
                                                      'fabricantes' => $fabricantes,
                                                      'tipos' => $tipos,
                                                      'categorias' => $categorias,
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
        //guardar aeronave
        $aeronave = new Aeronave();
        $aeronave->cae_id = $request->input('cae_id');
        $aeronave->tia_id = $request->input('tia_id');
        $aeronave->faa_id = $request->input('faa_id');
        $aeronave->ae_matricula = $request->input('ae_matricula');
        $aeronave->ae_serial_number = $request->input('ae_serial_number');
        $aeronave->ae_anio_fabricacion = $request->input('ae_anio_fabricacion');
        $aeronave->ae_nro_componentes = $request->input('ae_nro_componentes');
        $aeronave->ae_nro_componentes_mel = 0;
        $aeronave->ae_estado_matricula = $request->input('ae_estado_matricula');
        $aeronave->ae_pais_adquisicion = $request->input('ae_pais_adquisicion');
        $aeronave->ae_tipo_adquisicion = $request->input('ae_tipo_adquisicion');
        //guardar foto del aeronave aereo en storage
        $disk = Storage::disk('public');
        $carpeta_aeronave = 'docs_aeronaves/';
        $disk->makeDirectory($carpeta_aeronave);
        $disk->put($carpeta_aeronave.'/index.html', "<h2>Acceso no permitido</h2>");
        $uri_foto = $request->file('ae_foto')->storePublicly($carpeta_aeronave, 'public'); // store encadenado

        $aeronave->ae_foto = $uri_foto;
        $aeronave->save();

        $componente = new Componente();
        $componente->fac_id = null;
        $componente->com_part_number = $request->input("ae_part_number");
        $componente->com_serial_number = $request->input("ae_serial_number");
        $componente->com_descripcion = "AIRFRAME";
        // $componente->com_modelo = $request->input("-");
        //1=SLL Scrap, 2=SLL Overhaul, 3=shelf life, 4=OnCondition, 5=Conditionnin Monitoring 
        $componente->com_tipo_componente = 2; 
        $componente->com_master = 1;
        $componente->com_principal = 1;
        $componente->com_hv_ac_normales = 0;
        $componente->com_hv_ac_acrobaticas = 0;
        $componente->com_hv_ac_utilitarias = 0;
        $componente->com_hv_ac_landings = 0;
        $componente->save();

        $inventario = new InventarioAeronave();
        $inventario->com_id = $componente->com_id;
        $inventario->ae_id = $aeronave->ae_id;
        $inventario->ina_ubicacion = "ESTRUCTURA PRINCIPAL";
        $inventario->ina_fecha_instalacion = date('Y-m-d');
        $inventario->ina_observaciones_instalacion = "DE FABRICA";
        $inventario->save();

        $detalle = new DetalleGrupoAeronave();
        $detalle->gru_id = $request->input("gru_id");
        $detalle->ae_id = $aeronave->ae_id;
        $detalle->dga_fecha_cambio = date('Y-m-d');
        $detalle->save();

        return redirect('aeronaves');
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
        $id = Crypt::decryptString($id);
        $titulo = 'EDITAR AERONAVE';
        $grupos = GrupoAereo::all();
        $fabricantes = FabricanteAeronave::all();
        $tipos = TipoAeronave::all();
        $categorias = CategoriaAeronave::all();
        $aeronave = Aeronave::where('ae_id', $id)->first();

        return view('aeronaves.form_editar_aeronave', ['titulo'=>$titulo, 
                                                      'grupos' => $grupos,
                                                      'fabricantes' => $fabricantes,
                                                      'tipos' => $tipos,
                                                      'categorias' => $categorias,
                                                      'aeronave' => $aeronave,
                                                      'modulo_activo' => $this->modulo
                                                    ]);
    }

    public function edit_estado($id)
    {
        $id = Crypt::decryptString($id);
        $titulo = 'EDITAR ESTADO AERONAVE';
        $aeronave = Aeronave::where('ae_id', $id)->first();

        return view('aeronaves.form_editar_estado_aeronave', ['titulo'=>$titulo, 
                                                      'aeronave' => $aeronave,
                                                      'modulo_activo' => $this->modulo
                                                    ]);
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
        $id = Crypt::decryptString($id);
        //guardar aeronave
        $aeronave = Aeronave::where('ae_id', $id)->first();
        $aeronave->cae_id = $request->input('cae_id');
        $aeronave->tia_id = $request->input('tia_id');
        $aeronave->faa_id = $request->input('faa_id');
        $aeronave->ae_matricula = $request->input('ae_matricula');
        $aeronave->ae_serial_number = $request->input('ae_serial_number');
        $aeronave->ae_anio_fabricacion = $request->input('ae_anio_fabricacion');
        $aeronave->ae_nro_componentes = $request->input('ae_nro_componentes');
        $aeronave->ae_nro_componentes_mel = 0;
        $aeronave->ae_estado_matricula = $request->input('ae_estado_matricula');
        $aeronave->ae_pais_adquisicion = $request->input('ae_pais_adquisicion');
        $aeronave->ae_tipo_adquisicion = $request->input('ae_tipo_adquisicion');
        //guardar foto del aeronave aereo en storage
        $disk = Storage::disk('public');
        $carpeta_aeronave = 'docs_aeronaves/';
        $disk->makeDirectory($carpeta_aeronave);
        $disk->put($carpeta_aeronave.'/index.html', "<h2>Acceso no permitido</h2>");
        $uri_foto = $request->file('ae_foto')->storePublicly($carpeta_aeronave, 'public'); // store encadenado

        $aeronave->ae_foto = $uri_foto;
        $aeronave->save();


        $componente = $aeronave->componentes[0];
        $componente->fac_id = null;
        $componente->com_part_number = $request->input("ae_part_number");
        $componente->com_serial_number = $request->input("ae_serial_number");
        $componente->com_descripcion = "AIRFRAME";
        // $componente->com_modelo = $request->input("-");
        //1=SLL Scrap, 2=SLL Overhaul, 3=shelf life, 4=OnCondition, 5=Conditionnin Monitoring 
        $componente->com_tipo_componente = 2; 
        $componente->com_master = 1;
        $componente->com_principal = 1;
        // $componente->com_hv_ac_normales = 0;
        // $componente->com_hv_ac_acrobaticas = 0;
        // $componente->com_hv_ac_utilitarias = 0;
        // $componente->com_hv_ac_landings = 0;
        $componente->save();

        // $inventario = new InventarioAeronave();
        // $inventario->com_id = $componente->com_id;
        // $inventario->ae_id = $aeronave->ae_id;
        // $inventario->ina_ubicacion = "ESTRUCTURA PRINCIPAL";
        // $inventario->ina_fecha_instalacion = date('Y-m-d');
        // $inventario->ina_observaciones_instalacion = "DE FABRICA";
        // $inventario->save();

        // $detalle = new DetalleGrupoAeronave();
        // $detalle->gru_id = $request->input("gru_id");
        // $detalle->ae_id = $aeronave->ae_id;
        // $detalle->dga_fecha_cambio = date('Y-m-d');
        // $detalle->save();

        return redirect('aeronaves');
    }

    public function update_estado(Request $request, $id)
    {
        $id = Crypt::decryptString($id);
        //guardar aeronave
        $aeronave = Aeronave::where('ae_id', $id)->first();
        $aeronave->ae_estado_matricula = $request->input('ae_estado_matricula');
        $aeronave->save();

        return redirect('aeronaves');
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
