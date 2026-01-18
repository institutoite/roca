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
        Schema::table('cartas', function (Blueprint $table) {
            // Iglesia destino (si se elige de la BD)
            $table->unsignedBigInteger('iglesia_destino_id')->nullable()->after('iglesia_origen_id');
            $table->foreign('iglesia_destino_id')->references('id')->on('iglesias');

            // Motivo desde catálogo (si se elige de la BD)
            $table->unsignedBigInteger('carta_motivo_id')->nullable()->after('motivo');
            $table->foreign('carta_motivo_id')->references('id')->on('carta_motivos');

            // Alternativa manual para motivo / destinatarios
            $table->string('motivo_texto', 120)->nullable()->after('carta_motivo_id');

            $table->string('destinatario_principal_texto', 120)->nullable()->after('destinatario_principal_id');
            $table->text('destinatarios_texto')->nullable()->after('destinatario_principal_texto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cartas', function (Blueprint $table) {
            $table->dropForeign(['iglesia_destino_id']);
            $table->dropColumn('iglesia_destino_id');

            $table->dropForeign(['carta_motivo_id']);
            $table->dropColumn('carta_motivo_id');

            $table->dropColumn('motivo_texto');
            $table->dropColumn('destinatario_principal_texto');
            $table->dropColumn('destinatarios_texto');
        });
    }
};
