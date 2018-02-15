<?php

use Illuminate\Support\Facades\Gate;

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
    
    #if(Gate::allows('access-admin'))
    #{
    #	return "Usuário COM permissão de Administração";
    #}
    #else
    #{
    #	return "Usuário SEM permissão de Administração";
    #}

    ##return view('welcome');

    return redirect()->route('admin.home');
});



Route::get('/home', function(){
	return redirect()->route('admin.home');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){	
	Auth::routes();
	Route::group(['middleware' => 'can:access-admin'], function(){
		Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('banks', 'Admin\BanksController', ['except' => 'show']);
	});
});

Route::get('/app', function(){
    return view('layouts.spa');
});
