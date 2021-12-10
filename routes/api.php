<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\MuebleController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\InstrumentoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TallerController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors']], function () {
    //Rutas a las que se permitirá acceso desde cualquier origen

Route::get('/talleres', [TallerController::class, 'index']);
Route::post('/talleres', [TallerController::class, 'store']);
Route::get('/talleres/{id}', [TallerController::class, 'show']);
Route::put('/talleres/{id}', [TallerController::class, 'update']);
Route::delete('/talleres/{id}', [TallerController::class, 'destroy']);

Route::get('/instrumentos', [InstrumentoController::class, 'index']);
Route::post('/instrumentos', [InstrumentoController::class, 'store']);
Route::get('/instrumentos/{id}', [InstrumentoController::class, 'show']);
Route::put('/instrumentos/{id}', [InstrumentoController::class, 'update']);
Route::delete('/instrumentos/{id}', [InstrumentoController::class, 'destroy']);

Route::get('/muebles', [MuebleController::class, 'index']);
Route::post('/muebles', [MuebleController::class, 'store']);
Route::get('/muebles/{id}', [MuebleController::class, 'show']);
Route::put('/muebles/{id}', [MuebleController::class, 'update']);
Route::delete('/muebles/{id}', [MuebleController::class, 'destroy']);

Route::get('/registros', [RegistroController::class, 'index']);
Route::post('/registros', [RegistroController::class, 'store']);
Route::get('/registros/{id}', [RegistroController::class, 'show']);
Route::put('/registros/{id}', [RegistroController::class, 'update']);
Route::delete('/registros/{id}', [RegistroController::class, 'destroy']);

Route::get('/alumnos', [AlumnoController::class, 'index']);
Route::post('/alumnos', [AlumnoController::class, 'store']);
Route::get('/alumnos/{id}', [AlumnoController::class, 'show']);
Route::put('/alumnos/{id}', [AlumnoController::class, 'update']);
Route::delete('/alumnos/{id}', [AlumnoController::class, 'destroy']);

Route::get('/roles', [RolController::class, 'index']);
Route::post('/roles', [RolController::class, 'store']);
Route::get('/roles/{id}', [RolController::class, 'show']);
Route::put('/roles/{id}', [RolController::class, 'update']);
Route::delete('/roles/{id}', [RolController::class, 'destroy']);

Route::get('/usuarios', [UserController::class, 'index']);
Route::post('/usuarios', [UserController::class, 'store']);
Route::get('/usuarios/{id}', [UserController::class, 'show']);
Route::put('/usuarios/{id}', [UserController::class, 'update']);
Route::delete('/usuarios/{id}', [UserController::class, 'destroy']);

});