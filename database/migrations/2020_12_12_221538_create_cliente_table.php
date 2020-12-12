<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('email', 255)->unique();
            $table->string('tel_residencial', 11);
            $table->string('tel_comercial', 11);
            $table->string('cel', 100);
            $table->enum('cel_operadora', [ "Claro","CTBC","OI","Sercomtel","Tim","Vivo","Nextel" ]);
            $table->string('nextel_id', 20);
            $table->string('nacionalidade', 20);
            $table->string('ocupacao', 20);
            $table->string('doc_tipo', 50);
            $table->string('doc_numero', 20);
            $table->string('nome_pai', 100);
            $table->string('nome_mae', 100);
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
        Schema::dropIfExists('cliente');
    }
}
