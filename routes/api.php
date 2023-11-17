<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DetalleMovimientoProductoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\OportunidadController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\PagoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::resource('usuarios', UsuarioController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('productos', ProductoController::class);
Route::resource('detalles-movimientos-productos', DetalleMovimientoProductoController::class);
Route::resource('contactos', ContactoController::class);
Route::resource('oportunidades', OportunidadController::class);
Route::resource('actividades', ActividadController::class);
Route::resource('notas', NotaController::class);
Route::resource('ventas', VentaController::class);
Route::resource('detalles_ventas', DetalleVentaController::class);
Route::resource('pagos', PagoController::class);