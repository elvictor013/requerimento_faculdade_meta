@extends ('layouts.admin')

@section ('content')
<main class="container">
    <h1>Visualizar Requerimento</h1>

    <div class="btn-top-actions">
        <button type="button" class="btn btn-success" title="Aprovar Requerimento" onclick="alert('Requerimento aprovado')">
            <i class="fas fa-check"></i> Aprovar
        </button>
        <button type="button" class="btn btn-danger" title="Reprovar Requerimento" onclick="alert('Requerimento reprovado')">
            <i class="fas fa-times"></i> Reprovar
        </button>
        <button type="button" class="btn btn-warning" title="Encaminhar Requerimento" onclick="encaminharRequerimento()">
            <i class="fas fa-share"></i> Encaminhar
        </button>
    </div>

    <div class="row-item">
        <span class="label">Protocolo:</span>
        <span class="value">REQ-03062025-02</span>
    </div>
    <div class="row-item">
        <span class="label">Aluno:</span>
        <span class="value">Victor Gabriel Admin</span>
    </div>
    <div class="row-item">
        <span class="label">Matrícula:</span>
        <span class="value">202127814</span>
    </div>
    <div class="row-item">
        <span class="label">Tipo:</span>
        <span class="value">Cursar Disciplina Pendente</span>
    </div>
    <div class="row-item">
        <span class="label">Status:</span>
        <span class="value">Pendente</span>
    </div>
    <div class="row-item">
        <span class="label">Curso:</span>
        <span class="value">3</span>
    </div>
    <div class="row-item">
        <span class="label">Semestre:</span>
        <span class="value"></span>
    </div>
    <div class="row-item">
        <span class="label">Data de Criação:</span>
        <span class="value">03/06/2025 17:23</span>
    </div>
    <div class="row-item">
        <span class="label">Descrição:</span>
        <div class="description"></div>
    </div>

    <form id="responseForm" class="mt-4">
        <div class="mb-3">
            <label for="responseText" class="form-label">Responder ao Aluno</label>
            <textarea
                id="responseText"
                class="form-control"
                placeholder="Digite sua resposta aqui..."
                required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-paper-plane"></i> Responder
        </button>
    </form>
</main>

<script>
    function encaminharRequerimento() {
        const setor = prompt(
            "Informe o setor para o qual deseja encaminhar o requerimento:\nExemplos: Financeiro, Acadêmico, Secretaria, Técnico, Outros"
        );
        if (setor && setor.trim() !== "") {
            alert(`Requerimento encaminhado para o setor: ${setor.trim()}`);
        } else if (setor !== null) {
            alert("Setor inválido. Por favor, informe um setor válido.");
        }
    }

    const responseForm = document.getElementById("responseForm");
    responseForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const responseText = document.getElementById("responseText").value.trim();
        if (!responseText) {
            alert("Por favor, digite a resposta para o aluno.");
            return;
        }
        alert(`Resposta enviada:\n${responseText}`);
        responseForm.reset();
    });
</script>
@endsection