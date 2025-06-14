    @extends('layouts.admin')

    @section('content')
    <main class="container my-5">
        <x-alert />
        <h1 class="mb-4 fw-bold">Cadastro de Setor</h1>
        <div class="bg-white rounded shadow-sm p-4">
            <form id="setorForm" action="{{ route('setores.store') }}" method="POST" novalidate>
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label class="form-label" for="name">Nome do Setor</label>
                    <input
                        class="form-control"
                        id="nome"
                        name="nome"
                        placeholder="Digite o nome do setor"
                        type="text" />
                    <div class="invalid-feedback">Por favor, insira o nome do setor.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="descricao">Descrição do Setor</label>
                    <textarea
                        class="form-control"
                        id="descricao"
                        name="descricao"
                        placeholder="Digite a descrição do setor"
                        rows="4"></textarea>
                    <div class="invalid-feedback">Por favor, insira a descrição do setor.</div>
                </div>
                <button class="btn btn-primary" type="submit">Cadastrar Setor</button>
                <button class="btn btn-secondary" type="reset">Limpar</button>
                <!-- botão de voltar -->
                <a href="{{ route('setores.index') }}" class="btn btn-secondary">Voltar</a>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endsection