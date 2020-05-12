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

Route::prefix('admin')->middleware('user.role:admin', 'auth')->group(function () {

    Route::get('/', 'Admin\AdminController@getMenu')->name('menu.admin');
    Route::get('/editar/inscricao', 'Admin\EditaInscricaoController@getEditaInscricao')->name('editar.inscricao');
    Route::post('/editar/inscricao', 'Admin\EditaInscricaoController@postEditaInscricao')->name('editar.inscricao');
    Route::get('lista/users', 'Admin\AdministraUserController@index')->name('lista.edita.usuarios');
    Route::resource('datatable/users','DataTable\UserDataTableController');
    Route::get('inscricoes/nao/finalizadas', 'Admin\ListaInscricaoNaoFinalizadasController@getInscricoesNaoFinalizadas')->name('inscricoes.nao.finalizadas');

    Route::resource('datatable/inscricoesnaofinalizadas','DataTable\InscricoesNaoFinalizadasDataTableController');

    Route::get('inscricao/altera/recomendantes', 'Admin\MudaRecomendanteController@getAlteraRecomendantes')->name('altera.recomendante');

    Route::resource('datatable/alterarecomendante','DataTable\MudarRecomendanteDataTableController');
});

Route::prefix('coordenador')->middleware('user.role:admin,coordenador', 'auth')->group(function () {

    Route::get('/','Coordenador\CoordenadorController@getMenu')->name('menu.coordenador');

    Route::get('/configura/inscricao', 'Coordenador\ConfiguraInscricaoController@getConfiguraInscricao')->name('configura.inscricao');

    Route::post('/configura/inscricao', 'Coordenador\ConfiguraInscricaoController@postConfiguraInscricao')->name('configura.inscricao');

    Route::get('relatorio/edital/vigente/{id_inscricao_pnpd}', 'RelatorioController@geraRelatorio')->name('gera.relatorio');

    Route::get('relatorio', 'RelatorioController@getListaRelatorios')->name('relatorio.atual');

    Route::get('gera/ficha/individual', 'Coordenador\RelatorioPNPDController@getFichaInscricaoPorCandidato')->name('gera.ficha.individual');

    Route::get('ver/ficha/individual', 'Coordenador\RelatorioPNPDController@GeraPdfFichaIndividual')->name('ver.ficha.individual');
});

Route::prefix('candidato')->middleware('user.role:candidato', 'define.locale', 'auth')->group(function () {

    // Route::get('/', 'Candidato\CandidatoController@getMenu');

    Route::get('/inscricao', 'Candidato\CandidatoController@getMenu')->name('candidato.inscricao');
    
    Route::post('/processa/inscricao', 'Candidato\ProcessaInscricaoController@postProcessaInscricao')->name('candidato.inscricao');

    Route::get('/finaliza/inscricao', 'Candidato\FinalizaInscricaoController@getFinalizaInscricao')->name('finalizar.inscricao');

    Route::post('/finaliza/inscricao', 'Candidato\FinalizaInscricaoController@postFinalizaInscricao')->name('finalizar.inscricao');
});

Route::prefix('recomendante')->middleware('define.locale', 'autoriza.carta')->group(function () {

    // Route::get('/', 'Candidato\CandidatoController@getMenu');

    Route::get('/preenche/carta/{token}/{reco}', 'Recomendante\RecomendanteController@getLink');

    Route::post('/salva/carta', 'Recomendante\RecomendanteController@postSalvaCarta')->name('salva.carta');
});
