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
        Schema::create('iglesias', function (Blueprint $table) {
            $table->id();
            $table->string("nombre",50);
            $table->string("Direccion",120);
            $table->string("coordenadax",20)->nullable();
            $table->string("coordenaday",20)->nullable();

            $table->bigInteger('pais_id')->unsigned();
            $table->bigInteger('departamento_id')->unsigned();
            $table->bigInteger('provincia_id')->unsigned();
            $table->bigInteger('municipio_id')->unsigned();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iglesias');
    }
};
