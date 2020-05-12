@extends('templates.default')

@section('nao_finalizadas')

<div id="app">
  <div class="row">
    <div class="col-md-12">
      <inscricoes-nao-finalizadas endpoint="{{ route('inscricoesnaofinalizadas.index') }}"></inscricoes-nao-finalizadas>
    </div>
  </div>
</div>

@endsection