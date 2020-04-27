<?php

namespace App\Http\Controllers\Candidato;

use Illuminate\Support\Facades\Hash;
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

        $numero_cartas = $edital->numero_cartas;

        $necessita_recomendante = $edital->necessita_recomendante;

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
        
        $nomes_recomendantes = $request->nome_recomendante;

        $emails_recomendantes = $request->email_recomendante;

        $user = Auth::user();

        $usuario_id = $user->usuario_id;

        $inscricao = new DadosInscricao();

        $usuario = User::find($usuario_id);

        $atualiza_nome['nome'] = $request->nome;

        $usuario->update($atualiza_nome);

        $cpf = str_replace("-", "", str_replace(".", "", $request->cpf));

        $instituicao = $request->instituicao;

        $ano_doutorado = (int)$request->ano_doutorado;

        $colaboradores = $request->colaboradores;

        $ja_iniciou_inscricao = $inscricao->retorna_registro($id_inscricao_pnpd, $usuario_id);

        $id_recomendantes = "";

        for ($i=0; $i < $numero_cartas; $i++) { 
            
            $novo_usuario = new User();

            $usuario_existe = $novo_usuario->retorna_id_pelo_email($emails_recomendantes[$i]);

            if (is_null($usuario_existe)) {
                
                $novo_usuario->nome = $nomes_recomendantes[$i];

                $novo_usuario->email = $emails_recomendantes[$i];

                $novo_usuario->password = Hash::make('temp');

                $novo_usuario->locale = 'en';

                $novo_usuario->user_type = 'recomendante';

                $novo_usuario->save();

                if ($i == 0) {
                    $id_recomendantes .= $novo_usuario->usuario_id."_";
                }else{
                    $id_recomendantes .= $novo_usuario->usuario_id;
                }
            }else{
                if ($i == 0) {
                    $id_recomendantes .= $usuario_existe."_";
                }else{
                    $id_recomendantes .= $usuario_existe;
                }
            }
        }

        $dados_inscricao_candidato = [];

        $dados_inscricao_candidato['cpf'] = $cpf;

        $dados_inscricao_candidato['instituicao'] = $instituicao;

        $dados_inscricao_candidato['ano_doutorado'] = $ano_doutorado;

        $dados_inscricao_candidato['colaboradores'] = $colaboradores;

        $dados_inscricao_candidato['recomendantes'] = $id_recomendantes;

        if (is_null($ja_iniciou_inscricao)) {

            $inscricao->save($dados_inscricao_candidato);
        }else{
            $atualiza = DadosInscricao::find($ja_iniciou_inscricao);

            dd($atualiza->update($dados_inscricao_candidato));
        }
    }
}
