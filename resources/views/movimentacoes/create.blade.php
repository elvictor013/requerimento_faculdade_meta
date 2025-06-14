@extends('layouts.admin')

@section('content')

    <h2>Criar Movimentação</h2>

    <form action="{{ route('movimentacoes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Requerimento</label>
            <select name="requerimento_id" class="form-control">
                @foreach($requerimentos as $req)
                    <option value="{{ $req->id }}">{{ $req->titulo }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Setor Origem</label>
            <select name="setor_origem_id" class="form-control">
                @foreach($setores as $setor)
                    <option value="{{ $setor->id }}">{{ $setor->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Setor Destino</label>
            <select name="setor_destino_id" class="form-control">
                @foreach($setores as $setor)
                    <option value="{{ $setor->id }}">{{ $setor->nome }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection
