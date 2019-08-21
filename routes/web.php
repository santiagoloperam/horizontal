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

Route::get('/', 'PagesController@home');

Route::group(['prefix' => 'admin',
 'namespace' => 'Admin',
  'middleware' => 'superadmin'],
   function()
{
    Route::get('users','UsersController@index')->name('admin.users.index');
    Route::get('users/crate','UsersController@create')->name('admin.users.create');
    Route::post('users','UsersController@store')->name('admin.users.store');
    Route::get('users/{user}','UsersController@edit')->name('admin.users.edit');
    Route::put('users/{user}','UsersController@update')->name('admin.users.update');
    Route::delete('users/{user}','UsersController@destroy')->name('admin.users.delete');

    Route::get('unidades','UnidadesController@index')->name('admin.unidades.index');
    Route::get('unidades/crate','UnidadesController@create')->name('admin.unidades.create');
    Route::post('unidades','UnidadesController@store')->name('admin.unidades.store');
    Route::get('unidades/{unidad}','UnidadesController@edit')->name('admin.unidades.edit');
    Route::put('unidades/{unidad}','UnidadesController@update')->name('admin.unidades.update');
    Route::delete('unidades/{unidad}','UnidadesController@destroy')->name('admin.unidades.delete');

    Route::get('bloques','BloquesController@index')->name('admin.bloques.index');
    Route::get('bloques/crate','BloquesController@create')->name('admin.bloques.create');
    Route::post('bloques','BloquesController@store')->name('admin.bloques.store');
    Route::get('bloques/{bloque}','BloquesController@edit')->name('admin.bloques.edit');
    Route::put('bloques/{bloque}','BloquesController@update')->name('admin.bloques.update');
    Route::delete('bloques/{bloque}','BloquesController@destroy')->name('admin.bloques.delete');

});

Route::group(['prefix' => 'adminc',
 'namespace' => 'AdminConjuntos',
  'middleware' => 'admin'],
   function()
{   
    Route::get('users','UsersController@index')->name('adminc.users.index');
    Route::get('users/crate','UsersController@create')->name('adminc.users.create');
    Route::post('users','UsersController@store')->name('adminc.users.store');
    Route::get('users/{user}','UsersController@edit')->name('adminc.users.edit');
    Route::put('users/{user}','UsersController@update')->name('adminc.users.update');
    Route::delete('users/{user}','UsersController@destroy')->name('adminc.users.delete');

    Route::get('unidades','UnidadesController@index')->name('adminc.unidades.index');
    Route::get('unidades/crate','UnidadesController@create')->name('adminc.unidades.create');
    Route::post('unidades','UnidadesController@store')->name('adminc.unidades.store');
    Route::get('unidades/{unidad}','UnidadesController@edit')->name('adminc.unidades.edit');
    Route::put('unidades/{unidad}','UnidadesController@update')->name('adminc.unidades.update');
    Route::delete('unidades/{unidad}','UnidadesController@destroy')->name('adminc.unidades.delete');

    Route::get('bloques','BloquesController@index')->name('adminc.bloques.index');
    Route::get('bloques/crate','BloquesController@create')->name('adminc.bloques.create');
    Route::post('bloques','BloquesController@store')->name('adminc.bloques.store');
    Route::get('bloques/{bloque}','BloquesController@edit')->name('adminc.bloques.edit');
    Route::put('bloques/{bloque}','BloquesController@update')->name('adminc.bloques.update');
    Route::delete('bloques/{bloque}','BloquesController@destroy')->name('adminc.bloques.delete');

});



Route::get('home',function(){
	return view ('admin.dashboard');
})->middleware('auth');

		Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        //Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        //Route::post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');
