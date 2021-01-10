<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ImovelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Imovel::factory(30)->create();
    }
}
