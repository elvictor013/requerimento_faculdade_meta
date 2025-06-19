<?php

namespace App\Http\Controllers;

use App\Models\Requerimento;
use App\Models\User;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Requerimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtendimentoController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Se o usuário logado for um funcionário, obtemos seu setor
        $setorId = $user->funcionario->setor_id ?? null;

        // Verificação de segurança
        if (!$setorId) {
            abort(403, 'Setor do funcionário não identificado.');
        }

        // Buscando os requerimentos relacionados ao setor do funcionário
        $requerimentos = Requerimento::with(['aluno.user', 'movimentacoes'])
            ->whereHas('movimentacoes', function ($query) use ($setorId) {
                $query->where('setor_destino_id', $setorId);
            })
            ->when($request->tipo, function ($query, $tipo) {
                $query->where('tipo_requerimento', $tipo);
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->busca, function ($query, $busca) {
                $query->where(function ($q) use ($busca) {
                    $q->where('tipo_requerimento', 'like', "%$busca%")
                        ->orWhere('protocolo', 'like', "%$busca%");
                });
            })
            ->when($request->ordenacao, function ($query, $ordenacao) {
                $query->orderBy('created_at', $ordenacao);
            }, function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->paginate(10);

        return view('atendimento.index', compact('requerimentos'));
    }



  public function show($id)
{
    $user = auth()->user();
    $requerimento = Requerimento::with('movimentacoes')->findOrFail($id);

    $setorId = $user->funcionario->setor_id ?? null;

    if (!$setorId) {
        abort(403, 'Setor do funcionário não identificado.');
    }

    // Se ninguém atendeu ainda, define o atendente e muda o status
    if (!$requerimento->atendente_id) {
        $requerimento->atendente_id = $user->id;
        $requerimento->status = 'Em Atendimento'; // 👈 Atualiza o status aqui
        $requerimento->save();
    }

    // Se outro atendente já assumiu, impede acesso
    if ($requerimento->atendente_id != $user->id) {
        abort(403, 'Este requerimento já está sendo atendido por outro usuário.');
    }

    // Marca como recebido no setor (movimentação)
    $movimentacao = $requerimento->movimentacoes()
        ->where('setor_destino_id', $setorId)
        ->whereNull('recebido_por')
        ->first();

    if ($movimentacao) {
        $movimentacao->recebido_por = $user->id;
        $movimentacao->data_hora_recebido = now();
        $movimentacao->status = 'Recebido';
        $movimentacao->save();
    } elseif (!$requerimento->movimentacoes()->where('setor_destino_id', $setorId)->exists()) {
        abort(403, 'Este requerimento não foi direcionado para o seu setor.');
    }

    return view('atendimento.show', compact('requerimento'));
}


}
