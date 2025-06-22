@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalhes do Requerimento</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Protocolo:</strong> {{ $requerimento->protocolo }}</p>
            <p><strong>Aluno:</strong> {{ $requerimento->aluno->nome }}</p>
            <p><strong>Matrícula:</strong> {{ $requerimento->aluno->matricula }}</p>
            <p><strong>Tipo:</strong> {{ $requerimento->tipo_requerimento }}</p>
            <p><strong>Descrição:</strong> {{ $requerimento->descricao }}</p>
            <p><strong>Status:</strong> {{ $requerimento->status }}</p>

            <p><strong>Curso:</strong>
                {{ $requerimento->categoria->nome ?? 'Não informado' }}
            </p>

            <p><strong>Semestre:</strong> {{ $requerimento->semestre }}</p>
            <p><strong>Data de Criação:</strong> {{ $requerimento->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Resposta:</strong></p>

            @if($requerimento->resposta_atendente)
            <div class="alert alert-info mt-4">
                <strong>Resposta do Atendente:</strong><br>
                <p>{{ $requerimento->resposta_atendente }}</p>

                @if($requerimento->anexo_resposta_atendente)
                <p class="mt-2 mb-0">
                    <strong>Anexo da Resposta:</strong>
                    <a href="{{ route('requerimentos.downloadAnexo', $requerimento->id) }}" target="_blank">
                        Baixar Anexo da Resposta
                    </a>
                </p>
                @endif
            </div>
            @endif


            <a href="{{ route('requerimentos.index') }}" class="btn btn-secondary mt-3">Voltar</a>
        </div>
    </div>
</div>
@endsection