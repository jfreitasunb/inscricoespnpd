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
                <div id="collapseUm" class="panel-collapse collapse">
                    <div class="card-body bg-white">
                        <table class="table">
                            <tr>
                                <td class= "{{ Route::currentRouteNamed('configura.inscricao') ? 'active_link' : '' }}">
                                    <span class="glyphicon glyphicon-wrench fa-fw"></span><a href="{{ route('configura.inscricao') }}">Configurar Inscrição</a>
                                </td>
                            </tr>
                            <tr>
                                <td class= "{{ Route::currentRouteNamed('editar.inscricao') ? 'active_link' : '' }}">
                                    <span class="glyphicon glyphicon-pencil fa-fw"></span><a href="{{ route('editar.inscricao') }}">Editar detalhes da inscrição</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="card-header bg-card border-primary">
                        <h4 class="card-title">
                            <span class="glyphicon glyphicon-log-out fa-fw"></span>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >Sair</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </h4>
                    </div>
                </div>
        </div>
    </div>
    <div class="col-sm-9 col-md-10">
        <div class="menuadmin card card-body">
            <div class="bg-light">
                @yield('configura_inscricao')
            @yield('editar_inscricao')    
            </div>
        </div>
    </div>
</div>