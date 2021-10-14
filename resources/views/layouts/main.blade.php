<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Titulo -->
        <title>@yield('title') | HTC Events</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- CSS -->
        <link rel="stylesheet" href="/css/style.css">

    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
            <div class="container-fluid align-items-center py-2">
                <a class="navbar-brand" href="{{ route('events') }}">Navbar</a>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link @if($title == 'events') active @endif" aria-current="page" href="{{ route('events') }}">Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($title == 'new event') active @endif" aria-current="page" href="{{ route('event.new') }}">Criar Evento</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Meus Eventos</a>
                            </li>
                            <li class="nav-item">
                                <form method="post" action="/logout">
                                    @csrf
                                    <a class="nav-link @if($title == 'dashboard') active @endif"
                                       aria-current="page"
                                       href="/logout"
                                       onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        Sair
                                    </a>
                                </form>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/login">Entrar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/register">Cadastrar</a>
                            </li>
                        @endguest
                    </ul>
                </div><!--navbar-collapse-->
            </div><!--container-fluid-->
        </nav>
        @if(session('message'))
            <div class="alert alert-dismissible fade show position-absolute top-0 end-0 @if(session('success') == false)alert-danger @else alert-success @endif" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')

        <footer class="text-center text-white bg-dark py-4">
            Matheus Bespalec - &copy; 2020
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script src="/js/vue.js"></script>
    </body>
</html>
