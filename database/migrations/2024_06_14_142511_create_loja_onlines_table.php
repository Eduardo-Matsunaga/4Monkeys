<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    { if(config('database.default') == 'sqlite'){
        DB::statement('
            CREATE TABLE loja_online(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                urlLoja VARCHAR(255),
                valor REAL,
                moeda VARCHAR(20),
                created_at TIMESTAMP,
                updated_at TIMESTAMP
            )
        ');

    } else{
        Schema::create('loja_online', function (Blueprint $table) {
            $table->id();
            $table->string('urlLoja');
            $table->float('valor');
            $table->string('moeda', 20);
            $table->timestamps();
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loja_online');
    }
};
