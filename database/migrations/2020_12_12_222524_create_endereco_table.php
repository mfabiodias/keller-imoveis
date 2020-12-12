<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('cliente');
            $table->timestamps();
            $table->string('rua', 100);
            $table->string('numero', 10);
            $table->string('complemento', 100);
            $table->string('bairro', 100);
            $table->string('cidade', 50);
            $table->string('estado', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endereco');
    }
}
