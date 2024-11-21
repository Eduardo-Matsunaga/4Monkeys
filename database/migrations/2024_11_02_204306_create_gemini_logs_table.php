<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gemini_logs', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');  // Descrição da operação ou erro
            $table->string('operacao');   // Tipo de operação (ex: 'getRecommendations')
            $table->string('status');     // Status da operação (ex: 'sucesso' ou 'erro')
            $table->unsignedBigInteger('user_id')->nullable();  // ID do usuário, se aplicável
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gemini_logs');
    }
};
