<?php

namespace Database\Factories;

use App\Models\Endereco;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnderecoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Endereco::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $estado = ["SP", "BA", "PR", "PE", "MG"];

        return [
            'cliente_id'  => rand(1,100),
            'cep'         => rand(11111111,99999999),
            'rua'         => $this->faker->address,
            'numero'      => rand(230,9999),
            'complemento' => "",
            'bairro'      => $this->faker->name,
            'cidade'      => $this->faker->city,
            'estado'      => $estado[rand(0,4)]
        ];
    }
}
