<?php

namespace App\Http\Controllers\DataTable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\FinalizaInscricao;
use App\Models\User;
use App\Models\ConfiguraInscricaoPNPD;
use App\Models\DadosInscricao;
use App\Models\ArquivosParaInscricao;
use App\Models\CartaRecomendacao;
use App\Models\LinkCartaRecomendacao;
use App\Notifications\NotificaRecomendante;

use Notification;
use Storage;
use DB;
use URL;
use File;

class InscricoesNaoFinalizadasDataTableController extends DataTableController
{
    public function builder()
    {
        return FinalizaInscricao::query();
    }

    public function getDisplayableColumns()
    {
        return [
            'id_candidato', 'created_at', 'updated_at'
        ];
    }

    public function getVisibleColumns()
    {
        return [
            'id_candidato', 'nome', 'email', 'created_at', 'updated_at'
        ];
    }

    public function getCustomColumnNanes()
    {
        return [
            'id_candidato' => 'Identificador',
            'nome' => 'Nome',
            'email' => 'Email',
            'created_at' => 'Criação',
            'updated_at' => 'Última atualização',
        ];
    }

    public function index(Request $request)
    {   
        return response()->json([
            'data' => [
                'table' => $this->builder->getModel()->getTable(),
                'displayable' => array_values($this->getDisplayableColumns()),
                'visivel' => array_values($this->getVisibleColumns()),
                'custom_columns' => $this->getCustomColumnNanes(),
                'records' => $this->getRecords($request),
            ]
        ]);
    }

    protected function getDatabaseColumnNames()
    {
        return Schema::getColumnListing($this->builder->getModel()->getTable());
    }


    protected function getRecords(Request $request)
    {   
        $edital = new ConfiguraInscricaoPNPD();

        $edital_vigente = $edital->retorna_edital_vigente();

        $id_inscricao_pnpd = $edital_vigente->id_inscricao_pnpd;

        $necessita_recomendante = $edital_vigente->necessita_recomendante;

        $dados_temporarios = $this->builder()->limit($request->limit)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->where('inscricao_finalizada', FALSE)->orderBy('id_candidato')->get($this->getDisplayableColumns());

        if (sizeof($dados_temporarios) > 0) {
            foreach ($dados_temporarios as $dados) {

                $id_candidato = $dados->id_candidato;

                if ($necessita_recomendante) {
                    
                    $contatos = new DadosInscricao();
                
                    $situacao_recomendante = $contatos->retorna_dados_inscricao($id_candidato,
                        $id_inscricao_pnpd);
                    
                    $ids_recomendantes = $situacao_recomendante[0]->recomendantes;
                    
                    if (!is_null($ids_recomendantes)) {
                        
                        $temp = explode("_", $ids_recomendantes);

                        for ($i=0; $i < sizeof($temp); $i++) {

                            $carta = new CartaRecomendacao();

                            $recomendantes[$i+1] = $carta->retorna_carta_inicializada($temp[$i], $id_candidato, $id_inscricao_pnpd);

                            $link = new LinkCartaRecomendacao();

                            $link_carta[$i+1] = $link->link_existe($temp[$i], $id_candidato, $id_inscricao_pnpd);
                        }
                    }else{
                        $recomendante[1] = null;
                        $recomendante[2] = null;

                        $link_carta[1] = null;

                        $link_carta[2] = null;
                    }
                }
                
                $url_arquivo = URL::to('/').str_replace('/var/www/inscricoespos/storage/app/public','storage',storage_path('app/public/relatorios/arquivos_auxiliares/'));

                $documentos_enviados = new ArquivosParaInscricao();
                
                $documentos_candidato = $documentos_enviados->retorna_arquivo_edital_atual($id_candidato, $id_inscricao_pnpd);

                if (sizeof($documentos_candidato)){
                    
                    foreach ($documentos_candidato as $documento) {
                        
                        $temp =explode("/", $documento['nome_arquivo']);

                        if (count($temp) > 1) {
                            File::copy(storage_path("app/").$documento['nome_arquivo'], storage_path("app/public/relatorios/")."arquivos_auxiliares/".$temp[1]);

                            $tipo_documento[strtolower($documento->tipo_arquivo)] = $url_arquivo.$temp[1];
                        }else{
                            $tipo_documento[strtolower($documento->tipo_arquivo)] = null;
                        }
                    }
                }

                if ($necessita_recomendante) {
                    $dados_vue[] = ['id_candidato' => $id_candidato, 'nome' => (User::find($dados->id_candidato))->nome, 'email' => (User::find($dados->id_candidato))->email, 'created_at' => $dados->created_at->format('d/m/Y'). " ".$dados->created_at->format('H:m'), 'updated_at' => $dados->updated_at->format('d/m/Y'). " ".$dados->updated_at->format('H:m'), 'recomendante1' => $recomendantes[1], 'recomendante2' => $recomendantes[2], 'link_carta1' => $link_carta[1], 'link_carta2' => $link_carta[2], 'projeto' => is_null($tipo_documento['projeto'])?: $tipo_documento['projeto'], 'curriculo' => is_null($tipo_documento['curriculo'])?: $tipo_documento['curriculo'], 'id_inscricao_pnpd' => $id_inscricao_pnpd, 'necessita_recomendante' => $necessita_recomendante];
                }else{
                    $dados_vue[] = ['id_candidato' => $id_candidato, 'nome' => (User::find($dados->id_candidato))->nome, 'email' => (User::find($dados->id_candidato))->email, 'created_at' => $dados->created_at->format('d/m/Y'). " ".$dados->created_at->format('H:m'), 'updated_at' => $dados->updated_at->format('d/m/Y'). " ".$dados->updated_at->format('H:m'), 'projeto' => is_null($tipo_documento['projeto'])?: $tipo_documento['projeto'], 'curriculo' => is_null($tipo_documento['curriculo'])?: $tipo_documento['curriculo'], 'id_inscricao_pnpd' => $id_inscricao_pnpd, 'necessita_recomendante' => $necessita_recomendante];
                }
                
            }
        }else{
            $dados_vue = [];
        }
        
        return $dados_vue;
    }

