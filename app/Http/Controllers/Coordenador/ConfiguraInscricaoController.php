<?php

namespace App\Http\Controllers\Coordenador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfiguraInscricaoController extends Controller
{
    public function getConfiguraInscricao()
    {
        return view('templates.partials.coordenador.configurar_inscricao');
    }

    public function postConfiguraInscricao()
    {
        
    }
}
