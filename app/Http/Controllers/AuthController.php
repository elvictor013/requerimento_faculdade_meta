<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\Aluno;
use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\MoodleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Services\MoodleService;
use Exception;


class AuthController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function loginProcess(LoginRequest $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        try {
            //  Primeiro tenta autenticar no banco local
            $user = User::where('username', $request->username)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                //  Login local bem-sucedido
                Auth::login($user);
                return redirect()->route('requerimentos.index')->with('success', 'Logado com sucesso!');
            }

            //  Se não encontrou localmente, tenta no Moodle
            $tokenResponse = Http::asForm()->post(env('MOODLE_LOGIN_URL', 'http://localhost/moodle/login/token.php'), [
                'username' => $request->username,
                'password' => $request->password,
                'service' => 'moodle_mobile_app',
            ]);

            if ($tokenResponse->failed() || isset($tokenResponse['error'])) {
                return redirect()->back()->withInput()->with('error', 'Usuário ou senha incorretos');
            }

            $token = $tokenResponse['token'];

            // Busca informações do usuário no Moodle
            $userResponse = Http::get(env('MOODLE_REST_URL', 'http://localhost/moodle/webservice/rest/server.php'), [
                'wstoken' => $token,
                'wsfunction' => 'core_user_get_users_by_field',
                'field' => 'username',
                'values[0]' => $request->username,
                'moodlewsrestformat' => 'json',
            ]);

            if ($userResponse->failed()) {
                return redirect()->back()->with('error', 'Erro ao buscar dados do usuário no Moodle');
            }

            $moodleUser = $userResponse->json();

            if (empty($moodleUser)) {
                return redirect()->back()->with('error', 'Usuário não encontrado no Moodle');
            }

            // Cria o usuário localmente
            $user = User::updateOrCreate(
                ['username' => $moodleUser[0]['username']],
                [
                    'name' => $moodleUser[0]['fullname'],
                    'username' => $moodleUser[0]['username'],
                    'moodle_id' => $moodleUser[0]['id'],
                    'email' => $moodleUser[0]['email'],
                    'password' => bcrypt($request->password), // opcionalmente armazena para login local futuro
                    'role' => 'aluno',
                ]
            );

            // Cria ou atualiza dados do aluno
            Aluno::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nome' => $user->name,
                    'matricula' => $user->username,
                ]
            );

            // Faz o login local
            Auth::login($user);

            return redirect()->route('requerimentos.index')->with('success', 'Logado com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao autenticar: ' . $e->getMessage());
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Deslogado com sucesso!');
    }
}
