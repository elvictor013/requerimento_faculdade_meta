@extends('layouts.admin')

@section('content')

<style>
    /* Estilo geral dos cards */
    .card, .bg-white {
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e0e0e0;
    }

    /* Cabeçalho do card */
    .card-header {
        background-color: #f8f9fa;
        font-weight: 600;
        font-size: 1.2rem;
        border-bottom: 1px solid #dee2e6;
    }

    /* Títulos */
    h1 {
        color: #343a40;
        font-size: 1.8rem;
    }

    /* Labels */
    label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 5px;
    }

    /* Inputs e Select */
    input.form-control,
    select.form-select,
    textarea.form-control {
        border-radius: 8px;
        border: 1px solid #ced4da;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    input:focus,
    select:focus,
    textarea:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    /* Botões */
    .btn {
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5c636a;
        border-color: #545b62;
    }

    /* Validação */
    .is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: none;
        color: #dc3545;
        font-size: 0.875rem;
    }

    input.is-invalid + .invalid-feedback,
    textarea.is-invalid + .invalid-feedback {
        display: block;
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .input-group {
            flex-direction: column;
        }
        .input-group .form-control {
            border-radius: 8px 8px 0 0;
        }
        .input-group .input-group-text {
            border-radius: 0 0 8px 8px;
        }
    }
</style>

<main class="container my-5">
    <x-alert />
    <h1 class="mb-4 fw-bold">Editar Setor</h1>
    <div class="bg-white rounded shadow-sm p-4">
        <form id="setorForm" action="{{ route('setores.update', ['setor' => $setor->id]) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label" for="nome">Nome do Setor</label>
                <input
                    class="form-control"
                    id="nome"
                    name="nome"
                    placeholder="Digite o nome do setor"
                    type="text"
                    value="{{ old('nome', $setor->nome) }}" />
                <div class="invalid-feedback">Por favor, insira o nome do setor.</div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="descricao">Descrição do Setor</label>
                <textarea
                    class="form-control"
                    id="descricao"
                    name="descricao"
                    placeholder="Digite a descrição do setor"
                    rows="4">{{ old('descricao', $setor->descricao) }}</textarea>
                <div class="invalid-feedback">Por favor, insira a descrição do setor.</div>
            </div>

            <button class="btn btn-primary" type="submit">Editar Setor</button>
            <a href="{{ route('setores.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
