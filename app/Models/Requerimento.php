<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requerimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nome', 'email', 'curso', 'disciplina', 'tipo', 'descricao', 'status'
    ];


}
