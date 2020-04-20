<?php

namespace App\Http\Controllers\Coordenador;

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
        
        // dd($request);
    }
}
