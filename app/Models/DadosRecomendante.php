<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DadosRecomendante extends Model
{
    protected $table = 'dados_recomendante';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_recomendante',
        'instituicao',
    ];

    public function retorna_id_dados_recomendante($id_recomendante)
    {
        return $this->select('id')->where('id_recomendante', $id_recomendante)->value('id');
    }

    public function retorna_dados_recomendante($id_recomendante)
    {
        return $this->where('id_recomendante', $id_recomendante)->get()->first();
    }
}
