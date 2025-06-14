@extends('layouts.admin')
@section('content')

<div class="card mt-4 mb-4 border-light shadow">

    <div class="card-header hstack gap-2">
        <span>Cadastrar Funcionario</span>
        <span class="ms-auto d-sm-flex flex-row">
            <a href="{{ route('funcionario.index')}}" class="btn btn-info btn-sm me-1">Tela Inicial</a>
        </span>
    </div>

    <div class="card-body">
        <x-alert />

        <form action="{{ route('funcionario.store') }}" method="POST" class="row g-3">
            @csrf
            @method('POST')

            <div class="col-md-12">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nome Completo" value="{{ old('name') }}">
            </div>

            <div class="col-md-12">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Melhor E-mail do Usuário" value="{{ old('email') }}">
            </div>

            <!-- cadastar CPF -->

            <div class="col-md-12">
                <label for="cpf" class="form-label">CPF:</label>
                <input type="text" name="cpf" class="form-control" id="cpf" placeholder="00000000000" value="{{ old('cpf') }}">

            </div>

            <!-- tipo de funcionario -->

            <div class="col-md-12">
                <label class="form-label" for="tipo_funcionario">Tipo do Funcionário</label>
                <select class="form-select" id="tipo_funcionario" name="tipo_funcionario" required>
                    <option value="" disabled selected>Selecione um papel</option>
                    <option value="coordenador">Funcionario</option>
                    <option value="admin">Administrador</option>
                    <option value="atendente">Atendente</option>
                    <option value="professor">Professor</option>
                    <option value="pedagogo">Pedagogo</option>
                    <option value="coordenador_curso">Coordenador de Curso</option>
                    <option value="coordenador_estagio">Coordenador de Estágio</option>
                    <option value="gerente_academico">Gerente Acadêmico</option>
                    <option value="diretor_academico">Diretor Acadêmico</option>
                    <option value="vice_diretor">Vice-Diretor</option>
                    <option value="financeiro">Financeiro</option>
                    <option value="secretario">Secretário(a)</option>
                </select>
            </div>

            <!-- setor do funcionario -->

            <div class="mb-3">
                <label class="form-label fw-semibold" for="setor_id">Setor</label>
                <select class="form-select" id="setor_id" name="setor_id" required>
                    <option value="" disabled selected>Selecione o setor</option>
                    @foreach($setores as $setor)
                    <option value="{{ $setor['id'] }}">{{ $setor['descricao'] }}</option>
                    @endforeach
                </select>
            </div>


            <div class="col-md-6">
                <label for="password" class="form-label">Senha:</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Senha com no mínimo 6 caracteres" value="{{ old('password') }}">
                    <span class="input-group-text" role="button" onclick="togglePassword('password', this)"><i class="bi bi-eye"></i></span>
                </div>
            </div>

            <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Confirmar Senha:</label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirmar a senha" value="{{ old('password_confirmation') }}">
                    <span class="input-group-text" role="button" onclick="togglePassword('password_confirmation', this)"><i class="bi bi-eye"></i></span>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-sm btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>

</div>

@endsection