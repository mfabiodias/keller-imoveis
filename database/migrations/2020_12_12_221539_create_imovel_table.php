<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImovelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imovel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('cliente');
            $table->foreignId('tipo_id')->constrained('tipo');
            $table->foreignId('subtipo_id')->constrained('subtipo');
            $table->string('nome', 100);
            $table->tinyInteger('quarto')->default(0);
            $table->tinyInteger('suite')->default(0);
            $table->tinyInteger('banheiro')->default(0);
            $table->tinyInteger('vagas')->default(0);
            $table->tinyInteger('andar')->default(0);
            $table->double('valor_venda', 15, 2)->nullable();
            $table->double('valor_aluguel', 15, 2)->nullable();
            $table->double('condominio', 12, 2)->nullable();
            $table->double('iptu', 12, 2)->nullable();
            $table->double('area_total', 12, 2)->nullable();
            $table->double('area_util', 12, 2)->nullable();
            $table->enum('posicao', [ "norte/leste","norte/oeste","sul/leste","sul/oeste" ])->nullable();
            $table->enum('chaves', [ "imobiliaria","portaria","proprietario","inquilino","construtora","posse" ])->nullable();
            $table->enum('status', [ "ativo" , "inativo" ]);
            $table->string('caracteristica', 100)->nullable();
            $table->longText('observacao')->nullable();
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
        Schema::dropIfExists('imovel');
    }
}
