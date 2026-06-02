<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('email', 150)->unique();
            $table->string('telefone', 20)->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'cliente'])->default('cliente');
            $table->string('foto')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
            // Se quiser soft delete em users, descomente a linha abaixo:
            // $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};