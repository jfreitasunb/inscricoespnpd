<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <title>Inscrições Pós-Graduação do MAT/UnB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="{{ asset('css/css_pnpd.css') }}" rel="stylesheet">
    @yield('stylesheets')
  </head>
  <body>
      @include('sweetalert::alert')
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
        @else --}}
          @yield('inicio')
          @yield('content')
          {{-- @yield('ver_ficha')
        @endif --}}
      @include('templates.partials.rodape')
      <script src="https://use.fontawesome.com/96ea273a00.js"></script>
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
      crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <script src="{{ asset('js/pnpd.js') }}"></script>
      <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>