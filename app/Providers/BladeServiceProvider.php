<?php

namespace App\Providers;

use App\Models\ConfiguraInscricaoPNPD;
use App\Models\FinalizaInscricao;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Request;
use App\Models\LinkCartaRecomendacao;
use App\Models\DadosInscricao;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    
    private $accordion_configurar_edital = ['configura.inscricao', 'editar.inscricao'];

    public function ativa_accordion_configura_edital()
    {
        if (in_array(Route::currentRouteName(), $this->accordion_configurar_edital)) {
            return 'show';
        }else{
            return '';
        }
    }

    public function boot()
    {
        Blade::if('admin', function ( $user = null ){

            if (!$user && auth()->check()) {
                $user = auth()->user();
            }

            if (!$user) {
                return false;
            }

            // View::share('keep_open_accordion_contas', $this->ativa_accordion_contas());

            // View::share('keep_open_accordion_dados_pos', $this->ativa_accordion_dados_pos());

            // View::share('keep_open_accordion_relatorios', $this->ativa_accordion_relatorios());

            View::share('keep_open_accordion_configurar_edital', $this->ativa_accordion_configura_edital());

            return $user->isAdmin();
        });

        Blade::if('coordenador', function ( $user = null ){

            if (!$user && auth()->check()) {
                $user = auth()->user();
            }

            if (!$user) {
                return false;
            }

            // View::share('keep_open_accordion_contas', $this->ativa_accordion_contas());

            // View::share('keep_open_accordion_dados_pos', $this->ativa_accordion_dados_pos());

            // View::share('keep_open_accordion_relatorios', $this->ativa_accordion_relatorios());

            View::share('keep_open_accordion_configurar_edital', $this->ativa_accordion_configura_edital());

            return $user->isCoordenador();
        });

        Blade::if('candidato', function ( $user = null ){

            if (!$user && auth()->check()) {
                $user = auth()->user();
            }

            if (!$user) {
                return false;
            }

            View::share('nome_usuario', $user->nome);

            return $user->isCandidato();
        });

        Blade::if('liberainscricao', function ( $user = null ){

            $edital_ativo = new ConfiguraInscricaoPNPD();

            $autoriza_inscricao = $edital_ativo->autoriza_inscricao();

            return $autoriza_inscricao;

        });

        Blade::if('statuscarta', function ( $user = null ){

            $user = auth()->user();

            $id_user = $user->usuario_id;

            $edital_ativo = new ConfiguraInscricaoPNPD();

            $id_inscricao_pnpd = $edital_ativo->retorna_edital_vigente()->id_inscricao_pnpd;

            $edital = $edital_ativo->retorna_edital_vigente()->edital;

            $autoriza_status_carta = $edital_ativo->visualiza_status_carta();

            $finaliza_inscricao = new FinalizaInscricao();

            $status_inscricao = $finaliza_inscricao->retorna_inscricao_finalizada($id_user, $id_inscricao_pnpd);

            if ($autoriza_status_carta and ($status_inscricao or is_null($status_inscricao))) {
                return true;
            }else{
                return false;
            }
        });

        Blade::if('acessa_carta', function (){
            
            $url = explode("/", Request::url());

            $tamanho_array = sizeof($url);

            $inscricao = new ConfiguraInscricaoPNPD();

            $autoriza_carta = $inscricao->autoriza_carta();

            if (!$autoriza_carta) {

                return False;
            }

            $link_acesso = $url[$tamanho_array - 2];

            $link = new LinkCartaRecomendacao();

            $dados_link = $link->retorna_dados_link($link_acesso);

            if (count($dados_link)> 1 or count($dados_link) == 0) {
                
                return False;
            }

            $dados_link = $link->retorna_dados_link($link_acesso)[0];

            $edital = $inscricao->retorna_edital_vigente();

            $id_inscricao_pnpd = $edital->id_inscricao_pnpd;

            $reco = $url[$tamanho_array - 1];

            $id_recomendante = explode("-", $reco)[0];

            $id_inscricao = explode("-", $reco)[1];

            if (!$edital->necessita_recomendante) {
                
                return False;
            }

            if ($edital->id_inscricao_pnpd != $id_inscricao) {
                
                return False;
            }

            if ($dados_link->id_recomendante != $id_recomendante ) {
                
                return False;
            }

            $dados = new DadosInscricao();

            $dados_candidato = $dados->retorna_dados_inscricao($dados_link->id_candidato, $id_inscricao_pnpd);

            if (strpos($dados_candidato[0]->recomendantes, $id_recomendante) == false) {
                
                return False;
            }

            return True;
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
