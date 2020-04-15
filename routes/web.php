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

Route::get('/', [
        'uses'  => 'HomeController@index',
        'as'    => 'home',
        // 'middleware' => ['define.locale'],
]);

Route::get('/ptbr', [
    'uses' => 'HomeController@getLangPortuguese',
    'as'   => 'lang.portuguese',
    'middleware' => ['define.locale'],
]);

Route::get('/en', [
    'uses' => 'HomeController@getLangEnglish',
    'as'   => 'lang.english',
    'middleware' => ['define.locale'],
]);

Route::get('/es', [
    'uses' => 'HomeController@getLangSpanish',
    'as'   => 'lang.spanish',
    'middleware' => ['define.locale'],
]);