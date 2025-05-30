@extends('layouts.admin')

@section('content')

<!-- Greeting and Button -->
<header class="container-fluid bg-gradient-to-b from-light py-4 position-relative" style="background: linear-gradient(to bottom, #f7f9fc, #f3f5f9);">
    <div class="container d-flex justify-content-between align-items-center position-relative">
        <h1 class="fs-3 fw-bold mb-0">
            Olá, {{ Auth::user()->name }}!
            <span class="wave">
                👋
            </span>
        </h1>
        <a href="{{ route('requerimentos.create') }}" class="btn btn-outline-secondary btn-sm btn-top-right btn-sn"> Solicitar um novo requerimento </a>
    </div>
</header>

<div class="container-fluid bg-gradient-to-b from-light py-4 position-relative"> 

</div>


<main class="container my-4">
    <!-- Alerta -->
    <x-alert />

    <!-- Histórico de Requerimento -->
    <section class="bg-white rounded-3 shadow-sm p-4 mb-5">
        <h2 class="fw-semibold fs-5 mb-4">
            Histórico de requerimento
        </h2>

        <!-- Filtros -->
        <form class="row g-3 align-items-center mb-4" method="GET" action="{{ route('requerimentos.index') }}">
            <div class="col-auto">
                <select name="tipo" class="form-select form-select-sm">
                    <option value="">Selecione o tipo de requerimento</option>
                    <option value="" {{ request('tipo') == '' ? 'selected' : '' }}>Todos</option>
                    <option value="Trancamento" {{ request('tipo') == 'Trancamento' ? 'selected' : '' }}>Trancamento</option>
                    <option value="Cancelamento" {{ request('tipo') == 'Cancelamento' ? 'selected' : '' }}>Cancelamento</option>
                    <option value="Justificativa de Falta" {{ request('tipo') == 'Justificativa de Falta' ? 'selected' : '' }}>Justificativa de Falta</option>
                    <option value="Transferência Externa" {{ request('tipo') == 'Transferência Externa' ? 'selected' : '' }}>Transferência Externa</option>
                    <option value="Ementas" {{ request('tipo') == 'Ementas' ? 'selected' : '' }}>Ementas</option>
                    <option value="Segunda Via de Diploma e Certificado" {{ request('tipo') == 'Segunda Via de Diploma e Certificado' ? 'selected' : '' }}>Segunda Via de Diploma e Certificado</option>
                    <option value="Reabertura de Matrícula" {{ request('tipo') == 'Reabertura de Matrícula' ? 'selected' : '' }}>Reabertura de Matrícula</option>
                    <option value="Reembolso" {{ request('tipo') == 'Reembolso' ? 'selected' : '' }}>Reembolso</option>
                    <option value="Correção de Nota" {{ request('tipo') == 'Correção de Nota' ? 'selected' : '' }}>Correção de Nota</option>
                    <option value="Solicitação de Desconto" {{ request('tipo') == 'Solicitação de Desconto' ? 'selected' : '' }}>Solicitação de Desconto</option>
                    <option value="Cursar Disciplina Pendente" {{ request('tipo') == 'Cursar Disciplina Pendente' ? 'selected' : '' }}>Cursar Disciplina Pendente</option>
                    <option value="Crédito de Disciplina" {{ request('tipo') == 'Crédito de Disciplina' ? 'selected' : '' }}>Crédito de Disciplina</option>
                    <option value="Declaração de Matrícula" {{ request('tipo') == 'Declaração de Matrícula' ? 'selected' : '' }}>Declaração de Matrícula</option>
                    <option value="Histórico Escolar" {{ request('tipo') == 'Histórico Escolar' ? 'selected' : '' }}>Histórico Escolar</option>
                    <option value="Declaração de Estágio" {{ request('tipo') == 'Declaração de Estágio' ? 'selected' : '' }}>Declaração de Estágio</option>
                    <option value="Revisão" {{ request('tipo') == 'Revisão' ? 'selected' : '' }}>Revisão</option>

                </select>
            </div>
            <div class="col-auto">
                <select name="ordenacao" class="form-select form-select-sm">
                    <option value="">Ordenar por data</option>
                    <option value="desc" {{ request('ordenacao') == 'desc' ? 'selected' : '' }}>Mais recentes</option>
                    <option value="asc" {{ request('ordenacao') == 'asc' ? 'selected' : '' }}>Mais antigos</option>
                </select>
            </div>
            <div class="col">
                <input type="search" name="busca" value="{{ request('busca') }}" class="form-control form-control-sm" placeholder="Buscar por protocolo">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-primary">Filtrar</button>
            </div>
        </form>


        <!-- Tabela de Requerimentos -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Protocolo</th>
                        <th>Tipo de Requerimento</th>
                        <th>Status</th>
                        <th>Data de Envio</th>
                        <th class="text-center">Anexo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requerimentos as $requerimento)
                    <tr>
                        <td>{{ $requerimento->protocolo }}</td>
                        <td>{{$requerimento->tipo_requerimento}}</td>
                        <td>{{ $requerimento->status }}</td>
                        <td>{{ $requerimento->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('requerimentos.show', ['requerimento' => $requerimento->id]) }}" class="btn btn-primary btn-sm">
                                Visualizar
                            </a>
                            <a href="{{ route('requerimentos.download', ['id' => $requerimento->id]) }}" class="btn btn-success btn-sm">
                                Download
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Nenhum requerimento encontrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $requerimentos->appends(request()->query())->links() }}
        </div>
    </section>
</main>



<!-- Floating Buttons on right side -->
<!-- <div class="position-fixed top-50 end-0 translate-middle-y d-flex flex-column gap-3 p-2" style="z-index: 1050;">
    <button aria-label="Navegação anterior" class="btn btn-primary rounded-pill d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" type="button">
        <i class="fas fa-chevron-left">
        </i>
    </button>
    <button aria-label="Acessibilidade" class="btn btn-info rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" type="button">
        <i class="fas fa-universal-access">
        </i>
    </button>
</div> -->
<!-- Bottom right help button -->
<button aria-label="Ajuda" class="btn btn-light position-fixed bottom-3 end-3 rounded-circle shadow" style="width: 48px; height: 48px; z-index: 1050;" type="button">
    <i class="fas fa-question">
    </i>
</button>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
</script>

@endsection