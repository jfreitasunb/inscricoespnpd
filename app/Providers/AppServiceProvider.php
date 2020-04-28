<?php

namespace App\Providers;

use App\Models\ConfiguraInscricaoPNPD;
use Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        Validator::extend('valida_recomendantes', function($attribute, $value, $parameters, $validator) {
            $configura_pnpd = new ConfiguraInscricaoPNPD();

            $numero_cartas = $configura_pnpd->retorna_edital_vigente()->numero_cartas;
            
            if(sizeof(array_unique($value)) <> $numero_cartas){
                return false;
            }
                return true;
        });
    }
}
