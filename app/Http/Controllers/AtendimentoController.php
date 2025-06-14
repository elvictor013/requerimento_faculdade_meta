<?php

namespace App\Http\Controllers;

use App\Models\Requerimento;
use App\Models\User;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    public function index(Request $request)
    {
        $user = User::with('funcionario')->find(auth()->user()->id);

        if (!$user || !$user->funcionario) {
            return back()->with('error', 'Funcionário não encontrado para este usuário.');
        }

        $requerimentos = Requerimento::with(['aluno.user']) // carrega nome do solicitante
            ->when($request->tipo, fn($query, $tipo) => $query->where('tipo_requerimento', $tipo))
            ->when($request->status, fn($query, $status) => $query->where('status', $status))
            ->when($request->busca, function ($query, $busca) {
                $query->where(function ($q) use ($busca) {
                    $q->where('tipo_requerimento', 'like', "%$busca%")
                        ->orWhere('protocolo', 'like', "%$busca%");
                });
            })
            ->when(
                $request->ordenacao,
                fn($query, $ordenacao) => $query->orderBy('created_at', $ordenacao),
                fn($query) => $query->orderBy('created_at', 'desc')
            )
            ->paginate(10);

        return view('atendimento.index', compact('requerimentos'));
    }
}
