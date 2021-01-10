<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'Keller Yorinori Souza',
            'email' => 'kellerys@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$O38jFdPcnGMNAlSkyVogI.yvl0z6IEoCnMvbownj/7hR7rdzNDbq.',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}