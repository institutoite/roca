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
        Schema::create('carta_hermano', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carta_id');
            $table->unsignedBigInteger('hermano_id');

            $table->foreign('carta_id')->references('id')->on('cartas')->onDelete('cascade');
            $table->foreign('hermano_id')->references('id')->on('hermanos');

            $table->unique(['carta_id', 'hermano_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carta_hermano');
    }
};
