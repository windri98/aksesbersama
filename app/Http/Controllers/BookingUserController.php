<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Fasilitas;
use App\Models\bookingfasilitas;
use App\Models\bookingpending;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

use function PHPUnit\Framework\isNull;

class BookingUserController extends Controller
{
    protected $detailhari;

    public function __construct()
    {
        $this->detailhari = null; 
    }

    public function index($id)
    {

        $batasbook = $this->detailhari($id);
        $pesanerror = null;
        if (isset($batasbook['error'])) {
            $pesanerror = 'Perhatian : ' . ($batasbook['error'] ?? 'Unknown error');
        }
        $fasilitasData = Cache::get('fasilitas');
        $data1 = collect($fasilitasData)->firstWhere('fasilitas.id_fasilitas', $id);
        if (!$data1) {
            abort(404, 'Fasilitas tidak ditemukan dalam cache.');
        }

                if ($data1['fasilitas']['kategori'] === "Ruang Meeting") {
                        return view('user.booking.bookingmetting',[
                            'iconname' => 'Booking',
                            'hasilreq1' => $data1,
                            'error' => $pesanerror,
                        ]);

                } else {
                    return view('user.booking.booking',[
                        'iconname' => 'Booking',
                        'hasilreq1' => $data1,
                        'error' => $pesanerror,
                    ]);
                }
    }

    public function editjadwal($id)
    {
            $user = Auth::user();
            $booking = collect(Cache::get("bookings-{$user->username}"))->firstWhere('id_booking', $id);
        
            if ($booking['fasilitas']->kategori === "Ruang Meeting") {
                return view('User.booking.editjadwalmetting', [
                    'iconname' => 'Edit Jadwal',
                    'hasilreq1' => $booking,
                ]);
            } else {
                return view('User.booking.editjadwal', [
                    'iconname' => 'Edit Jadwal',
                    'hasilreq1' => $booking,
                ]);
            }
    }

    public function delete($id)
    {

        $booking = bookingfasilitas::find($id);
    
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan.');
        }
    
