<?php

namespace App\Http\Controllers\DataTable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Validation\Rule;

class UserDataTableController extends DataTableController
{
    public function builder()
    {
        return User::query();
    }

    public function getDisplayableColumns()
    {
        return [
            'usuario_id', 'nome', 'email', 'locale', 'user_type'
        ];
    }

    public function getUpdatableColumns()
    {
        return [
            'nome', 'email', 'locale', 'user_type'
        ];
    }

    public function getCustomColumnNanes()
    {
        return [
            'usuario_id' => 'Identificador',
            'nome' => 'Nome',
            'email' => 'E-mail',
            'locale' => 'Idioma',
            'user_type' => 'Tipo de Usuário',
        ];
    }

    public function update($usuario_id, Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:255',
            'email'  => 'required|email|max:255',
            'locale' => [
                    'required', Rule::in(['en', 'es', 'pt-br'])
                        ],
            'user_type' => [
                    'required', Rule::in(['coordenador', 'candidato', 'recomendante'])
                        ],
        ]);

        $this->builder->find($usuario_id)->update($request->only($this->getUpdatableColumns()));
    }
}
