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
}
