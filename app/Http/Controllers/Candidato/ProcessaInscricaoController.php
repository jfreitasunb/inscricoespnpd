<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ConfiguraInscricaoPNPD;

class ProcessaInscricaoController extends Controller
{
    public function postProcessaInscricao(Request $request)
    {
        $configura_inscricao = new ConfiguraInscricaoPNPD();

        $edital = $configura_inscricao->retorna_edital_vigente();

        $id_inscricao_pnpd = $edital->id_inscricao_pnpd;

        $libera_formulario = $configura_inscricao->autoriza_inscricao();

        if (!$libera_formulario) {
            return view('/');
        }

        if ($necessita_recomendante) {
            
            $this->validate($request, [
                'nome' => 'required',
                'cpf' => 'required',
                'instituicao' => 'required',
                'ano_doutorado',
                'colaboradores',
                'nome_recomendante' => 'required|valida_recomendantes',
                'email_recomendante' => 'required|valida_recomendantes',
                'confirmar_email_recomendante' => 'required|same:email_recomendante',
                'curriculo' => 'required|max:50000|mimes:pdf',
                'projeto' => 'required|max:50000|mimes:pdf',
            ]);
        }else{
            $this->validate($request, [
                'nome' => 'required',
                'cpf' => 'required',
                'instituicao' => 'required',
                'ano_doutorado' => 'required',
                'colaboradores' => 'required|array|min:2',
                'curriculo' => 'required|max:50000|mimes:pdf',
                'projeto' => 'required|max:50000|mimes:pdf',
            ]);
        }
        
    }
}
