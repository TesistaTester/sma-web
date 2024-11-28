<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\UnidadOrganizacional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CargoController extends Controller
{
    private $modulo = "cargos";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}


        if(session('gru_id') == -1){
            $cargos = Cargo::all();      
        }else{
            $cargos = Cargo::with(['unidad.grupo'])
                ->whereHas('unidad.grupo', function ($query) {
                    $query->where('gru_id', session('gru_id'));
                })
                ->get();
        }


        return view('cargos.lista_cargos', ['titulo'=>'Gestionar de cargos',
                                                          'cargos' => $cargos,
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

        $titulo = 'NUEVO CARGO';
        $unidades = UnidadOrganizacional::all();

        // activity()->log('Creando un nuevo cargo');                                         


        return view('cargos.form_nuevo_cargo', ['titulo'=>$titulo, 
                                                   'unidades' => $unidades,
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

        //guardar cargo
        $cargo = new Cargo();
        $cargo->car_jefe = 1;
        $cargo->uor_id = $request->input('uor_id');
        $cargo->car_nombre = $request->input('car_nombre');
        $cargo->save();
        return redirect('cargos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $titulo = 'EDITAR CARGO';
        $cargo = Cargo::where('car_id', $id)->first();
        $unidades = UnidadOrganizacional::all();

        return view('cargos.form_editar_cargo', ['titulo'=>$titulo, 
                                                'cargo' => $cargo,
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
        $cargo = Cargo::where('car_id', $id)->first();
        $cargo->car_jefe = 1;
        $cargo->uor_id = $request->input('uor_id');
        $cargo->car_nombre = $request->input('car_nombre');
        $cargo->save();
        return redirect('cargos');
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

        $cargo = Cargo::where('car_id', $id)->first();
        $cargo->delete();
        return redirect('cargos');
    }
}
