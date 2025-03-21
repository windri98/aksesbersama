<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class BookingController extends Controller
{
  

    public function index($id)
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

    $response1 = Http::apiClient($apiToken)->get(env('API_BASE_URL') . '/detailhari/' . $id);
        //$success = $response1->json();
        
        $pesanerror = null;
    if (!$response1->successful()) {
        // Tangkap error dari backend
        $error = json_decode($response1->body(), true);
        $pesanerror = 'Perhatian : ' . ($error['message'] ?? 'Unknown error'); // Set pesan error
        //session(['error' => 'Perhatian: ' . ($error['message'] ?? 'Unknown error')]);
        //return back()->with('error', 'Validasi gagal: ' . ($error['message'] ?? 'Unknown error'));
        
    }

        $response2 = Http::apiClient($apiToken)->get(env('API_BASE_URL') . '/list-fasilitas/' . $id);
            if ($response2->successful()) {        
                $data1 = $response2->json();
                
                //$message = json_decode($response1->body(), true)['message'] ?? null;
               // session()->put('successnotif', $message);

                if ($data1['kategori'] === "Ruang Meeting") {
                    // if (!$response1->successful()) {
                    //         $error = json_decode($response1->body(), true);
                    //         return view('booking.bookingmetting',[
                    //             'iconname' => 'Booking',
                    //             'hasilreq1' => $data1,
                    //             'error' => 'Validasi gagal: ' . ($error['message'] ?? 'Unknown error') // Kirim pesan error ke view
                    //         ]);
                    //     }
                        return view('Admin.booking.bookingmetting',[
                            'iconname' => 'Booking',
                            'hasilreq1' => $data1,
                            'error' => $pesanerror,
                        ]);

                } else {
                    // if (!$response1->successful()) {
                    //     $error = json_decode($response1->body(), true);
                    //     session(['error' => 'Validasi gagal: ' . ($error['message'] ?? 'Unknown error')]);
                    //     return view('booking.booking',[
                    //         'iconname' => 'Booking',
                    //         'hasilreq1' => $data1,
                    //        // 'error' => 'Validasi gagal: ' . ($error['message'] ?? 'Unknown error') // Kirim pesan error ke view
                    //     ]);
                    // }
                    // session()->flash('successnotif', $message);
                    //$message = $response1->json('message') ?? null;
                    return view('booking.booking',[
                        'iconname' => 'Booking',
                        'hasilreq1' => $data1,
                        'error' => $pesanerror,
                    ]);//->with('succes', 'Informasi: ' . $response1->json('message'));
                }
            }

            $error = json_decode($response1->body(), true);
            return back()->with('error', 'Data failed : ' . ($error['message'] ?? 'Unknown error'));
    }
        //     $error = json_decode($response1->body(), true);
        //     if (json_last_error() !== JSON_ERROR_NONE) {
                
        //     $error = ['message' => 'Response tidak valid.'];
        //     }
            
        // return back()->with('error', 'Data failed : ' . ($error['message'] ?? 'Unknown error'));
    //}

    public function editjadwal($id, $idf)
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

      
        $response1 = Http::apiClient($apiToken)->get(env('API_BASE_URL') . '/detailbooking/' . $id);
        
        if ($response1->successful()) {
            $data1 = $response1->json();
           
                $response2 = Http::apiClient($apiToken)->get(env('API_BASE_URL') . '/list-fasilitas/' . $idf);
                $data2 = $response2->json();

                if ($data2['kategori'] === "Ruang Meeting") {
                   
                    return view('booking.editjadwalmetting',[
                      'iconname' => 'Edit Jadwal',
                        'hasilreq1' => $data1,
                    ]);

                } else {
                    
                    return view('booking.editjadwal',[
                        'iconname' => 'Edit Jadwal',
                        'hasilreq1' => $data1,
                ]);
                }
                
             
        }

        // return view('booking.editjadwal',[
        //     'iconname' => 'Edit Jadwal',
        //     'id' => $id,
        //     'date' => $date,
        //     'time' => $time,
        //     'fasilitas' => $fasilitas,
        //     'unit_nomor' => $unit_nomor,
        // ]);

    }
    public function delete($id)
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

        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $apiToken,
        // ])->get(config('services.api_base_url') . '/booking-delete/' . $id);
        //$response1 = Http::apiClient($apiToken)->get(config('services.api_base_url') . "/booking-delete/$id");
        $response1 = Http::apiClient($apiToken)->delete(env('API_BASE_URL') . '/booking-delete/' . $id);
        //dd($response1->json());
        if ($response1->successful()) {
            $success = $response1->json();
       
            return redirect()->back()->with('success', $success['message']);
        } else {

            return redirect()->back()->with('errorlogout', 'Gagal Hapus: ' . $response1->json('message'));
        
        }
    }

    public function update(Request $request, $id)
    {

        try {

            $apiToken = session('api_token');
            if (!$apiToken) {
                return redirect()->back()->with('error', 'Token tidak ditemukan. Silakan login ulang.');
            }

            $times = json_decode($request->input('times'), true);
            // Periksa apakah 'times' adalah array
            if (!is_array($times)) {
                //return back()->with('error',['message' => 'Format input times tidak valid.'], 422);
                return back()->with('error', 'Terjadi kesalahan: ' . 'Format input times tidak valid.');
            }
            $localTime = Carbon::now()->setTimezone('Asia/Jakarta');

            $date = $request->input('date');
            // Validasi tanggal hari ini
            $todayDate = now()->format('Y-m-d');
            //$now = Carbon::now(); // Waktu sekarang
            $tenMinutesAgo = $localTime->subMinutes(10);
            $disableTimeStart = '00:00';
            $roundedHour = $tenMinutesAgo->minute === 0 ? $tenMinutesAgo->hour : $tenMinutesAgo->hour;
            $disableTimeEnd = str_pad($roundedHour, 2, '0', STR_PAD_LEFT) . ':00';
            //$response1 = Http::apiClient($apiToken)->get(config('services.api_base_url') . '/detailhari/' . $id);
            //$unavailableTimes = $response1->json()['unavailable_times'] ?? [];
                 // Validasi setiap jam
                foreach ($times as $time) {
                    if ($date === $todayDate && ($time >= $disableTimeStart && $time <= $disableTimeEnd)) {
                        return back()->with('error', "Terjadi kesalahan: Jam $time tidak valid karena berada dalam range waktu disable ($disableTimeStart - $disableTimeEnd).");
                        // return response()->json([
                        //     'error' => "Jam $time tidak valid karena berada dalam range waktu disable ($disableTimeStart - $disableTimeEnd)."
                        // ], 400);
                    }
                }
            // Kirim permintaan POST ke API dengan Authorization header
            // $response = Http::withHeaders([
            //     'Authorization' => 'Bearer ' . $apiToken,
            // ])->post('http://192.168.3.113:8000/api/booking-requests', [
               // ])->post(config('services.api_base_url') . '/booking-pending', [

               
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                ])->put(env('API_BASE_URL') . '/booking-update/' . $id, [
                '_token' => $request->input('_token'),
                'date' => $request->input('date'),
                'times' => $request->input('times'), // Pastikan "times" adalah array
                'alasan' => $request->input('alasan'),
                'id_fasilitas' => $request->input('id_fasilitas'),
            ]);
       
        if ($response->successful()) {
         
            $response1 = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                ])->post(env('API_BASE_URL') . '/booking-pending/', [
                '_token' => $request->input('_token'),
                'id_booking' => $id,
                'date' => $request->input('date'),
                'requested_start' => $request->input('times'), // Pastikan "times" adalah array
                'alasan' => $request->input('alasan'),
            ]);
  
            if ($response1->successful()) {
                $success = $response->json();
                return redirect()->back()->with('success', $success['message']);
            }
        } 
           
            // Tangani error dari API
            $error = json_decode($response->body(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $error = ['message' => 'Response tidak valid.'];
            }
            return back()->with('error', 'Info: ' . ($error['message'] ?? 'Unknown error'));
        } catch (\Exception $e) {
            // Tangani error jika API tidak bisa diakses atau error lainnya
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function updatemetting(Request $request, $id)
    {

        try {

            $apiToken = session('api_token');
            if (!$apiToken) {
                return redirect()->back()->with('error', 'Token tidak ditemukan. Silakan login ulang.');
            }

            // Kirim permintaan POST ke API dengan Authorization header
            // $response = Http::withHeaders([
            //     'Authorization' => 'Bearer ' . $apiToken,
            // ])->post('http://192.168.3.113:8000/api/booking-requests', [
               // ])->post(config('services.api_base_url') . '/booking-pending', [
 
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                ])->put(env('API_BASE_URL') . '/booking-updatemetting/' . $id, [
                '_token' => $request->input('_token'),
                'date' => $request->input('date'),
                'times' => $request->input('times'), // Pastikan "times" adalah array
                'alasan' => $request->input('alasan'),
                'id_fasilitas' => $request->input('id_fasilitas'),
            ]);
            
        if ($response->successful()) {

            $response1 = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                ])->post(env('API_BASE_URL') . '/booking-pendingmetting/', [
                '_token' => $request->input('_token'),
                'id_booking' => $id,
                'date' => $request->input('date'),
                'times' => $request->input('times'), // Pastikan "times" adalah array
                'alasan' => $request->input('alasan'),
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
            return back()->with('error', 'Info: ' . ($error['message'] ?? 'Unknown error'));
        } catch (\Exception $e) {
            // Tangani error jika API tidak bisa diakses atau error lainnya
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function create(Request $request, $id)
    {
        try {
            
            $apiToken = session('api_token');
            if (!$apiToken) {
                return redirect()->back()->with('error', 'Token tidak ditemukan. Silakan login ulang.');
            }
            // Kirim permintaan POST ke API dengan Authorization header
            // $response = Http::withHeaders([
                //     'Authorization' => 'Bearer ' . $apiToken,
                // ])->post('http://192.168.3.113:8000/api/booking-requests', [
                    // Decode input 'times' menjadi array
                    $times = json_decode($request->input('times'), true);
                    // Periksa apakah 'times' adalah array
                    if (!is_array($times)) {
                        //return back()->with('error',['message' => 'Format input times tidak valid.'], 422);
                return back()->with('error', 'Terjadi kesalahan: ' . 'Format input times tidak valid.');
            }
            $localTime = Carbon::now()->setTimezone('Asia/Jakarta');

            $date = $request->input('date');
            // Validasi tanggal hari ini
            $todayDate = now()->format('Y-m-d');
            //$now = Carbon::now(); // Waktu sekarang
            $tenMinutesAgo = $localTime->subMinutes(10);
            $disableTimeStart = '00:00';
            $roundedHour = $tenMinutesAgo->minute === 0 ? $tenMinutesAgo->hour : $tenMinutesAgo->hour;
            $disableTimeEnd = str_pad($roundedHour, 2, '0', STR_PAD_LEFT) . ':00';
            //$response1 = Http::apiClient($apiToken)->get(config('services.api_base_url') . '/detailhari/' . $id);
            //$unavailableTimes = $response1->json()['unavailable_times'] ?? [];
                 // Validasi setiap jam
                foreach ($times as $time) {
                    if ($date === $todayDate && ($time >= $disableTimeStart && $time <= $disableTimeEnd)) {
                        return back()->with('error', "Terjadi kesalahan: Jam $time tidak valid karena berada dalam range waktu disable ($disableTimeStart - $disableTimeEnd).");
                        // return response()->json([
                        //     'error' => "Jam $time tidak valid karena berada dalam range waktu disable ($disableTimeStart - $disableTimeEnd)."
                        // ], 400);
                    }
                }

            $countTimes = count($times);
            $response1 = Http::apiClient($apiToken)->get(env('API_BASE_URL') . '/detailhari/' . $id);
            $data = $response1->json();
         
            // Lakukan validasi
            if ($countTimes > $data['data']) {
                return back()->with('error', 'Terjadi kesalahan: ' . 'Jumlah waktu yang dipilih melebihi batas yang diizinkan.');
                // return response()->json([
                //     'message' => 'Jumlah waktu yang dipilih melebihi batas yang diizinkan.',
                //     'detail' => [
                //         'max_allowed' => $data,
                //         'selected_count' => $countTimes,
                //     ],
                // ], 422);
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
            ])->post(env('API_BASE_URL') . '/booking-requests/' . $id, [
                '_token' => $request->input('_token'),
                'date' => $request->input('date'),
                'times' => $request->input('times'), // Pastikan "times" adalah array
            ]);
            
            if ($response->successful()) {
                $success = $response->json();
              
                return redirect('/dashboard')->with('success', $success['message']);
            } 
           // dd($response->json());
            // Tangani error dari API
            $error = json_decode($response->body(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $error = ['message' => 'Response tidak valid.'];
            }
            return back()->with('error', 'Data failed : ' . ($error['message'] ?? 'Unknown error'));
        } catch (\Exception $e) {
            // Tangani error jika API tidak bisa diakses atau error lainnya
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function createmetting(Request $request, $id)
    {
//    Terjadi kesalahan: Method Illuminate\Http\Client\PendingRequest::apiClient does not exist.
        try {
         
            $apiToken = session('api_token');
            if (!$apiToken) {
                return redirect()->back()->with('error', 'Token tidak ditemukan. Silakan login ulang.');
            }
      
            $response1 = Http::apiClient($apiToken)->get(env('API_BASE_URL') . '/detailhari/' . $id);
             // Periksa respons dari API
       
             if ($response1->failed()) {
                return redirect()->back()->with('error', 'Gagal mendapatkan data. Silakan coba lagi.');
            }
        
            $data = $response1->json();
            
            //$count = isset($data['data']) ? count($data['data']) : 0;
            $maxLimit = $data['data'] ?? 0;
            // $currentRequests = $request->input('time_period'); // Misalnya times adalah array waktu yang dikirimkan
            // if (is_string($currentRequests)) {
            //     // Jika time_period adalah string JSON, decode ke array
            //     $currentRequests = json_decode($currentRequests, true);
            // }
            // $currentCount = is_array($currentRequests) ? count($currentRequests) : 0;
            // Validasi jumlah data
            if (0 >= $maxLimit) { // Misalnya, batas total adalah 5
                return redirect()->back()->with('error', 'Jumlah data yang diajukan melebihi batas maksimal.');
            }
     
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
            ])->post(env('API_BASE_URL') . '/booking-metting/' . $id, [
                '_token' => $request->input('_token'),
                'date' => $request->input('date'),
                'times' => $request->input('times'), // Pastikan "times" adalah array
            ]);
        
            if ($response->successful()) {
                $success = $response->json();
              
                return redirect('/dashboard')->with('success', $success['message']);
            } 
           // dd($response->json());
            // Tangani error dari API
            $error = json_decode($response->body(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $error = ['message' => 'Response tidak valid.'];
            }
            return back()->with('error', 'Data failed : ' . ($error['message'] ?? 'Unknown error'));
        } catch (\Exception $e) {
            // Tangani error jika API tidak bisa diakses atau error lainnya
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
}
