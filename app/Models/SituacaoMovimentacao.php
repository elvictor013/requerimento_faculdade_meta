<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituacaoMovimentacao extends Model
{
    use HasFactory;

    protected $table = 'situacao_movimentacao';

    protected $fillable = ['descricao'];

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class, 'situacao_id');
    }
}

