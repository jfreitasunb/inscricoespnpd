<?php

namespace App\Http\Controllers\Recomendante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LinkCartaRecomendacao;
use App\Models\ConfiguraInscricaoPNPD;
use App\Models\User;
use App\Models\DadosInscricao;
use App\Models\CartaRecomendacao;
use App\Models\DadosRecomendante;


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

        $reco = $request->reco;

        $id_recomendante = explode("-", $reco)[0];

        $id_inscricao = explode("-", $reco)[1];

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

        $dados_recomendante = [];

        $dados_recomendante['nome_recomendante'] = User::find($id_recomendante)->nome;

        $dados_recomendante['id_recomendante'] = $id_recomendante;

        $recomendante = new DadosRecomendante();

        $dados_recomendante['instituicao_recomendante'] = $recomendante->retorna_dados_recomendante($id_recomendante)->instituicao;

        $carta = new CartaRecomendacao();

        $dados_recomendante['carta'] = $carta->retorna_dados_carta($id_recomendante, $dados_link->id_candidato, $id_inscricao_pnpd)->recomendacao;
        
        $dados_candidato = [];

        $dados_candidato['nome_candidato'] = User::find($dados_link->id_candidato)->nome;

        $dados_candidato['id_candidato'] = $dados_link->id_candidato;

        return view('templates.partials.recomendante.carta_recomendacao')->with(compact('id_inscricao_pnpd', 'dados_candidato', 'dados_recomendante', 'link_acesso', 'reco'));
    }

    public function postSalvaCarta(Request $request)
    {
        $inscricao = new ConfiguraInscricaoPNPD();

        $autoriza_carta = $inscricao->autoriza_carta();

        if (!$autoriza_carta) {

            Alert::error('Dear professor, the deadline for sending letters is closed.');

            return redirect('/');
        }

        $this->validate($request, [
            'nome_recomendante' => 'required',
            'instituicao' => 'required',
            'recomendacao' => 'required',
        ]);

        $nome_recomendante = $request->nome_recomendante;

        $instituicao = $request->instituicao;

        $recomendacao = $request->recomendacao;

        $valor_original = $_GET['reco'];

        $link_original = $_GET['link_acesso'];

        $id_recomendante_original = explode('-', $valor_original)[0];

        $id_inscricao_pnpd_original = explode('-', $valor_original)[1];

        $id_inscricao_pnpd_formulario = (int)$request->id_inscricao_pnpd;

        $id_candidato_formulario = (int)$request->id_candidato;

        $id_recomendante_formulario = (int)$request->id_recomendante;

        if (($id_recomendante_original != $id_recomendante_formulario) or ($id_inscricao_pnpd_original != $id_inscricao_pnpd_formulario)) {
            
            return redirect('/');
        }

        $link = new LinkCartaRecomendacao();

        $dados_link = $link->retorna_dados_link($link_original);

        if (count($dados_link)> 1 or count($dados_link) == 0) {
            
            return redirect('/');
        }

        $dados_link = $link->retorna_dados_link($link_original);

        $edital = $inscricao->retorna_edital_vigente();

        if (!$edital->necessita_recomendante) {
            
            return redirect('/');
        }

        if ($edital->id_inscricao_pnpd != $id_inscricao_pnpd_original) {
            
            return redirect('/');
        }

        if ($dados_link[0]->id_recomendante != $id_recomendante_original ) {
            
            return redirect('/');
        }

        $dados = new DadosInscricao();

        $dados_candidato = $dados->retorna_dados_inscricao($dados_link[0]->id_candidato, $id_inscricao_pnpd_original);

        if (strpos($dados_candidato[0]->recomendantes, $id_recomendante_original) == false) {
            
            return redirect('/');
        }

        $carta = new CartaRecomendacao();

        $id_carta_inicializada = $carta->retorna_id_carta_inicializada($id_recomendante_original, $dados_link[0]->id_candidato, $id_inscricao_pnpd_original);

       $preenche_carta = CartaRecomendacao::find($id_carta_inicializada);

       $preenche_carta->recomendacao = $recomendacao;

       $preenche_carta->carta_finalizada = True;

       $preenche_carta->update();

       $user = User::find($id_recomendante_original);

       if ($user->nome != $nome_recomendante) {
           
           $user->nome = $nome_recomendante;

           $user->update();
       }

       $dado_recomendate = new DadosRecomendante();

       $id_dado_recomendante = $dado_recomendate->retorna_id_dados_recomendante($id_recomendante_original);

       if (is_null($id_dado_recomendante)) {
           
           $dado_recomendate->id_recomendante = $id_recomendante_original;

           $dado_recomendate->instituicao = $instituicao;

           $dado_recomendate->save();
       }else{
            
            $atualiza_dados_recomendante = DadosRecomendante::find($id_dado_recomendante);

            $atualiza_dados_recomendante->instituicao = $instituicao;

            $atualiza_dados_recomendante->update();
       }
    }
}
