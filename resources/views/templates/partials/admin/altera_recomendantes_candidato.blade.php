@extends('templates.default')

@section('altera_recomendantes')
<div id="app">
  <div class="row">
    <div class="col-md-12">
      <muda-recomendante endpoint="{{ route('alterarecomendante.index') }}"></muda-recomendante>
    </div>
  </div>
</div>

@endsection