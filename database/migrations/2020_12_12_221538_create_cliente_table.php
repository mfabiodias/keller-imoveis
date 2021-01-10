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
            $table->string('tel_residencial', 30)->nullable();
            $table->string('tel_comercial', 30)->nullable();
            $table->string('cel', 30)->nullable();
            $table->enum('cel_operadora', [ "Claro", "CTBC", "OI", "Sercomtel", "Tim", "Vivo", "Nextel" ])->nullable();
            $table->string('nextel_id', 20)->nullable();
            $table->string('nacionalidade', 20)->nullable();
            $table->string('ocupacao', 20)->nullable();
            $table->string('doc_tipo', 50)->nullable();
            $table->string('doc_numero', 30)->nullable();
            $table->enum('perfil', [ "Proprietário", "Cliente Interessado" ]);
            $table->enum('fase', [ "Novo", "Em Atendimento" , "Com Proposta" , "Ganhou" , "Perdeu" , "Inativo" ]);
            $table->enum('tipo', [ "Pessoa Física", "Pessoa Jurídica" ]);
            $table->enum('investidor', [ "Sim" , "Não" ]);
            $table->enum('origem', [ "Email" , "Jornal", "Pessoal", "Placa", "Revista", "Site", "Telefone", "Outros" ]);
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
