<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Alert;
use App\Models\ConfiguraInscricaoPNPD;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditaInscricaoController extends Controller
{
    public function getEditaInscricao()
    {
        $user = Auth::user();

        if ($user->user_type == "admin") {

            $configurapnpd = new ConfiguraInscricaoPNPD();

            $edital_vigente = $configurapnpd->retorna_edital_vigente();

            return view('templates.partials.admin.editar_inscricao')->with(compact('edital_vigente'));
        }else{
            return redirect()->home();
        }
        
    }

    public function postEditaInscricao(Request $request)
    {
        $user = Auth::user();

        if ($user->user_type == "admin") {

            $this->validate($request, [
            'inicio_inscricao' => 'required|date_format:"Y-m-d"|before:fim_inscricao',
            'fim_inscricao' => 'required|date_format:"Y-m-d"|after:inicio_inscricao',
            'prazo_carta' => 'required|date_format:"Y-m-d"|after:inicio_inscricao',
            'data_homologacao' => 'required|date_format:"Y-m-d"|after:fim_inscricao',
            'data_divulgacao_resultado' => 'required|date_format:"Y-m-d"|after:data_homologacao',
            'necessita_recomendante' => 'required',
        ]);
            
        $edital_vigente = ConfiguraInscricaoPNPD::find((int)$request->id_inscricao_pnpd);

        $novos_dados_edital['inicio_inscricao'] = $request->inicio_inscricao;
        
        $novos_dados_edital['fim_inscricao'] = $request->fim_inscricao;

        $novos_dados_edital['prazo_carta'] = $request->prazo_carta;
        
        $novos_dados_edital['data_homologacao'] = $request->data_homologacao;
        
        $novos_dados_edital['data_divulgacao_resultado'] = $request->data_divulgacao_resultado;

        $temp = strtolower($request->necessita_recomendante);

        switch ($temp) {
            case 'nao':
                $necessita_recomendante = false;
                break;
            case 'não':
                $necessita_recomendante = false;
                break;
            
            case 'n':
                $necessita_recomendante = false;
                break;
            case '0':
                $necessita_recomendante = false;
                break;
                
            default:
                $necessita_recomendante = true;
                break;
        }

        $novos_dados_edital['necessita_recomendante'] = $necessita_recomendante;

        if (!is_null($request->numero_cartas)) {
            $novos_dados_edital['numero_cartas'] = (int) $request->numero_cartas;
        }

        $edital_vigente->update($novos_dados_edital);

        Alert::success('', 'Dados atualizados com sucesso!')->autoclose(3000);

        return redirect()->route('editar.inscricao');

        }else{
            return redirect()->home();
        }
    }
}
