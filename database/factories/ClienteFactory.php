<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $doc_type      = ["RG", "CPF"];
        $ocupacao      = ["Empresario", "CLT", "MEI", "Desempregado", "Investidor"];
        $operadora     = ["Claro","CTBC","OI","Sercomtel","Tim","Vivo","Nextel"];
        $nacionalidade = ["Brasileira", "Japonesa", "Americana"];

        return [
            'nome'            => $this->faker->name,
            'email'           => $this->faker->unique()->safeEmail,
            'tel_residencial' => $this->faker->phoneNumber,
            'tel_comercial'   => $this->faker->phoneNumber,
            'cel'             => $this->faker->phoneNumber,
            'nome_pai'        => $this->faker->name,
            'nome_mae'        => $this->faker->name,
            'investidor'      => rand(0,1),
            'nacionalidade'   => $nacionalidade[rand(0,2)],
            'ocupacao'        => $ocupacao[rand(0,4)],
            'doc_tipo'        => $doc_type[rand(0,1)],
            'doc_numero'      => rand(11111111111,99999999999),
            'cel_operadora'   => $operadora[rand(0,6)],
            'nextel_id'       => "",
        ];
    }
}
