<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Mail;
use Session;
use File;
use ZipArchive;
use PDF;
use Imagick;
use App\Http\Controllers\FPDFController;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ConfiguraInscricaoPNPD;
use App\Models\DadosInscricao;
use App\Models\ArquivosParaInscricao;
use App\Models\FinalizaInscricao;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use League\Csv\Writer;
use Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

/**
* Classe para visualização da página inicial.
*/
class RelatorioController extends HomeController
{

  protected $normalizeChars = array(
      'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
      'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
      'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
      'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
      'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
      'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
      'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
      'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T',
    );

  public function ConsolidaLocaisArquivos($edital)
  {

    $locais_arquivos = [];
    
    $locais_arquivos['arquivos_temporarios'] = storage_path("app/public/relatorios/temporario/");

    $locais_arquivos['ficha_inscricao'] = storage_path("app/public/relatorios/ficha_inscricao/");

    $locais_arquivos['local_relatorios'] = storage_path("app/public/relatorios/edital_".$edital."/");
    
    $locais_arquivos['arquivo_relatorio_csv'] = 'Inscricoes_Edital_'.$edital.'.csv';

    $locais_arquivos['local_documentos'] = storage_path('app/');

    $locais_arquivos['arquivo_zip'] = $locais_arquivos['local_relatorios'].'zip/';

    File::isDirectory($locais_arquivos['arquivos_temporarios']) or File::makeDirectory($locais_arquivos['arquivos_temporarios'],0775,true);

    File::isDirectory($locais_arquivos['ficha_inscricao']) or File::makeDirectory($locais_arquivos['ficha_inscricao'],0775,true);

    File::isDirectory($locais_arquivos['local_relatorios']) or File::makeDirectory($locais_arquivos['local_relatorios'],0775,true);

    File::isDirectory($locais_arquivos['arquivo_zip']) or File::makeDirectory($locais_arquivos['arquivo_zip'],0775,true);

    return $locais_arquivos;
  }

  public function ConsolidaDadosPessoais($id_candidato)
  {
    $consolida_dados = [];

    $usuario = User::find($id_candidato);
    
    $consolida_dados['nome'] = $usuario->nome;

    $consolida_dados['email'] = $usuario->email;

    return $consolida_dados;
  }

  public function ConsolidaDadosInscricao($id_candidato, $id_inscricao_pnpd)
  {

    $consolida_dados_inscricao = [];

    $dados_inscricao = new DadosInscricao();

    $dados = $dados_inscricao->retorna_dados_inscricao($id_candidato, $id_inscricao_pnpd);

    $consolida_dados_inscricao['cpf'] = $dados[0]->cpf;

    $consolida_dados_inscricao['instituicao'] = $dados[0]->instituicao;

    $consolida_dados_inscricao['ano_doutorado'] = $dados[0]->ano_doutorado;

    $consolida_dados_inscricao['colaboradores'] = $dados[0]->colaboradores;

    return $consolida_dados_inscricao;
  }

  public function ConsolidaIndicaoes($id_candidato, $id_inscricao_pnpd)
  {

    $configura = new ConfiguraInscricaoPNPD();

    $numero_cartas = $configura->retorna_edital_vigente($id_inscricao_pnpd)->numero_cartas;

    $dados_inscricao = new DadosInscricao();

    $dados = $dados_inscricao->retorna_dados_inscricao($id_candidato, $id_inscricao_pnpd);

    $temp = explode("_", $dados[0]->recomendantes);

    $recomendantes = [];

    for ($i=0; $i < $numero_cartas; $i++) { 
      
      $user = User::find($temp[$i]);

      $recomendantes['nome_recomendante_'.$i] = $user->nome;

      $recomendantes['email_recomendante_'.$i] = $user->email;
    }

    return $recomendantes;
  }

  public function ConsolidaNomeArquivos($local_arquivos_temporarios, $local_arquivos_definitivos, $dados_candidato_para_relatorio)
  {
    $nome_arquivos = [];

    $nome_arquivos['arquivo_relatorio_candidato_temporario'] = $local_arquivos_temporarios.str_replace(' ', '-',strtr($dados_candidato_para_relatorio['nome'], $this->normalizeChars)).'_'.$dados_candidato_para_relatorio['id_candidato'].'.pdf';
    $nome_arquivos['arquivo_relatorio_candidato_final'] = $local_arquivos_definitivos.'Inscricao_'.str_replace(' ', '-',strtr($dados_candidato_para_relatorio['nome'], $this->normalizeChars)).'_'.$dados_candidato_para_relatorio['id_candidato'].'.pdf';
      

      return $nome_arquivos;
  }

  public function geraFichaInscricao($id_candidato, $id_inscricao_pnpd, $locale_relatorio)
  {

    $endereco_mudar = '/var/www/inscricoespos/storage/app/public/';
    
    $relatorio = new ConfiguraInscricaoPNPD();

    $relatorio_disponivel = $relatorio->retorna_edital_vigente();

    $necessita_recomendante = $relatorio_disponivel->necessita_recomendante;

    $locais_arquivos = $this->ConsolidaLocaisArquivos($relatorio_disponivel->edital);

    $dados_candidato_para_relatorio = [];

    $dados_candidato_para_relatorio['edital'] = $relatorio_disponivel->edital;

    $dados_candidato_para_relatorio['id_candidato'] = $id_candidato;

    foreach ($this->ConsolidaDadosPessoais($dados_candidato_para_relatorio['id_candidato']) as $key => $value)
    {
       $dados_candidato_para_relatorio[$key] = $value;
    }

    foreach ($this->ConsolidaDadosInscricao($dados_candidato_para_relatorio['id_candidato'], $id_inscricao_pnpd) as $key => $value) {
       $dados_candidato_para_relatorio[$key] = $value;
    }

    if ($necessita_recomendante) {
      $contatos_indicados = $this->ConsolidaIndicaoes($dados_candidato_para_relatorio['id_candidato'], $id_inscricao_pnpd);
    }

    $nome_arquivos = $this->ConsolidaNomeArquivos($locais_arquivos['arquivos_temporarios'], $locais_arquivos['ficha_inscricao'], $dados_candidato_para_relatorio);
    
    dd($dados_candidato_para_relatorio);
    
    $pdf = PDF::loadView('templates.partials.candidato.pdf_ficha_inscricao', compact('dados_candidato_para_relatorio','recomendantes_candidato', 'necessita_recomendante'));
    $pdf->save($nome_arquivos['arquivo_relatorio_candidato_temporario']);

    $nome_uploads = $this->ConsolidaDocumentosPDF($dados_candidato_para_relatorio['id_candidato'], $locais_arquivos['local_documentos'], $id_inscricao_pnpd, $necessita_recomendante);

    $this->ConsolidaFichaRelatorio($nome_arquivos, $nome_uploads);

    return str_replace($endereco_mudar,'storage/', $nome_arquivos['arquivo_relatorio_candidato_final']);
  }

}