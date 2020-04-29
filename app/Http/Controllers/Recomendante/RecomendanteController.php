<?php

namespace App\Http\Controllers\Recomendante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecomendanteController extends Controller
{
    public function getLink(Request $request)
    {
        $link_acesso = $request->token;
        $id_recomendante = $request->reco;

        dd($id_recomendante);
    }
}
