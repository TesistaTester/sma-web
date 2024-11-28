<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Destino;
use App\Models\Especialidad;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\Personal;
use App\Models\Grado;
use App\Models\Grupo;
use App\Models\Persona;
use App\Models\UnidadFuncionario;
use Illuminate\Support\Facades\DB;

class PersonalController extends Controller
{
    private $modulo = "personal";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        // $personal = UnidadFuncionario::all();      

        // $personal = UnidadFuncionario::with([
        //     'cargo.unidad.grupo'
        // ])->get();

        if(session('gru_id') == -1){
            $personal = UnidadFuncionario::all();      
        }else{
            $personal = UnidadFuncionario::with([
                'cargo.unidad.grupo'
            ])->whereHas('cargo.unidad.grupo', function ($query) {
                $query->where('gru_id', session('gru_id'));
            })->get();    
        }


        // $personal = DB::table('unidad_funcionario')
        // ->join('cargo', 'unidad_funcionario.car_id', '=', 'cargo.car_id')
        // ->join('unidad_organizacional', 'unidad_organizacional.uor_id', '=', 'cargo.uor_id')
        // ->join('grupo_aereo', 'grupo_aereo.gru_id', '=', 'unidad_organizacional.gru_id')
        // ->select('unidad_funcionario.*', 'grupo_aereo.*')
        // ->get();

        return view('personal.lista_personal', ['titulo'=>'Gestión del personal técnico',
                                                          'personal' => $personal,
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

        $titulo = 'NUEVO PERSONAL';
        $grados = Grado::all();
        $especialidades = Especialidad::all();
        if(session('gru_id') == -1){
            $cargos = Cargo::all();      
        }else{
            $cargos = Cargo::with(['unidad.grupo'])
                ->whereHas('unidad.grupo', function ($query) {
                    $query->where('gru_id', session('gru_id'));
                })
                ->get();
        }

        return view('personal.form_nuevo_personal', ['titulo'=>$titulo, 
                                                    'modulo_activo' => $this->modulo,
                                                    'grados' => $grados,
                                                    'cargos' => $cargos,
                                                    'especialidades' => $especialidades
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

        //guardar persona
        $persona = new Persona();
        $persona->per_ci = $request->input('per_ci');
        $persona->per_expedido = 'x';
        $persona->per_nombres = $request->input('per_nombres');
        $persona->per_primer_apellido = $request->input('per_primer_apellido');
        $persona->per_segundo_apellido = $request->input('per_segundo_apellido');
        $persona->per_genero = 'x';
        $persona->save();
        //guardar funcionario
        $funcionario = new Funcionario();
        $funcionario->per_id = $persona->per_id;
        $funcionario->fun_nivel = $request->input('per_nivel');
        $funcionario->fun_pid = $request->input('fun_pid');
        $funcionario->gra_id = $request->input('gra_id');
        $funcionario->esp_id = $request->input('esp_id');
        $funcionario->save();
        //guardar unidad_funcionario
        $unidad_funcionario = new UnidadFuncionario();
        $unidad_funcionario->car_id = $request->input('car_id');
        $unidad_funcionario->fun_id = $funcionario->fun_id;
        $unidad_funcionario->unf_fecha_inicio = $request->input('unf_fecha_inicio');
        $unidad_funcionario->unf_motivo_designacion = $request->input('unf_motivo_designacion');
        $unidad_funcionario->unf_fecha_fin = '01/01/1970';
        $unidad_funcionario->unf_motivo_desvinculacion = '';
        $unidad_funcionario->unf_activo = 1;
        $unidad_funcionario->save();

        return redirect('personal');
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
        $id = Crypt::decryptString($id);
        $titulo = 'EDITAR PERSONAL';
        $grados = Grado::all();
        $especialidades = Especialidad::all();

        if(session('gru_id') == -1){
            $cargos = Cargo::all();      
        }else{
            $cargos = Cargo::with(['unidad.grupo'])
                ->whereHas('unidad.grupo', function ($query) {
                    $query->where('gru_id', session('gru_id'));
                })
                ->get();
        }
        

        $personal = UnidadFuncionario::where('unf_id', $id)->first();

        return view('personal.form_editar_personal', ['titulo'=>$titulo, 
                                                    'modulo_activo' => $this->modulo,
                                                    'grados' => $grados,
                                                    'cargos' => $cargos,
                                                    'personal' => $personal,
                                                    'especialidades' => $especialidades
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
        $id = Crypt::decryptString($id);
        $unidad_funcionario = UnidadFuncionario::where('unf_id', $id)->first();
        $funcionario = $unidad_funcionario->funcionario;
        $persona = $funcionario->persona;

        //guardar persona
        // $persona = new Persona();
        $persona->per_ci = $request->input('per_ci');
        $persona->per_expedido = 'x';
        $persona->per_nombres = $request->input('per_nombres');
        $persona->per_primer_apellido = $request->input('per_primer_apellido');
        $persona->per_segundo_apellido = $request->input('per_segundo_apellido');
        $persona->per_genero = 'x';
        $persona->save();
        //guardar funcionario
        // $funcionario = new Funcionario();
        $funcionario->per_id = $persona->per_id;
        $funcionario->fun_nivel = $request->input('per_nivel');
        $funcionario->fun_pid = $request->input('fun_pid');
        $funcionario->gra_id = $request->input('gra_id');
        $funcionario->esp_id = $request->input('esp_id');
        $funcionario->save();
        //guardar unidad_funcionario
        // $unidad_funcionario = new UnidadFuncionario();
        $unidad_funcionario->car_id = $request->input('car_id');
        $unidad_funcionario->fun_id = $funcionario->fun_id;
        $unidad_funcionario->unf_fecha_inicio = $request->input('unf_fecha_inicio');
        $unidad_funcionario->unf_motivo_designacion = $request->input('unf_motivo_designacion');
        $unidad_funcionario->unf_fecha_fin = '01/01/1970';
        $unidad_funcionario->unf_motivo_desvinculacion = '';
        $unidad_funcionario->unf_activo = 1;
        $unidad_funcionario->save();

        return redirect('personal');
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

        $id = Crypt::decryptString($id);

        $unidad_funcionario = UnidadFuncionario::where('unf_id', $id)->first();
        $fun_id = $unidad_funcionario->fun_id;
        $unidad_funcionario->delete();
        $funcionario = Funcionario::where('fun_id', $fun_id)->first();
        $per_id = $funcionario->per_id;
        $funcionario->delete();
        $persona = Persona::where('per_id', $per_id)->first();
        $persona->delete();

        return redirect('personal');
    }



}
