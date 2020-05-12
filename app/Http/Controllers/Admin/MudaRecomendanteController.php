<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use Mail;
use Session;
use Notification;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;

/**
* Classe para visualização da página inicial.
*/
class MudaRecomendanteController extends AdminController
{
	public function getAlteraRecomendantes()
	{
		return view('templates.partials.admin.altera_recomendantes_candidato');
	}
}