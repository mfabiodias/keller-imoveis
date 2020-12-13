<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermutaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permuta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('imovel_id')->constrained('imovel');
            $table->foreignId('subtipo_id')->constrained('subtipo');
            $table->json('caracteristica')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permuta');
    }
}
