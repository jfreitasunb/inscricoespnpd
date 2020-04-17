<?php

namespace App\Http\Controllers\Admin;

Use Alert;
use Auth;
use DB;
use Mail;
use Session;
use Notification;
use Carbon\Carbon;
use App\Models\{User, ConfiguraInscricaoPNPD};
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Coordenador\CoordenadorController;
use App\Http\Controllers\DataTable\UserController;
use App\Notifications\NotificaRecomendante;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;

/**
* Classe para visualização da página inicial.
*/
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
	public $unwanted_array = array('Š'=>'_', 'š'=>'_', 'Ž'=>'_', 'ž'=>'_', 'À'=>'_', 'Á'=>'_', 'Â'=>'_', 'Ã'=>'_', 'Ä'=>'_', 'Å'=>'_', 'Æ'=>'_', 'Ç'=>'_', 'È'=>'_', 'É'=>'_',
        'Ê'=>'_', 'Ë'=>'_', 'Ì'=>'_', 'Í'=>'_', 'Î'=>'_', 'Ï'=>'_', 'Ñ'=>'_', 'Ò'=>'_', 'Ó'=>'_', 'Ô'=>'_', 'Õ'=>'_', 'Ö'=>'_', 'Ø'=>'_', 'Ù'=>'_',
        'Ú'=>'_', 'Û'=>'_', 'Ü'=>'_', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'_', 'á'=>'_', 'â'=>'_', 'ã'=>'_', 'ä'=>'_', 'å'=>'_', 'æ'=>'_', 'ç'=>'_',
        'è'=>'_', 'é'=>'_', 'ê'=>'_', 'ë'=>'_', 'ì'=>'_', 'í'=>'_', 'î'=>'_', 'ï'=>'_', 'ð'=>'_', 'ñ'=>'_', 'ò'=>'_', 'ó'=>'_', 'ô'=>'_', 'õ'=>'_',
        'ö'=>'_', 'ø'=>'_', 'ù'=>'_', 'ú'=>'_', 'û'=>'_', 'ý'=>'_', 'þ'=>'_', 'ÿ'=>'_', 'Ğ'=>'_', 'İ'=>'_', 'Ş'=>'_', 'ğ'=>'_', 'ı'=>'_', 'ş'=>'_', 'ü'=>'_', 'ă'=>'_', 'Ă'=>'_', 'ș'=>'_', 'Ș'=>'_', 'ț'=>'_', 'Ț'=>'_');

	public $locale_default = 'pt-br';

	public $pesquisa = [
			'nome' => 'Nome',
			'email' => 'E-mail',
		];

	public function getMenu()
	{	
        Alert::success('Login efetuado', 'Bem vindo!')->autoclose(1500);
		Session::get('locale');
		return view('home');
	}
}