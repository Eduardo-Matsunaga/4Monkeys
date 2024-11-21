<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (config('database.default') === 'sqlite') {
            DB::statement('
                CREATE TABLE conjunto (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nome VARCHAR(255),
                    categoria_id integer,
                    user_id integer,
                    created_at TIMESTAMP,
                    updated_at TIMESTAMP
                )
            ');
        } else {
            Schema::create('conjunto', function (Blueprint $table) {
                $table->id();
                $table->string('nome');
                $table->string('categoria_id');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conjunto');
    }
};
