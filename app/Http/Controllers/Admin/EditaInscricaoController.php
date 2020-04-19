<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditaInscricaoController extends Controller
{
    public function getEditaInscricao()
    {
        return view('templates.partials.admin.editar_inscricao');
    }

    public function postEditaInscricao()
    {
        
    }
}
