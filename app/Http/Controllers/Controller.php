<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $periodo_inscricao;

    public $texto_inscricao_pos;

    public function __construct()
    {
        // $inscricao_pos = new ConfiguraInscricaoPos();

        // $periodo_inscricao = $inscricao_pos->retorna_periodo_inscricao();

        // $texto_inscricao_pos = $inscricao_pos->define_texto_inscricao();
        // 
        
        $periodo_inscricao = "01/04/2020 à 31/12/2020";

        View::share ( 'periodo_inscricao', $periodo_inscricao );
    }
}
