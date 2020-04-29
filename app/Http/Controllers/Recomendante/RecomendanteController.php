<?php

namespace App\Http\Controllers\Recomendante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecomendanteController extends Controller
{
    public function getLink(Request $request)
    {
        $link_acesso = $request->token;
        
        $id_recomendante = explode("-", $request->reco)[0];

        $id_inscricao_pnpd = explode("-", $request->reco)[1];

        dd($id_recomendante);
    }
}
