<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Atendente - Histórico de Requerimentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Montserrat", sans-serif;
            background-color: #f3f5f9;
            color: #1a1a1a;
            min-height: 100vh;
        }

        .table thead th {
            vertical-align: middle;
        }

        .filter-section {
            background: white;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 8px rgb(0 0 0 / 0.1);
            margin-bottom: 1.5rem;
        }

        .table-responsive {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0 8px rgb(0 0 0 / 0.1);
            padding: 1rem;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.25rem;
            border-radius: 0.375rem;
        }

        .btn-icon:last-child {
            margin-right: 0;
        }

        .btn-view {
            color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-view:hover,
        .btn-view:focus {
            background-color: #0d6efd;
            color: white;
        }

        .btn-download {
            color: #198754;
            border-color: #198754;
        }

        .btn-download:hover,
        .btn-download:focus {
            background-color: #198754;
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom">
        <div class="container-fluid px-4">
            <a href="#" class="navbar-brand d-flex align-items-center gap-2">
                <img src="//ava.meta.edu.br/faculdade/pluginfile.php/1/theme_moove/logo/1737842252/logofaculdade.svg" alt="AVA - Faculdade Meta" width="250" height="48" loading="lazy" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-4 mb-2 mb-md-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('requerimentos.index') }}">Página Requerimentos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('funcionario.index') }}">Funcionário</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('setores.index') }}">Setores</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('movimentacoes.index') }}">Movimentações</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.index') }}">Usuários</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://dliportal.zbra.com.br/Login.aspx?key=meta">Biblioteca Virtual</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://aluno-meta.phidelis.com.br/">Portal do Aluno</a></li>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-3 position-relative">
                <div class="dropdown d-flex align-items-center">
                    <button class="btn p-0 text-secondary ms-1 dropdown-toggle" id="perfilDropdown" data-bs-toggle="dropdown" aria-expanded="false" type="button">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="perfilDropdown" style="min-width: 180px;">
                        <li><a class="dropdown-item" href="{{ route('user.show', ['user' => Auth::user()->id]) }}">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Configurações</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item text-danger" href="{{ route('login.destroy') }}">Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <main class="container">
        <h1 class="mb-4 fw-bold">Histórico de Requerimentos - Atendente</h1>

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
                            <td>{{ $requerimento->aluno->user->name ?? '-' }}</td>
                            <td>{{ $requerimento->atendente->user->name ?? '-' }}</td>
                            <td>{{ $requerimento->status ?? 'Pendente' }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary btn-icon btn-view" title="Visualizar Requerimento" onclick="alert('Visualizar {{ $requerimento->protocolo }}')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success btn-icon btn-download" title="Baixar Anexo" onclick="alert('Baixar anexo {{ $requerimento->protocolo }}')">
                                    <i class="fas fa-download"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7">Nenhum requerimento encontrado.</td></tr>
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
</body>

</html>
