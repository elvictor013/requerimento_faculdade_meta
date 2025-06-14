@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Movimentação</h1>

    <form action="{{ route('movimentacoes.update', $movimentacao->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Repete os campos como no create, mas com os valores preenchidos -->
        
        <div class="mb-3">
            <label>Setor Destino</label>
            <select name="setor_destino_id" class="form-control">
                @foreach ($setores as $setor)
                    <option value="{{ $setor->id }}" {{ $setor->id == $movimentacao->setor_destino_id ? 'selected' : '' }}>
                        {{ $setor->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Situação</label>
            <select name="situacao_id" class="form-control">
                @foreach ($situacoes as $sit)
                    <option value="{{ $sit->id }}" {{ $sit->id == $movimentacao->situacao_id ? 'selected' : '' }}>
                        {{ $sit->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
