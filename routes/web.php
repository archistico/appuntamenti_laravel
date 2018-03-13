<?php

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

use App\Appuntamento;

Route::get('/', function () {
    $appuntamenti = Appuntamento::all();
    return view('welcome', ['appuntamenti' => $appuntamenti]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
