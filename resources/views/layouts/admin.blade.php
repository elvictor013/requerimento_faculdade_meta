<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <link rel="shortcut icon" href="https://ava.meta.edu.br/faculdade/pluginfile.php/1/theme_moove/favicon/1737842252/icone.ico" />
  <!-- <link rel="icon" href="/img/logometa.png" type="image/png" /> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <title>Meus requerimentos | AVA - Faculdade Meta</title>

  <style>
    body {
      font-family: "Montserrat", sans-serif;
      background-color: #f3f5f9;
      color: #1a1a1a;
    }

    .wave {
      display: inline-block;
      animation: wave 2s infinite;
      transform-origin: 70% 70%;
    }

    @keyframes wave {

      0%,
      60%,
      100% {
        transform: rotate(0deg);
      }

      20% {
        transform: rotate(15deg);
      }

      40% {
        transform: rotate(-10deg);
      }
    }

    .btn-top-right {
      position: absolute;
      right: 1rem;
      top: 1.5rem;
    }

    .timeline-icon {
      color: #0d3b66;
      font-size: 1.5rem;
    }

    .status-badge {
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      padding: 0.25em 0.5em;
      border-radius: 0.375rem;
      color: white;
      display: block;
      width: fit-content;
      margin-bottom: 0.25rem;
      text-align: center;
      min-width: 90px;
    }

    .status-em-andamento {
      background-color: #0d6efd;
    }

    .status-deferido {
      background-color: #198754;
    }

    .status-indeferido {
      background-color: #dc3545;
    }

    .status-encaminhado {
      background-color: #fd7e14;
    }

    .status-cancelado {
      background-color: #6c757d;
    }

    .status-concluido {
      background-color: #20c997;
    }

    .status-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-right: 0.5rem;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom">

    <div class="container-fluid px-4">
      <a
        href=""
        class="navbar-brand d-flex align-items-center gap-2" 
      >
        <img
          src="//ava.meta.edu.br/faculdade/pluginfile.php/1/theme_moove/logo/1737842252/logofaculdade.svg"
          class="d-inline-block align-text-top"
          alt="AVA - Faculdade Meta"
          width="250"
          height="48"
          loading="lazy"
        />
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
            <a class="nav-link" href="{{ route('requerimentos.index') }}">Página requerimentos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('courses.index') }}">Cadastar curso</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://dliportal.zbra.com.br/Login.aspx?key=meta">Biblioteca Virtual</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://aluno-meta.phidelis.com.br/">Portal do Aluno</a>
          </li>
        </ul>
      </div>
      <div class="d-flex align-items-center gap-3 position-relative">
        <!-- Notificações Dropdown -->
        <div class="dropdown">
          <button
            aria-expanded="false"
            aria-haspopup="true"
            aria-label="Notificações"
            class="btn position-relative p-0 text-secondary"
            data-bs-toggle="dropdown"
            id="notificacoesDropdown"
            type="button">
            <i class="far fa-bell fa-lg"></i>
            <span
              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
              style="font-size: 0.6rem;">1</span>
          </button>
          <ul
            aria-labelledby="notificacoesDropdown"
            class="dropdown-menu dropdown-menu-end shadow"
            style="min-width: 250px;">
            <li>
              <h6 class="dropdown-header">Notificações</h6>
            </li>
            <li>
              <a class="dropdown-item small" href="#">Você tem 1 nova notificação.</a>
            </li>
            <li>
              <hr class="dropdown-divider" />
            </li>
            <li>
              <a class="dropdown-item small text-center" href="#">Ver todas</a>
            </li>
          </ul>
        </div>
        <!-- Mensagens Button -->
        <button aria-label="Mensagens" class="btn p-0 text-secondary" type="button">
          <i class="far fa-comment-alt fa-lg"></i>
        </button>
        <!-- Perfil Dropdown -->
        <div class="dropdown">
          <button
            aria-expanded="false"
            aria-haspopup="true"
            aria-label="Perfil do usuário"
            class="btn p-0 rounded-circle overflow-hidden"
            data-bs-toggle="dropdown"
            id="perfilDropdown"
            style="width: 40px; height: 40px;"
            type="button">
            <img
              alt="Foto do perfil do usuário, mulher loira sorrindo com fundo azul"
              class="w-100 h-100 object-fit-cover"
              src="https://storage.googleapis.com/a1aa/image/fe84ebd5-b86a-4513-1125-a28c0c30c7c2.jpg" />
            <span
              class="position-absolute bottom-0 end-0 bg-white rounded-circle border border-secondary"
              style="width: 12px; height: 12px;"></span>
          </button>
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
              <a class="dropdown-item" href="{{ route('user.show', ['user' => Auth::user()->id]   )}}">Perfil</a>
            </li>
            <li>
              <a class="dropdown-item" href="">Configurações</a>
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
  <div class="container">
    @yield('content')
  </div>

</body>

</html>