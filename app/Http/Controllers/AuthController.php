<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function autenticar(Request $request)
    {
        $usr = $request->input('uuo');
        $pwd = $request->input('ovc');
        $credenciales = $request->validate([
            'uuo' => 'required',
            'ovc' => 'required',
            'g-recaptcha-response' => 'required|recaptchav3:captcha,0.9' 
        ]);

        if(Auth::attempt(['usu_nombre' => $usr, 'password' => $pwd])){
            $request->session()->regenerate();
            $usuario = Auth::user();

            if($usuario->funcionario){
                $grupo_aereo = $usuario->funcionario->unidades[0]->cargo->unidad->grupo->gru_nombre;
                $grupo_id = $usuario->funcionario->unidades[0]->cargo->unidad->grupo->gru_id;
                $request->session()->put('gru_nombre', $grupo_aereo);    
                $request->session()->put('gru_id', $grupo_id);    
            }else{
                $request->session()->put('gru_nombre', "");    
                $request->session()->put('gru_id', -1);    
            }

            if($usuario->rol->rol_codigo == '1'){ //ADMINISTRADOR
                return redirect('dashboard');
            }
            if($usuario->rol->rol_codigo == '3'){ //CONTROL DE CALIDAD
            // if($usuario->rol->rol_codigo == '3' && $request->ip() == '186.121.247.106'){ //CONTROL DE CALIDAD
                return redirect('dashboard');
            }
            if($usuario->rol->rol_codigo == '2'){ //COMANDANTE
                return redirect('monitoreo');
            }
            if($usuario->rol->rol_codigo == '4'){ //JEFE DE MANTENIMIENTO
                // if($usuario->rol->rol_codigo == '3' && $request->ip() == '186.121.247.106'){ //CONTROL DE CALIDAD
                    return redirect('dashboard');
                }
            }

        return redirect('/');

    }

    public function logout(Request $request){
        Auth::logout();//elimina los datos de sesion del usuario
        $request->session()->invalidate(); //inicializa la sesion y genera un ID nuevo
        $request->session()->regenerateToken();//regenera el toke CSRF
        return redirect('/');
    }

    
}


// $2y$10$mFz0R4X37lVQf2T5ILqZF.hgNG822FahLnNvyjXXSJPsHBue/6XjK