@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Detalhes do Funcionario</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $funcionario->id }}</p>
            <p><strong>Nome:</strong> {{ $funcionario->user->name}}</p>
            <p><strong>Email:</strong> {{ $funcionario->user->email}}</p>
            <p><strong>CPF:</strong> {{ $funcionario->cpf }}</p>
            <p><strong>Tipo de Funcionario:</strong> {{ $funcionario->tipo_funcionario }}</p>
            <p><strong>Data de Criação:</strong> {{ $funcionario->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Data de Edição:</strong> {{ $funcionario->updated_at->format('d/m/Y H:i') }}</p>
            

            
            <a href="{{ route('requerimentos.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection
