<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
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
            // Faz a requisição para o Moodle para obter o token
            $tokenResponse = Http::asForm()->post(env('MOODLE_LOGIN_URL', 'http://localhost/moodle/login/token.php'), [
                'username' => $request->username,
                'password' => $request->password,
                'service' => 'moodle_mobile_app', // nome exato do seu serviço criado no Moodle
            ]);

            if ($tokenResponse->failed() || isset($tokenResponse['error'])) {
                return redirect()->back()->withInput()->with('error', 'Usuário ou senha incorretos');
            }


            $token = $tokenResponse['token'];
    
            // Usa o token para buscar informações do usuário via Webservice
            $userResponse = Http::get(env('MOODLE_REST_URL', 'http://localhost/moodle/webservice/rest/server.php'), [
                'wstoken' => env('MOODLE_TOKEN', $token),
                'wsfunction' => 'core_user_get_users_by_field',
                'field' => 'username',
                'values[0]' => $request->username,
                'moodlewsrestformat' => 'json',
                 
            ]);

            if ($userResponse->failed()) {
                return redirect()->back()->with('error', 'Erro ao buscar dados do usuário');
            }

            $moodleUser = $userResponse->json();

            
            

            // Cria ou atualiza o usuário local
            $user = User::updateOrCreate(
                ['username' => $moodleUser[0]['username']],
                [
                    'name' => $moodleUser[0]['fullname'],
                    'username' => $moodleUser[0]['username'],
                    'moodle_id' => $moodleUser[0]['id'],
                    'email' => $moodleUser[0]['email'],// você pode adaptar conforme necessário
                    'password' => bcrypt($request->password), // salva a senha localmente criptografada (opcional)
                    'role' => 'webservice',
                ]
            );
           

            // Autentica localmente
            Auth::login($user);

            return redirect()->route('requerimentos.index')->with('success', 'Logado com sucesso!');

        } catch (\Exception $e) {
            
            return redirect()->back()->with('error', 'Erro ao autenticar no Moodle');
        }
    }
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Deslogado com sucesso!');
    }

}