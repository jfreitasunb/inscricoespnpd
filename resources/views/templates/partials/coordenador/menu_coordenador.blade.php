<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand">Bem vindo(a), {{ $nome_usuario }}!</a>
    <button class="btn btn-outline-success my-2 my-sm-0" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" type="submit">{{ trans('mensagens_gerais.menu_sair') }}</button>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</nav>
<div class="row">
    <div class="col-md-3 col-lg-2">
        <div class="panel-group" id="accordion">
            <div class="menuadmin card bg-card border-primary">
                <div class="card-header">
                    <h4 class="card-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseUm"><span class="glyphicon glyphicon-user fa-fw">
                        </span>Configurar Edital</a>
                    </h4>
                </div>
                <div id="collapseUm" class="panel-collapse collapse {{ $keep_open_accordion_configurar_edital }}">
                    <div class="card-body bg-white">
                        <table class="table">
                            <tr>
                                <td class= "{{ Route::currentRouteNamed('configura.inscricao') ? 'active_link' : '' }}">
                                    <span class="glyphicon glyphicon-wrench fa-fw"></span><a href="{{ route('configura.inscricao') }}">Configurar Inscrição</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-header">
                    <h4 class="card-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseDois"><span class="glyphicon glyphicon-user fa-fw">
                        </span>Relatórios</a>
                    </h4>
                </div>
                <div id="collapseDois" class="panel-collapse collapse {{ $keep_open_accordion_relatorios }}">
                    <div class="card-body bg-white">
                        <table class="table">
                            <tr>
                                <td class= "{{ Route::currentRouteNamed('relatorio.atual') ? 'active_link' : '' }}">
                                    <span class="glyphicon glyphicon-wrench fa-fw"></span><a href="{{ route('relatorio.atual') }}">Edital Vigente</a>
                                </td>
                            </tr>
                            <tr>
                                <td class= "{{ Route::currentRouteNamed('gera.ficha.individual') ? 'active_link' : '' }}">
                                    <span class="glyphicon glyphicon-file fa-fw"></span><a href="{{ route('gera.ficha.individual') }}">Ver fichas individuais</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-9 col-md-10">
        <div class="menuadmin card card-body">
            <div class="bg-light">
                @yield('configura_inscricao')
                @yield('relatorio_pnpd_edital_vigente')
                @yield('ficha_individual')
            </div>
        </div>
    </div>
</div>