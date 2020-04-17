<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppModelsConfiguraInscricaoPNPD extends Model
{
    // protected $table = 'users';

    protected $primaryKey = 'id_inscricao_pnpd';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inicio_inscricao', 
        'fim_inscricao',
        'prazo_carta',
        'data_homologacao',
        'data_divulgacao_resultado',
        'edital',
        'id_coordenador',
        'necessita_recomendante',
    ];
}
