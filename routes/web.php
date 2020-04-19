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

Route::get('/', 'HomeController@index')->name('home')->middleware('define.locale');

Route::get('/ptbr','HomeController@getLangPortuguese')->name('lang.portuguese')->middleware('define.locale');

Route::get('/en','HomeController@getLangEnglish')->name('lang.english')->middleware('define.locale');

Route::get('/es','HomeController@getLangSpanish')->name('lang.spanish')->middleware('define.locale');

Auth::routes(['verify' => true]);

/*
*Área do Admin
 */

Route::prefix('admin')->middleware('user.role:admin, coordenador', 'auth')->group(function () {

    Route::get('/', 'Admin\AdminController@getMenu')->name('menu.admin');
    Route::get('/editar/inscricao', 'Admin\EditaInscricaoController@getEditaInscricao')->name('editar.inscricao');
    Route::post('/editar/inscricao', 'Admin\EditaInscricaoController@postEditaInscricao')->name('editar.inscricao');
});

Route::prefix('coordenador')->middleware('user.role:admin, coordenador', 'auth')->group(function () {

    // Route::get('/', 'Admin\AdminController@getMenu')->name('menu.admin');
    Route::get('/configura/inscricao', 'Coordenador\ConfiguraInscricaoController@getConfiguraInscricao')->name('configura.inscricao');
    Route::post('/configura/inscricao', 'Coordenador\ConfiguraInscricaoController@postConfiguraInscricao')->name('configura.inscricao');
});