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

Auth::routes();

Route::middleware('auth')->group(function() {

    Route::get('/', function () {
        $appuntamenti = DB::table('appuntamentos')
            ->join('orarios', 'orarios.id', '=', 'appuntamentos.orario_id')
            ->select('appuntamentos.*', 'orarios.ora as ora', 'orarios.giorno as giorno')
            ->orderBy('data', 'ASC')
            ->orderBy('orarios.id', 'ASC')
            ->get();

        return view('welcome', ['appuntamenti' => $appuntamenti]);
    })->name('lista');;

    Route::get('/new', function () {
        return view('new');
    })->name('new');

    Route::post('/new', 'AppuntamentoController@add' );

    Route::get('/show/{id}', 'AppuntamentoController@show' )->name('show');
    Route::get('/delete/{id}', 'AppuntamentoController@delete' )->name('delete');
    Route::get('/edit/{id}', 'AppuntamentoController@edit' )->name('edit');
    Route::post('/edit/{id}', 'AppuntamentoController@update' );

    Route::get( '/ajax', [
        'as' => 'ajax',
        'uses' => 'TeachController@get_teach'
    ]);

});



