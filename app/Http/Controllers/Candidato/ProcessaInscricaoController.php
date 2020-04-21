<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcessaInscricaoController extends Controller
{
    public function getProcessaInscricao()
    {

    }

    public function postProcessaInscricao(Request $request)
    {
      dd($request);
    }
}
