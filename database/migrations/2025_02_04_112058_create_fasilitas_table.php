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
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->bigIncrements('id_fasilitas');
            $table->string('id_kategori');
            $table->string('unit_nomor');
            $table->string('fasilitas');
            $table->string('icon')->nullable();
            $table->string('foto')->nullable();
            $table->integer('kapasitas')->nullable();
            $table->integer('maxjam');
            $table->string('kategori')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
