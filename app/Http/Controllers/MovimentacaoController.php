<?php
namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\Requerimento;
use App\Models\Setor;
use App\Models\Funcionario;
use Illuminate\Http\Request;

class MovimentacaoController extends Controller
{
    public function index()
    {
        $movimentacoes = Movimentacao::with(['requerimento', 'setorOrigem', 'setorDestino', 'enviadoPor', 'recebidoPor'])
                                      ->orderBy('created_at', 'desc')
                                      ->get();
        return view('movimentacoes.index', ['movimentacoes' => $movimentacoes]); 
    }

    public function create()
    {
        $requerimentos = Requerimento::all();
        $setores = Setor::all();
        return view('movimentacoes.create', compact('requerimentos', 'setores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'requerimento_id' => 'required',
            'setor_origem_id' => 'required',
            'setor_destino_id' => 'required',
        ]);

        Movimentacao::create([
            'requerimento_id' => $request->requerimento_id,
            'setor_origem_id' => $request->setor_origem_id,
            'setor_destino_id' => $request->setor_destino_id,
            'enviado_por' => auth()->user()->id,
            'data_hora_enviado' => now(),
            'status' => 'Enviado',
        ]);

        return redirect()->route('movimentacoes.index')->with('success', 'Movimentação criada com sucesso.');
    }

    public function receber(Movimentacao $movimentacao)
    {
        $movimentacao->update([
            'recebido_por' => auth()->user()->id,
            'data_hora_recebido' => now(),
            'status' => 'Recebido',
        ]);

        return redirect()->route('movimentacoes.index')->with('success', 'Movimentação recebida com sucesso.');
    }
}
