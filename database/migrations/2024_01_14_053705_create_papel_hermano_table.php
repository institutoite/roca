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
        Schema::create('hermano_papel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('papel_id');
            $table->unsignedBigInteger('hermano_id');
            $table->foreign('papel_id')->references('id')->on('papels');
            $table->foreign('hermano_id')->references('id')->on('hermanos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('papel_hermano');
    }
};
