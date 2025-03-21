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
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->string('kategori')->unique();
            $table->timestamps();
        });
        
        // Cek apakah tabel fasilitas ada dan memiliki data
        if (Schema::hasTable('fasilitas')) {
            $dataCount = DB::table('fasilitas')->count();
            if ($dataCount > 0) {
                DB::statement('
                    INSERT INTO kategoris (kategori, icon, created_at, updated_at)
                    SELECT DISTINCT kategori, icon, NOW(), NOW() 
                    FROM fasilitas
                    WHERE kategori IS NOT NULL
                ');
            }
        }
    }

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};
