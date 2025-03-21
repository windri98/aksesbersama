<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\bookingfasilitas;
use App\Models\bookingpending;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Fasilitas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class BookingfasilitasController extends Controller
{
    protected $LihatFasilitas;
    // Method untuk menampilkan fasilitas berdasarkan ID
    public function deletebooking($id)
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
        $response1 = Http::apiClient($apiToken)->delete(config('services.api_base_url') . '/admin/booking-delete/' . $id);

        if ($response1->successful()){
        
            $success = $response1->json();
            return redirect()->back()->with('success', $success['message']);
        }
    }

    
    //----> lihat data hari ini
    public function kelolabooking(Request $request)
{

    $perPage = $request->input('per_page', 10);
    $bookings = bookingfasilitas::with('fasilitas')->has('fasilitas')->paginate($perPage);

    $mergedBookings = $bookings->getCollection()->map(function ($booking) {
        $bookingPending = bookingpending::where('id_booking', $booking->id_booking)->first();
        $userid = user::where('username', $booking->username)->first();
        return [
            'booking' => $booking,
            'pending' => $bookingPending ?? null,
            'userid' => $userid->id_card ?? null,
        ];
    });

    $paginatedBookings = new \Illuminate\Pagination\LengthAwarePaginator(
        $mergedBookings,
        $bookings->total(),
        $bookings->perPage(),
        $bookings->currentPage(),
        ['path' => $request->url(), 'query' => $request->query()]
    );
    $cekdata = $paginatedBookings->items();
    $data2 = $this->LihatFasilitas($perPage);

    if (!empty($cekdata)) {
        return view('Admin.dashboard.main.kelolabooking', [
            'hasilreq1' => $paginatedBookings->items(),
            'hasilreq2' => $data2['datafasilitas'],
            'iconname' => 'Kelola Booking',
            'pagination' => [
                'current_page' => $paginatedBookings->currentPage(),
                'last_page' => $paginatedBookings->lastPage(),
                'per_page' => $paginatedBookings->perPage(),
                'total' => $paginatedBookings->total()
                ]
            ]);
            
        }
    return view('Admin.dashboard.main.kelolabooking', [
        'hasilreq1' => [],
        'hasilreq2' => [],
        'iconname' => 'Kelola Booking',
        'pagination' => [
            'current_page' => 1,
            'last_page' => 1,
            'per_page' => $perPage,
            'total' => 0
        ]
    ])->with('error', "Gagal memuat data.");
    
} 

public function LihatFasilitas($perPage = 10)
{
    $kategori = Kategori::all();
    $fasilitas = Fasilitas::paginate($perPage);

    return [
        'datakategori' => $kategori,
        'datafasilitas' => $fasilitas->items(),
        'current_page' => $fasilitas->currentPage(),
        'last_page' => $fasilitas->lastPage(),
        'per_page' => $fasilitas->perPage(),
        'total' => $fasilitas->total(),
    ];
}

public function approve(Request $request)
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

    $response1 = Http::apiClient($apiToken)->put(config('services.api_base_url') . '/admin/booking-pending/berhasil' , $request);

    if ($response1->successful()){
        $success = $response1->json();
        return redirect()->back()->with('success', $success['message']);
    }
}
public function reject(Request $request)
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
    $response1 = Http::apiClient($apiToken)->put(config('services.api_base_url') . '/admin/booking-pending/ditolak/' , $request);

    if ($response1->successful()){
        $success = $response1->json();
        return redirect()->back()->with('success', $success['message']);
    }
}

