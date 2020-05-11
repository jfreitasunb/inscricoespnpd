<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartaRecomendacao extends Model
{
    protected $table = 'carta_recomendacao';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_recomendante',
        'id_candidato', 
        'id_inscricao_pnpd',
        'recomendacao',
        'carta_finalizada',
    ];

    public function retorna_carta_inicializada($id_recomendante, $id_candidato, $id_inscricao_pnpd)
    {
        $temp = $this->where('id_recomendante', $id_recomendante)->where('id_candidato', $id_candidato)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->get();

        if (count($temp) == 0) {
            return False;
        }else{
            return True;
        }
    }

    public function carta_preenchida($id_recomendante, $id_candidato, $id_inscricao_pnpd)
    {
        return $this->select('carta_finalizada')->where('id_recomendante', $id_recomendante)->where('id_candidato', $id_candidato)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->value('carta_finalizada');
    }

    public function retorna_id_carta_inicializada($id_recomendante, $id_candidato, $id_inscricao_pnpd)
    {
        return $this->select('id')->where('id_recomendante', $id_recomendante)->where('id_candidato', $id_candidato)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->value('id');
    }

    public function retorna_dados_carta($id_recomendante, $id_candidato, $id_inscricao_pnpd)
    {
        return $this->where('id_recomendante', $id_recomendante)->where('id_candidato', $id_candidato)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->get()->first();
    }

    public function conta_cartas_enviadas_por_candidato($id_inscricao_pnpd, $id_candidato)
    {
        return $this->where('id_inscricao_pnpd',$id_inscricao_pnpd)->where('id_candidato',$id_candidato)->where('carta_finalizada',TRUE)->count();
    }
}
