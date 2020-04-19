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
                {{-- <div class="panel panel-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseDois"><span class="glyphicon glyphicon-file fa-fw">
                            </span>Dados da Pós-Graduação</a>
                        </h4>
                    </div>
                    <div id="collapseDois" class="panel-collapse collapse {{ $keep_open_accordion_dados_pos }}">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('dados.coordenador.pos') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-cog fa-fw"></span><a href="{{ route('dados.coordenador.pos') }}">Dados do coordenador da Pós</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('cadastra.area.pos') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-wrench fa-fw"></span><a href="{{ route('cadastra.area.pos') }}">Cadastrar nova área Pós</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('editar.area.pos') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-wrench fa-fw"></span><a href="{{ route('editar.area.pos') }}">Editar áreas Pós</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('editar.formacao') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-wrench fa-fw"></span><a href="{{ route('editar.formacao') }}">Editar Formação</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTres"><span class="glyphicon glyphicon-file fa-fw">
                            </span>Configurar Edital</a>
                        </h4>
                    </div>
                    <div id="collapseTres" class="panel-collapse collapse {{ $keep_open_accordion_configurar_edital }}">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('configura.inscricao') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-wrench fa-fw"></span><a href="{{ route('configura.inscricao') }}">Configurar Inscrição</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('configura.periodo.confirmacao') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-wrench fa-fw"></span><a href="{{ route('configura.periodo.confirmacao') }}">Configurar Período Confirmação</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('configura.periodo.matricula') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-wrench fa-fw"></span><a href="{{ route('configura.periodo.matricula') }}">Configurar Envio de Documentos</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('editar.inscricao') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-pencil fa-fw"></span><a href="{{ route('editar.inscricao') }}">Editar detalhes da inscrição</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('editar.periodo.confirmacao') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-pencil fa-fw"></span><a href="{{ route('editar.periodo.confirmacao') }}">Editar período de confirmação</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('editar.periodo.envio.documentos.matricula') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-pencil fa-fw"></span><a href="{{ route('editar.periodo.envio.documentos.matricula') }}">Editar período de envio de documentos</a>
                                    </td>
                                </tr>
                            </table>
                        </div> 
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseQuatro"><span class="glyphicon glyphicon-file fa-fw">
                            </span>Acompanhar Inscrições</a>
                        </h4>
                    </div>
                    <div id="collapseQuatro" class="panel-collapse collapse {{ $keep_open_accordion_acompanhar_inscricoes }}">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('lista.recomendacoes') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-list fa-fw"></span><a href="{{ route('lista.recomendacoes') }}">Lista as indicações por candidato</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('gera.ficha.individual') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-file fa-fw"></span><a href="{{ route('gera.ficha.individual') }}">Ver fichas individuais</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('auxilia.selecao') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-duplicate fa-fw"></span><a href="{{ route('auxilia.selecao') }}">Desclassificar Candidatos</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('reativar.candidato') || Route::currentRouteNamed('pesquisa.candidato') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-refresh fa-fw"></span><a href="{{ route('reativar.candidato') }}">Reativar Inscrição Candidato</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('pesquisa.carta') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-envelope fa-fw"></span><a href="{{ route('pesquisa.carta') }}">Reativar Carta</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('altera.recomendante') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-random fa-fw"></span><a href="{{ route('altera.recomendante') }}">Mudar Recomendante</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('pesquisa.indicacoes') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-list fa-fw"></span><a href="{{ route('pesquisa.indicacoes') }}">Lista indicações</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('inscricoes.nao.finalizadas') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-list fa-fw"></span><a href="{{ route('inscricoes.nao.finalizadas') }}">Inscrições Não Finalizadas</a>
                                    </td>
                                </tr>
                            </table>
                        </div> 
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseCinco"><span class="glyphicon glyphicon-file fa-fw">
                            </span>Gerar Relatórios de Inscritos</a>
                        </h4>
                    </div>
                    <div id="collapseCinco" class="panel-collapse collapse {{ $keep_open_accordion_relatorios }}">
                        <div class="card-body">
                            <table class="table">
                                
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('relatorio.atual') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-duplicate fa-fw"></span><a href="{{ route('relatorio.atual') }}">Edital Vigente</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('relatorio.anteriores') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-backward fa-fw"></span><a href="{{ route('relatorio.anteriores') }}">Edital Anterior</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('link.acesso') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-file fa-fw"></span><a href="{{ route('link.acesso') }}">Link de Acesso</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeis"><span class="glyphicon glyphicon-file fa-fw">
                            </span>Processo de Seleção</a>
                        </h4>
                    </div>
                    <div id="collapseSeis" class="panel-collapse collapse {{ $keep_open_accordion_processo_selecao }}">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('homologa.inscricoes') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-list fa-fw"></span><a href="{{ route('homologa.inscricoes') }}">Homologa Inscrições</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('seleciona.candidatos') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-list fa-fw"></span><a href="{{ route('seleciona.candidatos') }}">Candidatos Selecionados</a>
                                    </td>
                                </tr>
                            </table>
                        </div> 
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseSete"><span class="glyphicon glyphicon-file fa-fw">
                            </span>Acompanha Selecionados</a>
                        </h4>
                    </div>
                    <div id="collapseSete" class="panel-collapse collapse {{ $keep_open_accordion_acompanha_selecionados }}">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('altera.status.selecionados') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-list fa-fw"></span><a href="{{ route('altera.status.selecionados') }}">Status das Confirmações</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class= "{{ Route::currentRouteNamed('coordenador.documentos.matricula') ? 'active_link' : '' }}">
                                        <span class="glyphicon glyphicon-list fa-fw"></span><a href="{{ route('coordenador.documentos.matricula') }}">Documentos para Matrícula</a>
                                    </td>
                                </tr>
                            </table>
                        </div> 
                    </div>
                </div> --}}
                {{-- <div class="panel panel-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <span class="glyphicon glyphicon-stats fa-fw"></span><a href="{{ route('ver.charts') }}">Estatísticas</a>
                        </h4>
                    </div>
                </div> --}}
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
            <div class="menuadmin well">
                @yield('configura_inscricao')
                @yield('editar_inscricao')
            </div>
        </div>
    </div>