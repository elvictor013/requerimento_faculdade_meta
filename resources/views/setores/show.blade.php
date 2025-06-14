@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Detalhes do Setor</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $setor->id }}</p>
            <p><strong>Nome:</strong> {{ $setor->nome}}</p>
            <p><strong>Data de Criação:</strong> {{ $setor->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Data de Edição:</strong> {{ $setor->updated_at->format('d/m/Y H:i') }}</p>
            <p><strong>Descrição:</strong> {{ $setor->descricao }}</p> 
            <a href="{{ route('requerimentos.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection
