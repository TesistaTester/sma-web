<?php

use App\Http\Controllers\AeronaveController;
use App\Http\Controllers\AuditoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\ConfiguracionMantenimientoController;
use App\Http\Controllers\TarjetaController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\InspeccionController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\MonitoreoController;
use App\Http\Controllers\GrupoAereoController;
use App\Http\Controllers\RegistroVueloController;
use App\Http\Controllers\RegistroVueloDiarioController;
use App\Http\Controllers\ServicioComponenteController;
use App\Models\GrupoAereo;
use App\Models\RegistroVueloDiario;
use App\Models\ServicioComponente;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
----------------------------------------
* RUTAS: PÚBLICAS
----------------------------------------
*/
Route::get('/', function () {
    return view('publico.login', ['titulo'=>'Acceso al sistema']);
})->name('login');

/*
----------------------------------------
* RUTAS: AUTENTICACIÓN
----------------------------------------
*/
Route::get('/logout', [AuthController::class ,'logout']);
Route::post('/auth', [AuthController::class ,'autenticar']);
// Route::resource('/auth', AuthController::class);

/*
----------------------------------------
* RUTAS: DASHBOARD
----------------------------------------
*/
Route::resource('/dashboard', DashboardController::class)->middleware('auth');

/*
----------------------------------------
* RUTAS: DASHBOARD
----------------------------------------
*/
Route::resource('/auditoria', AuditoriaController::class)->middleware('auth');

/*
----------------------------------------
* RUTAS: PERSONAL
----------------------------------------
*/
Route::delete('/destinos/{id}', [PersonalController::class ,'destroy_destino'])->middleware('auth');
Route::post('/destinos', [PersonalController::class ,'store_destino'])->middleware('auth');
Route::get('/personal/{id}/nuevo_destino', [PersonalController::class ,'nuevo_destino'])->middleware('auth');
Route::resource('/personal', PersonalController::class)->middleware('auth');

/*
----------------------------------------
* RUTAS: COMPONENTES
----------------------------------------
*/
Route::get('aeronaves/{ae_id}/componentes/{com_id}/mantenimientos/{cma_id}/inspecciones', [InspeccionController::class, 'inspecciones_componente'])->middleware('auth');
Route::get('aeronaves/{ae_id}/componentes/{com_id}/mantenimientos/{cma_id}/nueva_inspeccion', [InspeccionController::class, 'nueva_inspeccion_componente'])->middleware('auth');
Route::get('/inspecciones', [InspeccionController::class, 'index'])->middleware('auth');
Route::post('/inspecciones', [InspeccionController::class, 'store'])->middleware('auth');
// Route::resource('/inspecciones', InspeccionController::class)->middleware('auth');


Route::put('mantenimientos/{cma_id}', [ConfiguracionMantenimientoController::class, 'update'])->middleware('auth');
Route::delete('mantenimientos/{cma_id}', [ConfiguracionMantenimientoController::class, 'destroy'])->middleware('auth');
Route::post('aeronaves/{ae_id}/componentes/{com_id}/mantenimientos', [ConfiguracionMantenimientoController::class, 'store'])->middleware('auth');
Route::get('aeronaves/{ae_id}/componentes/{com_id}/mantenimientos/editar', [ConfiguracionMantenimientoController::class, 'edit'])->middleware('auth');
Route::get('aeronaves/{ae_id}/componentes/{com_id}/mantenimientos/nuevo', [ConfiguracionMantenimientoController::class, 'create'])->middleware('auth');
Route::get('aeronaves/{ae_id}/componentes/{com_id}/mantenimientos', [ConfiguracionMantenimientoController::class, 'index'])->middleware('auth');
Route::post('aeronaves/{id}/componentes/{id1}/servicios', [ServicioComponenteController::class, 'store'])->middleware('auth');
Route::get('aeronaves/{id}/componentes/{id1}/servicios/nuevo', [ServicioComponenteController::class, 'create'])->middleware('auth');
Route::get('aeronaves/{id}/componentes/{id1}/servicios', [ServicioComponenteController::class, 'index'])->middleware('auth');
Route::get('/componentes/{id}/horas', [ComponenteController::class, 'horas_vuelo'])->middleware('auth');
Route::resource('/componentes', ComponenteController::class)->middleware('auth');


/*
----------------------------------------
* RUTAS: REGISTROS DE VUELO DIARIO
----------------------------------------
*/
Route::get('/rvds/{id}/nuevo_digitalizado', [RegistroVueloDiarioController::class, 'digitalizado'])->middleware('auth');
Route::get('/rvds/{id}/rvus/nuevo', [RegistroVueloController::class, 'create'])->middleware('auth');
Route::get('/rvds/{id}/rvus', [RegistroVueloController::class, 'index'])->middleware('auth');
Route::resource('/rvds', RegistroVueloDiarioController::class)->middleware('auth');

Route::post('/rvds/{id}/store_digitalizado', [RegistroVueloDiarioController::class, 'store_digitalizado'])->middleware('auth');
Route::resource('/rvus', RegistroVueloController::class)->middleware('auth');

/*
----------------------------------------
* RUTAS: AERONAVES
----------------------------------------
*/
Route::get('/aeronaves/{id}/mantenimiento', [InspeccionController::class, 'inspecciones_aeronave'])->middleware('auth');
Route::get('/aeronaves/{id}/componentes/{id2}/trazabilidad', [ComponenteController::class, 'trazabilidad'])->middleware('auth');
Route::get('/aeronaves/{id}/rvds', [RegistroVueloDiarioController::class, 'index'])->middleware('auth');
Route::get('/aeronaves/{id}/componentes/nuevo', [ComponenteController::class, 'create'])->middleware('auth');
Route::put('/aeronaves/{id}/update_estado', [AeronaveController::class, 'update_estado'])->middleware('auth');
Route::get('/aeronaves/{id}/editar_estado', [AeronaveController::class, 'edit_estado'])->middleware('auth');
Route::get('/aeronaves/{id}/componentes', [ComponenteController::class, 'index'])->middleware('auth');
Route::resource('/aeronaves', AeronaveController::class)->middleware('auth');

/*
----------------------------------------
* RUTAS: ADMINISTRATIVO
----------------------------------------
*/
Route::resource('/grupos', GrupoAereoController::class)->middleware('auth');
Route::resource('/unidades', UnidadController::class)->middleware('auth');
Route::resource('/cargos', CargoController::class)->middleware('auth');
/*
----------------------------------------
* RUTAS: INSPECCIONES Y TARJETAS
----------------------------------------
*/

Route::put('/tarjetas/{id}/editar_actividad', [TarjetaController::class ,'update_actividad'])->middleware('auth');
Route::get('/tarjetas/{id}/editar_actividad', [TarjetaController::class ,'editar_actividad'])->middleware('auth');
Route::delete('/tarjetas/{id1}/eliminar_actividad/{id2}', [TarjetaController::class ,'destroy_actividad'])->middleware('auth');
Route::post('/tarjetas/{id}/nueva_actividad', [TarjetaController::class ,'store_actividad'])->middleware('auth');
Route::get('/tarjetas/{id}/nueva_actividad', [TarjetaController::class ,'nueva_actividad'])->middleware('auth');
Route::get('/tarjetas/{id}/actividades', [TarjetaController::class ,'lista_actividades'])->middleware('auth');
Route::resource('/tarjetas', TarjetaController::class)->middleware('auth');

/*
----------------------------------------
* RUTAS: ORDENES TRABAJO
----------------------------------------
*/
Route::get('/ordenes/print1/{id}', [OrdenController::class ,'imprimir_hoja1'])->middleware('auth');
Route::get('/ordenes/print3/{id}', [OrdenController::class ,'imprimir_hoja3'])->middleware('auth');
Route::post('/ordenes/subir_digital/{id}', [OrdenController::class ,'subir_digital'])->middleware('auth');
Route::get('/ordenes/{id}/apertura', [OrdenController::class, 'create_orden'])->middleware('auth');
Route::resource('/ordenes', OrdenController::class)->middleware('auth');
Route::post('/seguimientos/back_realizar', [SeguimientoController::class ,'back_realizar'])->middleware('auth');
Route::post('/seguimientos/back_desarrollo', [SeguimientoController::class ,'back_desarrollo'])->middleware('auth');
Route::post('/seguimientos/a_concluido', [SeguimientoController::class ,'a_concluido'])->middleware('auth');
Route::post('/seguimientos/a_desarrollo', [SeguimientoController::class ,'a_desarrollo'])->middleware('auth');
Route::resource('/seguimientos', SeguimientoController::class)->middleware('auth');


/*
----------------------------------------
* RUTAS: REPORTES
----------------------------------------
*/
// Route::resource('/reportes', ReporteController::class)->middleware('auth');
Route::get('/monitoreo/orden/{id}', [MonitoreoController::class ,'tablero_orden'])->middleware('auth');
Route::resource('/monitoreo', MonitoreoController::class)->middleware('auth');


/*
----------------------------------------
* RUTAS: USUARIOS
----------------------------------------
*/
Route::put('/usuarios/update_password/{id}', [UsuarioController::class ,'update_password'])->middleware('auth');
Route::resource('/usuarios', UsuarioController::class)->middleware('auth');



