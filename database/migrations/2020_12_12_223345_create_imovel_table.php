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
            $table->foreignId('subtipo_id')->constrained('subtipo');
            $table->foreignId('cliente_id')->constrained('cliente');
            $table->string('nome', 100);
            $table->string('complemento', 100);
            $table->tinyInteger('quarto');
            $table->tinyInteger('suite');
            $table->tinyInteger('banheiro');
            $table->tinyInteger('vagas');
            $table->tinyInteger('andar');
            $table->double('valor_venda', 15, 2);
            $table->double('valor_aluguel', 15, 2);
            $table->double('condominio', 12, 2);
            $table->double('iptu', 12, 2);
            $table->double('area_total', 12, 2);
            $table->double('area_util', 12, 2);
            $table->enum('posicao', [ "norte/leste","norte/oeste","sul/leste","sul/oeste" ]);
            $table->longText('informacao');
            $table->json('caracteristica');
            $table->tinyInteger('investidor')->default(0);
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
