<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Discipline;
use Exception;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    

    //Listar Cursos
    public function index()
    {   //recuperar os registros do banco de dados
        $courses = Course::orderBy('id', 'DESC')->get();
        $disciplines = Discipline::all();
        //$courses = Course::paginate(10);
        //$courses = Course::where('id', 1000)->get();
        // carregar a view
        return view('courses.index', ['courses' => $courses , 'disciplines' => $disciplines]); 
    }

    //visualizar um unico curso
    public function show(Request $request)
    {   
       $course = Course::where('id', $request->course)->first();
        $disciplines = Discipline::all();

        
        // carregar a view
        return view('courses.show', ['course' => $course , 'disciplines' => $disciplines]);
    }

    //cadastrar um curso
    public function create()
    {   // carregar a view
        return view('courses.create');
    }

    //cadastrar um curso
    public function store(CourseRequest $request)
    {   
        //validadar o formulário
        $request->validated([
            'name' => 'required ',
            'description' => 'required',
        ]);
        // cadastrar no banco de dados 
        $course = Course::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        //redirecionar o usuario, enviar uma mensagem de sucesso
        return redirect()->route('courses.index', ['course' => $course->id])->with('success', 'Curso cadastrado com sucesso!');
    }

    //editar um curso
    public function edit(Course $course)
    {  
        
        // carregar a view
        return view('courses.edit' , ['course' => $course]);
    }

    //atualizar no banco de dados de curso
    public function update(CourseRequest $request, Course $course)
    {   
        //validadar o formulário
        $request->validated();
        //editar informações no banco de dados 
        $course->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        // redirecionar o usuario, enviar uma mensagem de sucesso
        return redirect()->route('courses.show', ['course' => $course->id])->with('success', 'Curso editado com sucesso!');
    }   

    // deletar um curso
    public function destroy(Course $course)
    {   
        try {
        //deletar no banco de dados
        $course->delete();
        // redirecionar o usuario, enviar uma mensagem de sucesso
        return redirect()->route('courses.index')->with('success', 'Curso removido com sucesso!');
        
        } catch (Exception $e) {

            
            return redirect()->route('courses.index')->with('error', 'Erro ao remover o curso, verifique se ele possui disciplinas cadastradas!');
        }
    }
}
