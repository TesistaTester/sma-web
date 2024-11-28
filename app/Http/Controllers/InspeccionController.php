<?php

namespace App\Http\Controllers;

use App\Models\Aeronave;
use App\Models\Componente;
use App\Models\ConfiguracionMantenimiento;
use App\Models\Inspeccion;
use App\Models\ServicioComponente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use function PHPUnit\Framework\isNull;

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
        return view('inspecciones.lista_inspecciones', ['titulo'=>'Inspecciones registradas',
                                                          'inspecciones' => $inspecciones,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    public function inspecciones_componente($ae_id, $com_id, $cma_id)
    {
        $ae_id = Crypt::decryptString($ae_id);
        $com_id = Crypt::decryptString($com_id);
        $cma_id = Crypt::decryptString($cma_id);

        $aeronave = Aeronave::where('ae_id', $ae_id)->first();
        $componente = Componente::where('com_id', $com_id)->first();
        $mantenimiento = ConfiguracionMantenimiento::where('cma_id', $cma_id)->first();
        $inspecciones = Inspeccion::where('cma_id', $cma_id)->get();    

        return view('inspecciones.lista_inspecciones_componente', ['titulo'=>'Inspecciones del componente',
                                                          'inspecciones' => $inspecciones,
                                                          'aeronave' => $aeronave,
                                                          'componente' => $componente,
                                                          'mantenimiento' => $mantenimiento,
                                                          'modulo_activo' => 'aeronaves'
                                                         ]);
    }

    public function inspecciones_aeronave($ae_id)
    {
        $ae_id = Crypt::decryptString($ae_id);

        $aeronave = Aeronave::where('ae_id', $ae_id)->first();
        $componentes = $aeronave->componentes;

        $inspecs = collect();

        foreach($componentes as $item){
            foreach($item->configuraciones_mantenimiento as $kitem){
                foreach($kitem->inspecciones as $sitem){
                    $inspecs->push($sitem);
                }
            }
        }
        $inspecciones = $inspecs->sortBy('ins_hora_componente');        

        $horas = 0;
        foreach($aeronave->horas_diario as $item){
            foreach($item->registros_vuelo as $ritem){
                // echo $ritem;
                // echo $ritem->rvu_horas_normales;
                $horas = $horas + $ritem->rvu_normales;
            }
        }

        return view('inspecciones.lista_inspecciones_aeronave', ['titulo'=>'Inspecciones aeronave',
                                                          'aeronave' => $aeronave,
                                                          'componentes' => $componentes,
                                                          'inspecciones' => $inspecciones,
                                                          'horas' => $horas,
                                                          'modulo_activo' => 'aeronaves'
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


    public function nueva_inspeccion_componente($ae_id, $com_id, $cma_id)
    {
        $titulo = 'NUEVA INSPECCION';

        $ae_id = Crypt::decryptString($ae_id);
        $com_id = Crypt::decryptString($com_id);
        $cma_id = Crypt::decryptString($cma_id);

        $aeronave = Aeronave::where('ae_id', $ae_id)->first();
        $componente = Componente::where('com_id', $com_id)->first();
        $mantenimiento = ConfiguracionMantenimiento::where('cma_id', $cma_id)->first();
        $servicio = ServicioComponente::where('com_id', $com_id)->latest()->first();

        return view('inspecciones.form_nueva_inspeccion_componente', ['titulo'=>$titulo, 
                                                                      'aeronave' => $aeronave,
                                                                      'componente' => $componente,
                                                                      'servicio' => $servicio,
                                                                      'mantenimiento' => $mantenimiento,
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
        $inspeccion->cma_id = $request->input('cma_id');
        $inspeccion->sec_id = $request->input('sec_id');
        $inspeccion->ins_nombre = $request->input('ins_nombre');
        $inspeccion->ins_descripcion = $request->input('ins_descripcion');
        $inspeccion->ins_hora_componente = $request->input('ins_hora_componente');
        $inspeccion->ins_hora_componente_max = $request->input('ins_hora_componente_max');
        $inspeccion->save();

        // if(isNull($request->input('cma_id'))){
        //     return redirect('inspecciones');
        // }else{
            return redirect('aeronaves/'.Crypt::encryptString($request->input('ae_id')).'/componentes/'.Crypt::encryptString($request->input('ae_id')).'/mantenimientos/'.Crypt::encryptString($request->input('cma_id')).'/inspecciones');            
        // }
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
