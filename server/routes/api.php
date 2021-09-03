<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CuentaBancariaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TipoCuentaBancariaController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\TipoProductoController;
use App\Http\Controllers\VentaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// API Cliente +
Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/clientes/show/{id}', [ClienteController::class, 'show']);
Route::post('/clientes/store', [ClienteController::class, 'store']);
Route::put('/clientes/update/{id}', [ClienteController::class, 'update']);
Route::delete('/clientes/destroy/{id}', [ClienteController::class, 'destroy']);
Route::post('/clientes/login', [ClienteController::class, 'login']);

// API Cuenta Bancaria +
Route::get('/cuenta_bancaria', [CuentaBancariaController::class, 'index']);
Route::get('/cuenta_bancaria/show/{id}', [CuentaBancariaController::class, 'show']);
Route::post('/cuenta_bancaria/store', [CuentaBancariaController::class, 'store']);
Route::put('/cuenta_bancaria/update/{id}', [CuentaBancariaController::class, 'update']);
Route::delete('/cuenta_bancaria/destroy/{id}', [CuentaBancariaController::class, 'destroy']);

// API Detalle Venta +
Route::get('/detalles_venta', [DetalleVentaController::class, 'index']);
Route::get('/detalles_venta/show/{id}', [DetalleVentaController::class, 'show']);
Route::post('/detalles_venta/store', [DetalleVentaController::class, 'store']);
Route::put('/detalles_venta/update/{id}', [DetalleVentaController::class, 'update']);
Route::delete('/detalles_venta/destroy/{id}', [DetalleVentaController::class, 'destroy']);
Route::get('/detalles_venta/verDetalleVentaCliente/{id}', [DetalleVentaController::class, 'verDetalleVentaCliente']);

// API Producto +
Route::get('/productos', [ProductoController::class, 'index']);
Route::get('/productos/show/{id}', [ProductoController::class, 'show']);
Route::post('/productos/store', [ProductoController::class, 'store']);
Route::put('/productos/update/{id}', [ProductoController::class, 'update']);
Route::delete('/productos/destroy/{id}', [ProductoController::class, 'destroy']);

// API Roles +
Route::get('/roles', [RolController::class, 'index']);
Route::get('/roles/show/{id}', [RolController::class, 'show']);
Route::post('/roles/store', [RolController::class, 'store']);
Route::put('/roles/update/{id}', [RolController::class, 'update']);
Route::delete('/roles/destroy/{id}', [RolController::class, 'destroy']);

// API tipo cuenta bancaria +
Route::get('/tipos_cuentas_bancarias', [TipoCuentaBancariaController::class, 'index']);
Route::get('/tipos_cuentas_bancarias/show/{id}', [TipoCuentaBancariaController::class, 'show']);
Route::post('/tipos_cuentas_bancarias/store', [TipoCuentaBancariaController::class, 'store']);
Route::put('/tipos_cuentas_bancarias/update/{id}', [TipoCuentaBancariaController::class, 'update']);
Route::delete('/tipos_cuentas_bancarias/destroy/{id}', [TipoCuentaBancariaController::class, 'destroy']);

// API Tipo de Pago +
Route::get('/tipo_pago', [TipoPagoController::class, 'index']);
Route::get('/tipo_pago/show/{id}', [TipoPagoController::class, 'show']);
Route::post('/tipo_pago/store', [TipoPagoController::class, 'store']);
Route::put('/tipo_pago/update/{id}', [TipoPagoController::class, 'update']);
Route::delete('/tipo_pago/destroy/{id}', [TipoPagoController::class, 'destroy']);

// API tipo de producto +
Route::get('/tipos_productos', [TipoProductoController::class, 'index']);
Route::get('/tipos_productos/show/{id}', [TipoProductoController::class, 'show']);
Route::post('/tipos_productos/store', [TipoProductoController::class, 'store']);
Route::put('/tipos_productos/update/{id}', [TipoProductoController::class, 'update']);
Route::delete('/tipos_productos/destroy/{id}', [TipoProductoController::class, 'destroy']);

// API ventas +
Route::get('/ventas', [VentaController::class, 'index']);
Route::get('/ventas/show/{id}', [VentaController::class, 'show']);
Route::post('/ventas/store', [VentaController::class, 'store']);
Route::put('/ventas/update/{id}', [VentaController::class, 'update']);
Route::delete('/ventas/destroy/{id}', [VentaController::class, 'destroy']);
