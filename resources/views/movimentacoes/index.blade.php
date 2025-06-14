@extends('layouts.admin')

@section('content')
    <h2>Movimentações</h2>
    <a href="{{ route('movimentacoes.create') }}" class="btn btn-success mb-3">Nova Movimentação</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Requerimento</th>
                <th>Origem</th>
                <th>Destino</th>
                <th>Enviado Por</th>
                <th>Recebido Por</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movimentacoes as $mov)
                <tr>
                    <td>{{ $mov->id }}</td>
                    <td>{{ $mov->requerimento->titulo ?? 'N/A' }}</td>
                    <td>{{ $mov->setorOrigem->nome ?? 'N/A' }}</td>
                    <td>{{ $mov->setorDestino->nome ?? 'N/A' }}</td>
                    <td>{{ $mov->enviadoPor->name ?? 'N/A' }}</td>
                    <td>{{ $mov->recebidoPor->name ?? '-' }}</td>
                    <td>{{ $mov->status }}</td>
                    <td>
                        @if($mov->status === 'Enviado')
                            <form action="{{ route('movimentacoes.receber', $mov) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary btn-sm">Receber</button>
                            </form>
                        @else
                            <span class="text-success">Recebido</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
