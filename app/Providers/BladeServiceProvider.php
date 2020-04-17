<?php

namespace App\Providers;

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

            return $user->isAdmin();
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
