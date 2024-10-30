<?php

namespace App\Http\Controllers;

use App\Models\GrupoAereo;
use App\Models\UnidadOrganizacional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UnidadController extends Controller
{
    private $modulo = "unidades";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $unidades = UnidadOrganizacional::all();
        return view('unidades.lista_unidades', ['titulo'=>'Gestionar de secciones',
                                                          'unidades' => $unidades,
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

        $titulo = 'NUEVA SECCIÓN O UNIDAD';
        $unidades = UnidadOrganizacional::all();
        $grupos = GrupoAereo::all();      

        return view('unidades.form_nueva_unidad', ['titulo'=>$titulo, 
                                                   'unidades' => $unidades,
                                                   'grupos' => $grupos,
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

        //guardar unidad
        $unidad = new UnidadOrganizacional();
        $unidad->gru_id = $request->input('gru_id');
        $unidad->uor_superior = $request->input('uor_superior');
        $unidad->uor_nombre = $request->input('uor_nombre');
        $unidad->save();
        return redirect('unidades');
        
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
        $titulo = 'EDITAR SECCIÓN O UNIDAD';
        $unidad = UnidadOrganizacional::where('uor_id', $id)->first();
        $unidades = UnidadOrganizacional::all();

        return view('unidades.form_editar_unidad', ['titulo'=>$titulo, 
                                                   'unidad' => $unidad,
                                                   'unidades' => $unidades,
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
        $unidad = UnidadOrganizacional::where('uor_id', $id)->first();
        $unidad->uor_superior = $request->input('uor_superior');
        $unidad->uor_nombre = $request->input('uor_nombre');
        $unidad->save();
        return redirect('unidades');
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

        $unidad = UnidadOrganizacional::where('uor_id', $id)->first();
        $unidad->delete();
        return redirect('unidades');
    }
}
