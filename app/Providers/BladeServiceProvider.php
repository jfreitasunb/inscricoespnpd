<?php

namespace App\Providers;

use App\Models\ConfiguraInscricaoPNPD;
use App\Models\FinalizaInscricao;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    
    private $accordion_configurar_edital = ['configura.inscricao', 'configura.periodo.confirmacao', 'configura.periodo.matricula', 'editar.inscricao', 'editar.periodo.confirmacao', 'editar.periodo.envio.documentos.matricula'];

    public function ativa_accordion_configura_edital()
    {
        if (in_array(Route::currentRouteName(), $this->accordion_configurar_edital)) {
            return 'in';
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

            if ($autoriza_status_carta and $status_inscricao) {
                return true;
            }else{
                return false;
            }
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
