<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetorRequest;
use App\Models\Setor;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;


class SetorController extends Controller
{
    public function index()
    {
        $setores = Setor::orderByDesc('id', 'DESC')->get();
        
        return view('setores.index', ['setores' => $setores]);
    }

    public function show(Request $request)
    {
        $setor = Setor::where('id', $request->setor)->first();
        return view('setores.show', ['setor' => $setor]);
    }

    public function create()
    {
        return view('setores.create');
    }

    public function store(SetorRequest $request)
    {
        $request->validated([
            'nome' => 'required|unique:setor,nome',
            'descricao' => 'required',
        ]);
       
        $setor = Setor::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
        ]);


        return redirect()->route('setores.index' , ['setor' => $setor->id])->with('success', 'Setor cadastrado com sucesso!');
    }

    public function edit(Setor $setor)
    {
        return view('setores.edit' , ['setor' => $setor]);
    }

    public function update(SetorRequest $request, Setor $setor)
    {
        $request->validated([
            'nome' => 'required|unique:setor,nome',
            'descricao' => 'required',
        ]);

        $setor->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
        ]);


        return redirect()->route('setores.index', ['setor' => $setor])->with('success', 'Setor editado com sucesso!');
    }

    public function destroy(Setor $setor)
    {
        try {
            $setor->delete();
            return redirect()->route('setores.index')->with('success', 'Setor removido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('setores.index')->with('error', 'Erro ao remover o setor, verifique se ele possui funcionários cadastrados!');
        }
        
    }

}




