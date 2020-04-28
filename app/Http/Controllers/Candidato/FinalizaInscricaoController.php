<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\ConfiguraInscricaoPNPD;
use App\Models\User;
use App\Models\DadosInscricao;
use App\Models\ArquivosParaInscricao;
use App\Models\FinalizaInscricao;
use Alert;

class FinalizaInscricaoController extends Controller
{
    public function getFinalizaInscricao()
    {
        $configura_inscricao = new ConfiguraInscricaoPNPD();

        $edital = $configura_inscricao->retorna_edital_vigente();

        $id_inscricao_pnpd = $edital->id_inscricao_pnpd;

        $libera_formulario = $configura_inscricao->autoriza_inscricao();

        $numero_cartas = $edital->numero_cartas;

        $necessita_recomendante = $edital->necessita_recomendante;

        if (!$libera_formulario) {
            return view('/');
        }

        $user = Auth::user();

        $usuario_id = $user->usuario_id;

        $locale_candidato = $user->locale;

        $finaliza_inscricao = new FinalizaInscricao();

        $status_inscricao = $finaliza_inscricao->retorna_inscricao_finalizada($usuario_id, $id_inscricao_pnpd);

        if ($status_inscricao) {

            Alert()::warning(trans('mensagens_gerais.inscricao_finalizada'));

            return redirect()->back();
        }

        $nome_candidato = $user->nome;

        $novo_relatorio = new RelatorioController;

        $ficha_inscricao = $novo_relatorio->geraFichaInscricao($usuario_id, $id_inscricao_pnpd, $locale_candidato);


        return view('templates.partials.candidato.finalizar_inscricao',compact('ficha_inscricao','nome_candidato'));
    }

    public function postFinalizaInscricao(Request $request)
    {

        $configura_inscricao = new ConfiguraInscricaoPNPD();

        $edital = $configura_inscricao->retorna_edital_vigente();

        $id_inscricao_pnpd = $edital->id_inscricao_pnpd;

        $libera_formulario = $configura_inscricao->autoriza_inscricao();

        $numero_cartas = $edital->numero_cartas;

        $necessita_recomendante = $edital->necessita_recomendante;

        if (!$libera_formulario) {
            return view('/');
        }

        $user = Auth::user();

        $usuario_id = $user->usuario_id;

        $locale_candidato = $user->locale;

        $finaliza_inscricao = new FinalizaInscricao();

        $status_inscricao = $finaliza_inscricao->retorna_inscricao_finalizada($usuario_id, $id_inscricao_pnpd);

        if ($status_inscricao) {

            Alert()::warning(trans('mensagens_gerais.inscricao_finalizada'));

            return redirect()->back();
        }

        Alert::success(trans('mensagens_gerais.mensagem_sucesso'));

        return redirect()->route('finalizar.inscricao');    
    }
}
