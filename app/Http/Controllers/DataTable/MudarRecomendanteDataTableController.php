<?php

namespace App\Http\Controllers\DataTable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ConfiguraInscricaoPNPD;
use App\Models\User;
use App\Models\CartaRecomendacao;
use App\Models\DadosInscricao;
use Illuminate\Validation\Rule;
use DB;
use Notification;
use Carbon\Carbon;
use App\Notifications\NotificaRecomendante;
use Illuminate\Support\Str;

class MudarRecomendanteDataTableController extends DataTableController
{
    public function builder()
    {
        return CartaRecomendacao::query();
    }

    public function getDisplayableColumns()
    {
        return [
            'id_candidato', 'id_recomendante', 'carta_finalizada'
        ];
    }

    public function getVisibleColumns()
    {
        return [
            'id', 'nome_candidato', 'nome_recomendante', 'email_recomendante', 'status_carta'
        ];
    }

    public function getUpdatableColumns()
    {
        return [
            'nome_recomendante', 'email_recomendante'
        ];
    }

    public function getCustomColumnNanes()
    {
        return [
            'id' => 'Inscrição',
            'id_candidato' => 'Identificador',
            'nome_candidato' => 'Nome',
            'email_recomendante' => 'E-mail Recomendante',
            'status_carta' => 'Carta enviada?'
        ];
    }

    public function index(Request $request)
    {   
        $relatorio = new ConfiguraInscricaoPNPD();

        $relatorio_disponivel = $relatorio->retorna_edital_vigente();

        $id_inscricao_pnpd = $relatorio_disponivel->id_inscricao_pnpd;

        return response()->json([
            'data' => [
                'table' => $this->builder->getModel()->getTable(),
                'displayable' => array_values($this->getDisplayableColumns()),
                'visivel' => array_values($this->getVisibleColumns()),
                'updatable' => $this->getUpdatableColumns(),
                'custom_columns' => $this->getCustomColumnNanes(),
                'records' => $this->getRecords($request),
                'id_inscricao_pnpd' => $id_inscricao_pnpd
            ]
        ]);
    }

    protected function getDatabaseColumnNames()
    {
        return Schema::getColumnListing($this->builder->getModel()->getTable());
    }


    protected function getRecords(Request $request)
    {   
        $relatorio = new ConfiguraInscricaoPNPD();

        $relatorio_disponivel = $relatorio->retorna_edital_vigente();

        $id_inscricao_pnpd = $relatorio_disponivel->id_inscricao_pnpd;

        $dados_temporarios = $this->builder()->limit($request->limit)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->orderBy('id_candidato')->get($this->getDisplayableColumns());

        $i = 1;

        if (sizeof($dados_temporarios) > 0) {
            foreach ($dados_temporarios as $dados) {
                
                $dados_vue[] = ['id' => $i, 'id_candidato' => $dados->id_candidato, 'nome_candidato' => (User::find($dados->id_candidato))->nome, 'id_recomendante' => $dados->id_recomendante, 'nome_recomendante' => (User::find($dados->id_recomendante))->nome, 'email_recomendante' => (User::find($dados->id_recomendante))->email, 'carta_finalizada' => $dados->carta_finalizada];

                $i++;
            }
        }else{
            $dados_vue = [];
        }
        

        return $dados_vue;
    }

    public function update($id_candidato, Request $request)
    {   
        $this->validate($request, [
            'id_candidato' => 'required',
            'id_recomendante' => 'required',
            'nome_recomendante' => 'required',
            'email_recomendante' => 'required|email',
        ]);

        $relatorio = new ConfiguraInscricaoPNPD();

        $relatorio_disponivel = $relatorio->retorna_edital_vigente();

        $id_inscricao_pnpd = $relatorio_disponivel->id_inscricao_pnpd;

        $id_candidato = (int)$request->id_candidato;

        $id_recomendante = (int)$request->id_recomendante;

        $email_recomendante = strtolower(trim($request->email_recomendante));

        $nome_recomendante = trim($request->nome_recomendante);

        $email_candidato = strtolower(trim($request->email_candidato));
        
        $novo_recomendante['nome'] = $nome_recomendante;
        
        $novo_recomendante['email'] = $email_recomendante;

        $user_recomendante = new User;

        $acha_recomendante = $user_recomendante->retorna_user_por_email($email_recomendante);

        if (is_null($acha_recomendante)) {
            
            $user_recomendante->registra_recomendante($novo_recomendante);
            
            $id_novo_recomendante = $user_recomendante->retorna_user_por_email($email_recomendante)->usuario_id;
        }else{

            if ($acha_recomendante->user_type === 'recomendante') {
                $id_novo_recomendante = $acha_recomendante->usuario_id;
            }else{

                notify()->flash('O e-mail: '.$email_recomendante.' pertence a um candidato!','error');
                return redirect()->back();
            }   
        }

        $carta_recomendacao = new CartaRecomendacao();

        $ja_enviou_carta = $carta_recomendacao->carta_preenchida($id_recomendante, $id_candidato, $id_inscricao_pnpd);

        if ($ja_enviou_carta) {
            
            return redirect()->back();
            
        }else{

            DB::table('carta_recomendacao')->where('id_candidato', $id_candidato)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->where('id_recomendante', $id_recomendante)->where('carta_finalizada', false)->update(['id_recomendante' => $id_novo_recomendante, 'updated_at' => date('Y-m-d H:i:s') ]);

            $dados_inscricao = new DadosInscricao();

            $dados_candidato = $dados_inscricao->retorna_dados_inscricao($id_candidato, $id_inscricao_pnpd);

            $novos_recomendantes = str_replace($id_recomendante, $id_novo_recomendante, $dados_candidato[0]->recomendantes);

            DB::table('dados_inscricao')->where('id_candidato', $id_candidato)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->update(['recomendantes' => $novos_recomendantes, 'updated_at' => date('Y-m-d H:i:s') ]);


            $novo_tamanho_link = rand(60, 99);

            $novo_link_acesso = Str::random($novo_tamanho_link);

            DB::table('link_carta_recomendacao')->where('id_candidato', $id_candidato)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->where('id_recomendante', $id_recomendante)->update(['id_recomendante' => $id_novo_recomendante, 'link_acesso' => $novo_link_acesso, 'tamanho_link' => $novo_tamanho_link, 'updated_at' => date('Y-m-d H:i:s') ]);

            $edital = ConfiguraInscricaoPNPD::find($id_inscricao_pnpd);

            $prazo_envio = Carbon::createFromFormat('Y-m-d', $edital->prazo_carta);

            $dados_email['nome_professor'] = $nome_recomendante;
            $dados_email['nome_candidato'] = $request->nome_candidato;
            $dados_email['email_recomendante'] = $email_recomendante;
            $dados_email['prazo_envio'] = $prazo_envio->format('d/m/Y');

            $dados_email['id_recomendante'] = $id_novo_recomendante;

            $dados_email['id_inscricao_pnpd'] = $id_inscricao_pnpd;

            $dados_email['link_acesso'] = $novo_link_acesso;

            Notification::send(User::find($id_novo_recomendante), new NotificaRecomendante($dados_email));
        }
    }
}
