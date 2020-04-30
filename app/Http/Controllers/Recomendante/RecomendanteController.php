<?php

namespace App\Http\Controllers\Recomendante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LinkCartaRecomendacao;
use App\Models\ConfiguraInscricaoPNPD;
use App\Models\User;
use App\Models\DadosInscricao;
use App\Models\CartaRecomendacao;


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

        $link = new LinkCartaRecomendacao();

        $dados_link = $link->retorna_dados_link($link_acesso);

        if (count($dados_link)> 1 or count($dados_link) == 0) {
            
            return redirect('/');
        }

        $dados_link = $link->retorna_dados_link($link_acesso)[0];

        $edital = $inscricao->retorna_edital_vigente();

        $id_inscricao_pnpd = $edital->id_inscricao_pnpd;

        $id_recomendante = explode("-", $request->reco)[0];

        $id_inscricao = explode("-", $request->reco)[1];

        if (!$edital->necessita_recomendante) {
            
            return redirect('/');
        }

        if ($edital->id_inscricao_pnpd != $id_inscricao) {
            
            return redirect('/');
        }

        if ($dados_link->id_recomendante != $id_recomendante ) {
            
            return redirect('/');
        }

        $dados = new DadosInscricao();

        $dados_candidato = $dados->retorna_dados_inscricao($dados_link->id_candidato, $id_inscricao_pnpd);

        if (strpos($dados_candidato[0]->recomendantes, $id_recomendante) == false) {
            
            return redirect('/');
        }

        


    }
}
