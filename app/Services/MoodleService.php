<?php

// app/Services/MoodleService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MoodleService
{
    protected $moodleUrl;
    protected $token;

    public function __construct()
    {
        $this->moodleUrl = env('MOODLE_URL', 'https://localhost/moodle'); // Agora pega do .env corretamente
        $this->token = env('MOODLE_TOKEN', '110a17f3222ffbd1006880a402a2e5a6');
    }


    /**
     * Função para obter informações do usuário usando o core_user_get_users
     */
    public function getMoodleUser($username)
    {
        // Fazendo a requisição à API do Moodle
        $response = Http::get($this->moodleUrl, [
            'wstoken' => $this->token,  // Token de autenticação
            'wsfunction' => 'core_user_get_users',  // Função da API
            'moodlewsrestformat' => 'json',  // Formato de resposta (JSON)
            'criteria[0][key]' => 'username',  // Alterado para 'username'
            'criteria[0][value]' => $username,  // Usuário
        ]);

        // Verificando a resposta da API
        dd($response->json());  // Verifica a resposta da API para depuração

        // Verificando se a requisição foi bem-sucedida
        if ($response->successful()) {
            return $response->json();  // Retorna os dados do usuário
        }

        // Se falhar, retorna null
        return null;
    }


    /**
     * Função para pegar os cursos de um usuário ;
     */
    public function getUserCourses($userId)
    {
        $response = Http::get("{$this->moodleUrl}/webservice/rest/server.php", [
            'wstoken' => $this->token,
            'wsfunction' => 'core_enrol_get_users_courses',
            'moodlewsrestformat' => 'json',
            'userid' => $userId,
        ]);

        if ($response->successful()) {
            return $response->json(); // Retorna a lista de cursos
        }

        return [];
    }
}
