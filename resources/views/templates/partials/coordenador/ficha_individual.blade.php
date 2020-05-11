@extends('templates.default')

@section('ficha_individual')

<fieldset class="scheduler-border">
  <legend class="scheduler-border">Fichas de Inscrição Individuais</legend>
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col">Nome do Candidato</th>
          <th>Ficha de Inscrição</th>
          <th>Cartas Recebidas</th>
        </tr>
      </thead>
      <tbody>
        @foreach( $inscricoes_finalizadas as $finalizada)
          <tr class="{{ $classes_linhas[$total_cartas[$finalizada['id_candidato']]] }}">
            <td><a href=" {{ route('ver.ficha.individual', ['id_inscricao_pnpd' => $finalizada['id_inscricao_pnpd'],'id_aluno' => $finalizada['id_candidato']]) }}">{{ $finalizada['nome'] }}</a></td>
            <td>@if($id_aluno_pdf == $finalizada['id_candidato']) <a target="_blank" href="{{asset($nome_pdf)}}" > Ficha de Inscrição </a> @endif</td>
            <td>{{ $total_cartas[$finalizada['id_candidato']] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</fieldset>

@endsection