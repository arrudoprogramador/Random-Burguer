<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
{
    Schema::create('carts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('lanche_models_id')->constrained()->onDelete('cascade');
        $table->integer('quantidade');
        $table->timestamps();
    });
}


    
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
