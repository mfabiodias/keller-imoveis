<?php

namespace Database\Factories;

use App\Models\Imovel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImovelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Imovel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $posicao    = ['norte/leste', 'norte/oeste', 'sul/leste', 'sul/oeste'];
        $chaves     = ['imobiliaria','portaria','proprietario','inquilino','construtora','posse'];
        $status     = ['ativo', 'inativo'];
        $tipo_id    = rand(1,5);
        $subtipo_id = [
            1 => rand(1,8),
            2 => rand(9,16),
            3 => rand(17,23),
            4 => rand(24,29),
            5 => rand(30,35)
        ];

        return [
            'cliente_id'    => rand(1,20),
            'tipo_id'       => $tipo_id,
            'subtipo_id'    => $subtipo_id[$tipo_id],
            'nome'          => $this->faker->name,
            'quarto'        => rand(0,8),
            'suite'         => rand(0,8),
            'banheiro'      => rand(0,10),
            'vagas'         => rand(0,10),
            'andar'         => rand(0,30),
            'valor_venda'   => $this->faker->randomFloat(2, 80000, 2000000),
            'valor_aluguel' => $this->faker->randomFloat(2, 800, 5000),
            'condominio'    => $this->faker->randomFloat(2, 800, 2000),
            'iptu'          => $this->faker->randomFloat(2, 1000, 100000),
            'area_total'    => $this->faker->randomFloat(2, 80000, 2000000),
            'area_util'     => $this->faker->randomFloat(2, 80000, 2000000),
            'posicao'       => $posicao[rand(0,(count($posicao)-1))],
            'chaves'        => $chaves[rand(0,(count($chaves)-1))],
            'status'        => $status[rand(0,(count($status)-1))],
        ];
    }
}
