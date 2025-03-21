<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use League\CommonMark\Extension\CommonMark\Parser\Inline\BacktickParser;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\confirm;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Models\bookingfasilitas;
class UserProsesController extends Controller
{

    public function showBookingPage()
    {
        return view('booking'); 
    }

    public function profil()
    {

        return view('User.user.profil',[
            'iconname' => 'Profil'
        ]);

    }

    public function ubahpassword()
    {
        return view('User.user.ubahpassword',[
            'iconname' => 'Ubah Password',
        ]);

    }

    public function history(Request $request)
    {
        $user = Auth::user();
        $report = collect(Cache::get("reports-requests-{$user->username}"));
        $bookings = collect(Cache::get("bookings-{$user->username}"));
        return view('User.user.history',[
            'hasilreq1' => $report,
            'hasilreq2' => $bookings,
            'iconname' => 'History',
        ]);
    // } else {   
    //         $request->session()->flush();
    //         $request->session()->regenerateToken();
    //     return redirect()->back()->with('errorlogout', 'User Invalid: ' . $response1->json('message'));
    //     return redirect()->back()->with('errorlogout', 'User Invalid: ' . $response2->json('message'));
    //     }
    }
    public function GetKategori($id){

        $kategori = collect(Cache::get('fasilitas'))->firstWhere('fasilitas.kategori', $id);
        $data = [];
        foreach ($kategori as $getdata) {
            $cacheTime = 60 * 180;
            $bookings = Cache::remember("bookings-last-{$getdata->id_fasilitas}", $cacheTime, function () use ($getdata) {
                return bookingfasilitas::where('id_fasilitas', $getdata->id_fasilitas)
                    ->orderBy('id_booking', 'desc')
                    ->first();
            });
            $totalbooking = Cache::remember("bookings-total-{$getdata->id_fasilitas}", $cacheTime, function () use ($getdata) {
                return bookingfasilitas::where('id_fasilitas', $getdata->id_fasilitas)->count();
            });
            $data[] = [
                'fasilitas' => $getdata, 
                'last_booking' => $bookings, 
                'total_booking' => $totalbooking, 
            ];
            return view('user.layouts.kategori',[
                'hasilreq1' => $data,
                'iconname' =>$id,
            ]);
        }
 
    }

    public function jadwalsaya()
    {
        $user = Auth::user();
        $data1 = collect(Cache::get("bookings-{$user->username}"));
            // $dataBooking = $data1['bookings'] ?? [];
            $dataBooking = $data1 ?? [];
            return view('User.user.jadwalsaya',[
                'hasilreq4' => $dataBooking,
                'iconname' => 'Jadwal Saya',
            ]);
    }
       
    public function register(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username|max:255',
            'id_card' => 'required|unique:users,id_card|max:5',
            'room_number' => 'required|max:10',
            'password' => 'required|min:8',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah terdaftar.',
            'username.max' => 'Username maksimal 255 karakter.',
            'id_card.required' => 'ID Card wajib diisi.',
            'id_card.unique' => 'ID Card sudah digunakan.',
            'id_card.max' => 'ID Card maksimal 5 karakter.',
            'id_card.min' => 'ID Card minimal 5 karakter.',
            'room_number.required' => 'Nomor kamar wajib diisi.',
            'room_number.max' => 'Nomor kamar maksimal 10 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

       if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }
    try {
        User::create([
            'username' => $request->username,
            'id_card' => $request->id_card,
            'room_number' => $request->room_number,
            'password' => Hash::make($request->password), 
            //'role' => 'user', 
        ]);

        return back()->with('success', 'Pendaftaran berhasil! Menunggu Approve Admin.');

    } catch (\Exception $e) {

        return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
    }    
}

    
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);
     
        $user = User::where('username', $request->username)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['errorlogin', 'Login failed: '  => 'Username atau password salah!']);
        }
        if ($user->role === 'pending') {
            return back()->withErrors(['errorlogin', 'Login failed: '  => 'Akun Anda belum disetujui oleh admin. Silakan tunggu persetujuan.']);
        }

        Auth::login($user);
        session([
            'id_card' => $user['id_card'],
            'username' => $user['username'],
            'no_kamar' => $user['room_number'],
            'role' => $user['role'],
            //'api_token' => $token,
        ]);

        return redirect()->route('dashboarduser')->with('success', 'Login berhasil!');
    
    }

    public function logout(Request $request)
    {
    
            if (!Auth::check()) {
                return redirect('/index')->with('errorlogout', 'Anda belum login.');
            }
            $user = Auth::user();
            Cache::forget("reports-requests-{$user->username}");
            Cache::forget("bookings-{$user->username}");
            // Logout pengguna
            Auth::logout();

            // Hapus semua session
            $request->session()->flush();
            $request->session()->regenerateToken();
            Cache::forget('kategori');
            Cache::forget('reports');
            Cache::forget('merged-bookings');
            Cache::forget('fasilitas');
            // Redirect ke halaman login dengan pesan sukses
            return redirect('/index')->with('successlogout', 'Logout berhasil!');
    }


    public function updatePassword(Request $request)
    {
       
    try {
        $request->validate([
            'passlama' => 'required', // Menggantikan 'current_password'
            'passbaru' => [
                'required',
                'min:8',
                //'confirmed', // Validasi Laravel masih bisa digunakan untuk pasangan default
            ],
            'repass' => 'required|same:passbaru', // Validasi manual untuk pasangan kustom
        ], [
            'passlama.required' => 'Password Lama wajib diisi.',
            'passbaru.required' => 'Password Baru wajib diisi.',
            'passbaru.min' => 'Password Baru harus minimal 8 karakter.',
            'repass.required' => 'Konfirmasi Password Baru wajib diisi.',
            'repass.same' => 'Konfirmasi Password Baru harus sama dengan Password Baru.',
        ]);
        $user = Auth::user();
 
        if (!Hash::check($request->passlama, $user->password)) {
            return redirect()->back()->with('errorubahpass', 'Kata sandi saat ini salah!');
        }
        $user->password = Hash::make($request->passbaru);
        $user->save();

        return redirect()->back()->with('successubahpass', 'Password berhasil diperbarui!');
    
        } catch (\Exception $e) {

            return back()->with('errorubahpass', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
