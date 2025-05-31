<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'aluno'; // <- Define o nome da tabela no singular
    protected $fillable = [
        'user_id',
        'nome',
        'matricula',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requerimentos()
    {
        return $this->hasMany(Requerimento::class);
    }

}
