<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <title>Inscrições Pós-Graduação do MAT/UnB</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/css_pnpd.css') }}" rel="stylesheet">
  <script src="https://use.fontawesome.com/96ea273a00.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
  crossorigin="anonymous"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/pnpd.js') }}"></script>
  <script src="{{ asset('bower_components/sweetalert2/dist/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  {{-- <script>
    window.Laravel = {!! json_encode([
      'csrfToken' => csrf_token(),
    ]) !!};
  </script> --}}

  @yield('stylesheets')
</head>
<body>
    @include('templates.partials.alertas_erros')
    @include('templates.partials.cabecalho')
      {{-- @if (Auth::check())
        @candidato(Auth()->user())
        <div class="container">
          @include('templates.partials.candidato.menu_candidato')
          @yield('dados_pessoais')
          @yield('dados_academicos')
          @yield('escolha_monitoria')
          @yield('motivacao_documentos')
          @yield('finaliza_inscricao')
          @yield('status_cartas')
          @yield('confirma_presenca')
          @yield('envia_documentos_matricula')
          @yield('processa_documentos_matricula')
        </div>
        @endcandidato
        @coordenador(Auth()->user())
        <div class="container-fluid">
          <div class="row-fluid">
            @include('templates.partials.coordenador.menu_coordenador')
          </div>
        </div>
        @endcoordenador
        @recomendante(Auth()->user())
          @include('templates.partials.recomendante.menu_recomendante')
          @yield('dados_pessoais_recomendante')
          @yield('cartas_pendentes')
          @yield('cartas_anteriores')
          @yield('carta_parte_inicial')
          @yield('carta_parte_final')
        @endrecomendante
        @admin(Auth()->user())
        <div class="container-fluid">
          <div class="row-fluid">
            @include('templates.partials.admin.menu_admin')
            @impersonating_recomendante
              @yield('dados_pessoais_recomendante')
              @yield('cartas_pendentes')
              @yield('carta_parte_inicial')
              @yield('carta_parte_final')
            @endimpersonating_recomendante
            @impersonating_candidato
              @yield('dados_pessoais')
              @yield('dados_academicos')
              @yield('escolha_monitoria')
              @yield('motivacao_documentos')
              @yield('finaliza_inscricao')
              @yield('confirma_presenca')
              @yield('status_cartas')
            @endimpersonating_candidato
          </div>
        </div>
        @endadmin
      @else
        @yield('inicio')
        @yield('content')
        @yield('ver_ficha')
      @endif
    </div> --}}
    @include('templates.partials.rodape')
</body>
</html>