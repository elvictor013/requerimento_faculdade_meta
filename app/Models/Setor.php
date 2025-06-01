<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;

    protected $fillable = ['descricao'];

    public function movimentacoesOrigem()
    {
        return $this->hasMany(Movimentacao::class, 'setor_origem_id');
    }

    public function movimentacoesDestino()
    {
        return $this->hasMany(Movimentacao::class, 'setor_destino_id');
    }
}
