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
        Schema::create('bookingfasilitas', function (Blueprint $table) {
            $table->bigIncrements('id_booking');
            $table->string('id_fasilitas');
            $table->string('username');
            $table->date('date');
            $table->text('start_time'); 
            $table->text('end_time')->nullable();
            $table->enum('status', ['pending', 'berhasil', 'ditolak', 'selesai'])->default('berhasil');
            $table->text('alasan')->nullable();
            $table->timestamps();
            // Menambahkan foreign key ke tabel users
            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookingfasilitas');
    }
};
