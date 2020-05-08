@extends('templates.default')

@section('relatorio_pnpd_edital_vigente')

  <form action="" method="POST">
    <legend>Relatório de inscritos</legend>
	<strong>Total de Inscritos: </strong> {{ $total_inscritos }} <br>
    	<div class="table-responsive">
		    <table class="table table-striped">
			  	<thead>
				    <tr>
				      <th>Edital</th>
				      <th>Período de Inscrição</th>
				      <th>Relatório de Inscritos</th>
				      <th>Lista de Inscritos</th>
				    </tr>
			  	</thead>
			  	<tbody>
			    	<tr>
			      	<th scope="row"><a href="{!! route('gera.relatorio', ['id_inscricao_pnpd' => $relatorio_disponivel['id_inscricao_pnpd']]) !!}">{{$relatorio_disponivel['edital']}}</a></th>
			      	<td><a href="{!! route('gera.relatorio', ['id_inscricao_pnpd' => $relatorio_disponivel['id_inscricao_pnpd']]) !!}">{{\Carbon\Carbon::parse($relatorio_disponivel['inicio_inscricao'])->format('d/m/Y')." à ".\Carbon\Carbon::parse($relatorio_disponivel['fim_inscricao'])->format('d/m/Y')}}</a></td>
			      	<td>@if($id_pnpd == $relatorio_disponivel['id_inscricao_pnpd'] || isset($local_arquivos)) 
			      		 	<a target="_blank" href="{{ asset($local_arquivos['arquivo_zip'].$arquivos_zipados_para_view) }}" >Inscrições.zip</a>
			      		@endif</td>
			      	<td>@if($id_pnpd == $relatorio_disponivel['id_inscricao_pnpd'] || isset($local_arquivos)) <a target="_blank" href="{{asset($local_arquivos['local_relatorios'].$relatorio_csv)}}">{{$relatorio_csv}}</a> @endif</td>
			    	</tr>
			  	</tbody>
			</table>
		</div>
  </form>
@stop
