@extends('layouts.auth')

@section('content')

<div class="login-card">
    <div class="d-flex justify-content-center align-items-center mb-4">
        <img src="{{asset('img/logofaculdade.svg')}}" alt="Logo Faculdade Meta azul e branco" width="300" height="50" class="me-3" />
        <h1 class="logo-text mb-0 d-flex align-items-center"><span class="ms-1"></span></h1>
    </div>

    <!-- ALERTAS -->
    <x-alert />
    <!-- FIM DOS ALERTAS -->

    <form action="{{ route('login.process') }}" method="POST">
        @csrf
        @method('POST')

        <div class="form-floating mb-4">
            <input type="text" name="username" required class="form-control" id="username" placeholder="Digite sua matrícula válida"
                value="{{ old('username', Cookie::get('remembered_username')) }}">
            <label for="username">Identificação ou matrícula</label>
        </div>

        <div class="mb-4">
            <div class="input-group">
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Senha">
                    <label for="password">Senha</label>
                </div>
                <span class="input-group-text" role="button" onclick="togglePassword('password', this)">
                    <i class="bi bi-eye"></i>
                </span>
            </div>
        </div>


        <button type="submit" class="btn btn-primary btn-primary-custom w-100 mb-3">
            Acessar
        </button>

        <div class="text-center mb-3">
            <a href="https://ava.meta.edu.br/faculdade/login/forgot_password.php" class="text-primary-custom text-decoration-none">Perdeu a senha?</a>
        </div>

        <div class="d-flex justify-content-end align-items-center text-primary-custom small">
            <i class="fas fa-question-circle me-1"></i>
            <a href="#" class="text-primary-custom text-decoration-none" data-bs-toggle="modal" data-bs-target="#cookieModal">Aviso de Cookies</a>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="cookieModal" tabindex="-1" aria-labelledby="cookieModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cookieModalLabel"><b>O uso de Cookies deve ser permitido no seu navegador</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <p>Dois cookies são utilizados neste site:</p>
                <p>O cookie essencial é o cookie de sessão, geralmente chamado MoodleSession. Você deve permitir este cookie no seu navegador para ter continuidade e permanecer logado enquanto navega pelo site. Quando você sai ou fecha o navegador este cookie é destruído (no seu navegador e no servidor).</p>
                <p>O outro cookie é apenas para sua conveniência, geralmente chamado de algo como MOODLEID. Ele apenas lembra sua identificação no navegador. Isso significa que quando você retornar a este site, o campo de identificação do usuário na página de autenticação será automaticamente preenchido para você. É seguro recusar este cookie - você apenas terá que redigitar a sua identificação toda vez que você autenticar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


<!-- Contêiner fixo de acessibilidade -->
<div id="acessibilidade" style="position: fixed; bottom: 20px; left: 20px; z-index: 9999; display: flex; flex-direction: column; align-items: flex-start;">
    <!-- VLibras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <!-- Botão de Alto Contraste -->
    <button
        onclick="toggleContrast()"
        type="button"
        class="btn btn-sm btn-light mt-2 shadow-sm contrast-button"
        title="Ativar alto contraste">
        <i class="fas fa-adjust me-1"></i> Contraste
    </button>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

<script>
    // Inicializa VLibras
    new window.VLibras.Widget('https://vlibras.gov.br/app');

    // Alterna visibilidade de senha
    function togglePassword(fieldId, iconElement) {
        const field = document.getElementById(fieldId);
        const icon = iconElement.querySelector('i');
        if (field.type === "password") {
            field.type = "text";
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            field.type = "password";
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    // Alterna modo de alto contraste
    function toggleContrast() {
        document.body.classList.toggle('high-contrast');
    }

    // Animação de entrada do botão de contraste
    window.addEventListener("DOMContentLoaded", () => {
        setTimeout(() => {
            document.body.classList.add("loaded");
        }, 200);
    });
</script>


@endsection