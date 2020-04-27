<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DadosInscricao extends Model
{
    protected $table = 'dados_inscricao';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_inscricao_pnpd',
        'id_candidato', 
        'cpf',
        'instituicao',
        'ano_doutorado',
        'colaboradores',
        'recomendantes',
    ];

    public function retorna_registro($id_inscricao_pnpd, $id_candidato)
    {
        return $this->select('id')->where('id_inscricao_pnpd', $id_inscricao_pnpd)->where('id_candidato', $id_candidato)->value('id');
    }
}
