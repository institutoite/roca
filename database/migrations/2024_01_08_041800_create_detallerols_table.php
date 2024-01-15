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
        Schema::create('detallerols', function (Blueprint $table) {
            $table->id();
            $table->date("fecha");

            $table->unsignedBigInteger("preside_id");
            $table->foreign("preside_id")->references("id")->on("hermanos");
            
            $table->unsignedBigInteger("ministra_id");
            $table->foreign("ministra_id")->references("id")->on("hermanos");

            $table->unsignedBigInteger("rol_id");
            $table->foreign("rol_id")->references("id")->on("rols");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallerols');
    }
};
