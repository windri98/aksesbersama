<?php

namespace App\Http\Controllers;

use App\Models\bookingpending;
use App\Models\bookingfasilitas;
use Illuminate\Http\Request;
use Carbon\Carbon;


class BookingpendingController extends Controller
{

            //melihat semua data pending
            public function index()
            {
                $bookingpendings = bookingpending::all();

                return response()->json([
                    'message' => 'Data booking pending berhasil diambil.',
                    'data' => $bookingpendings,
                ]);
            }
            public function store(Request $request)
        {
            // Validasi input dari pengguna
            $validatedData = $request->validate([
                'id_booking' => 'required|exists:bookingfasilitas,id_booking',
                'date' => 'required|date',
                'requested_start' => 'required|date_format:H:i',
                'alasan' => 'nullable|string|max:255',
            ]);
            $requestedStart = Carbon::createFromFormat('H:i', $validatedData['requested_start']);
            $endTime = $requestedStart->addHour()->format('H:i');
            
            // Cari booking di tabel bookingfasilitas
            $bookingpending = bookingpending::findOrFail($validatedData['id_booking']);
        // Jika ada booking yang bentrok, kembalikan error
        if ($bookingpending) {
            return response()->json([
                'message' => 'Jadwal yang diajukan sudah dibooking. Silakan pilih waktu lain.',
                'status' => 'failed',
                'existing_booking' => $bookingpending,
            ], 400);
        }   

            // Simpan data perubahan ke tabel bookingpendings
            $pendingBooking = bookingpending::create([
                'id_booking' => $bookingpending->id_booking,
                'id_fasilitas' => $bookingpending->id_fasilitas,
                'username' => $bookingpending->username,
                'date' => $validatedData['date'],
                'requested_start' => $validatedData['requested_start'],
                'requested_end' => $endTime, 
                'original_start' => $bookingpending->start_time,
                'original_end' => $bookingpending->end_time,
                'alasan' => $validatedData['alasan'],
                'status' => 'pending',
            ]);

            return response()->json([
                'message' => 'Request perubahan booking berhasil diajukan.',
                'status' => 'pending',
                'data' => $pendingBooking,
            ], 201);
        }


        // data berhasil
        public function berhasil($id_booking)
        {
            try {
                $pending = bookingpending::where('id_booking', $id_booking)->firstOrFail();
                $pending->update(['status' => 'berhasil']);

                $booking = bookingfasilitas::findOrFail($pending->id_booking);
                $booking->update([
                    'start_time' => $pending->requested_start,
                    'end_time' => $pending->requested_end,
                    'status' => 'berhasil',
                    'alasan' => $pending->alasan,
                ]);

                // Hapus data dari tabel bookingpendings
                // $pending->delete();

                return response()->json([
                    'message' => 'Request perubahan booking disetujui dan telah diproses.',
                    'status' => 'success',
                ]);

            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                return response()->json([
                    'message' => 'Data booking pending dengan ID ' . $id_booking . ' tidak ditemukan.',
                    'status' => 'failed',
                ], 404);
            }
        }

        public function ditolak($id_booking)
        {
            try {
                $pending = bookingpending::where('id_booking', $id_booking)->firstOrFail();
                $pending->update(['status' => 'ditolak']);

                $booking = bookingfasilitas::findOrFail($pending->id_booking);
                $booking->update(['status' => 'ditolak']);
        
                return response()->json([
                    'message' => 'Request perubahan booking ditolak, dan status di tabel bookingfasilitas telah diperbarui.',
                    'status' => 'failed',
                    'data' => $pending,
                ]);
        
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                return response()->json([
                    'message' => 'Data booking pending dengan ID ' . $id_booking . ' tidak ditemukan.',
                    'status' => 'failed',
                ], 404);
            }
        }
        


}
