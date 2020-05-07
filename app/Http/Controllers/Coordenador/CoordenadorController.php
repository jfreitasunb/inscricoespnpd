<?php

namespace App\Http\Controllers\Coordenador;

use Auth;
use Alert;
use Session;
use Carbon\Carbon;
use Notification;
use App\Models\User;
use App\Models\ConfiguraInscricaoPNPD;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\NotificaNovaInscricao;


class CoordenadorController extends Controller
{
    public function getMenu()
    {   
        Session::get('locale');
        return view('home');
    }
}
