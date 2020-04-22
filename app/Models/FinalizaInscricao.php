<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinalizaInscricao extends Model
{
    protected $primaryKey = 'id_candidato';

    protected $table = 'finaliza_inscricao';

    public function retorna_inscricao_finalizada($id_candidato, $id_inscricao_pnpd)
    {
        $finalizou_inscricao = $this->select('inscricao_finalizada')->where("id_candidato", $id_candidato)->where("id_inscricao_pnpd", $id_inscricao_pnpd)->get();

        if (count($finalizou_inscricao)>0 and $finalizou_inscricao[0]['finalizada']) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
