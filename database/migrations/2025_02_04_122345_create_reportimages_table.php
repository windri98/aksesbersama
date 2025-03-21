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
        Schema::create('reportimages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_report')->nullable(); // Pastikan tipe data sesuai
            $table->foreign('id_report')->references('id')->on('reports')->onDelete('cascade');
            $table->string('username');
            $table->string('room_number');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportimages');
    }
};
