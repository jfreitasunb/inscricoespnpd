<?php

namespace App\Http\Controllers\Candidato;

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
use Purifier;

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

        $atualiza_nome['nome'] = Purifier::clean(trim($request->nome));

        $usuario->update($atualiza_nome);

        $cpf = str_replace("-", "", str_replace(".", "", Purifier::clean(trim($request->cpf))));

        $instituicao = Purifier::clean(trim($request->instituicao));

        $ano_doutorado = (int)Purifier::clean(trim($request->ano_doutorado));

        $colaboradores = Purifier::clean(trim($request->colaboradores));

        $ja_iniciou_inscricao = $inscricao->retorna_registro($usuario_id, $id_inscricao_pnpd);

        $id_recomendantes = "";

        for ($i=0; $i < $numero_cartas; $i++) { 
            
            $novo_usuario = new User();

            $usuario_existe = $novo_usuario->retorna_id_pelo_email(Purifier::clean(trim(strtolower($emails_recomendantes[$i]))));

            if (is_null($usuario_existe)) {

                $senha_temporaria = str_shuffle(bin2hex(random_bytes(rand(5, 20))).$emails_recomendantes[0].bin2hex(random_bytes(rand(5, 25))));

                $novo_usuario->nome = Purifier::clean(trim($nomes_recomendantes[$i]));

                $novo_usuario->email = Purifier::clean(trim(strtolower($emails_recomendantes[$i])));

                $novo_usuario->password = Hash::make($senha_temporaria);

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

            $atualiza->update($dados_inscricao_candidato);
        }

        $curriculo = new ArquivosParaInscricao();
                
        $curriculo_ja_enviados = $curriculo->retorna_arquivo_edital_atual($usuario_id, $id_inscricao_pnpd, 'Curriculo');

        if (is_null($curriculo_ja_enviados)) {

            $curriculum = $request->curriculo->store('uploads');

            $curriculo->id_candidato = $usuario_id;
            
            $curriculo->id_inscricao_pnpd = $id_inscricao_pnpd;

            $curriculo->nome_arquivo = $curriculum;
        
            $curriculo->tipo_arquivo = "Curriculo";
        
            $curriculo->save();
        }else{
            
            $nome_arquivo = explode("/", $curriculo_ja_enviados->nome_arquivo);

            $request->curriculo->storeAs('uploads', $nome_arquivo[1]);

            $curriculo->atualiza_arquivos_enviados($usuario_id, $id_inscricao_pnpd, 'Curriculo');
        }
        
        $projeto = new ArquivosParaInscricao();
                
        $projeto_ja_enviado = $projeto->retorna_arquivo_edital_atual($usuario_id, $id_inscricao_pnpd, 'Projeto');

        if (is_null($projeto_ja_enviado)) {
            
            $proj = $request->projeto->store('uploads');

            $projeto->id_candidato = $usuario_id;
            
            $projeto->id_inscricao_pnpd = $id_inscricao_pnpd;

            $projeto->nome_arquivo = $proj;
        
            $projeto->tipo_arquivo = "Projeto";
        
            $projeto->save();

        }else{
            
            $nome_projeto = explode("/", $projeto_ja_enviado->nome_arquivo);

            $request->projeto->storeAs('uploads', $nome_projeto[1]);

            $projeto->atualiza_arquivos_enviados($usuario_id, $id_inscricao_pnpd, 'Projeto');
        }

        $finaliza_inscricao = new FinalizaInscricao();

        $ja_inicializou = $finaliza_inscricao->retorna_tabela_inicializada($usuario_id, $id_inscricao_pnpd);

        if (is_null($ja_inicializou)) {

            $finaliza_inscricao->id_candidato = $usuario_id;

            $finaliza_inscricao->id_inscricao_pnpd = $id_inscricao_pnpd;

            $finaliza_inscricao->save();
        }

        Alert::success(trans('mensagens_gerais.mensagem_sucesso'));

        return redirect()->route('finalizar.inscricao');    
    }
}
