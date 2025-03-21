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
        Schema::create('bookingpendings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_booking');
            $table->string('id_fasilitas');
            $table->string('username');
            $table->date('date');
            $table->text('requested_start');
            $table->text('requested_end')->nullable();
            $table->date('original_date');
            $table->text('original_start');
            $table->text('original_end')->nullable();
            $table->enum('status', ['pending', 'berhasil', 'ditolak'])->default('pending');
            $table->text('alasan')->nullable();
            $table->timestamps();
        
            // Foreign key constraint
            // $table->foreign('id_booking')
            // ->references('id_booking')
            // ->on('bookingfasilitas')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookingpendings');
    }
};
