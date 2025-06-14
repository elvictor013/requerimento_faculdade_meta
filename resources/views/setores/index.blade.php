@extends('layouts.admin')

@section('content')

<main class="container my-5">
    <x-alert />
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0">Lista de Setores</h1>
        <a href="{{ route('setores.create') }}"
            class="btn btn-sm btn-primary"
            type="button">
            <i class="fas fa-user-plus"></i> Cadastrar Setores
        </a>
    </div>
    <div class="table-responsive bg-white rounded shadow-sm p-3">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">

                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome do Setor</th>
                    <th scope="col">Cadastrado</th>
                    <th scope="col" class="text-center" style="width: 130px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($setores as $setor)
                <tr>
                    <td>{{ $setor->id }}</td>
                    <td>{{ $setor->nome }}</td>
                    <td>{{ \Carbon\Carbon::parse($setor->created_at)->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('setores.show', ['setor' => $setor->id]) }}"
                            class="btn btn-sm btn-outline-primary btn-icon"
                            title="Visualizar"
                            type="button">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('setores.edit', ['setor' => $setor->id]) }}"
                            class="btn btn-sm btn-outline-warning btn-icon"
                            title="Editar"
                            type="button">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('setores.destroy' , ['setor' => $setor->id]) }}" class="d-inline">
                            @csrf
                            @method('delete')

                            <button class="btn btn-sm btn-outline-danger btn-icon"
                                title="Apagar"
                                type="submit"
                                onclick="return confirm('Tem certeza que deseja apagar esse registro?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <div class="alert alert-danger" role="alert">
                    Nenhum usuário encontrado
                </div>
                @endforelse
            </tbody>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