    public function update($id, Request $request)
    {
        $id_candidato = explode("_", $id)[0];

        $id_inscricao_pnpd = explode("_", $id)[1];

        $edital_ativo = new ConfiguraInscricaoPNPD();

        $necessita_recomendante = $edital_ativo->retorna_edital_vigente()->necessita_recomendante;

        $locale_fixo = 'en';

        $dados_pessoais_candidato = User::find($id_candidato);

        if ($necessita_recomendante) {
            
            $dados_inscircao = new DadosInscricao();

            $informou_recomendantes = explode("_", $dados_inscircao->retorna_dados_inscricao($id_candidato,$id_inscricao_pnpd)[0]->recomendantes);

            for ($i=0; $i < sizeof($informou_recomendantes); $i++) { 
                
                $link = new LinkCartaRecomendacao();

                $dado_pessoal_recomendante = User::find($informou_recomendantes[$i]);

                $prazo_envio = Carbon::createFromFormat('Y-m-d', $edital_ativo->retorna_edital_vigente()->prazo_carta);

                $dados_email['nome_professor'] = $dado_pessoal_recomendante->nome;

                $dados_email['nome_candidato'] = $dados_pessoais_candidato->nome;

                $dados_email['email_recomendante'] = $dado_pessoal_recomendante->email;

                $dados_email['prazo_envio'] = $prazo_envio->format('d/m/Y');

                $dados_email['id_recomendante'] = $informou_recomendantes[$i];

                $dados_email['id_inscricao_pnpd'] = $id_inscricao_pnpd;

                $dados_email['link_acesso'] = $link->recupera_link_acesso($informou_recomendantes[$i], $id_candidato, $id_inscricao_pnpd);

                Notification::send(User::find($informou_recomendantes[$i]), new NotificaRecomendante($dados_email));
            }
        }

        DB::table('finaliza_inscricao')->where('id_candidato', $id_candidato)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->update(['inscricao_finalizada' => True, 'updated_at' => date('Y-m-d H:i:s')]);
    }
}
