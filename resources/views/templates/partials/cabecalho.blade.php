<header id="header">
  <div class="header-main">
    <div class="header-main-content">
      <div class="container-fluid">
        <div class="row-fluid">
              <div class="text-center">
                <a href="{{URL::to('/')}}"> <img src="{{ asset('imagens/logo/logo_unb.png') }}" class="img-fluid float-left" style="height:120px"/></a>
                <h1>{{ trans('mensagens_gerais.departamento') }}</h1>
                <h2>{{ trans('mensagens_gerais.PNPD') }}</h2>
                <h3>{{ $periodo_inscricao ?? '' }}</h3>
              </div>
        </div>
      </div>
    </div>
  </div>
</header>