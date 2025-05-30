<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <title>Acesso ao site | Requerimento - Faculdade Meta</title>
  <link rel="shortcut icon" href="https://ava.meta.edu.br/faculdade/pluginfile.php/1/theme_moove/favicon/1737842252/icone.ico" />
  <!-- <link rel="icon" href="/img/logometa.png" type="image/png" /> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


  <style>
    body {
      font-family: "Montserrat", sans-serif;
      background-image: url('/public/img/fundometa.png');
      background-size: cover;
      /* ajusta para cobrir toda a tela */
      background-repeat: no-repeat;
      background-position: center center;
    }


    .login-card {
      max-width: 400px;
      box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
      border-radius: 0.5rem;
      padding: 2rem;
      background-color: #fff;
    }

    .btn-primary-custom {
      background-color: #2c3e83;
      border-color: #2c3e83;
    }

    .btn-primary-custom:hover {
      background-color: #25356a;
      border-color: #25356a;
    }

    .text-primary-custom {
      color: #2c3e83 !important;
    }

    .logo-text {
      letter-spacing: -0.02em;
      color: #0f1942;
      font-weight: 700;
      font-size: 1.5rem;
    }

    /* alto contraste */
    body.high-contrast {
      filter: invert(1) hue-rotate(180deg);
    }

    /* Entrada animada e pulse no botão de contraste */
    .contrast-button {
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.6s ease;
      animation: pulse 2.5s infinite;
    }

    body.loaded .contrast-button {
      opacity: 1;
      transform: translateY(0);
    }

    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(44, 62, 131, 0.4);
      }

      70% {
        box-shadow: 0 0 0 10px rgba(44, 62, 131, 0);
      }

      100% {
        box-shadow: 0 0 0 0 rgba(44, 62, 131, 0);
      }
    }

    .cookie-info {
      color: #1a2a5a;
      font-size: 0.875rem;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      gap: 0.25rem;
      margin-top: 1rem;
    }

    .cookie-info i {
      font-size: 0.875rem;
    }

    .text-primary-custom {
      color: #1a2a5a;
    }
  </style>


</head>

<body class="d-flex align-items-center justify-content-center min-vh-100 p-3">



  @yield('content')


</body>

</html>