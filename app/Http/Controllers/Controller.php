<?php

namespace App\Http\Controllers;

use App\Models\ConfiguraInscricaoPNPD;
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
        $inscricao_pos = new ConfiguraInscricaoPNPD();

        $periodo_inscricao = $inscricao_pos->retorna_periodo_inscricao();

        View::share ( 'periodo_inscricao', $periodo_inscricao );
    }
}
