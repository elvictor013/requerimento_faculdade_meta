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
            min-height: 100vh;
        }

        .table thead th {
            vertical-align: middle;
        }

        .filter-section {
            background: white;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 8px rgb(0 0 0 / 0.1);
            margin-bottom: 1.5rem;
        }

        .table-responsive {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0 8px rgb(0 0 0 / 0.1);
            padding: 1rem;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.25rem;
            border-radius: 0.375rem;
        }

        .btn-icon:last-child {
            margin-right: 0;
        }

        .btn-view {
            color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-view:hover,
        .btn-view:focus {
            background-color: #0d6efd;
            color: white;
        }

        .btn-download {
            color: #198754;
            border-color: #198754;
        }

        .btn-download:hover,
        .btn-download:focus {
            background-color: #198754;
            color: white;
        }

        .container {
            max-width: 800px;
            background: white;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 12px rgb(0 0 0 / 0.1);
        }

        h1 {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .label {
            font-weight: 600;
            color: #555;
            width: 160px;
            display: inline-block;
        }

        .value {
            font-weight: 500;
            color: #222;
        }

        .description {
            margin-top: 1rem;
            padding: 1rem;
            background-color: #e9ecef;
            border-radius: 0.375rem;
            min-height: 100px;
            white-space: pre-wrap;
            font-size: 1rem;
            color: #333;
        }

        .row-item {
            margin-bottom: 0.75rem;
        }

        .form-label {
            font-weight: 600;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .btn-top-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .btn-top-actions button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
                        <a class="nav-link" href="{{ route('atendimento.index') }}">Página inicial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('funcionario.index') }}">Funcionario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setores.index') }}">Setores</a>
                    </li>

                    <!-- <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">Usuarios</a>
          </li> -->
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