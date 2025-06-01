<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuncionarioRequest;
use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AtendimentoController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::orderByDesc('id')->paginate(2);



        return view('atendimento.index', ['funcionarios' => $funcionarios]);
    }

    public function show()
    {
        return view('atendimento.show');
    }

    public function create()
    {
        return view('atendimento.create');
    }

    public function store(FuncionarioRequest $request)
    {
        $request->validated();

       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        Funcionario::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email, 
            'username' => $request->username,
            'role' => $request->role,
            'setor' => $request->setor,
        ]);

        return redirect()->route('atendimento.index')->with('success', 'Usuário atendente cadastrado com sucesso!');
    }
}
