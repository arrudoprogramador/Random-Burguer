<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lanche_models', function (Blueprint $table) {
            $table->id();
            $table->string('nomeLanche');
            $table->string('descLanche');
            $table->string('fotoLanche')->nullable();
            $table->decimal('valorLanche', 8, 2);
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
        Schema::dropIfExists('lanches');
    }
};
