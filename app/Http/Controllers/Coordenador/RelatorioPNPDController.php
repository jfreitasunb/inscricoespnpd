<?php

namespace App\Http\Controllers\Coordenador;

use Auth;
use Alert;
use Session;
use Carbon\Carbon;
use Notification;
use App\Models\User;
use App\Models\ConfiguraInscricaoPNPD;
use App\Models\FinalizaInscricao;
use App\Models\CartaRecomendacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\NotificaNovaInscricao;


class RelatorioPNPDController extends Controller
{
    public function getFichaInscricaoPorCandidato()
    {   
        $user = Auth::user();
        
        $relatorio = new ConfiguraInscricaoPNPD();

        $relatorio_disponivel = $relatorio->retorna_edital_vigente();

        $finalizacoes = new FinalizaInscricao;

        if (session()->has('nome_pdf')) {
            $nome_pdf = session()->get('nome_pdf');
        }else{
            $nome_pdf = null;
        }

        if (session()->has('id_aluno_pdf')) {
            $id_aluno_pdf = session()->get('id_aluno_pdf');
        }else{
            $id_aluno_pdf = null;
        }
        

        $finalizadas = $finalizacoes->retorna_usuarios_relatorios($relatorio_disponivel->id_inscricao_pnpd);

        $i=0;

        foreach ($finalizadas as $candidato ) {

            $inscricoes_finalizadas[$i]['id_inscricao_pnpd'] = $relatorio_disponivel->id_inscricao_pnpd;

            $inscricoes_finalizadas[$i]['id_candidato'] = $candidato->id_candidato;

            $inscricoes_finalizadas[$i]['nome'] = User::find($candidato->id_candidato)->nome;
            
            $cartas = new CartaRecomendacao();

            $total_cartas[$candidato->id_candidato]=  $cartas->conta_cartas_enviadas_por_candidato($candidato->id_inscricao_pnpd, $candidato->id_candidato);

            $i++;
        }

        $classes_linhas[0] = 'table-danger';
        $classes_linhas[1] = 'table-info';
        $classes_linhas[2] = 'table-success';

        return view('templates.partials.coordenador.ficha_individual', compact('inscricoes_finalizadas', 'total_cartas', 'classes_linhas', 'nome_pdf', 'id_aluno_pdf'));
    }

    public function GeraPdfFichaIndividual()
    {   
        $user = Auth::user();
        

        $id_inscricao_pnpd = (int) $_GET['id_inscricao_pnpd'];
        
        $id_aluno_pdf = (int) $_GET['id_aluno'];

        $ficha = new RelatorioController;
    
        $nome_pdf = $ficha->geraFichaIndividual($id_aluno_pdf, $this->locale_default);
        
        
        return redirect()->back()->with(compact('nome_pdf','id_aluno_pdf'));
    }
}
