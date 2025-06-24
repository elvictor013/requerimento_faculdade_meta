@extends('layouts.admin')
@section('content')
<main class="container my-5">
    <x-alert />
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0">Lista de Funcionários</h1>
        <a href="{{ route('funcionario.create') }}"
            class="btn btn-sm btn-primary"
            type="button">
            <i class="fas fa-user-plus"></i> Cadastrar Funcionário
        </a>
    </div>
    <div class="table-responsive bg-white rounded shadow-sm p-3">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col">Nome Completo</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Email</th>
                    <th scope="col">Função</th>
                    <th scope="col" class="text-center" style="width: 130px;">Ações</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($funcionarios as $funcionario)
                <tr>
                    <td>{{ $funcionario->user->name }}</td>
                    <td>{{ $funcionario->cpf }}</td>
                    <td>{{ $funcionario->user->email }}</td>
                    <td>{{ $funcionario->user->role}}</td>
                    <td class="text-center">
                        <a href="{{ route('funcionario.show', ['funcionario' => $funcionario->id]) }}"
                            class="btn btn-sm btn-outline-primary btn-icon"
                            title="Visualizar"
                            type="button">
                            <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{ route('funcionario.edit', $funcionario->id) }}"
                            class="btn btn-sm btn-outline-warning btn-icon"
                            title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form method="POST" action="{{ route('funcionario.destroy' , ['funcionario' => $funcionario->id]) }}" class="d-inline">
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
                <tr>
                    <td colspan="5">
                        <div class="alert alert-danger mb-0 text-center">
                            Nenhum funcionário cadastrado.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>
@endsection
