<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pendente', 'preparando', 'entregando', 'concluido', 'cancelado'])->default('pendente');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('taxa_entrega', 10, 2)->default(0);
            $table->decimal('desconto', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
};