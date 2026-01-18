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
        Schema::table('hermanos', function (Blueprint $table) {
            $table->string('genero', 1)
                ->default('M')
                ->comment('M=Masculino, F=Femenino')
                ->after('apellidos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hermanos', function (Blueprint $table) {
            $table->dropColumn('genero');
        });
    }
};
