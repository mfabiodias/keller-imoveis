<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class SubTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subtipo')->insert([
            ['tipo_id' => 1, 'nome' => 'Padrão', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 1, 'nome' => 'Duplex', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 1, 'nome' => 'Triplex', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 1, 'nome' => 'Kitinete', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 1, 'nome' => 'Cobertura', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 1, 'nome' => 'Loft', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 1, 'nome' => 'Sobreloja', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 1, 'nome' => 'Flat', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 2, 'nome' => 'Térrea', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 2, 'nome' => 'Em Condomínio', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 2, 'nome' => 'Em Vila Fechada', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 2, 'nome' => 'Sobrado Padão', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 2, 'nome' => 'Sobrado em Condomínio', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 2, 'nome' => 'Sobrado em Vila Fechada', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 2, 'nome' => 'Assobradada', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 2, 'nome' => 'Geminida', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 3, 'nome' => 'Casa', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 3, 'nome' => 'Loja', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 3, 'nome' => 'Loja em Shopping', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 3, 'nome' => 'Galpão / Barracão', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 3, 'nome' => 'Prédio Inteiro', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 3, 'nome' => 'Salão Comercial', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 3, 'nome' => 'Negócio', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 4, 'nome' => 'Chácara', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 4, 'nome' => 'Chácara em Condomínio', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 4, 'nome' => 'Fazenda', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 4, 'nome' => 'Sítio', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 4, 'nome' => 'Haras', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 4, 'nome' => 'Comercial', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 5, 'nome' => 'Em Rua', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 5, 'nome' => 'Em Condomínio', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 5, 'nome' => 'Em Loteamento', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 5, 'nome' => 'Comercial', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 5, 'nome' => 'Área Industrial', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_id' => 5, 'nome' => 'Para Empreendimento', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
