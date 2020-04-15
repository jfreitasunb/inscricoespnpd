@extends('templates.default')

@section('inicio')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="idiomas btn-toolbar">
        <div class="btn-group-justified">
          <a href="{{ route('lang.portuguese') }}" class="btn btn-primary button">Português</a>
          <a href="{{ route('lang.english') }}" class="btn btn-primary button">English</a>
          <a href="{{ route('lang.spanish') }}" class="btn btn-primary button">Español</a>
        </div>  
      </div>
    </div>
  </div>
  <p class="bottom-three"></p>
@endsection