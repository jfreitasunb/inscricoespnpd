<?php

namespace App\Http\Controllers\Candidato;

use Auth;
use Session;
use App\Models\ConfiguraInscricaoPNPD;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    public function getMenu()
    {
        Session::get('locale');
        
        // $user = $this->SetUser();
        
        // $id_user = $user->usuario_id;

        $configura_inscricao = new ConfiguraInscricaoPNPD();

        $libera_formulario = $configura_inscricao->autoriza_inscricao();

        if ($libera_formulario) {
            return view('templates.partials.candidato.formulario_inscricao');
        }else{
            return view('/');
        }
    }
}
