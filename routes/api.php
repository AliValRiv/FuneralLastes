<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RegistresController;

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

//Public Routes
Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

/* Route::post('password/email', [ForgotPasswordController::class,'forgot']);
Route::post('password/reset', [ForgotPasswordController::class,'resetPassword']); */


//Route::post('cliente/nuevo', [RegistresController::class,'nuevoRegistro']);

Route::post('cliente/nuevo', [RegistresController::class,'nuevoRegistro'])->middleware('auth:sanctum');
Route::post('cliente/estatus', [RegistresController::class,'estatusRegistro'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
