<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <title>Meus requerimentos | AVA - Faculdade Meta</title>
    <style>
        body {
            font-family: "Montserrat", sans-serif;
            background-color: #f3f5f9;
            color: #1a1a1a;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom">
        <div class="container-fluid px-4">
            <a href="" class="navbar-brand d-flex align-items-center gap-2">
                <img src="//ava.meta.edu.br/faculdade/pluginfile.php/1/theme_moove/logo/1737842252/logofaculdade.svg" class="d-inline-block align-text-top" alt="AVA - Faculdade Meta" width="250" height="48" loading="lazy" />
            </a>
            <button
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Alternar navegação"
                class="navbar-toggler"
                data-bs-target="#navbarNav"
                data-bs-toggle="collapse"
                type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-4 mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Página inicial</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Painel</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="https://dliportal.zbra.com.br/Login.aspx?key=meta">Biblioteca Virtual</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://aluno-meta.phidelis.com.br/">Portal do Aluno</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-3 position-relative">

                <button
                    aria-label="Menu de usuário"
                    class="btn p-0 text-secondary"
                    data-bs-toggle="dropdown"
                    id="perfilMenuToggle"
                    type="button">
                    <i class="fas fa-chevron-down"></i>
                </button>
                <ul
                    aria-labelledby="perfilDropdown"
                    class="dropdown-menu dropdown-menu-end shadow"
                    style="min-width: 180px;">
                    <li>
                        <a class="dropdown-item" href="#">Perfil</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Configurações</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="{{ route('login.destroy') }}">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <div class="container">
        @yield('content')
    </div>
    <br>
</body>

</html>