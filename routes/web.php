<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CargaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    return redirect('/login');
});


Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('verification', [CustomAuthController::class, 'verification'])->name('login.verification');
Route::get('import', [ImportController::class, 'index'])->name('import.index');
Route::post('import', [ImportController::class, 'import'])->name('import');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::get('users/status', [UserController::class, 'status'])->name('users.status'); 
Route::get('users/permisos', [UserController::class, 'permisos'])->name('users.permisos'); 
Route::get('users/profile', [UserController::class, 'profile'])->name('users.profile');
Route::post('users/profile', [UserController::class, 'update_profile'])->name('users.profile.update');
Route::resource('users', UserController::class);
Route::get('clientes/status', [ClienteController::class, 'status'])->name('clientes.status'); 
Route::get('clientes/index', [ClienteController::class, 'index'])->name('clientes.index');
Route::resource('clientes', ClienteController::class);
Route::get('empresas/status', [EmpresaController::class, 'status'])->name('empresas.status'); 
Route::resource('empresas', EmpresaController::class);

Route::post('cargas/guardar', [CargaController::class, 'mguardar'])->name('cargas.guardar');
Route::post('cargas/guardarbajas', [CargaController::class, 'mguardarbajas'])->name('cargas.guardarbajas');
Route::get('cargas/status', [CargaController::class, 'status'])->name('cargas.status');
Route::resource('cargas', CargaController::class);

Route::get('importExportView', 'MyController@importExportView');