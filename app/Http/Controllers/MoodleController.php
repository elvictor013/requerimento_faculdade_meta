<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoodleController extends Controller
{
    public function getUserCourses($moodle_id)


    {
        $token = env('MOODLE_TOKEN');
        $url = env('MOODLE_REST_URL');

        $params = [
            'wstoken' => $token,
            'wsfunction' => 'core_enrol_get_users_courses',
            'moodlewsrestformat' => 'json',
            'user_id' => $moodle_id
        ];

        $response = Http::get($url, $params);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json([
            'success' => false,
            'error' => $response->body()
        ], $response->status());
    }
    public function getCategorias()
    {
        $token = env('MOODLE_TOKEN');
        $url = env('MOODLE_REST_URL');

        $params = [
            'wstoken' => $token,
            'wsfunction' => 'core_course_get_categories',
            'moodlewsrestformat' => 'json',
        ];

        $response = Http::get($url, $params);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json([
            'success' => false,
            'error' => $response->body()
        ], $response->status());
    }
}
