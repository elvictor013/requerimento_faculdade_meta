<?php

namespace App\Http\Controllers;

use App\Models\Requerimento;
use App\Models\Course;
use App\Models\Discipline;
use App\Models\MoodleUser;
use App\Models\Movimentacao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Http;

class RequerimentoController extends Controller
{
    public function download($id)
    {
        $requerimento = Requerimento::findOrFail($id);

        if ($requerimento->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para acessar este arquivo.');
        }

        if (!$requerimento->anexo || !file_exists(storage_path("app/public/{$requerimento->anexo}"))) {
            abort(404, 'Arquivo não encontrado.');
        }

        return response()->download(storage_path("app/public/{$requerimento->anexo}"));
    }

    // public function getDisciplinasPorCurso($id)
    // {
    //     $disciplinas = Discipline::where('course_id', $id)->get();
    //     return response()->json($disciplinas);
    // }

    public function index(Request $request)
    {
        $user = User::with('aluno')->find(auth()->user()->id);

        if (!$user || !$user->aluno) {
            return back()->with('error', 'Aluno não encontrado para este usuário.');
        }

        $alunoId = $user->aluno->id;

        $requerimentos = Requerimento::query()
            ->where('aluno_id', $alunoId)
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

        return view('requerimentos.index', compact('requerimentos'));
    }

    public function show(Requerimento $requerimento)
    {
        $requerimento = $requerimento->load('aluno');

        return view('requerimentos.show', ['requerimento' => $requerimento]);
    }

    public function create()
    {
        // Pega o usuário logado
        $user = auth()->user();

        // Pega o moodle_id do usuário
        $moodleid = $user->moodle_id;

        // Pega o token e a URL da API do Moodle do .env
        $token = env('MOODLE_TOKEN');
        $url = env('MOODLE_REST_URL');

        // Verifica se as variáveis estão corretas
        if (!$url || !$token) {
            return back()->with('error', 'URL do Moodle ou Token não configurados corretamente no .env');
        }

        // Faz a requisição para buscar os cursos do usuário no Moodle
        $response = Http::get($url, [
            'wstoken' => env('MOODLE_TOKEN', $token),
            'wsfunction' => 'core_enrol_get_users_courses',
            'userid' => $moodleid,
            'moodlewsrestformat' => 'json',

        ]);

        // Verifica se houve erro na requisição
        if ($response->failed()) {
            return back()->with('error', 'Erro ao buscar cursos no Moodle');
        }

        // Pega os dados dos cursos
        $courses = $response->json();

        $paramsCategories = [
            'wstoken' => $token,
            'wsfunction' => 'core_course_get_categories',
            'moodlewsrestformat' => 'json',
        ];
      
        $responseCategories = Http::get($url, $paramsCategories);

        if ($responseCategories->failed()) {
            return back()->with('error', 'Erro ao buscar categorias no Moodle: ' . $responseCategories->body());
        }

        $categories = $responseCategories->json();

        // Retorna para a view passando os cursos e o moodle_id
        return view('requerimentos.create', compact('courses', 'categories', 'moodleid'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required|numeric',
                'semestre' => 'required|string',
                'course_id' => 'required|numeric',
                'tipo_requerimento' => 'required|string',
                'descricao' => 'required|string',
                'anexo' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
                'protocolo' => 'nullable|string',
                'status' => 'nullable|string',
            ]);

            $user = User::with('aluno')->find(auth()->user()->id);

            $anexoPath = $request->hasFile('anexo')
                ? $request->file('anexo')->store('anexos', 'public')
                : null;

            $requerimento = Requerimento::create([
                'aluno_id'    => $user->aluno->id,
                'category_id' => (int) $request->category_id,
                'semestre' => $request->semestre,
                'course_id' => (int) $request->course_id,
                'tipo_requerimento' => $request->tipo_requerimento,
                'descricao' => $request->descricao,
                'anexo' => $anexoPath,
                'status' => $request->status ?? 'Pendente',
            ]);

            Movimentacao::create([
                'requerimento_id' => $requerimento->id,
                'setor_origem_id' => 1,
                'setor_destino_id' => 1,
                'enviado_por' => auth()->user()->id,
                'data_hora_enviado' => now(),
                'status' => 'Enviado',
            ]);


            // return response()->json([
            //     'user'  => $request->category_id
            // ]);

            $protocolo = 'REQ-' . Carbon::now()->format('dmY') . '-' . str_pad($requerimento->id, 2, '0', STR_PAD_LEFT);
            $requerimento->update(['protocolo' => $protocolo]);
            // return response()->json([
            //     'requerimento'  => $requerimento
            // ]);
            return redirect()->route('requerimentos.index')
                ->with('success', "Requerimento enviado com sucesso! Seu protocolo: $protocolo");
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
            // return back()->with('error', 'Erro ao salvar: ' . $e->getMessage());}
        }
    }
}
