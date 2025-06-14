<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;

    protected $table = 'setor';

    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function funcioanarios()
    {
        return $this->hasMany(Funcionario::class);
    }

    public function movimentacoesOrigem()
    {
        return $this->hasMany(Movimentacao::class, 'setor_origem_id');
    }

    public function movimentacoesDestino()
    {
        return $this->hasMany(Movimentacao::class, 'setor_destino_id');
    }
}
