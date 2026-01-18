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
        Schema::create('carta_plantillas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 120);
            $table->enum('tipo', ['multiple', 'hermano', 'hermana'])->index();
            
            // Cada párrafo puede contener placeholders (ej: {{lugar}}, {{fecha}}, {{lista_hermanos}}, {{motivo}})
            $table->text('parrafo1')->nullable();
            $table->text('parrafo2')->nullable();
            $table->text('parrafo3')->nullable();
            $table->text('parrafo4')->nullable();
            $table->text('parrafo5')->nullable();
            $table->text('parrafo6')->nullable();
            $table->text('parrafo7')->nullable();
            $table->text('parrafo8')->nullable();
            $table->text('parrafo9')->nullable();
            $table->text('parrafo10')->nullable();
            $table->text('parrafo11')->nullable();
            $table->text('parrafo12')->nullable();

            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carta_plantillas');
    }
};
