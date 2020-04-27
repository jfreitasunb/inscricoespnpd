<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\ConfiguraInscricaoPNPD;
use App\Models\User;
use App\Models\DadosInscricao;

class ProcessaInscricaoController extends Controller
{
    public function postProcessaInscricao(Request $request)
    {
        $configura_inscricao = new ConfiguraInscricaoPNPD();

        $edital = $configura_inscricao->retorna_edital_vigente();

        $id_inscricao_pnpd = $edital->id_inscricao_pnpd;

        $libera_formulario = $configura_inscricao->autoriza_inscricao();

        $necessita_recomendante = $configura_inscricao->necessita_recomendante;

        if (!$libera_formulario) {
            return view('/');
        }

        if ($necessita_recomendante) {
            
            $this->validate($request, [
                'nome' => 'required',
                'cpf' => 'required',
                'instituicao' => 'required',
                'ano_doutorado' => 'required',
                'colaboradores' => 'required',
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
                'colaboradores' => 'required',
                'curriculo' => 'required|max:50000|mimes:pdf',
                'projeto' => 'required|max:50000|mimes:pdf',
            ]);
        }
        
        $user = Auth::user();

        $usuario_id = $user->usuario_id;

        $inscricao = new DadosInscricao();

        $cpf = str_replace("-", "", str_replace(".", "", $request->cpf));

        $instituicao = $request->instituicao;

        $ano_doutorado = (int)$request->ano_doutorado;

        $colaboradores = $request->colaboradores;

        $ja_iniciou_inscricao = $inscricao->retorna_registro($id_inscricao_pnpd, $usuario_id);

        $dados_inscricao_candidato = [];

        $dados_inscricao_candidato['cpf'] = $cpf;

        $dados_inscricao_candidato['instituicao'] = $instituicao;

        $dados_inscricao_candidato['ano_doutorado'] = $ano_doutorado;

        $dados_inscricao_candidato['colaboradores'] = $colaboradores;

        if (is_null($ja_iniciou_inscricao)) {

            $inscricao->save($dados_inscricao_candidato);
        }else{
            $atualiza = DadosInscricao::find($ja_iniciou_inscricao);

            dd($atualiza->update($dados_inscricao_candidato));
        }
    }
}
