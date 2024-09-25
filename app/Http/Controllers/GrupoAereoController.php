<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GrupoAereo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class GrupoAereoController extends Controller
{
    private $modulo = "grupos";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = GrupoAereo::all();      
        return view('grupos.lista_grupos', ['titulo'=>'ADMINISTRAR Grupos Aereos',
                                                          'grupos' => $grupos,
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
        $titulo = 'NUEVO GRUPO AEREO';

        return view('grupos.form_nuevo_grupo', ['titulo'=>$titulo, 
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
        //guardar grupo
        $grupo = new GrupoAereo();
        $grupo->gru_nombre = $request->input('gru_nombre');
        $grupo->gru_direccion = $request->input('gru_direccion');
        $grupo->gru_telefono = $request->input('gru_telefono');
        //guardar foto del grupo aereo en storage
        $disk = Storage::disk('public');
        $carpeta_grupo = 'docs_grupos/';
        $disk->makeDirectory($carpeta_grupo);
        $disk->put($carpeta_grupo.'/index.html', "<h2>Acceso no permitido</h2>");
        $uri_foto = $request->file('gru_foto')->storePublicly($carpeta_grupo, 'public'); // store encadenado

        $grupo->gru_foto = $uri_foto;
        $grupo->save();

        return redirect('grupos');
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
        $titulo = 'EDITAR GRUPO AEREO';
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $grupo = GrupoAereo::where('gru_id', $id)->first();

        return view('grupos.form_editar_grupo', ['titulo'=>$titulo, 
                                                    'grupo'=>$grupo,
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
        //guardar grupo
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $grupo = GrupoAereo::where('gru_id', $id)->first();
        $grupo->gru_nombre = $request->input('gru_nombre');
        $grupo->gru_direccion = $request->input('gru_direccion');
        $grupo->gru_telefono = $request->input('gru_telefono');
        //guardar foto del grupo aereo en storage
        $disk = Storage::disk('public');
        $carpeta_grupo = 'docs_grupos/';
        $disk->makeDirectory($carpeta_grupo);
        $disk->put($carpeta_grupo.'/index.html', "<h2>Acceso no permitido</h2>");
        $uri_foto = $request->file('gru_foto')->storePublicly($carpeta_grupo, 'public'); // store encadenado

        $grupo->gru_foto = $uri_foto;
        $grupo->save();

        return redirect('grupos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Crypt::decryptString($id);

        $grupo = GrupoAereo::where('gru_id', $id)->first();
        $grupo->delete();
        return redirect('grupos');
    }
}