public function updatebooking(Request $request)
{

    try {

        $apiToken = session('api_token');
        if (!$apiToken) {
            return redirect()->back()->with('error', 'Token tidak ditemukan. Silakan login ulang.');
        }
 
        if($request->waktu !== "AM" && $request->waktu !== "PM" ){
         
            $times = $request->input('waktu');
           
            $localTime = Carbon::now()->setTimezone('Asia/Jakarta');

            $date = $request->input('tanggalawal');
            // Validasi tanggal hari ini
            $todayDate = now()->format('Y-m-d');
            //$now = Carbon::now(); // Waktu sekarang
            $tenMinutesAgo = $localTime->subMinutes(10);
            $disableTimeStart = '00:00';
            $roundedHour = $tenMinutesAgo->minute === 0 ? $tenMinutesAgo->hour : $tenMinutesAgo->hour;
            $disableTimeEnd = str_pad($roundedHour, 2, '0', STR_PAD_LEFT) . ':00';
                    if ($date === $todayDate && ($times >= $disableTimeStart && $times <= $disableTimeEnd)) {
                        return back()->with('error', "Terjadi kesalahan: Jam $times tidak valid karena berada dalam range waktu disable ($disableTimeStart - $disableTimeEnd).");
                        }
                    }
 
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiToken,
            ])->put(config('services.api_base_url') . '/admin/booking-update/' . $request->input('datid3'), [
            '_token' => $request->input('_token'),
            'date' => $request->input('tanggalawal'),
            'times' => $request->input('waktu'),
            'alasan' =>'diupdate oleh admin',
            'id_fasilitas' => $request->input('idfasil'),
            'nama_fasil' => $request->input('fasilitas'),
        ]);

    if ($response->successful()) {
        $data = $response->json();
        $response1 = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiToken,
            ])->post(config('services.api_base_url') . '/admin/booking-pendingadmin/', [
            '_token' => $request->input('_token'),
            'id_booking' => $request->input('datid3'),
            'date' => $request->input('tanggalawal'),
            'times' => $request->input('waktu'), 
            'original_date' => $data['data']['date'],
            'original_start' => $data['data']['start_time'], 
            'original_end' => $data['data']['end_time'],            
            //'alasan' => $request->input('alasan'),
        ]);

        if ($response1->successful()) {
            $success = $response->json();
            return redirect()->back()->with('success', $success['message']);
        }
    } 
       // dd($response->json());
        // Tangani error dari API
        $error = json_decode($response->body(), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $error = ['message' => 'Response tidak valid.'];
        }
        return back()->with('error', 'Data failed: ' . ($error['message'] ?? 'Unknown error'));
    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    // ---->Tambah data
    public function createbookingfasilitas(Request $request)
{
    
    try {
        $times = array_map(function ($time) {
            return str_replace('.', ':', $time); 
        }, $request->input('times'));

        $request->merge(['times' => $times]);

        $request->validate([
            'date' => 'required|date',
            'times' => 'required|array',
            'times.*' => 'date_format:H:i:s', 
            'fasilitas' => 'required|string',
        ]);

        $fasilitas = Fasilitas::where('fasilitas', $request->fasilitas)->first();

        if (!$fasilitas) {
            return response()->json([
                'message' => 'Fasilitas tidak ditemukan.',
                'status' => 'failed'
            ], 404);
        }

        $times = array_map(function ($time) {
            return Carbon::parse($time)->format('H:i:s');
        }, $request->input('times'));

        $existingBookings = bookingfasilitas::where('date', $request->date)
            ->where('id_fasilitas', $fasilitas->id_fasilitas)
            ->whereIn('start_time', $times)
            ->get();

        if ($existingBookings->isNotEmpty()) {
            $existingTimes = $existingBookings->pluck('start_time')->toArray();
            return response()->json([
                'message' => "Room pada jam " . implode(', ', $existingTimes) . " sudah dibooking. Silakan pilih waktu lain.",
                'status' => 'failed',
                'existing_bookings' => $existingBookings,
            ], 400);
        }

        foreach ($times as $time) {
            bookingfasilitas::create([
                'id_fasilitas' => $fasilitas->id_fasilitas, 
                'username' => Auth::user()->username,
                'date' => $request->date,
                'start_time' => $time,
                'end_time' => Carbon::parse($time)->addHour()->format('H:i:s'),
                'status' => 'berhasil', 
                'alasan' => '',
            ]);
        }

        return response()->json([
            'message' => 'Booking berhasil!',
            'status' => 'success',
            'existing_bookings' => $existingBookings,
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan saat memproses permintaan.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    //---->update
    public function updateFasilitas(Request $request, $id)
{
  
    try {
        $formattedTimes = array_map(function ($time) {
            return Carbon::parse(str_replace('.', ':', $time))->format('H:i:s');
        }, $request->input('times'));

        $request->merge(['times' => $formattedTimes]); 

        $request->validate([
            'date' => 'required|date',
            'times' => 'required|array',
            'times.*' => 'date_format:H:i:s',
            'fasilitas' => 'required|string',
            'alasan' => 'nullable|string|max:255',
        ]);

        $booking = bookingfasilitas::findOrFail($id);

        if ($booking->username !== Auth::user()->username) {
            return response()->json([
                'message' => 'Anda tidak memiliki izin untuk mengubah booking ini.',
                'status' => 'failed'
            ], 403);
        }

        $fasilitas = Fasilitas::where('fasilitas', $request->fasilitas)->first();

        if (!$fasilitas) {
            return response()->json([
                'message' => 'Fasilitas tidak ditemukan.',
                'status' => 'failed'
            ], 404);
        }

        $existingBookings = bookingfasilitas::where('date', $request->date)
            ->where('id_fasilitas', $fasilitas->id_fasilitas) 
            ->whereIn('start_time', $formattedTimes) 
            ->where('id_fasilitas', '!=', $id)
            ->get();

        if ($existingBookings->isNotEmpty()) {
            $existingTimes = $existingBookings->pluck('start_time')->toArray();
            return response()->json([
                'message' => "Room pada jam " . implode(', ', $existingTimes) . " sudah dibooking. Silakan pilih waktu lain.",
                'status' => 'failed',
                'existing_bookings' => $existingBookings,
            ], 400);
        }

        $booking->update([
            'date' => $request->date,
            'start_time' => $formattedTimes[0],
            'end_time' => Carbon::parse($formattedTimes[0])->addHour()->format('H:i:s'),
            'id_fasilitas' => $fasilitas->id_fasilitas,
            'status' => 'pending',
            'alasan' => $request->input('alasan', $booking->alasan)
        ]);

        return response()->json([
            'message' => 'Booking berhasil diperbarui dan menunggu persetujuan.',
            'status' => 'pending',
            'data' => [
                'start_time' => $formattedTimes[0],
                'end_time' => Carbon::parse($formattedTimes[0])->addHour()->format('H:i:s'),
            ]
        ]);
        
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'message' => 'Booking dengan ID ' . $id . ' tidak ditemukan.',
            'status' => 'failed'
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan saat memproses permintaan.',
            'error' => $e->getMessage(),
            'status' => 'failed'
        ], 500);
    }
}

    //---->jika update di setujui
    public function approveFasilitas($id, Request $request)
    {
        try {
            if (Auth::user()->role !== 'admin') {
                return response()->json([
                    'message' => 'Hanya admin yang bisa menyetujui booking.',
                    'status' => 'ditolak'
                ], 403);
            }
    
            $booking = bookingfasilitas::findOrFail($id);
    
            // Pastikan status booking adalah pending
            if ($booking->status !== 'pending') {
                return response()->json([
                    'message' => 'Booking ini tidak dalam status pending.',
                    'status' => 'failed'
                ], 400);
            }
    
            $booking->status = 'berhasil';
            $booking->save();
    
            return response()->json([
                'message' => 'Booking berhasil disetujui.',
                'status' => 'berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat memproses permintaan.',
                'error' => $e->getMessage(),
                'status' => 'ditolak'
            ], 500);
        }
    }

    // jika update ditolak
    public function rejectFasilitas($id)
    {
    try {
        // Pastikan hanya admin yang bisa menolak booking
        if (Auth::user()->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang bisa menolak booking.',
                'status' => 'ditolak'
            ], 403);
        }

        // Cari booking berdasarkan ID
        $booking = bookingfasilitas::findOrFail($id);

        // Pastikan status booking adalah pending
        if ($booking->status !== 'pending') {
            return response()->json([
                'message' => 'Booking ini tidak dalam status pending.',
                'status' => 'ditolak'
            ], 400);
        }

        $booking->status = 'ditolak';
        $booking->save();

        return response()->json([
            'message' => 'Booking berhasil ditolak.',
            'status' => 'ditolak'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan saat memproses permintaan.',
            'error' => $e->getMessage(),
            'status' => 'ditolak'
        ], 500);
    }
    }


