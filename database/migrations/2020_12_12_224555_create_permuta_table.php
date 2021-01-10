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
            $table->foreignId('cliente_id')->constrained('cliente');
            $table->foreignId('tipo_id')->constrained('tipo');
            $table->foreignId('subtipo_id')->nullable()->constrained('subtipo');
            $table->foreignId('range_id')->constrained('range');
            $table->enum('status', [ "Ativo" , "Inativo" ]);
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
