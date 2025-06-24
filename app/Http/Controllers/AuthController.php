<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\Aluno;
use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\MoodleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
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
            // LOGIN FUNCIONÁRIO
            $funcionario = Funcionario::where('cpf', $request->username)->first();
            
            if ($funcionario) {
                $user = User::where('username', $funcionario->cpf)->first();
                if ($user && Hash::check($request->password, $user->password)) {
                    Auth::login($user);
                    
                    // Lembra automaticamente a identificação
                    Cookie::queue('remembered_username', $request->username, 60 * 24 * 30);

                    return redirect()->route('atendimento.index')->with('success', 'Usuário logado com sucesso!');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Usuário ou senha incorretos');
                }
            }

            // LOGIN MOODLE
            $tokenResponse = Http::asForm()->post(env('MOODLE_LOGIN_URL', 'http://localhost/moodle/login/token.php'), [
                'username' => $request->username,
                'password' => $request->password,
                'service' => 'moodle_mobile_app',
            ]);

            if ($tokenResponse->failed() || isset($tokenResponse['error'])) {
                // return response()->json(['error' => 'Usuário ou senha incorretos'], 401);
                     return redirect()->back()->withInput()->with('error', 'Usuário ou senha incorretos');
            }

            // $token = $tokenResponse['token'];


            $userResponse = Http::get(env('MOODLE_REST_URL', 'http://localhost/moodle/webservice/rest/server.php'), [
                'wstoken' => env('MOODLE_TOKEN'),
                'wsfunction' => 'core_user_get_users_by_field',
                'field' => 'username',
                'values[0]' => $request->username,
                'moodlewsrestformat' => 'json',
            ]);

            if ($userResponse->failed()) {
                return redirect()->back()->with('error', 'Erro ao buscar dados do usuário');
            }

            $moodleUser = $userResponse->json();
            $user = User::updateOrCreate(
                ['username' => $moodleUser[0]['username']],
                [
                    'name' => $moodleUser[0]['fullname'],
                    'username' => $moodleUser[0]['username'],
                    'moodle_id' => $moodleUser[0]['id'],
                    'email' => $moodleUser[0]['email'],
                    'password' => bcrypt($request->password),
                    'role' => 'aluno',
                    'setor_id' => ['id'],
                ]
            );

            Aluno::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nome' => $user->name,
                    'matricula' => $user->username,
                ]
            );

            Auth::login($user);

            // Lembra automaticamente a identificação
            Cookie::queue('remembered_username', $request->username, 60 * 24 * 30);

            return redirect()->route('requerimentos.index')->with('success', 'Logado com sucesso!');
        } catch (\Exception $e) {
            // return response()->json(['error' => $e->getMessage()], 500);
             return redirect()->back()->with('error', 'Erro ao autenticar no Moodle');
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Deslogado com sucesso!');
    }
}
