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

Auth::routes();