<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Alert;
use App\Models\ConfiguraInscricaoPNPD;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditaInscricaoController extends Controller
{
    public function getEditaInscricao()
    {
        $user = Auth::user();

        if ($user->user_type == "admin") {
            return view('templates.partials.admin.editar_inscricao');
        }else{
            return redirect()->home();
        }
        
    }

    public function postEditaInscricao()
    {
        
    }
}
