@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Detalhes do Requerimento</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Protocolo:</strong> {{ $requerimento->protocolo }}</p>
            <p><strong>Tipo:</strong> {{ $requerimento->tipo_requerimento }}</p>
            <p><strong>Descrição:</strong> {{ $requerimento->descricao }}</p>
            <p><strong>Status:</strong> {{ $requerimento->status }}</p>
            <p><strong>Curso:</strong> {{ $requerimento->course->name ?? 'Não informado' }}</p>
            <p><strong>Data de Criação:</strong> {{ $requerimento->created_at->format('d/m/Y H:i') }}</p>

            @if($requerimento->anexo)
                <p><strong>Anexo:</strong> 
                    <a href="{{ route('requerimentos.download', $requerimento->id) }}" target="_blank">
                        Baixar Anexo
                    </a>
                </p>
            @endif

            <a href="{{ route('requerimentos.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection
