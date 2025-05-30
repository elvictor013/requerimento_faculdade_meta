@extends('layouts.admin')
@section('content')
<div class="card mt-4 mb-4 border-light shadow">

    <div class="card-header hstack gap-2">
        <h2>Bem vindo ao sistema {{ Auth::user()->name }}</h2>
        <span class="ms-auto">
            <a href="{{ route('permissions.index') }}" class="btn btn-info btn-sm">Permissoes</a> <!-- Botão para tela de requerimento -->
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

                @forelse ($users as $user)

                <tr>
                    <th> {{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        <a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-primary btn-sm">Visualizar</a>
                        <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form method="POST" action="{{ route('user.destroy' , ['user' => $user->id]) }}" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm " onclick="return confirm('Tem certeza que deseja apagar esse registro?')">Apagar</button>
                        </form>
                    </td>
                </tr>

                @empty
                <div class="alert alert-danger" role="alert">
                    Nenhum usuário encontrado
                </div>
                @endforelse
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection
