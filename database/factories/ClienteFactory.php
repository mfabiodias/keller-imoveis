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
        $operadora     = ["Claro","CTBC","OI","Sercomtel","Tim","Vivo","Nextel"];
        $nacionalidade = ["Brasileira", "Estrangeira"];
        $doc_tipo      = ["RG", "CPF", "CNPJ", "RNE", "CNH", "Passaporte", "Carteira de Trabalho", "Título Eleitor", "Certidão Nascimento"]; 
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
            'doc_tipo'        => $doc_tipo[rand(0,(count($doc_tipo)-1))],
            'doc_numero'      => rand(11111111111,99999999999),
            'perfil'          => $perfil[rand(0,(count($perfil)-1))],
            'fase'            => $fase[rand(0,(count($fase)-1))],
            'tipo'            => $tipo[rand(0,(count($tipo)-1))],
            'investidor'      => $investidor[rand(0,(count($investidor)-1))],
            'origem'          => $origem[rand(0,(count($origem)-1))],
        ];
    }
}