        try {

            $booking->delete();
    
            return redirect()->back()->with('success', 'Booking berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus booking: ' . $e->getMessage());
        }
    }
    

    public function update(Request $request, $id)
    {
     
        try {
            $times = json_decode($request->input('times'), true);
            $localTime = Carbon::now()->setTimezone('Asia/Jakarta');
            $todayDate = now()->format('Y-m-d');
            $tenMinutesAgo = $localTime->subMinutes(10);
            $disableTimeStart = '00:00';
            $disableTimeEnd = str_pad($tenMinutesAgo->hour, 2, '0', STR_PAD_LEFT) . ':00';

                foreach ($times as $time) {
                    if ($request->times === $todayDate && ($time >= $disableTimeStart && $time <= $disableTimeEnd)) {
                        return back()->with('error', "Terjadi kesalahan: Jam $time tidak valid karena berada dalam range waktu disable ($disableTimeStart - $disableTimeEnd).");
                    }
                }

                $bookingpending = bookingpending::where('id_booking', $id)->first();
                if ($bookingpending) {
                    return back()->with([
                        'error' => 'Request perubahan booking sudah diajukan sebelumnya.',
                        'existing_bookings' => $bookingpending,
                    ]);
                }
                $booking = bookingfasilitas::findOrFail($id);
                if ($booking->username !== Auth::user()->username) {
                    return back()->with('error', "Anda tidak memiliki izin untuk mengubah booking ini.");
                }
                $fasilitas = Fasilitas::where('id_fasilitas', $request->id_fasilitas)->first();
                if (!$fasilitas) {
                    return back()->with('error', "Fasilitas tidak ditemukan.");
                }
            
                $existingBookings = bookingfasilitas::where('date', $request->date)
                ->where('id_fasilitas', $fasilitas->id_fasilitas) 
                ->whereIn('start_time', $times) 
                ->exists(); 

                if ($existingBookings) {
                    return back()->with([
                        'error' => "Room pada waktu {$request->times} sudah dibooking. Silakan pilih waktu lain.",
                        'existing_bookings' => $existingBookings,
                    ]);
                }
                $booking->update([
                     'status' => 'pending',
                     'alasan' => $request->input('alasan', $booking->alasan),
                     'updated_at' => now(),
                 ]);
                 $time = $times[0];
                 $formattedStartTime =str_replace('.', ':', $time);
                 $endTime =  Carbon::parse($formattedStartTime)->addHour()->format('H:i');
                 bookingpending::create([
                    'id_booking' => $booking->id_booking,
                    'id_fasilitas' => $booking->id_fasilitas,
                    'username' => $booking->username,
                    'date' => $request->date,
                    'requested_start' =>  $formattedStartTime,
                    'requested_end' =>$endTime, 
                    'original_date' => $booking->date,
                    'original_start' => $booking->start_time,
                    'original_end' => $booking->end_time,
                    'alasan' => $booking->alasan,
                    'status' => 'pending',
                ]);
            return redirect()->route('dashboarduser')->with('success', 'Booking berhasil diperbarui dan menunggu persetujuan.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }
    public function updatemetting(Request $request, $id)
    {

        try {
            $request->validate([
                'date' => 'required|date',
                'times' => 'required|in:AM,PM', 
                'alasan' => 'required|string|max:255',
                'id_fasilitas' => 'required|exists:fasilitas,id_fasilitas',
            ]);  
           
            $bookingpending = bookingpending::where('id_booking', $id)->first();
            if ($bookingpending) {
                return back()->with([
                    'error' => 'Request perubahan booking sudah diajukan sebelumnya.',
                    'existing_bookings' => $bookingpending,
                ]);
            }
            $booking = bookingfasilitas::findOrFail($id);
        if ($booking->username !== Auth::user()->username) {
            return back()->with('error', "Anda tidak memiliki izin untuk mengubah booking ini.");
        }    

        $fasilitas = Fasilitas::findOrFail($request->id_fasilitas);
        if (!$fasilitas) {
            return back()->with('error', "Fasilitas tidak ditemukan.");
        }

        $existingBookings = bookingfasilitas::where('date', $request->date)
            ->where('id_fasilitas', $fasilitas->id_fasilitas) 
            ->where('start_time', $request->times) 
            ->exists(); 
    
        if ($existingBookings) {
            return back()->with([
                'error' => "Room pada waktu {$request->times} sudah dibooking. Silakan pilih waktu lain.",
                'existing_bookings' => $existingBookings,
            ]);
        }
            $booking->update([
                'status' => 'pending',
                'alasan' => $request->input('alasan', $booking->alasan),
                'updated_at' => now(),
            ]);
         
            // $booking = bookingfasilitas::findOrFail($id);  
           bookingpending::create([
                'id_booking' => $booking->id_booking,
                'id_fasilitas' => $booking->id_fasilitas,
                'username' => $booking->username,
                'date' => $request['date'],
                'requested_start' => $request['times'],
                'requested_end' => '0', 
                'original_date' => $booking->date,
                'original_start' => $booking->start_time,
                'original_end' => $booking->end_time,
                'alasan' => $request['alasan'],
                'status' => 'pending',
            ]);

            return redirect()->route('dashboarduser')->with('success', 'Request perubahan booking berhasil diajukan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }
    public function create(Request $request, $id)
    {

        try {
            $times = json_decode($request->input('times'), true);
            $localTime = Carbon::now()->setTimezone('Asia/Jakarta');
            $todayDate = now()->format('Y-m-d');
            $tenMinutesAgo = $localTime->subMinutes(10);
            $disableTimeStart = '00:00';
           // $roundedHour = $tenMinutesAgo->minute === 0 ? $tenMinutesAgo->hour : $tenMinutesAgo->hour;
            $disableTimeEnd = str_pad($tenMinutesAgo->hour, 2, '0', STR_PAD_LEFT) . ':00';

            $validated = $request->validate([
                'date' => [
                    'required',
                    'date',
                    'after_or_equal:' . now()->format('Y-m-d'), 
                    'before_or_equal:' . now()->addDays(2)->format('Y-m-d'), 
                ],
                //'times' => 'required|array',
                'times.*' => 'regex:/^\d{2}:\d{2}$/',
            ], [
                'date.required' => 'Tanggal wajib diisi.',
                'date.after_or_equal' => 'Tanggal minimal hari ini.',
                'date.before_or_equal' => 'Tanggal maksimal 2 hari ke depan.',
                'times.required' => 'Waktu wajib diisi.',
                'times.*.regex' => 'Format waktu tidak valid, gunakan format HH:mm.',
            ]);
         
            foreach ($times as $time) {
                if ($validated['date'] === $todayDate && ($time >= $disableTimeStart && $time <= $disableTimeEnd)) {
                    return back()->with('error', "Jam $time tidak valid karena berada dalam range waktu yang tidak dapat dipilih ($disableTimeStart - $disableTimeEnd).");
                }
            }

            $fasilitas = Fasilitas::find($id);

            if (!$fasilitas) {
                return back()->with('error', 'Fasilitas tidak ditemukan.');
            }

            $countTimes = count($times);
            $batasbook = $this->detailhari($id);

            if ($countTimes > $batasbook['data']) {
                return back()->with('error', 'Terjadi kesalahan: ' . 'Jumlah waktu yang dipilih melebihi batas yang diizinkan.');

            }

            $existingBookings = bookingfasilitas::where('date', $validated["date"])
            ->where('id_fasilitas', $fasilitas->id_fasilitas) 
            ->whereIn('start_time', $times) 
            ->exists(); 
            
            if ($existingBookings) {
                return back()->with([
                    'error' => "Room pada waktu {$request->times} sudah dibooking. Silakan pilih waktu lain.",
                    'existing_bookings' => $existingBookings,
                ]);
            }

        $bookings = [];
        foreach ($times as $time) {
            $bookings[] = [
                'id_fasilitas' => $fasilitas->id_fasilitas, 
                'username' => Auth::user()->username,
                'date' => $validated['date'],
                'start_time' => str_replace('.', ':', $time), 
                'end_time' => Carbon::parse(str_replace('.', ':', $time))->addHour()->format('H:i'),
                'status' => 'berhasil',
                'alasan' => '',
                'created_at' => now(), 
                'updated_at' => now(),
            ];
        }
        bookingfasilitas::insert($bookings);
        $user = Auth::user()->username;
        Cache::forget("bookings-{$user}");
        return redirect()->back()->with('success', 'Booking berhasil.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        return back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }

    }

    public function createmetting(Request $request, $id)
    {
     
        try {
            
            $times = is_array($request->times) ? $request->times : explode(',', $request->times);

            $batasbook = $this->detailhari($id);
            $maxLimit = $batasbook['data'] ?? 0;
       
            if (0 >= $maxLimit) {
                return redirect()->back()->with('error', 'Jumlah data yang diajukan melebihi batas maksimal.');
            }
            $validated = $request->validate([
                'date' => [
                    'required',
                    'date',
                    'after_or_equal:' . now()->format('Y-m-d'),
                    'before_or_equal:' . now()->addDays(15)->format('Y-m-d'), 
                ],
                'times' => 'required|array|min:1',
                'times' => 'required|in:AM,PM', 
                ], [
                    'date.required' => 'Tanggal wajib diisi.',
                    'date.after_or_equal' => 'Tanggal yang dipilih max : 15 hari ke depan.',
                    'date.before_or_equal' => 'Tanggal yang dipilih max : 15 hari ke depan.',
                    'times.array' => 'Format waktu harus berupa array.',
                    'times.min' => 'Minimal harus memilih satu waktu.',
                    'times.required' => 'Waktu wajib diisi.',
                    'times.in' => 'Waktu harus berupa AM atau PM.',
                ]);
                $times = is_array($request->times) ? $request->times : explode(',', $request->times);
             
                $fasilitas = Fasilitas::find($id);
                if (!$fasilitas) {
                    return back()->with('error', 'Fasilitas tidak ditemukan.');
                }
   
                $existingBookings = bookingfasilitas::where('date', $validated["date"])
                ->where('id_fasilitas', $fasilitas->id_fasilitas) 
                ->whereIn('start_time',$times) 
                ->exists(); 
         
                if ($existingBookings) {
                    return back()->with([
                        'error' => "Room pada waktu {$request->times} sudah dibooking. Silakan pilih waktu lain.",
                        'existing_bookings' => $existingBookings,
                    ]);
                }
                bookingfasilitas::create([
                    'id_fasilitas' => $fasilitas->id_fasilitas, 
                    'username' => Auth::user()->username,
                    'date' => $validated['date'],
                    'start_time' => $validated['times'],
                    'end_time' => '0',
                    'status' => 'berhasil',
                    'alasan' => '',
                    'created_at' => now(), 
                    'updated_at' => now(),
                ]);

            return redirect()->back()->with('success', 'Booking berhasil.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    
    public function LihatFasilitas($id)
    {
        $fasilitas = Fasilitas::where('id_fasilitas', $id)->firstOrFail();
        return response()->json($fasilitas);
    }
    public function getUnavailableDates1(Request $request)
    {
        $idFasilitas = $request->query('id_fasilitas');
    
        if (!$idFasilitas) {
            return response()->json(['message' => 'ID Fasilitas tidak diberikan'], 400);
        }
    
        $unavailableDates = bookingfasilitas::where('id_fasilitas', $idFasilitas) 
            ->where('date', '>=', Carbon::now())
            ->where('date', '<=', Carbon::now()->addMonth())
            ->pluck('date')
            ->toArray();
      \Log::info("Unavailable dates for Picker1:", $unavailableDates);
        return response()->json(['unavailable_dates' => $unavailableDates]);
    }
    
    public function getUnavailableDates2(Request $request)
    {
        $idFasilitas = $request->query('id_fasilitas'); 
    
        if (!$idFasilitas) {
            return response()->json(['message' => 'ID Fasilitas tidak diberikan'], 400);
        }
    
        $unavailableDates = bookingfasilitas::where('id_fasilitas', $idFasilitas)
            ->where('date', '>=', Carbon::now()->addMonth()->startOfMonth())
            ->pluck('date')
            ->toArray();
    
        return response()->json(['unavailable_dates' => $unavailableDates]);
    }
    public function fetchUnavailableTimes()
    {
        
        $unavailableDates = bookingfasilitas::where('status', 'berhasil')
            ->where('date', '>=', Carbon::now())
            ->where('date', '<=', Carbon::now()->addMonth())
            ->pluck('date')
            ->toArray();

        return response()->json(['unavailable_dates' => $unavailableDates]);
    }

    public function myriquesbeliar(Request $request)
    {
        try {
            $date = $request->input('date');
            $idFasilitas = $request->input('id_fasilitas');
        
           if (!$idFasilitas) {
                $bookings = bookingfasilitas::where('date', $date)
                ->where('id_fasilitas', $idFasilitas)
                ->get();
                $data = $bookings->map(function ($booking) {
                    $time = $booking->start_time;
                    if (in_array($time, ['AM', 'PM'])) {
                        $formattedTime = $time;
                    } else {
                        try {
                            $formattedTime = Carbon::parse($time)->format('H:i');
                        } catch (\Exception $e) {
                            $formattedTime = $time;
                        }
                    }
                
                return [
                    'time' => $formattedTime,
                    'username' => $booking->username,
                    'status' => $booking->status,
                ];
            });
           }else {
            $bookings = bookingfasilitas::where('date', $date)->with('fasilitas')->has('fasilitas')->get();
          
                $data = $bookings->map(function ($booking) {
                    $time = $booking->start_time;

                   
                    if (in_array($time, ['AM', 'PM'])) {
                    
                        $formattedTime = $time;
                    } else {
                        try {
                        
                            $formattedTime = Carbon::parse($time)->format('H:i');
                        } catch (\Exception $e) {
                          
                            $formattedTime = $time;
                        }
                    }
                
                return [
                    'id' => $booking->id_fasilitas,
                    'nama' => $booking->fasilitas->fasilitas,
                    'time' => $formattedTime,
                    'username' => $booking->username,
                    'status' => $booking->status,
                    
                ];
            });
        }
            return response()->json([
                'date' => Carbon::parse($date)->format('d F Y'),
                'bookings' => $data,
            ]);
        } catch (\Exception $e) {
            \Log::error("Error in myriquesbeliar: " . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan saat memproses permintaan.',
                'error' => $e->getMessage(),
                'status' => 'failed'
            ], 500);
        }
    }

    public function getUnavailableTimes(Request $request)
    {
        $date = $request->input('date');
            $idFasilitas = $request->input('id_fasilitas');
    
        if (!$date || !$idFasilitas) {
            return response()->json([
                'message' => 'Tanggal atau ID Fasilitas tidak diberikan.',
                'status' => 'failed'
            ], 400);
        }
    
       
        $unavailableTimes = bookingfasilitas::where('date', $date)
            ->where('id_fasilitas', $idFasilitas)
            ->get(['start_time', 'end_time']);
    
        if ($unavailableTimes->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada waktu yang tidak tersedia untuk tanggal dan fasilitas ini.',
                'unavailable_times' => []
            ]);
        }
    
        return response()->json([
            'message' => 'Data waktu yang tidak tersedia ditemukan.',
            'unavailable_times' => $unavailableTimes
        ]);
    }

    public function detailhari($id)
    {
        $user = Auth::user();
        if (!$user) {
            return null;
        }

        $fasilitas = Fasilitas::where('id_fasilitas', $id)->first();
        if (!$fasilitas) {
            return null; 
        }
       
        $bookings = bookingfasilitas::where('username', $user->username)
            ->where('id_fasilitas', $fasilitas->id_fasilitas)
            ->whereIn('status', ['pending','berhasil', 'ditolak'])
            ->count();

        if ($bookings >= $fasilitas->maxjam) {
            return (['error' => "Fasilitas sudah melebihi batas yang ditentukan : $fasilitas->maxjam x, Silakan pilih fasilitas lain."]);
        }

        $batasbook = $fasilitas->maxjam - $bookings;
        return([
            'data' => $batasbook,
            'message' => "$batasbook jam waktu tersisa.",
        ]);

    }

    
}
