<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
// use Faker\Provider\pt_BR as FakerBR;

class UsuarioFactory extends Factory
{
    
    protected $model = Usuario::class;
    
    public function definition()
    {
        // $this->faker->addProvider(new FakerBR\Person($this->faker));
        // $this->faker->addProvider(new FakerBR\Address($this->faker));
        // $this->faker->addProvider(new FakerBR\Company($this->faker));
        // $this->faker->addProvider(new FakerBR\PhoneNumber($this->faker));

        $this->faker = \Faker\Factory::create('pt_BR');
        
        return [
            'nome' => $this->faker->name(),
            'telefone' => $this->faker->phoneNumber(),
            'cpf' => preg_replace('/[^0-9]/', '', $this->faker->cpf),
        ];

        // return [
        //     'nome' => $this->faker->name,
        //     'dia' => $this->faker->dateTimeThisYear(),
        //     'cnpj_empresa' => preg_replace('/[^0-9]/', '', $this->faker->cnpj),
        // ];
    }
}
