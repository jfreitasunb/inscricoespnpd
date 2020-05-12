<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <style>
            h2 {text-align:center;}
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

        <h2>Ficha de Inscrição</h2>
        <div>
            <label class="control-label">Nome: </label>{{ $dados_candidato_para_relatorio['nome'] }}
        </div>
        <div>
            <label class="control-label">E-mail: </label>{{ $dados_candidato_para_relatorio['email'] }}
        </div>
        <div>
            <label>CPF: </label>{{ $dados_candidato_para_relatorio['cpf'] }}
        </div>
        <div>
            <label>Instituição: </label> {{ $dados_candidato_para_relatorio['instituicao'] }} &nbsp; &nbsp; &nbsp; <label>Ano de conclusão do Doutorado: </label> {{ $dados_candidato_para_relatorio['ano_doutorado'] }}
        </div>
    
        <hr>
        <h3>Possíveis colaboradores</h3>
            <ul>{!! $dados_candidato_para_relatorio['instituicao'] !!}</ul>

        @if ($necessita_recomendante)
            <hr>
            <h3>Dados dos Recomendantes</h3>
            @foreach ($recomendantes_candidato as $recomendante)
            <div>
                <label> Nome: </label> {{ $recomendante['nome'] }}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label>Email: </label>{{ $recomendante['email'] }}
            </div>
            @endforeach

            @foreach ($recomendantes_candidato as $recomendante)
            <div class="page_break"></div>
            <div>
                <label>Dados do Recomendante</label>
                <div>
                    <label>Nome: </label> {{ $recomendante['nome'] }}
                </div>
                <div>
                    <label>Instituição: </label> {{ $recomendante['instituicao_recomendante'] }}
                </div>
            </div>
            <h3>Carta de Recomendação</h3>
            <div>
                {!! $recomendante['recomendacao'] !!}
            </div>
            @endforeach
        @endif
        
    </body>
</html>