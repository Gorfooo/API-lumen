<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpresaFactory extends Factory
{

    protected $model = Empresa::class;

    public function definition()
    {
        $this->faker = \Faker\Factory::create('pt_BR');
        return [
            'nome' => $this->faker->company(),
            'telefone' => $this->faker->phoneNumber(),
            'cnpj' => preg_replace('/[^0-9]/', '', $this->faker->cnpj)        ];
    }
}
