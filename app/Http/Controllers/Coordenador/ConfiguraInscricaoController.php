<?php

namespace App\Http\Controllers\Coordenador;

use Auth;
use Alert;
use Carbon\Carbon;
use App\Models\ConfiguraInscricaoPNPD;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use InscricoesPos\Notifications\NotificaNovaInscricao;


class ConfiguraInscricaoController extends Controller
{
    public function getConfiguraInscricao()
    {
        return view('templates.partials.coordenador.configurar_inscricao');
    }

    public function postConfiguraInscricao(Request $request)
    {
        $this->validate($request, [
            'inicio_inscricao' => 'required|date_format:"d/m/Y"|before:fim_inscricao|after:today',
            'fim_inscricao' => 'required|date_format:"d/m/Y"|after:inicio_inscricao|after:today',
            'prazo_carta' => 'required|date_format:"d/m/Y"|after:inicio_inscricao|after:today',
            'data_homologacao' => 'required|date_format:"d/m/Y"|after:fim_inscricao|after:today',
            'data_divulgacao_resultado' => 'required|date_format:"d/m/Y"|after:data_homologacao|after:today',
            'necessita_recomendante' => 'required',
        ]);


        $user = Auth::user();

        $inicio = Carbon::createFromFormat('d/m/Y', $request->inicio_inscricao);
        
        $fim = Carbon::createFromFormat('d/m/Y', $request->fim_inscricao);
        
        $prazo = Carbon::createFromFormat('d/m/Y', $request->prazo_carta);
        
        $homologacao = Carbon::createFromFormat('d/m/Y', $request->data_homologacao);
        
        $divulgacao_resultado = Carbon::createFromFormat('d/m/Y', $request->data_divulgacao_resultado);

        $necessita_recomendante = $request->necessita_recomendante;

        $data_inicio = $inicio->format('Y-m-d');
        
        $data_fim = $fim->format('Y-m-d');
        
        $prazo_carta = $prazo->format('Y-m-d');
        
        $data_homologacao = $homologacao->format('Y-m-d');
        
        $data_divulgacao_resultado = $divulgacao_resultado->format('Y-m-d');

        $configura_nova_inscricao_pnpd = new ConfiguraInscricaoPNPD();

        $pode_configurar = $configura_nova_inscricao_pnpd->permite_configurar_inscricao($data_inicio, $data_fim);

        $ano = explode("-", $data_inicio)[0];

        $numero_ultimo_edital = $configura_nova_inscricao_pnpd->ultimo_edital($ano);

        if ($pode_configurar) {
            
            $configura_nova_inscricao_pnpd->inicio_inscricao = $data_inicio;
            
            $configura_nova_inscricao_pnpd->fim_inscricao = $data_fim;
            
            $configura_nova_inscricao_pnpd->prazo_carta = $prazo_carta;
            
            $configura_nova_inscricao_pnpd->data_homologacao = $data_homologacao;
            
            $configura_nova_inscricao_pnpd->data_divulgacao_resultado = $data_divulgacao_resultado;
            
            $configura_nova_inscricao_pnpd->edital = ($numero_ultimo_edital+1)."-".$ano;
            
            $configura_nova_inscricao_pnpd->id_coordenador = $user->usuario_id;

            $configura_nova_inscricao_pnpd->necessita_recomendante = $necessita_recomendante;

            $configura_nova_inscricao_pnpd->save();
        }else{
            Alert::error('Já existe uma inscrição ativa!', 'Não é possível configurar uma nova!');
            return redirect()->back();
        }
    }
}
