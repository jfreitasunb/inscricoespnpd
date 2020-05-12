<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use Mail;
use Session;
use Notification;
use Carbon\Carbon;
use InscricoesPos\Models\User;
use Illuminate\Http\Request;
use InscricoesPos\Http\Controllers\DataTable\UserController;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;

/**
* Classe para visualização da página inicial.
*/
class AdministraUserController extends AdminController
{
    public function index()
    {
        return view('templates.partials.admin.lista_edita_usuarios');
    }
    
}