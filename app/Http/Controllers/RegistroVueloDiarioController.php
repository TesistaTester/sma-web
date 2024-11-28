<?php

namespace App\Http\Controllers;

use App\Models\Aeronave;
use App\Models\RegistroVueloDiario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class RegistroVueloDiarioController extends Controller
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
        $rvds = RegistroVueloDiario::where('ae_id', $id)->get();      
        return view('registro_vuelos.lista_registro_vuelos_diarios', [ 
                                                        'titulo'=>'REGISTROS DE VUELO DE LA AERONAVE',
                                                        'aeronave' => $aeronave,
                                                        'rvds' => $rvds,
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
        $rvd = new RegistroVueloDiario();
        $rvd->ae_id = $request->input("ae_id");
        $rvd->rvd_fecha = $request->input("rvd_fecha");
        $rvd->save();

        return redirect('aeronaves/'.Crypt::encryptString($request->input("ae_id")).'/rvds');
    }

    public function digitalizado($id)
    {
        $id = Crypt::decryptString($id);
        $rvd = RegistroVueloDiario::where('rvd_id', $id)->first();
        $aeronave = $rvd->aeronave;

        return view('registro_vuelos.form_nuevo_registro_digitalizado', [ 
                                                                'titulo'=>'NUEVO REGISTRO DE VUELO',
                                                                'aeronave' => $aeronave,
                                                                'rvd' => $rvd,
                                                                'modulo_activo' => $this->modulo
                                                                 ]);
    }


    public function store_digitalizado(Request $request)
    {        
        $rvd = RegistroVueloDiario::where('rvd_id', $request->input("rvd_id"))->first();
        //guardar foto del aeronave aereo en storage
        $disk = Storage::disk('public');
        $carpeta_rvds = 'docs_rvds_digitalizados/';
        $disk->makeDirectory($carpeta_rvds);
        $disk->put($carpeta_rvds.'/index.html', "<h2>Acceso no permitido</h2>");
        $uri_archivo = $request->file('rvd_digitalizado')->storePublicly($carpeta_rvds, 'public'); // store encadenado

        $rvd->rvd_digitalizado = $uri_archivo;
        $rvd->save();

        return redirect('aeronaves/'.Crypt::encryptString($request->input("ae_id")).'/rvds');
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
