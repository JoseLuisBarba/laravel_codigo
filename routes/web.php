<?php

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

$servicios = [
    ['titulo' => 'Servicio 01'],
    ['titulo' => 'Servicio 02'],
    ['titulo' => 'Servicio 03'],
    ['titulo' => 'Servicio 04'],
    ['titulo' => 'Servicio 05'],
];

Route::view('/', 'home')->name('home');
Route::view('nosotros', 'nosotros')->name('nosotros');

Route::get('servicios', 'App\Http\Controllers\Servicios2Controller@index')->name('servicios');
Route::resource('servicios', 'App\Http\Controllers\Servicios2Controller')->only('index', 'show');
#Route::get('servicios', 'App\Http\Controllers\ServiciosController@servicios')->name('servicios');
//Route::view('servicios', 'servicios',compact('servicios'))->name('servicios');
Route::view('contacto', 'contacto')->name('contacto');

