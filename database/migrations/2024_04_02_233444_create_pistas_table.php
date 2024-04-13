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
        Schema::create('pistas', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 100)->default("Sin titulo");
            $table->string('audio', 100)->default("sinpista.mp3");
            $table->string('foto', 100)->default("sinfoto.png");
            $table->dateTime('fureproduccion')->nullable();
            $table->integer('click')->unsigned()->default(1);
            $table->boolean('estado')->default(1);

            $table->unsignedBigInteger("hermano_id");
            $table->foreign("hermano_id")->references("id")->on("hermanos");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pistas');
    }
};
