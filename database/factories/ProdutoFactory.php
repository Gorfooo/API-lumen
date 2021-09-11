<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{

    protected $model = Produto::class;

    public function definition()
    {
        $this->faker = \Faker\Factory::create('pt_BR');
        return [
            'nome' => $this->faker->word(),
            'quanto' => $this->faker->numberBetween(0,200),
            'ncm' => $this->faker->randomNumber(8),
        ];
    }
}
