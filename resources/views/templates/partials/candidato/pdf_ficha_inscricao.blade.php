<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <style>
            #logo {
                max-width:77px;
            }
            h2 {text-align:center;}
            h4 {text-align:left;}
            label {font-weight: bold;}
            label.motivacao {font-weight: normal;text-align:justify;}
            p.motivacao {font-weight: normal;text-align:justify;}
            .page_break { page-break-before: always;}
            table.tftable {font-size:12px;width:100%;border-width: 1px;border-collapse: collapse;}
    		table.tftable th {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;text-align:center;}
    		table.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;}
            table.tftable td.valor_celula {text-align:center;font-weight: bold;font-size:14px;border-width: 1px;padding: 8px;border-style: solid;}
            table.tftable td.cabecalho {text-align:center;font-size:12px;border-width: 1px;padding: 8px;border-style: solid;}
            .footer {
                width: 100%;
                text-align: center;
                position: fixed;
                font-size: 8pt;
                bottom: 0px;
            }
            .pagenum:before {
                content: counter(page);
            }
            p:last-child { page-break-after: never; }
        </style>
    </head>

    <body>
        <script type="text/php">
            if (isset($pdf)) {
                $font = $fontMetrics->getFont("Arial", "bold");
                $pdf->page_text(35, 750, "{{  $dados_candidato_para_relatorio['nome'] }}", $font, 7, array(0, 0, 0) );
                $pdf->page_text(540, 750, "Página {PAGE_NUM}/{PAGE_COUNT}", $font, 7, array(0, 0, 0));
            }
        </script>

        <p style="width: 500px;">
            <img src="{!! public_path("/imagens/logo/logo_unb_para_relatorios.png") !!}" id="logo" style="float: left;" />
            <h4>
                Departamento de Matemática<br>
                Programa de Pós-Graduação do MAT/UnB
            </h4>
        </p>
        <h3>Ficha de Inscrição ao Programa Nacional de Pós Doutorado</h3>
        <div>
            <label class="control-label">{{ trans('tela_inscricao.nome') }}: </label>{{ $dados_candidato_para_relatorio['nome'] }}
        </div>
        <div>
            <label class="control-label">{{ trans('tela_inscricao.cpf') }}: </label>{{ $dados_candidato_para_relatorio['cpf'] }}
        </div>
        <div>
            <label>{{ trans('tela_ficha_inscricao.instituicao') }}: </label> {{ $dados_candidato_para_relatorio['instituicao'] }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label>{{ trans('tela_ficha_inscricao.ano_doutorado') }}: </label> {{ $dados_candidato_para_relatorio['ano_doutorado'] }}
        </div>
        <hr>
        <h3>{{ trans('tela_ficha_inscricao.colaboradores') }}</h3>
        @php
            $temp = explode(";", $dados_candidato_para_relatorio['colaboradores'])
        @endphp
        @foreach ($temp as $colab)
            <ul>
                <li>{{ $colab }}</li>
            </ul>
        @endforeach

        @if ($necessita_recomendante)
            <hr>
            <h3>{{ trans('tela_ficha_inscricao.recomendante') }}</h3>
            @for ($i = 0; $i < $numero_cartas; $i++)
                <div>
                    <label> {{ trans('tela_ficha_inscricao.nome') }}: </label> {{ $contatos_indicados['nome_recomendante_'.$i] }}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label>Email: </label>{{ $contatos_indicados['email_recomendante_'.$i] }}
                </div>
            @endfor
        @endif
    </body>
</html>