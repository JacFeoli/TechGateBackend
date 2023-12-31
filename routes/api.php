<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContrapartesController;
use App\Http\Controllers\FormulariosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('register', 'App\Http\Controllers\UserController@register');
// Route::post('login', 'App\Http\Controllers\UserController@authenticate');
// Route::group(['middleware' => ['jwt.verify']], function() {
//     Route::post('user','App\Http\Controllers\UserController@getAuthenticatedUser');
// });

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::group(['prefix' => 'usuario'], function () {
    Route::get('index/{buscar}', [UserController::class, 'index']);
    Route::get('detail/{buscar}', [UserController::class, 'detail']);
    Route::post('update', [UserController::class, 'update']);
    Route::post('register', [UserController::class, 'register']);
    Route::get('delete/{id}', [UserController::class, 'delete']);
    Route::get('roles', [UserController::class, 'roles']);
});

Route::group(['prefix' => 'roles'], function () {
    Route::get('index/{buscar}', [RolesController::class, 'index']);
    Route::get('detail/{buscar}', [RolesController::class, 'detail']);
    Route::post('update', [RolesController::class, 'update']);
    Route::post('register', [RolesController::class, 'register']);
    Route::get('delete/{id}', [RolesController::class, 'delete']);
});

Route::group(['prefix' => 'formulario'], function () {
    Route::get('index/{buscar}', [FormulariosController::class, 'index']);
    Route::get('detail/{buscar}', [FormulariosController::class, 'detail']);
    Route::post('update', [FormulariosController::class, 'update']);
    Route::post('register', [FormulariosController::class, 'register']);
    Route::get('delete/{id}', [FormulariosController::class, 'delete']);
    Route::post('activate', [FormulariosController::class, 'activate']);
});

Route::group(['prefix' => 'contraparte'], function () {
    Route::get('index_contacto/{id_formulario}', [ContrapartesController::class, 'index_contacto']);
    Route::get('index_representante/{id_formulario}', [ContrapartesController::class, 'index_representante']);
    Route::get('index_beneficiario_esal/{id_formulario}', [ContrapartesController::class, 'index_beneficiario_esal']);
    Route::get('index_representante_esal/{id_formulario}', [ContrapartesController::class, 'index_representante_esal']);
    Route::get('index_accionista/{id_formulario}', [ContrapartesController::class, 'index_accionista']);
    Route::get('index_junta_directiva/{id_formulario}', [ContrapartesController::class, 'index_junta_directiva']);
    Route::post('register_contacto', [ContrapartesController::class, 'register_contacto']);
    Route::post('register_representante', [ContrapartesController::class, 'register_representante']);
    Route::post('register_beneficiario_esal', [ContrapartesController::class, 'register_beneficiario_esal']);
    Route::post('register_representante_esal', [ContrapartesController::class, 'register_representante_esal']);
    Route::post('register_accionista', [ContrapartesController::class, 'register_accionista']);
    Route::post('register_junta_directiva', [ContrapartesController::class, 'register_junta_directiva']);
    Route::post('register_empresas', [ContrapartesController::class, 'register_empresas']);
    Route::get('delete_contacto/{id}', [ContrapartesController::class, 'delete_contacto']);
    Route::get('delete_representante/{id}', [ContrapartesController::class, 'delete_representante']);
    Route::get('delete_beneficiario_esal/{id}', [ContrapartesController::class, 'delete_beneficiario_esal']);
    Route::get('delete_representante_esal/{id}', [ContrapartesController::class, 'delete_representante_esal']);
    Route::get('delete_accionista/{id}', [ContrapartesController::class, 'delete_accionista']);
    Route::get('delete_junta_directiva/{id}', [ContrapartesController::class, 'delete_junta_directiva']);
});