<?php

namespace App\Http\Controllers\Recomendante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LinkCartaRecomendacao;

class RecomendanteController extends Controller
{   
    public function getLink(Request $request)
    {
        $inscricao = new ConfiguraInscricaoPNPD();

        $autoriza_carta = $inscricao->autoriza_carta();

        if (!$autoriza_carta) {

            Alert::error('Dear professor, the deadline for sending letters is closed.');

            return redirect('/');
        }

        $link_acesso = $request->token;
        
        $id_recomendante = explode("-", $request->reco)[0];

        $id_inscricao_pnpd = explode("-", $request->reco)[1];

        dd($id_recomendante);
    }
}
