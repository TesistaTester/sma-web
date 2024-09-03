<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Rol;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    private $modulo = "usuarios";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $usuarios = Usuario::all();      
        return view('usuarios.lista_usuarios', ['titulo'=>'ADMINISTRAR Usuarios',
                                                          'usuarios' => $usuarios,
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

        $titulo = 'NUEVO USUARIO';
        $roles = Rol::all();
        $funcionarios = Funcionario::all();

        return view('usuarios.form_nuevo_usuario', ['titulo'=>$titulo, 
                                                    'funcionarios' => $funcionarios,
                                                    'roles' => $roles,
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

        //guardar usuario
        $usuario = new Usuario();
        $usuario->usu_nombre = $request->input('usu_nombre');
        $usuario->password = Hash::make($request->input('usu_password'));
        if($request->input('fun_id') == 'x'){
            $usuario->fun_id = null;
        }else{
            $usuario->fun_id = $request->input('fun_id');
        }
        // $usuario->usu_nombres_persona = $request->input('usu_nombres_persona');
        // $usuario->usu_apellidos_persona = $request->input('usu_apellidos_persona');
        $usuario->usu_email = $request->input('usu_email');
        $usuario->rol_id = $request->input('rol_id');
        // $usuario->gru_id = 1;
        $usuario->save();

        return redirect('usuarios');
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

        $titulo = 'EDITAR USUARIO';
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $usuario = Usuario::where('usu_id', $id)->first();
        $funcionarios = Funcionario::all();
        $roles = Rol::all();

        return view('usuarios.form_editar_usuario', ['titulo'=>$titulo, 
                                                    'roles'=>$roles,
                                                    'usuario'=>$usuario,
                                                    'funcionarios'=>$funcionarios,
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

        //guardar usuario
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $usuario = Usuario::where('usu_id', $id)->first();
        $usuario->usu_nombre = $request->input('usu_nombre');
        $usuario->usu_nombres_persona = $request->input('usu_nombres_persona');
        $usuario->usu_apellidos_persona = $request->input('usu_apellidos_persona');
        $usuario->usu_email = $request->input('usu_email');
        $usuario->usu_rol = $request->input('usu_rol');
        $usuario->gru_id = 1;
        $usuario->save();

        return redirect('usuarios');
    }

    public function update_password(Request $request, $id)
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        //guardar usuario
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $usuario = Usuario::where('usu_id', $id)->first();
        if(Hash::check($request->input('pwd_actual'), $usuario->password)){
            $usuario->password = Hash::make($request->input('pwd_nuevo'));
            $usuario->save();
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'2']);
        }
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

        $usuario = Usuario::where('usu_id', $id)->first();
        $usuario->delete();
        return redirect('usuarios');
    }
}
