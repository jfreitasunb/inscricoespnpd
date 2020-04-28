<?php

namespace App\Http\Controllers\Candidato;

use Auth;
use Session;
use App\Models\ConfiguraInscricaoPNPD;
use App\Models\CartaRecomendacao;
use App\Models\FinalizaInscricao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    public function getMenu()
    {
        Session::get('locale');
        
        $configura_inscricao = new ConfiguraInscricaoPNPD();

        $edital = $configura_inscricao->retorna_edital_vigente();

        $id_inscricao_pnpd = $edital->id_inscricao_pnpd;

        $numero_cartas = $edital->numero_cartas;

        $libera_formulario = $configura_inscricao->autoriza_inscricao();


        if (!$libera_formulario) {
            
            return view('/');
        }

        $user = Auth::user();

        $nome = $user->nome;

        $usuario_id = $user->usuario_id;

        $finaliza_inscricao = new FinalizaInscricao();

        $status_inscricao = $finaliza_inscricao->retorna_inscricao_finalizada($usuario_id, $id_inscricao_pnpd);

        if ($status_inscricao) {

            $carta = new CartaRecomendacao();

            return view('templates.partials.candidato.status_cartas')->with(compact('dados_cartas'));
            
        }

        return view('templates.partials.candidato.formulario_inscricao')->with(compact('id_inscricao_pnpd', 'numero_cartas', 'nome'));
    }
}
