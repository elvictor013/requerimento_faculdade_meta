<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requerimento extends Model
{
    use HasFactory;

   protected $fillable = [
    'user_id',
    'matricula',
    'category_id',
    'course_id',
    'tipo_requerimento',
    'descricao',
    'anexo',
    'status',
    'protocolo',
];



    //criar relacionamento entre um e muitos
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
