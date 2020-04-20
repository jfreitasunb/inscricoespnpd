<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguraInscricaoPNPD extends Model
{
    protected $table = 'configura_inscricao_pnpd';

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

    public function permite_configurar_inscricao($data_inicio, $data_fim)
    {
        $existe = count($this->whereBetween('fim_inscricao', [$data_inicio, $data_fim])->get());

        if ($existe) {
            return false;
        }

        return true;
    }
}
