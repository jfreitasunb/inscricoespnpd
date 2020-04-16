<header id="header">
  <div class="header-main">
    <div class="header-main-content">
      <div class="container-fluid">
        <div class="row-fluid">
              <div class="col-lg-4 col-xl-3 col-12 image-container">
                <a href="{{URL::to('/')}}"> <img src="{{ asset('imagens/logo/logo_unb.png') }}" class="img-fluid" style="height:120px"/></a>
              </div>
              <div class="col-lg-8 col-xl-7 col-12">  
                <h1>{{ trans('mensagens_gerais.departamento') }}</h1>
                <h2>{{ trans('mensagens_gerais.PNPD') }}</h2>
                <h3>{{ $periodo_inscricao }}</h3>
              </div>
        </div>
      </div>
    </div>
  </div>
</header>