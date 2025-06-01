@extends('layouts.admin')
@section('content')
<div class="card mt-4 mb-4 border-light shadow">

    <div class="card-header hstack gap-2">
        <h2>Bem vindo ao sistema {{ Auth::user()->name }}</h2>
        <span class="ms-auto">
            <a href="{{ route('permissions.index') }}" class="btn btn-info btn-sm">Permissoes</a> <!-- Botão para tela de requerimento -->
            <!-- cadastrar um novo atendente -->
            <a href="{{ route('atendimento.create') }}" class="btn btn-primary btn-sm">Cadastrar novo atendente</a>
        </span>
    </div>

    <div class="card-body">
        <x-alert />
        <table class="table">
            <thead>
                <tr>    
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($funcionarios as $funcionario)

                <tr>
                    <th> {{ $funcionario->id }}</th>
                    <td>{{ $funcionario->name }}</td>
                    <td>{{ $funcionario->email }}</td>
                    <td class="text-center">
                        
                    </td>
                </tr>

                @empty
                <div class="alert alert-danger" role="alert">
                    Nenhum usuário atendente encontrado
                </div>
                @endforelse
            </tbody>
        </table>
        {{ $funcionarios->links() }}
    </div>
</div>
@endsection
