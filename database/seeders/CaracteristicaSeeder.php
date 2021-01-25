<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaracteristicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('caracteristica')->insert([
            // Infra-estrutura
            ['nome' => 'Alarme', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Aquecimento a gás', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Aquecimento a eletrico', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Aquecimento a solar', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Ar condicionado', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Canil', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Cerca Elétrica', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Cercado', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Copa', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Cocho', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Curral', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Depósito', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Depósito privativo', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Despensa', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Energia Elétrica', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Escritório', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Esgoto', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Estrada asfaltada', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Gerador', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Home Office', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Lavabo', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Mezanino', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Mobiliado', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Muro Arrimo', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Paiol', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Piscina', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Poço artesiano', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Rua Asfaltada', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Reservatório de água', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Sala de 2 ambientes', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Sala de estar', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Sala de jantar', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Sala de TV', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Sala de visitas', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Semi-mobiliado', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Tela de proteção em janelas', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'WC Empregadas', 'tipo' => 'Infra-estrutura', 'created_at' => now(), 'updated_at' => now()],
            // Lazer
            ['nome' => 'Adega', 'tipo' => 'Lazer', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Churrasqueira gourmet', 'tipo' => 'Lazer', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Churrasqueira privativa', 'tipo' => 'Lazer', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Forno de pizza privativo', 'tipo' => 'Lazer', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Hidromassagem', 'tipo' => 'Lazer', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Jardim de inverno', 'tipo' => 'Lazer', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Lareira', 'tipo' => 'Lazer', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Piscina privativa', 'tipo' => 'Lazer', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Sacada', 'tipo' => 'Lazer', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Sauna privativa', 'tipo' => 'Lazer', 'created_at' => now(), 'updated_at' => now()],
            // Segurança
            ['nome' => 'Alarme individual', 'tipo' => 'Segurança', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Cameras de segurança', 'tipo' => 'Segurança', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Casa de caseiro', 'tipo' => 'Segurança', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Cerca eletrica', 'tipo' => 'Segurança', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Cercado', 'tipo' => 'Segurança', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Guarita de segurança', 'tipo' => 'Segurança', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Sistema contra incêndio', 'tipo' => 'Segurança', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Sistema de alarme', 'tipo' => 'Segurança', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Vigilancia 24hs', 'tipo' => 'Segurança', 'created_at' => now(), 'updated_at' => now()],
            // Piso
            ['nome' => 'Cerâmico', 'tipo' => 'Piso', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Cimentado', 'tipo' => 'Piso', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Nármore', 'tipo' => 'Piso', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Piso de madeira', 'tipo' => 'Piso', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Piso frio', 'tipo' => 'Piso', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Piso laminado', 'tipo' => 'Piso', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Piso Vinílico', 'tipo' => 'Piso', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Porcelanato', 'tipo' => 'Piso', 'created_at' => now(), 'updated_at' => now()],
            // Armários
            ['nome' => 'Armários no banheiro', 'tipo' => 'Armários', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Armários na área de serviço', 'tipo' => 'Armários', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Armários na cozinha', 'tipo' => 'Armários', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Armários na cozinha', 'tipo' => 'Armários', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Armários nos dormitórios', 'tipo' => 'Armários', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Closet', 'tipo' => 'Armários', 'created_at' => now(), 'updated_at' => now()],
            // Natureza
            ['nome' => 'Lago', 'tipo' => 'Natureza', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Mina d agua', 'tipo' => 'Natureza', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Pasto', 'tipo' => 'Natureza', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Pomar', 'tipo' => 'Natureza', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Rio', 'tipo' => 'Natureza', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
