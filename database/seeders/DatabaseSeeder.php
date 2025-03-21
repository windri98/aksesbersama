<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\fasilitas;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id_card' => '00000',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'room_number' => '00000',
            'role' => 'admin',
        ]);  
        User::create([
            'id_card' => '12345',
            'username' => 'csman',
            'password' => Hash::make('12345678'),
            'room_number' => '12345',
            'role' => 'user',
        ]);  
        Kategori::create([
            'icon' => 'metting.png',
            'kategori' => 'Ruang Meeting',
        ]);
        Kategori::create([
            'icon' => 'metting.png',
            'kategori' => 'Hiburan',
        ]);
        Fasilitas::create([
            'id_kategori' => '1',
            'unit_nomor' => '001',
            'fasilitas' => 'Ruang Meeting',
            'icon' => 'metting.jpg',
            'foto' => 'metting.jpg',
            'kapasitas' => '12',
            'maxjam' => '2',
            'kategori' => 'Ruang Meeting',
        ]);
        Fasilitas::create([
            'id_kategori' => '2',
            'unit_nomor' => '001',
            'fasilitas' => 'Playstation',
            'icon' => 'metting.jpg',
            'foto' => 'metting.jpg',
            'kapasitas' => '12',
            'maxjam' => '5',
            'kategori' => 'Hiburan',
        ]);
    }
}
