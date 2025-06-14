<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;

    protected $table = 'movimentacoes';

    protected $fillable = [
        'requerimento_id',
        'setor_origem_id',
        'setor_destino_id',
        'enviado_por',
        'recebido_por',
        'data_hora_enviado',
        'data_hora_recebido',
        'status',
    ];

    public function requerimento() {
        return $this->belongsTo(Requerimento::class);
    }

    public function setorOrigem() {
        return $this->belongsTo(Setor::class, 'setor_origem_id');
    }

    public function setorDestino() {
        return $this->belongsTo(Setor::class, 'setor_destino_id');
    }

    public function enviadoPor() {
        return $this->belongsTo(User::class, 'enviado_por');
    }

    public function recebidoPor() {
        return $this->belongsTo(User::class, 'recebido_por');
    }
}
