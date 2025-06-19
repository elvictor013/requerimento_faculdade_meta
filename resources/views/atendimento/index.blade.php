@extends('layouts.admin')

@section('content')

<br><br>
<main class="container">
    <h1 class="mb-4 fw-bold">Histórico de Requerimentos - Atendente {{ Auth::user()->name }}</h1>

    <section class="filter-section">
        <form id="filterForm" class="row g-3 align-items-center">
            <div class="col-md-4">
                <label for="filterType" class="form-label fw-semibold">Tipo de requerimento</label>
                <select id="filterType" name="type" class="form-select form-select-sm">
                    <option value="" selected>Todos</option>
                    <option value="trancamento">Trancamento</option>
                    <option value="cancelamento">Cancelamento</option>
                    <option value="revisao">Revisão</option>
                    <option value="outros">Outros</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="filterOrder" class="form-label fw-semibold">Ordenar por data</label>
                <select id="filterOrder" name="order" class="form-select form-select-sm">
                    <option value="desc" selected>Mais recentes</option>
                    <option value="asc">Mais antigos</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="filterProtocol" class="form-label fw-semibold">Buscar por protocolo</label>
                <input type="text" id="filterProtocol" name="protocol" class="form-control form-control-sm" placeholder="Número do protocolo" />
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-sm btn-primary">Filtrar</button>
            </div>
        </form>
    </section>

    <section class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Protocolo</th>
                    <th>Tipo de Requerimento</th>
                    <th>Data do Recebimento</th>
                    <th>Solicitante</th>
                    <th>Atendente</th>
                    <th>Status</th>
                    <th style="min-width: 120px;">Ações</th>
                </tr>
            </thead>
            <tbody id="requestsTableBody">
                @forelse ($requerimentos as $requerimento)
                <tr data-type="{{ $requerimento->tipo_requerimento }}" data-date="{{ $requerimento->created_at->format('Y-m-d') }}" data-protocol="{{ $requerimento->protocolo }}" data-solicitante="{{ $requerimento->aluno->user->name ?? '' }}" data-atendente="{{ $requerimento->atendente->user->name ?? '' }}" data-status="{{ $requerimento->status ?? 'Pendente' }}">
                    <td>{{ $requerimento->protocolo }}</td>
                    <td>{{ ucfirst($requerimento->tipo_requerimento) }}</td>
                    <td>{{ $requerimento->created_at->format('d/m/Y') }}</td>
                    <td>{{ $requerimento->aluno->user->name ?? 'não atendido por ninguém' }}</td>
                    <!-- funcionario atendente -->
                    <td>{{ $requerimento->atendente->name ?? 'não atendido por ninguém' }}</td>
                    <td>{{ $requerimento->status ?? 'Pendente' }}</td>

                    <td>
                        <a href="{{ route('atendimento.show', $requerimento->id) }}" class="btn btn-sm btn-outline-primary btn-icon btn-view" title="Visualizar Requerimento">
                            <i class="fas fa-eye"></i>
                        </a>

                        <button class="btn btn-sm btn-outline-success btn-icon btn-download" title="Baixar Anexo" onclick="alert('Baixar anexo {{ $requerimento->protocolo }}')">
                            <i class="fas fa-download"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">Nenhum requerimento encontrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const filterForm = document.getElementById("filterForm");
    const tableBody = document.getElementById("requestsTableBody");

    filterForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const typeVal = this.type.value.toLowerCase();
        const orderVal = this.order.value;
        const protocolVal = this.protocol.value.toLowerCase();

        let rows = Array.from(tableBody.rows);

        rows = rows.filter(row => {
            const rowType = row.dataset.type.toLowerCase();
            const rowProtocol = row.dataset.protocol.toLowerCase();
            const typeMatch = !typeVal || rowType === typeVal;
            const protocolMatch = !protocolVal || rowProtocol.includes(protocolVal);
            return typeMatch && protocolMatch;
        });

        rows.sort((a, b) => {
            const dateA = new Date(a.dataset.date);
            const dateB = new Date(b.dataset.date);
            return orderVal === "asc" ? dateA - dateB : dateB - dateA;
        });

        tableBody.innerHTML = "";
        rows.forEach(row => tableBody.appendChild(row));
    });
</script>

@endsection