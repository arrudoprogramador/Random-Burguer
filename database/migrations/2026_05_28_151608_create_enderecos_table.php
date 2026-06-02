<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('cep', 10)->nullable();
            $table->string('rua', 150)->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('cidade', 100)->nullable();
            $table->string('estado', 2)->nullable();
            $table->string('complemento', 150)->nullable();
            $table->boolean('principal')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
};