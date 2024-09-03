<?php

namespace App\Http\Controllers;

use App\Models\Inspeccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class InspeccionController extends Controller
{
    private $modulo = "inspecciones";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $inspecciones = Inspeccion::all();      
        return view('inspecciones.lista_inspecciones', ['titulo'=>'Gestionar inspecciones',
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
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $titulo = 'NUEVA INSPECCION';

        return view('inspecciones.form_nueva_inspeccion', ['titulo'=>$titulo, 
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
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        //guardar inspeccion
        $inspeccion = new Inspeccion();
        $inspeccion->ins_nombre = $request->input('ins_nombre');
        $inspeccion->ins_descripcion = $request->input('ins_descripcion');
        $inspeccion->save();
        return redirect('inspecciones');
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
        // if(!Auth::check()){return redirect('/');}

        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $titulo = 'EDITAR INSPECCION';
        $inspeccion = Inspeccion::where('ins_id', $id)->first();

        return view('inspecciones.form_editar_inspeccion', ['titulo'=>$titulo, 
                                                   'inspeccion' => $inspeccion,
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
        // if(!Auth::check()){return redirect('/');}

        // $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $inspeccion = Inspeccion::where('ins_id', $id)->first();
        $inspeccion->ins_nombre = $request->input('ins_nombre');
        $inspeccion->ins_descripcion = $request->input('ins_descripcion');
        $inspeccion->save();
        return redirect('inspecciones');
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
        // if(!Auth::check()){return redirect('/');}

        // $id = Crypt::decryptString($id);

        $inspeccion = Inspeccion::where('ins_id', $id)->first();
        $inspeccion->delete();
        return redirect('inspecciones');
    }
}
