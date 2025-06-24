@extends ('layouts.admin')

@section('content')

<x-alert />
<form method="POST" action="{{ route('requerimentos.encaminhar', $requerimento->id) }}">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title">Encaminhar Requerimento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="mb-3">
        <label class="form-label fw-semibold" for="setor_id">Setor</label>
        <select class="form-select" id="setor_id" name="setor_id" required>
            <option value="" disabled selected>Selecione o setor</option>
            @foreach($setores as $setor)
            <option value="{{ $setor['id'] }}">{{ $setor['descricao'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Enviar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    </div>
</form>
@endsection