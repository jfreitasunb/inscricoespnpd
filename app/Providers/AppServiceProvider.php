<?php

namespace App\Providers;

use App\Models\ConfiguraPNPD;
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
        $configura_pnpd = new ConfiguraPNPD();

        $numero_cartas = $configura_pnpd->retorna_edital_vigente()->numero_cartas;
        
        Validator::extend('valida_recomendantes', function($attribute, $value, $parameters, $validator) {
            if(sizeof(array_unique($value)) <> $numero_cartas){
                return false;
            }
                return true;
        });
    }
}
