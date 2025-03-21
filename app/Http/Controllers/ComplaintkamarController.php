<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaintkamar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
class ComplaintkamarController extends Controller
{
    //-----menampilkan data
    public function myriquescomplaints()
    {
        
        $apiToken = session('api_token');
        if (!$apiToken) {
            return redirect()->back()->with('error', 'Token tidak ditemukan. Silakan login ulang.');
        }
        Http::macro('apiClient', function ($apiToken) {
            return Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
            ]);
        });

        $response1 = Http::apiClient($apiToken)->get(config('services.api_base_url') . '/myriquescomplaints' );

        if ($response1->successful()) {
            $data1 = $response1->json();
            return view('dashboard.main.kelolabooking',[
                'hasilreq1' => $data1,
            ]);
        } 
        $error1 = !$response1->successful() ? $response1->json()['message'] ?? 'API 1 gagal' : null;
        return view('dashboard.main.keluhan_pengaduan', [
            'hasilreq1' => [],
        ])->with('error', "Gagal memuat data: $error1");

    }

    //-----tambah data
    public function createcomplaints(Request $request)
{
    $request->validate([
        'keluhan' => 'required|string',
        'keterangan' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    try {
        $user = Auth::user();
        // Cari keluhan sebelumnya berdasarkan username dan room_number
        $complaint = ComplaintKamar::where('username', $user->username)
            ->where('room_number', $user->room_number)
            ->first();

        // Jika ada gambar lama, hapus gambar tersebut
        if ($complaint && $complaint->image) {
            Storage::delete($complaint->image);
        }

        // Proses penyimpanan keluhan
        $newComplaint = ComplaintKamar::create([
            'username' => $user->username,
            'room_number' => $user->room_number,
            'keluhan' => $request->keluhan,
            'keterangan' => $request->keterangan,
            'image' => $request->hasFile('image') ? $request->file('image')->store('complaints') : null,
            'status' => 'Pending',
        ]);

        return response()->json(['message' => 'Complaint created successfully!', 'data' => $newComplaint], 201);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to create complaint', 'error' => $e->getMessage()], 500);
    }
}

//-----sedang proses
public function inprograsecomplaints($id, Request $request)
    {
        try {
            $Complaintkamar = Complaintkamar::findOrFail($id);
            if (Auth::user()->role !== 'admin') {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            $Complaintkamar->status = 'Sedang diproses';
            $Complaintkamar->save();
            return response()->json($Complaintkamar, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Meeting request not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    

    //-----selesai
    public function donecomplaints($id)
    {
        try {
            $Complaintkamar = Complaintkamar::findOrFail($id);
    
            if (Auth::user()->role !== 'admin') {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            $Complaintkamar->status = 'Selesai';
            $Complaintkamar->save();
            return response()->json($Complaintkamar, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Meeting request not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    //-----batal
    public function batalBooking($id, Request $request)
{
    try {
        $booking = Complaintkamar::findOrFail($id);
        $booking->status = 'dibatalkan'; 
        $booking->save();
        
        return response()->json([
            'message' => 'Booking berhasil dibatalkan.',
            'booking' => $booking,
        ], 200);
        
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['message' => 'Booking tidak ditemukan'], 404);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    }
}

}