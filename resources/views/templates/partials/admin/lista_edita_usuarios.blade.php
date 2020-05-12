@extends('templates.default')

@section('lista_edita_usuarios')

<div id="app">
  <div class="row">
    <div class="col-lg-12">
      <data-table-user endpoint="{{ route('users.index') }}"></data-table-user>
    </div>
  </div>
</div>

@endsection