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
    ];

    public function carta_preenchida($id_recomendante, $id_candidato, $id_inscricao_pnpd)
    {
        $temp = $this->where('id_recomendante', $id_recomendante)->where('id_candidato', $id_candidato)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->get();

        if (count($temp) == 0) {
            return False;
        }elseif ($temp[0]->recomendacao == "") {
            return False;
        }else{
            return True;
        }
    }
}
