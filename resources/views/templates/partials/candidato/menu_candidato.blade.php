<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand">Bem vindo(a), {{ $nome_usuario }}!</a>
    <button class="btn btn-outline-success my-2 my-sm-0" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" type="submit">{{ trans('mensagens_gerais.menu_sair') }}</button>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</nav>