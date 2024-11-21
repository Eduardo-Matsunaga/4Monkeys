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
        Schema::create('conjunto_software', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conjunto_id')->constrained('conjunto')->onDelete('cascade');
            $table->foreignId('software_id')->constrained('softwares')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conjunto_software');
    }
};
