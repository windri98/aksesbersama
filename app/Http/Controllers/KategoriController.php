<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    
        public function lihatkategori()
    {
        $kategori = Kategori::all();
        return response()->json($kategori);
    }

    public function tambahkategori(Request $request)
    {

        try {
            // Validasi data yang diterima
            $request->validate([
                'icon' => 'required|string|max:255',
                'kategori' => 'required|string|max:255',
            ]);
            // Menambahkan data ke tabel kategori
            Kategori::create([
                'icon' => $request->icon,
                'kategori' => $request->kategori,
            ]);
    
            // Mengembalikan respon
            return response()->json(['message' => 'Kategori berhasil ditambahkan'], 201);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menambahkan kategori.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updatekategori(Request $request, $id)
{
    try {
        // Validasi data yang diterima
        $request->validate([
            'icon' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:255',
        ]);

        // Mencari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Mengupdate data kategori
        $kategori->update([
            'icon' => $request->icon ?? $kategori->icon,
            'kategori' => $request->kategori ?? $kategori->kategori,
        ]);

        // Mengembalikan respon
        return response()->json(['message' => 'Kategori berhasil diperbarui'], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Validasi gagal.',
            'errors' => $e->errors()
        ], 422);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'message' => 'Kategori tidak ditemukan.'
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan saat memperbarui kategori.',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function deletekategori($id)
{
    try {
        // Mencari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Menghapus data kategori
        $kategori->delete();

        // Mengembalikan respon
        return response()->json(['message' => 'Kategori berhasil dihapus'], 200);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'message' => 'Kategori tidak ditemukan.'
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan saat menghapus kategori.',
            'error' => $e->getMessage()
        ], 500);
    }
}


}
