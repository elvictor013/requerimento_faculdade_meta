<?php

namespace Database\Seeders;

use App\Models\Funcionario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // database/seeders/FuncionarioSeeder.php
        Funcionario::create([
            'nome' => 'Atendente João',
            'email' => 'joao@faculdade.test',
            'senha' => bcrypt('123456'),
            'papel' => 'atendente'
        ]);
    }
}
