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
        Schema::create('himnos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('numero')->nullable();
            $table->string('numero_text', 10)->nullable();
            $table->string('titulo');
            $table->char('letra', 1)->nullable();
            $table->longText('estrofas_html')->nullable();
            $table->longText('estrofas_texto')->nullable();
            $table->json('estrofas')->nullable();
            $table->json('coro')->nullable();
            $table->string('url')->nullable();
            $table->json('informacion')->nullable();
            $table->json('datos')->nullable();
            $table->timestamps();

            $table->index('numero');
            $table->index('letra');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('himnos');
    }
};
