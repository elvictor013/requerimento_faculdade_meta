<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuncionarioRequest;
use App\Models\Funcionario;
use App\Models\Setor;
use App\Models\User;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::with('user')->orderByDesc('id')->paginate(10);
        return view('funcionario.index', ['funcionarios' => $funcionarios]);
    }

    public function show(Funcionario $funcionario)
    {
        return view('funcionario.show', compact('funcionario'));
    }

    public function create()
    {
        $setores = Setor::all();
        return view('funcionario.create', compact('setores'));
    }

    public function store(FuncionarioRequest $request)
    {
        $request->validated();

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'username' => $request->cpf,
            'role'     => $request->tipo_funcionario,
            'setor_id' => $request->setor_id,
            'password' => bcrypt($request->password),
        ]);

        Funcionario::create([
            'user_id'          => $user->id,
            'cpf'              => $request->cpf,
            'tipo_funcionario' => $request-> role,
            'setor_id'         => $request->setor_id,
        ]);

        return redirect()->route('funcionario.index')->with('success', 'Funcionário cadastrado com sucesso!');
    }

    public function edit(Funcionario $funcionario)
    {
        $setores = Setor::all();
        return view('funcionario.edit', compact('funcionario', 'setores'));
    }

    public function update(FuncionarioRequest $request, Funcionario $funcionario)
    {
        $request->validated();

        $funcionario->update([
            'cpf'              => $request->cpf,
            'tipo_funcionario' => $request->role,
            'setor_id'         => $request->setor_id,
        ]);

        $funcionario->user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'username' => $request->cpf,
            'role'     => $request->role,
        ]);

        return redirect()->route('funcionario.index')->with('success', 'Funcionário atualizado com sucesso!');
    }

    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();
        return redirect()->route('funcionario.index')->with('success', 'Funcionário apagado com sucesso!');
    }
}
