<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Empresa;
use App\Models\Produto;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // \App\Models\Empresa::factory(10)->create();
        // \App\Models\Produto::factory(10)->create();
        // \App\Models\Usuario::factory(10)->create();

        Empresa::factory(100)
            ->has(Usuario::factory(5)
                ->has(Produto::factory(10)))
                ->create();
    }
}
