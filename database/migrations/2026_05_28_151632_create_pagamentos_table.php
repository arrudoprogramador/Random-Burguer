<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
            $table->enum('metodo', ['pix', 'credito', 'debito', 'dinheiro']);
            $table->enum('status', ['pendente', 'pago', 'falhou', 'reembolsado'])->default('pendente');
            $table->string('transaction_id')->nullable();
            $table->decimal('valor', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
};