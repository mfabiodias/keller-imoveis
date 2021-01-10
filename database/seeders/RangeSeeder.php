<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('range')->insert([
            ['nome' => "Até R$ 100.000,00", 'min'  => 0, 'max'  => 100000.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => "De R$ 100.000,01 a R$ 200.000,00",'min'  => 100000.01,'max'  => 200000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 200.000,01 a R$ 300.000,00",'min'  => 200000.01,'max'  => 300000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 300.000,01 a R$ 400.000,00",'min'  => 300000.01,'max'  => 400000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 400.000,01 a R$ 500.000,00",'min'  => 400000.01,'max'  => 500000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 500.000,01 a R$ 600.000,00",'min'  => 500000.01,'max'  => 600000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 600.000,01 a R$ 700.000,00",'min'  => 600000.01,'max'  => 700000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 700.000,01 a R$ 800.000,00",'min'  => 700000.01,'max'  => 800000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 800.000,01 a R$ 900.000,00",'min'  => 800000.01,'max'  => 900000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 900.000,01 a R$ 1000.000,00",'min'  => 900000.01,'max'  => 1000000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 1000.000,01 a R$ 1100.000,00",'min'  => 1000000.01,'max'  => 1100000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 1100.000,01 a R$ 1200.000,00",'min'  => 1100000.01,'max'  => 1200000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 1200.000,01 a R$ 1300.000,00",'min'  => 1200000.01,'max'  => 1300000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 1300.000,01 a R$ 1400.000,00",'min'  => 1300000.01,'max'  => 1400000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 1400.000,01 a R$ 1500.000,00",'min'  => 1400000.01,'max'  => 1500000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 1500.000,01 a R$ 1600.000,00",'min'  => 1500000.01,'max'  => 1600000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 1600.000,01 a R$ 1700.000,00",'min'  => 1600000.01,'max'  => 1700000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 1700.000,01 a R$ 1800.000,00",'min'  => 1700000.01,'max'  => 1800000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 1800.000,01 a R$ 1900.000,00",'min'  => 1800000.01,'max'  => 1900000.00,'created_at' => now(),'updated_at' => now()],
            ['nome' => "De R$ 1900.000,01 a R$ 2000.000,00",'min'  => 1900000.01,'max'  => 2000000.00,'created_at' => now(),'updated_at' => now()],
        ]);
    }
}
