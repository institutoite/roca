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
        Schema::create('cartas', function (Blueprint $table) {
            $table->id();

            $table->enum('tipo', ['multiple', 'hermano', 'hermana'])->index();

            // Datos variables de la carta
            $table->date('fecha');
            $table->string('lugar', 120);

            // Iglesia que emite la carta (normalmente la local)
            $table->unsignedBigInteger('iglesia_origen_id')->default(1);
            $table->foreign('iglesia_origen_id')->references('id')->on('iglesias');

            // Texto libre para el destino (ej: "Barrio X", "Iglesia en ...")
            $table->string('destino_texto', 200)->nullable();

            // Para cartas a un solo hermano/hermana (se usa el mismo modelo Hermano)
            $table->unsignedBigInteger('destinatario_principal_id')->nullable();
            $table->foreign('destinatario_principal_id')->references('id')->on('hermanos');

            // Motivo que se inyecta en la plantilla
            $table->text('motivo')->nullable();

            // Plantilla usada al momento de generar (para congelar la selección)
            $table->unsignedBigInteger('carta_plantilla_id')->nullable();
            $table->foreign('carta_plantilla_id')->references('id')->on('carta_plantillas');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartas');
    }
};
