<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkCartaRecomendacao extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'link_carta_recomendacao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_recomendante',
        'id_candidato',
        'id_inscricao_pnpd',
        'link_acesso',
    ];

    public function link_existe($id_recomendante, $id_candidato, $id_inscricao_pnpd)
    {
        $temp = $this->where('id_recomendante', $id_recomendante)->where('id_candidato', $id_candidato)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->get();

        if (count($temp) > 0) {
            return True;
        }

        return False;
    }

    public function recupera_link_acesso($id_recomendante, $id_candidato, $id_inscricao_pnpd)
    {
        return $this->select('link_acesso')->where('id_recomendante', $id_recomendante)->where('id_candidato', $id_candidato)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->value('link_acesso');
    }
}
