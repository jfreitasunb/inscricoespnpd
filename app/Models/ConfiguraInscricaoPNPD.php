<?php

namespace App\Models;

use Session;
use Carbon\Carbon;
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
        'id_usuario_configurou',
        'inicio_inscricao', 
        'fim_inscricao',
        'prazo_carta',
        'data_homologacao',
        'data_divulgacao_resultado',
        'necessita_recomendante',
        'numero_cartas',
        'edital',
    ];

    public function permite_configurar_inscricao($data_inicio, $data_fim)
    {
        $existe = count($this->whereBetween('fim_inscricao', [$data_inicio, $data_fim])->get());

        if ($existe) {
            return false;
        }

        return true;
    }

    public function ultimo_edital($ano)
    {
        $temp = $this->select('edital')->where('inicio_inscricao', 'like', $ano.'%')->orderby('edital', 'desc')->value('edital');

        if (!is_null($temp)) {
            return explode("-", $temp)[0];
        }

        return 0;
    }

    public function retorna_edital_vigente($id_inscricao_pnpd = null)
    {
        if (is_null($id_inscricao_pnpd)) {

            return $this->orderBy('id_inscricao_pnpd','desc')->get()->first();
        }else{
            
            return $this->where('id_inscricao_pnpd', $id_inscricao_pnpd)->get()->first();
        }    
    }

    public function retorna_periodo_inscricao()
    {
        Session::get('locale');

        if (is_null($this->retorna_edital_vigente())){

            $data_inicio = '3000-01-01';
        }else{
            $inicio = Carbon::createFromFormat('Y-m-d', $this->retorna_edital_vigente()->inicio_inscricao);
            
            $fim = Carbon::createFromFormat('Y-m-d', $this->retorna_edital_vigente()->fim_inscricao);
            
            $data_inicio = $inicio->format('Y-m-d');
            
            $data_fim = $fim->format('Y-m-d');    
        }

        $data_hoje = (new Carbon())->format('Y-m-d');

        if ($data_hoje >= $data_inicio && $data_hoje <= $data_fim) {

            if (Session::get('locale') == 'en') {
                
                return $periodo_inscricao = $inicio->format('m/d/Y').trans('mensagens_gerais.to').$fim->format('m/d/Y');
            }else{
                
                return $periodo_inscricao = $inicio->format('d/m/Y').trans('mensagens_gerais.to').$fim->format('d/m/Y');
            }
        }

        if ($data_hoje < $data_inicio) {
            return $periodo_inscricao = trans('mensagens_gerais.inscricao_nao_iniciada');
        }

        if ($data_hoje > $data_fim) {
            return $periodo_inscricao = trans('mensagens_gerais.inscricao_encerrada');
        }
    }

    public function autoriza_inscricao()
    {
        $inicio_inscricao = Carbon::createFromFormat('Y-m-d', $this->retorna_edital_vigente()->inicio_inscricao);

        $fim_inscricao = Carbon::createFromFormat('Y-m-d', $this->retorna_edital_vigente()->fim_inscricao);

        $data_inicio = $inicio_inscricao->format('Y-m-d');

        $data_fim = $fim_inscricao->format('Y-m-d');

        $data_hoje = (new Carbon())->format('Y-m-d');

        if (($data_hoje >= $data_inicio) AND ($data_hoje <= $data_fim)) {
            return true;
        }else{
            return false;
        }
    }

    public function visualiza_status_carta()
    {
        $inicio = Carbon::createFromFormat('Y-m-d', $this->retorna_edital_vigente()->inicio_inscricao);
        
        $fim = Carbon::createFromFormat('Y-m-d', $this->retorna_edital_vigente()->fim_inscricao)->addDays(20);

        $data_inicio = $inicio->format('Y-m-d');
        
        $data_fim = $fim->format('Y-m-d');

        $data_hoje = (new Carbon())->format('Y-m-d');

        if ($data_hoje >= $data_inicio && $data_hoje <= $data_fim) {
            return true;
        }else{
            return false;
        }
    }
}
