<?php

use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\StudentLogController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () { 
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); //Ruta de inicio

Route::get('home/{categ}', [App\Http\Controllers\HomeController::class,'buscar'])->name('anuncios.buscar'); //Ruta que busca una categoria 


