<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requerimento extends Model
{
    use HasFactory;

    protected $table = 'requerimentos';

    protected $fillable = [
        'aluno_id',
        'category_id',
        'course_id',
        'semestre',
        'tipo_requerimento',
        'descricao',
        'anexo',
        'status',
        'protocolo',
    ];

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class);
    }


    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function atendente()
    {
        return $this->belongsTo(User::class, 'atendente_id');
    }
}
