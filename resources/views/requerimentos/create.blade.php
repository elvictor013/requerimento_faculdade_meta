@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<header class="container-fluid bg-gradient-to-b from-light py-4" style="background: linear-gradient(to bottom, #f7f9fc, #f3f5f9);">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="fs-3 fw-bold mb-0">
            Solicitar Requerimento
            <span class="wave">📝</span>
        </h1>
    </div>
</header>

<!-- Form Section -->
<main class="container my-4">
    <form id="requerimentoForm" action="{{ route('requerimentos.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3 shadow-sm p-4">
        @csrf


        <!-- Categoria -->
        <div class="mb-3">
            <label class="form-label fw-semibold" for="category_id">Categoria</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="" disabled selected>Selecione uma categoria</option>
                @foreach($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>


        <!-- Semestre -->

        <!-- <div class="mb-3">
            <label class="form-label fw-semibold" for="semestre_id">Semestre</label>
            <select class="form-select" id="semestre_id" name="semestre_id" required>
                <option value="" disabled selected>Selecione um semestre</option>
                <option value="1">Semestre 1</option>
                <option value="2">Semestre 2</option>
                <option value="3">Semestre 3</option>
                <option value="4">Semestre 4</option>
                <option value="5">Semestre 5</option>
                <option value="6">Semestre 6</option>
                <option value="7">Semestre 7</option>
                <option value="8">Semestre 8</option>
                <option value="9">Semestre 9</option>
                <option value="10">Semestre 10</option>
            </select>
        </div> -->

        <!-- Curso -->
        <div class="mb-3">
            <label class="form-label fw-semibold" for="course_id">curso</label>
            <select class="form-select" id="course_id" name="course_id" required>
                <option value="" disabled selected>Selecione um curso</option>
                @foreach($courses as $course)
                <option value="{{ $course['id'] }}">{{ $course['fullname'] }}</option>
                @endforeach
            </select>
        </div>



        <!-- Tipo de Requerimento -->
        <div class="mb-3">
            <label class="form-label fw-semibold" for="tipo_requerimento">Tipo de Requerimento</label>
            <select class="form-select" id="tipo_requerimento" name="tipo_requerimento" required>
                <option value="" disabled selected>Selecione o tipo de requerimento</option>
                <option value="Trancamento">Trancamento</option>
                <option value="Cancelamento">Cancelamento</option>
                <option value="Justificativa de Falta">Justificativa de Falta</option>
                <option value="Transferência Externa">Transferência Externa</option>
                <option value="Ementas">Ementas</option>
                <option value="Segunda Via de Diploma e Certificado">Segunda Via de Diploma e Certificado</option>
                <option value="Reabertura de Matrícula">Reabertura de Matrícula</option>
                <option value="Reembolso">Reembolso</option>
                <option value="Correção de Nota">Correção de Nota</option>
                <option value="Solicitação de Desconto">Solicitação de Desconto</option>
                <option value="Cursar Disciplina Pendente">Cursar Disciplina Pendente</option>
                <option value="Crédito de Disciplina">Crédito de Disciplina</option>
                <option value="Declaração de Matrícula">Declaração de Matrícula</option>
                <option value="Histórico Escolar">Histórico Escolar</option>
                <option value="Declaração de Estágio">Declaração de Estágio</option>
                <option value="Outros">Outros</option>
            </select>
         

        </div>

        <!-- Disciplina -->
        <!-- <div class="mb-3" id="campo_disciplina" style="display: none;">
            <label class="form-label fw-semibold" for="discipline_id">Disciplina</label>
            <select id="discipline_id" name="discipline_id[]" class="form-select" multiple>
                <option value="">Selecione a disciplina</option>
            </select>
            <small class="text-muted">Segure Ctrl (ou Cmd no Mac) para selecionar várias disciplinas</small>
        </div> -->

        <!-- Descrição -->
        <div class="mb-3">
            <label class="form-label fw-semibold" for="descricaoTextarea">Descrição</label>
            <textarea class="form-control" id="descricaoTextarea" name="descricao" placeholder="Descreva o motivo do requerimento" required rows="4"></textarea>
        </div>

        <!-- Anexo -->
        <div class="mb-4">
            <label class="form-label fw-semibold" for="anexoInput">Anexo (documentação, se necessário)</label>
            <input class="form-control" id="anexoInput" name="anexo" type="file" />
        </div>

        <!-- Botões -->
        <div class="d-flex gap-3">
            <button class="btn btn-primary" type="submit">Enviar</button>
            <button class="btn btn-secondary" id="limparBtn" type="button">Limpar formulário</button>
        </div>
    </form>
</main>

<script>
    // Mostrar ou ocultar campo disciplina
    // document.getElementById('tipo_requerimento').addEventListener('change', function() {
    //     const campoDisciplina = document.getElementById('campo_disciplina');
    //     const requerimentosComDisciplina = [
    //         'Correção de Nota',
    //         'Cursar Disciplina Pendente',
    //         'Crédito de Disciplina'
    //     ];

    //     if (requerimentosComDisciplina.includes(this.value)) {
    //         campoDisciplina.style.display = 'block';
    //     } else {
    //         campoDisciplina.style.display = 'none';
    //         document.getElementById('discipline_id').value = '';
    //     }
    // });

    // Carregar disciplinas dinamicamente
    // document.getElementById('course_id').addEventListener('change', function() {
    //     const courseId = this.value;
    //     const disciplinaSelect = document.getElementById('discipline_id');

    //     disciplinaSelect.innerHTML = '<option value="">Carregando disciplinas...</option>';

    //     fetch(`/disciplinas-por-curso/${courseId}`)
    //         .then(response => response.json())
    //         .then(data => {
    //             disciplinaSelect.innerHTML = '';
    //             if (data.length === 0) {
    //                 disciplinaSelect.innerHTML = '<option value="">Nenhuma disciplina encontrada</option>';
    //             } else {
    //                 data.forEach(disciplina => {
    //                     const option = document.createElement('option');
    //                     option.value = disciplina.id;
    //                     option.textContent = disciplina.name;
    //                     disciplinaSelect.appendChild(option);
    //                 });
    //             }
    //         })
    //         .catch(error => {
    //             disciplinaSelect.innerHTML = '<option value="">Erro ao carregar disciplinas</option>';
    //             console.error(error);
    //         });
    // });

    // Limpar formulário
    document.getElementById('limparBtn').addEventListener('click', function() {
        const form = document.getElementById('requerimentoForm');
        form.reset();
        document.getElementById('campo_disciplina').style.display = 'none';
    });
</script>

@endsection