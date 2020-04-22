<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <title>Inscrições Pós-Graduação do MAT/UnB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <link href="{{ asset('css/css_pnpd.css') }}" rel="stylesheet">
    @yield('stylesheets')
  </head>
  <body>
      @include('sweetalert::alert')
      @include('templates.partials.alertas_erros')
      @include('templates.partials.cabecalho')
        @if (Auth::check())
          @candidato(Auth()->user())
            <div class="container">
              @include('templates.partials.candidato.menu_candidato')
              @liberainscricao
                @yield('formulario_inscricao')
              @endliberainscricao
              @yield('finaliza_inscricao')
              @statuscarta
                @yield('status_cartas')
              @endstatuscarta
            </div>
          @endcandidato
          @admin(Auth()->user())
            <div class="container-fluid">
              <div class="row-fluid">
                @include('templates.partials.admin.menu_admin')
              </div>
            </div>
          @endadmin
        @else
          @yield('inicio')
          @yield('content')
          {{-- @yield('ver_ficha') --}}
        @endif
      @include('templates.partials.rodape')
      <script src="https://use.fontawesome.com/96ea273a00.js"></script>
      <script src="https://kit.fontawesome.com/0890d3e2cc.js" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <script src="{{ asset('js/pnpd.js') }}"></script>
      <script src="{{ asset('js/app.js') }}"></script>
      <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
      </script>
  @yield('scripts')
  </body>
</html>
