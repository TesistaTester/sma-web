<?php

namespace App\Http\Controllers;

use App\Models\Inspeccion;
use App\Models\Tarjeta;
use App\Models\TarjetaCapitulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class TarjetaController extends Controller
{
    private $modulo = "tarjetas";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $tarjetas = Tarjeta::all();      
        return view('tarjetas.lista_tarjetas', ['titulo'=>'Gestionar tarjetas de inspección',
                                                          'tarjetas' => $tarjetas,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    public function lista_actividades($tar_id)
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $tar_id = Crypt::decryptString($tar_id);//Desencriptando parametro ID
        $tarjeta = Tarjeta::where('tar_id', $tar_id)->first();      
        $actividades = TarjetaCapitulo::where('tar_id', $tar_id)->get();      
        return view('tarjetas.lista_actividades', ['titulo'=>'Gestionar actividades de la tarjeta',
                                                          'tarjeta' => $tarjeta,
                                                          'actividades' => $actividades,
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
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $titulo = 'NUEVA TARJETA';
        $inspecciones = Inspeccion::all();

        return view('tarjetas.form_nueva_tarjeta', ['titulo'=>$titulo, 
                                                   'inspecciones' => $inspecciones,
                                                   'modulo_activo' => $this->modulo
                                                 ]);
    }

    public function nueva_actividad($tar_id)
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $titulo = 'NUEVA ACTIVIDAD';
        $tar_id = Crypt::decryptString($tar_id);//Desencriptando parametro ID
        $tarjeta = Tarjeta::where('tar_id', $tar_id)->first();      

        return view('tarjetas.form_nueva_actividad', ['titulo'=>$titulo, 
                                                   'tarjeta' => $tarjeta,
                                                   'modulo_activo' => $this->modulo
                                                 ]);
    }

    public function editar_actividad($tac_id)
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $titulo = 'EDITAR ACTIVIDAD';
        $tac_id = Crypt::decryptString($tac_id);//Desencriptando parametro ID
        $tarjeta_capitulo = TarjetaCapitulo::where('tac_id', $tac_id)->first();
        $tarjeta = $tarjeta_capitulo->tarjeta;

        return view('tarjetas.form_editar_actividad', ['titulo'=>$titulo, 
                                                   'tarjeta' => $tarjeta,
                                                   'actividad' => $tarjeta_capitulo,
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
        //Guardar digitalizado       
        if($request->file('tar_digitalizado')) {
            $ruta_archivo = Storage::putFile('archivos_tarjetas', $request->file('tar_digitalizado'), 'public'); // putFile estatico
        }else{
            $ruta_archivo = "-";
        }

        //guardar tarjeta
        $tarjeta = new Tarjeta();
        $tarjeta->tar_numero = $request->input('tar_numero');
        $tarjeta->tar_descripcion = $request->input('tar_descripcion');
        $tarjeta->tar_ata = $request->input('tar_ata');
        $tarjeta->tar_especialidad = $request->input('tar_especialidad');
        $tarjeta->tar_tecnicas_inspeccion = $request->input('tar_tecnicas');
        $tarjeta->tar_digitalizado = $ruta_archivo;
        $tarjeta->save();
        return redirect('tarjetas');
    }

    public function store_actividad(Request $request)
    {
        //verificar si esta logueado el usuario
        //guardar tarjeta
        $tarjeta_capitulo = new TarjetaCapitulo();
        $tarjeta_capitulo->tar_id = $request->input('tar_id');
        $tarjeta_capitulo->tac_descripcion = $request->input('tac_descripcion');
        $tarjeta_capitulo->tac_titulo = '';
        $tarjeta_capitulo->save();
        return redirect('tarjetas/'.Crypt::encryptString($tarjeta_capitulo->tarjeta->tar_id).'/actividades');
    }

    public function update_actividad(Request $request, $id)
    {
        //verificar si esta logueado el usuario
        //guardar tarjeta
        $tarjeta_capitulo = TarjetaCapitulo::where('tac_id', $id)->first();
        $tarjeta_capitulo->tac_descripcion = $request->input('tac_descripcion');
        $tarjeta_capitulo->save();
        return redirect('tarjetas/'.Crypt::encryptString($tarjeta_capitulo->tarjeta->tar_id).'/actividades');
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
        //verificar si esta logueado el usuario
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $titulo = 'EDITAR TARJETA';
        $tarjeta = Tarjeta::where('tar_id', $id)->first();
        $inspecciones = Inspeccion::all();

        return view('tarjetas.form_editar_tarjeta', ['titulo'=>$titulo, 
                                                    'inspecciones' => $inspecciones,
                                                    'tarjeta' => $tarjeta,
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
        //verificar si esta logueado el usuario
        //Guardar digitalizado       
        if($request->file('tar_digitalizado')) {
            $ruta_foto = Storage::putFile('foto_usuarios', $request->file('pro_foto'), 'public'); // putFile estatico
        }else{
            $ruta_archivo = "-";
        }

        //guardar tarjeta
        $tarjeta = Tarjeta::where('tar_id', $id)->first();
        $tarjeta->tar_numero = $request->input('tar_numero');
        $tarjeta->tar_descripcion = $request->input('tar_descripcion');
        $tarjeta->tar_ata = $request->input('tar_ata');
        $tarjeta->tar_especialidad = $request->input('tar_especialidad');
        $tarjeta->tar_tecnicas_inspeccion = $request->input('tar_tecnicas');
        if($ruta_archivo != '-'){
            $tarjeta->tar_digitalizado = $ruta_archivo;
        }
        $tarjeta->save();
        return redirect('tarjetas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //verificar si esta logueado el usuario

        $tarjeta = Tarjeta::where('tar_id', $id)->first();
        $tarjeta->delete();
        return redirect('tarjetas');
    }

    public function destroy_actividad($tar_id, $tac_id)
    {
        //verificar si esta logueado el usuario
        $tarjeta_capitulo = TarjetaCapitulo::where('tac_id', $tac_id)->first();
        $tarjeta_capitulo->delete();
        return redirect('tarjetas/'.Crypt::encryptString($tar_id).'/actividades');
    }


}
