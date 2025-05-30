<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'moodle_id',
        'name',
        'email',
        'password',
        'role',
    ];

    //criar relacionamento entre um e muitos
    public function requerimentos()
    {
        return $this->hasMany(Requerimento::class);
    }

    public function getAuthIdentifierName()
    {
        return 'username';
    }

// App\Models\User.php

public function aluno()
{
    return $this->hasOne(Aluno::class, 'user_id');
}


    public function funcionario()
    {
        return $this->hasOne(Funcionario::class, 'user_id');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        //'password' => 'hashed',
    ];
}
