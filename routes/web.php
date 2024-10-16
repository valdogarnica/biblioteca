<?php

use App\Http\Controllers\adminHome;
use App\Http\Controllers\agregarLibro;
use App\Http\Controllers\mochila;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\prestamoLibro;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use Illuminate\Routing\RouteGroup;

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
 

/* Route::get('/register', [RegisterController::class, 'show']);
Route::post('/action-register', [RegisterController::class, 'register']); */

Route::get('/', function(){
    return view('sinpermisos');
});





Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    //Route::get('/home', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});




//Route::get('/admin/home', [adminHome::class, 'show'])->name('admin.home');
//Route::post('/prestamos/{id}/recoger', [adminHome::class, 'recogerLibro'])->name('prestamos.recoger');
//Route::post('/regresar/libro/{id}', [adminHome::class, 'regresarLibro'])->name('regresar.libro');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/home', [adminHome::class, 'show'])->name('admin.home');
    Route::match(['get', 'post'], '/admin/agregar-libro', [agregarLibro::class, 'agregar_libro'])->middleware('auth')->name('agregar.libro');
    Route::post('/agregar/editorial', [agregarLibro::class, 'agregar_editorial']);
    Route::post('/prestamos/{id}/recoger', [adminHome::class, 'recogerLibro'])->name('prestamos.recoger');
    Route::post('/regresar/libro/{id}', [adminHome::class, 'regresarLibro'])->name('regresar.libro');
});




Route::middleware(['user'])->group(function (){
    Route::match(['get', 'post'], '/libros/{id}', [HomeController::class, 'show'])->name('libros.show');
    Route::match(['get', 'post'], '/prestamo/libro/{id}', [prestamoLibro::class, 'prestamo_libro'])->name('prestamo.libro');
    Route::match(['get', 'post'], '/mochila/{usuario}', [mochila::class, 'mochila'])->middleware('auth')->name('mochila.show');
    Route::post('/cancelar-reserva/{idPrestamo}', [mochila::class, 'cancelarReserva']);
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
});
