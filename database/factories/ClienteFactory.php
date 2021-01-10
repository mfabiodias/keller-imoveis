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
        $doc_type      = ["RG", "CPF", "CNPJ"];
        $ocupacao      = ["Empresario", "CLT", "MEI", "Desempregado", "Investidor"];
        $operadora     = ["Claro","CTBC","OI","Sercomtel","Tim","Vivo","Nextel"];
        $nacionalidade = ["Brasileira", "Japonesa", "Americana"];
        $perfil        = ["Proprietário", "Cliente Interessado"];
        $fase          = ["Novo", "Em Atendimento" , "Com Proposta" , "Ganhou" , "Perdeu" , "Inativo"];
        $tipo          = ["Pessoa Física", "Pessoa Jurídica"];
        $investidor    = ["Sim", "Não"];
        $origem        = ["Email" , "Jornal", "Pessoal", "Placa", "Revista", "Site", "Telefone", "Outros"];

        return [
            'nome'            => $this->faker->name,
            'email'           => $this->faker->unique()->safeEmail,
            'tel_residencial' => $this->faker->phoneNumber,
            'tel_comercial'   => $this->faker->phoneNumber,
            'cel'             => $this->faker->phoneNumber,
            'cel_operadora'   => $operadora[rand(0,(count($operadora)-1))],
            'nextel_id'       => rand(11111111111,99999999999),
            'nacionalidade'   => $nacionalidade[rand(0,(count($nacionalidade)-1))],
            'ocupacao'        => $ocupacao[rand(0,(count($ocupacao)-1))],
            'doc_tipo'        => $doc_type[rand(0,(count($doc_type)-1))],
            'doc_numero'      => rand(11111111111,99999999999),
            'perfil'          => $perfil[rand(0,(count($perfil)-1))],
            'fase'            => $fase[rand(0,(count($fase)-1))],
            'tipo'            => $tipo[rand(0,(count($tipo)-1))],
            'investidor'      => $investidor[rand(0,(count($investidor)-1))],
            'origem'          => $origem[rand(0,(count($origem)-1))],
        ];
    }
}
