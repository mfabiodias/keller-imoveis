<!doctype html>
<html lang="pt-br" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Fabio Messias Dias <mfabiodias@gmail.com>">
    <title>{{ isset($page) ? $page ." |" : "" }} Keller Imóveis</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">

    @livewireStyles
</head>
<body class="d-flex flex-column h-100">
    <div id="loader" style="display: none !important"><div id="loader-image" class="text-primary"></div></div>
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="{{ route('home') }}">Keller Imóveis</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?= my_route() ? 'active' : '' ?>">
                        <a class="nav-link" href="{{ route('home') }}">Home <?= my_route() ? '<span class="sr-only">(current)</span>' : '' ?></a>
                    </li>
                    <li class="nav-item <?= my_route('cliente') ? 'active' : '' ?>">
                        <a class="nav-link" href="{{ route('cliente') }}">Cliente <?= my_route("cliente") ? '<span class="sr-only">(current)</span>' : '' ?></a>
                    </li>
                    <li class="nav-item <?= my_route('imovel') ? 'active' : '' ?>">
                        <a class="nav-link" href="{{ route('imovel') }}">Imóveis <?= my_route("imovel") ? '<span class="sr-only">(current)</span>' : '' ?></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container py-5">
            @if(route('cliente') == url()->current())
                @livewire('cliente.index')
            @elseif(route('imovel') == url()->current())
                @livewire('imovel.index')
            @else 
                <p>/home</p>
            @endif
        </div>
    </main>

    <footer class="footer mt-auto py-3">
        <div class="container">
            <span class="text-muted">Desenvolvido por Fabio Dias - mfabiodias@gmail.com</span>
        </div>
    </footer>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>

    @livewireScripts
</body>
</html>
