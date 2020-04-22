@extends('templates.default')

@section('inicio')
  <div class="row">
    <div class="col-lg-4 offset-md-5">
      <div class="idiomas btn-toolbar">
        <div class="btn-group-justified">
          <a href="{{ route('lang.portuguese') }}" class="btn btn-primary button">Português</a>
          <a href="{{ route('lang.english') }}" class="btn btn-primary button">English</a>
          {{-- <a href="{{ route('lang.spanish') }}" class="btn btn-primary button">Español</a> --}}
        </div>
      </div>
    </div>
  </div>
  <div class="row" style="margin-top:50px">
    <div class="col-12 col-md-8 col-lg-6 offset-sm-2 offset-md-3">
        <form role="form">
            <fieldset>
                <div class="row">
                    <div class="col-6 col-md-6 col-lg-6">
                      <a href="{{ route('login') }}" class="btn btn-lg btn-success btn-block">{{ trans('tela_inicial.menu_login') }}</a>
                    </div>
                    <div class="col-6 col-md-6 col-lg-6">
                      <a href="{{ route('register') }}" class="btn btn-lg btn-primary btn-block">{{ trans('tela_inicial.menu_registrar') }}</a>
                    </div>
                    <div class="text-center" style="margin-top:70px">
                      <span class="button-form-check">
                        <a href="{{ route('password.request') }}" class="btn btn-link">{{ trans('tela_login.menu_esqueceu_senha') }}</a>
                      </span>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
  <p class="bottom-three"></p>
@endsection