<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArquivosParaInscricao extends Model
{
    protected $table = 'arquivos_para_inscricao';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_candidato',
        'id_inscricao_pnpd',
        'nome_arquivo',
        'tipo_arquivo',
    ];
}
