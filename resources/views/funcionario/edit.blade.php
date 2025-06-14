@extends('layouts.admin')
@section('content')

<div class="card mt-4 mb-4 border-light shadow">
    <div class="card-header hstack gap-2">
        <h5 class="mb-0">Editar Funcionário</h5>
    </div>

    <div class="card-body">
        <x-alert />

        <form action="{{ route('funcionario.update', $funcionario->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">
                    <label for="name" class="form-label">Nome:</label>
                    <input type="text" name="name" class="form-control" id="name"
                        placeholder="Nome Completo" value="{{ old('name', $funcionario->user->name) }}">
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" name="email" class="form-control" id="email"
                        placeholder="Melhor e-mail do usuário" value="{{ old('email', $funcionario->user->email) }}">
                </div>

                <div class="col-md-6">
                    <label for="cpf" class="form-label">CPF:</label>
                    <input type="text" name="cpf" class="form-control" id="cpf"
                        placeholder="00000000000" value="{{ old('cpf', $funcionario->cpf) }}">
                </div>

                <div class="col-md-6">
                    <label for="tipo_funcionario" class="form-label">Tipo do Funcionário:</label>
                    <select class="form-select" id="tipo_funcionario" name="tipo_funcionario" required>
                        <option value="" disabled>Selecione um papel</option>
                        @php
                        $roles = [
                            'coordenador' => 'Funcionário',
                            'admin' => 'Administrador',
                            'atendente' => 'Atendente',
                            'professor' => 'Professor',
                            'pedagogo' => 'Pedagogo',
                            'coordenador_curso' => 'Coordenador de Curso',
                            'coordenador_estagio' => 'Coordenador de Estágio',
                            'gerente_academico' => 'Gerente Acadêmico',
                            'diretor_academico' => 'Diretor Acadêmico',
                            'vice_diretor' => 'Vice-Diretor',
                            'financeiro' => 'Financeiro',
                            'secretario' => 'Secretário(a)',
                        ];
                        @endphp
                        @foreach($roles as $key => $value)
                        <option value="{{ $key }}"
                            {{ (old('tipo_funcionario', $funcionario->tipo_funcionario) == $key) ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="setor_id" class="form-label">Setor:</label>
                    <select class="form-select" id="setor_id" name="setor_id" required>
                        <option value="" disabled>Selecione o setor</option>
                        @foreach($setores as $setor)
                        <option value="{{ $setor->id }}"
                            {{ (old('setor_id', $funcionario->setor_id) == $setor->id) ? 'selected' : '' }}>
                            {{ $setor->descricao }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Senha:</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Deixe em branco para não alterar">
                        <span class="input-group-text" role="button"
                            onclick="togglePassword('password', this)">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Confirmar Senha:</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" class="form-control"
                            id="password_confirmation" placeholder="Confirme a senha">
                        <span class="input-group-text" role="button"
                            onclick="togglePassword('password_confirmation', this)">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Atualizar
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
