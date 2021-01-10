<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RangeSeeder::class,
            TipoSeeder::class,
            SubTipoSeeder::class,
            
            # Temporário para testes
            ClienteSeeder::class,
            ImovelSeeder::class,
            EnderecoSeeder::class,
        ]);
    }
}
