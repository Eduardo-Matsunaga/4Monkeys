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
        Schema::create('requisitos_software', function (Blueprint $table) {
            $table->id();
            $table->foreignId('software_id')->constrained('softwares')->onDelete('cascade');
            $table->enum('requisito_nivel', ['Minimo', 'Medio', 'Recomendado']); // Nível dos requisitos
            $table->string('cpu');
            $table->string('gpu');
            $table->string('ram');
            $table->string('placa_mae')->nullable();
            $table->string('ssd')->nullable();
            $table->string('cooler');
            $table->string('fonte');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitos_software');
    }
};
