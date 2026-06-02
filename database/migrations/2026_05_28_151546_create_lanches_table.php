<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lanches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->string('nome', 150);
            $table->string('slug', 180)->unique();
            $table->text('descricao');
            $table->string('imagem')->nullable();
            $table->decimal('preco', 10, 2);
            $table->integer('estoque')->default(0);
            $table->boolean('destaque')->default(false);
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->softDeletes(); // adiciona deleted_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('lanches');
    }
};