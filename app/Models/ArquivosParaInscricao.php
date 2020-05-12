<?php

namespace App\Models;

use DB;
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

    public function retorna_arquivo_edital_atual($id_candidato, $id_inscricao_pnpd, $tipo_arquivo = null)
    {

        if (!is_null($tipo_arquivo)) {
            return $this->select('nome_arquivo')->where('id_candidato', $id_candidato)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->where('tipo_arquivo', $tipo_arquivo)->orderBy('created_at','desc')->first();
        }else{
            return $this->where('id_candidato', $id_candidato)->where('id_inscricao_pnpd', $id_inscricao_pnpd)->orderBy('created_at','desc')->get();
        }
    }

    public function atualiza_arquivos_enviados($id_candidato, $id_inscricao_pnpd, $tipo_arquivo)
    {
        DB::table('arquivos_para_inscricao')
            ->where('id_candidato', $id_candidato)
            ->where('id_inscricao_pnpd', $id_inscricao_pnpd)
            ->where('tipo_arquivo', $tipo_arquivo)
            ->update(['updated_at' => date('Y-m-d H:i:s')]);
    }
}