//selesai jika melewati batas waktu
public function selesaitFasilitas($id, Request $request)
{
    try {
        // Periksa apakah user adalah admin
        if (Auth::user()->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang bisa menyetujui booking.',
                'status' => 'ditolak'
            ], 403);
        }

        // Temukan booking berdasarkan ID
        $booking = bookingfasilitas::findOrFail($id);

        // Periksa apakah waktu end_time telah tercapai
        if ($booking->end_time && Carbon::now()->greaterThanOrEqualTo($booking->end_time)) {
            // Periksa apakah status bisa diubah menjadi selesai
            if (in_array($booking->status, ['pending', 'berhasil'])) {
                $booking->status = 'selesai';
                $booking->save();

                return response()->json([
                    'message' => 'Booking telah selesai karena mencapai waktu end_time.',
                    'status' => 'selesai'
                ]);
            }

            // Jika status tidak valid untuk diselesaikan
            return response()->json([
                'message' => 'Booking ini tidak dalam status yang bisa diselesaikan.',
                'status' => 'failed'
            ], 400);
        }

        // Jika belum mencapai end_time
        return response()->json([
            'message' => 'Booking belum mencapai waktu end_time.',
            'status' => 'belum selesai'
        ], 200);
    } catch (\Exception $e) {
        // Tangani kesalahan
        return response()->json([
            'message' => 'Terjadi kesalahan saat memproses permintaan.',
            'error' => $e->getMessage(),
            'status' => 'ditolak'
        ], 500);
    }
}


    //--->Hapus data
    public function deleteFasilitas($id)
    {
        try {
            $booking = bookingfasilitas::findOrFail($id);
            if (Auth::user()->role !== 'admin') {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            $booking->delete();
            return response()->json(['message' => ' data berhasil dihapus'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'permintaan tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }


        // Menampilkan data booking terakhir
    public function LihatTerakhirbooking()
    {
        try {
            $lastBooking = bookingfasilitas::latest()->first();

            if (!$lastBooking) {
                return response()->json([
                    'message' => 'Tidak ada data booking terakhir.',
                    'status' => 'failed'
                ], 404);
            }

            // Format data booking terakhir
            $data = [
                'id' => $lastBooking->id,
                'username' => $lastBooking->username,
                'fasilitas' => Fasilitas::find($lastBooking->id_fasilitas)->fasilitas ?? 'Tidak diketahui',
                'date' => Carbon::parse($lastBooking->date)->format('d F Y'),
                'start_time' => Carbon::parse($lastBooking->start_time)->format('H:i'),
                'end_time' => Carbon::parse($lastBooking->end_time)->format('H:i'),
                'status' => $lastBooking->status,
                'alasan' => $lastBooking->alasan
            ];

            return response()->json([
                'message' => 'Data booking terakhir berhasil diambil.',
                'data' => $data,
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data.',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ], 500);
        }
    }


    // Menghitung total jumlah booking per fasilitas
public function getTotalBookingsPerFasilitas()
{
    try {
        // Ambil semua fasilitas
        $fasilitas = Fasilitas::all();

        // Hitung jumlah booking untuk setiap fasilitas
        $data = $fasilitas->map(function ($item) {
            $totalBookings = bookingfasilitas::where('id_fasilitas', $item->id_fasilitas)->count();

            return [
                'fasilitas' => $item->fasilitas,
                'total_bookings' => $totalBookings
            ];
        });

        return response()->json([
            'message' => 'Total booking per fasilitas berhasil dihitung.',
            'data' => $data,
            'status' => 'success'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan saat menghitung data.',
            'error' => $e->getMessage(),
            'status' => 'failed'
        ], 500);
    }
}
    // }
    public function getBookingData()
    {
        $data = bookingfasilitas::selectRaw("
                DATE_FORMAT(created_at, '%b') as month, 
                YEAR(created_at) as year, 
                MONTH(created_at) as month_number,
                COUNT(*) as count
            ")
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month_number', 'month') // Group by berdasarkan tahun dan bulan
            ->orderBy('year')
            ->orderBy('month_number')
            ->get();
    
        return response()->json($data);
    }
    
    public function getBookings($filterType)
    {
        $query = bookingfasilitas::query()
        ->join('fasilitas', 'bookingfasilitas.id_fasilitas', '=', 'fasilitas.id_fasilitas') 
        ->select('fasilitas.fasilitas as fasilitas', DB::raw('COUNT(bookingfasilitas.id_booking) as bookings')) 
        ->groupBy('fasilitas.fasilitas'); // Kelompokkan berdasarkan fasilitas
    // Tambahkan filter waktu berdasarkan parameter $filterType
    if ($filterType === 'last-month') {
        // Jika filter 1 bulan terakhir
        $query->where('bookingfasilitas.created_at', '>=', now()->subMonth());
    } elseif ($filterType === 'last-year') {
        // Jika filter 1 tahun terakhir
        $query->where('bookingfasilitas.created_at', '>=', now()->subYear());
    }
    // Jalankan query dan ambil data
    $data = $query->get();
    // Kembalikan data dalam format JSON
    return response()->json($data);
    }

}