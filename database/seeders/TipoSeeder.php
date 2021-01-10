<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo')->insert([
            ['id' => 1, 'nome' => 'Apartamento', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nome' => 'Casa', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nome' => 'Comercial', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nome' => 'Rural', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nome' => 'Terreno', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
