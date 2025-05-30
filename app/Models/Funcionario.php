<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionario';

    protected $fillable = [
        'user_id',
        'name',
        'cpf',
        'tipo_funcionario',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
