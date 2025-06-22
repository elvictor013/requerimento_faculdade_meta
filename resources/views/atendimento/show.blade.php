@extends('layouts.setor')

@section('content')
@push('styles')
<style>
    body {
        font-family: "Montserrat", sans-serif;
        background-color: #f3f5f9;
        color: #1a1a1a;
        min-height: 100vh;
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .container {
        max-width: 720px;
        background: white;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 0 12px rgb(0 0 0 / 0.1);
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

    .btn-top-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
</style>
@endpush

<main class="container">
    <h1>Visualizar Requerimento</h1>

    <div class="btn-top-actions">
        <button type="button" class="btn btn-success" title="Aprovar Requerimento" onclick="alert('Requerimento aprovado')">
            <i class="fas fa-check"></i> Aprovar
        </button>
        <button type="button" class="btn btn-danger" title="Reprovar Requerimento" onclick="alert('Requerimento reprovado')">
            <i class="fas fa-times"></i> Reprovar
        </button>
        <button type="button" class="btn btn-warning" title="Encaminhar Requerimento" data-bs-toggle="modal" data-bs-target="#encaminharModal">
            <i class="fas fa-share"></i> Encaminhar
        </button>
    </div>

    <div class="row-item"><span class="label">Protocolo:</span> <span class="value">{{ $requerimento->protocolo }}</span></div>
    <div class="row-item"><span class="label">Aluno:</span> <span class="value">{{ $requerimento->aluno->user->name }}</span></div>
    <div class="row-item"><span class="label">Matrícula:</span> <span class="value">{{ $requerimento->aluno->matricula }}</span></div>
    <div class="row-item"><span class="label">Tipo:</span> <span class="value">{{ $requerimento->tipo_requerimento }}</span></div>
    <div class="row-item"><span class="label">Status:</span> <span class="value">{{ $requerimento->status }}</span></div>
    <div class="row-item"><span class="label">Curso:</span> <span class="value">{{ $requerimento->categoria->nome ?? 'Não informado' }}</span></div>
    <div class="row-item"><span class="label">Semestre:</span> <span class="value">{{ $requerimento->semestre }}</span></div>
    <div class="row-item"><span class="label">Data de Criação:</span> <span class="value">{{ $requerimento->created_at->format('d/m/Y H:i') }}</span></div>
    <div class="row-item">
        <span class="label">Descrição:</span>
        <div class="description">{{ $requerimento->descricao }}</div>
    </div>

    <form id="responseForm" class="mt-4" method="POST" action="{{ route('requerimentos.responderAluno', $requerimento->id) }}">
        @csrf
        <div class="mb-3">
            <label for="responseText" class="form-label">Responder ao Aluno</label>
            <textarea id="responseText" name="mensagem" class="form-control" placeholder="Digite sua resposta aqui..." required>{{ old('mensagem', $requerimento->resposta_atendente) }}</textarea>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#anexoModal">
            <i class="fas fa-paper-plane"></i> Responder
        </button>

    </form>
</main>

<!-- Modal Encaminhar -->
<div class="modal fade" id="encaminharModal" tabindex="-1" aria-labelledby="encaminharModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="encaminharForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="encaminharModalLabel">Encaminhar Requerimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="setorSelect" class="form-label">Selecione o setor</label>
                        <select id="setorSelect" class="form-select" required>
                            <option value="" selected disabled>Selecione um setor</option>
                            <option value="financeiro">Financeiro</option>
                            <option value="academico">Acadêmico</option>
                            <option value="secretaria">Secretaria</option>
                            <option value="tecnico">Técnico</option>
                            <option value="outros">Outros</option>
                        </select>
                        <div class="invalid-feedback">Por favor, selecione um setor.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Anexo -->
<!-- Modal Anexo -->
<div class="modal fade" id="anexoModal" tabindex="-1" aria-labelledby="anexoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="anexoForm" enctype="multipart/form-data" method="POST" action="{{ route('requerimentos.responderAluno', $requerimento->id) }}">
                @csrf
                <input type="hidden" name="mensagem" id="mensagemInput">

                <div class="modal-header">
                    <h5 class="modal-title" id="anexoModalLabel">Deseja anexar um arquivo?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fileInput" class="form-label">Escolha o arquivo</label>
                        <input type="file" name="anexo_resposta" class="form-control" id="fileInput" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" />
                        <div class="form-text">Tipos permitidos: pdf, jpg, jpeg, png, doc, docx</div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enviar com Anexo</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="document.getElementById('anexoForm').submit()">Enviar sem Anexo</button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
<script>
    document.getElementById("encaminharForm").addEventListener("submit", function(e) {
        e.preventDefault();
        const setorSelect = document.getElementById("setorSelect");
        if (!setorSelect.value) {
            setorSelect.classList.add("is-invalid");
            return;
        } else {
            setorSelect.classList.remove("is-invalid");
        }

        alert(`Requerimento encaminhado para o setor: ${setorSelect.value}`);
        const modal = bootstrap.Modal.getInstance(document.getElementById("encaminharModal"));
        modal.hide();
        this.reset();
    });
</script>
@endpush

@endsection