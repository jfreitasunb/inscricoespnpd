<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use Mail;
use Session;
use Notification;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;

/**
* Classe para visualização da página inicial.
*/
class ListaInscricaoNaoFinalizadasController extends AdminController
{

	public function getInscricoesNaoFinalizadas()
	{
		return view('templates.partials.admin.nao_finalizadas');
	}
}