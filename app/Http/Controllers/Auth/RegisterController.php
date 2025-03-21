<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
class RegisterController extends Controller
{
   
    public function register(Request $request)
    {
        
        // Validasi input
        $validator = Validator::make($request->all(), [
            
            'username' => 'required|unique:users,username|max:255',
            'id_card' => 'required|unique:users,id_card|max:5',
            'room_number' => 'required|max:10',
            'password' => 'required|min:8',
            
        ]);
    
        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan, coba kembali!',
                'data' => $validator->errors()
            ], 422);
        }
    
        // Menyimpan data pengguna
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        
        try {
            $user = User::create($input);  // Membuat pengguna baru
    
            // Token untuk autentikasi
            $success['token'] = $user->createToken('auth_token')->plainTextToken;
            $success['username'] = $user->username;
            $success['id_card'] = $user->id_card;
            $success['room_number'] = $user->room_number;
    
            // Mengembalikan data pengguna beserta token
            return response()->json([
                'success' => true,
                'message' => 'Sukses register',
                'data' => $success
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function kelolapengguna(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);
        $users = User::whereIn('role', ['pending', 'nonaktif', 'user', 'admin'])
            ->paginate($perPage);

        if (!empty($users)) {
        return view('Admin.dashboard.main.kelolapengguna',[
            'iconname' => 'Kelola Pengguna',
            'hasilreq1' =>  $users->items(), 
            'pagination' => [
                'current_page' =>  $users->currentPage(),
                'last_page' =>$users->lastPage(), 
                'per_page' =>$users->perPage(),
                'total' => $users->total(),
            ]
        ]);
    }
        return view('Admin.dashboard.main.kelolapengguna', [
            'iconname' => 'Kelola Pengguna',
            'hasilreq1' => [],  
        ])->with('error', "Gagal memuat data.");
        
    }
    
        public function approve(Request $request, $id)
    {
        // Cari user berdasarkan ID
        $user = User::find($id);

        // Periksa apakah user ditemukan
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        // Update status user menjadi approved (misalnya dengan kolom `status`)
        $user->status = 'approved'; // Sesuaikan dengan field yang ada di tabel
        $user->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'User berhasil disetujui.');
    }


        public function delete(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }


        public function reject(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
        $user->status = 'rejected'; 
        $user->save();
        return redirect()->back()->with('success', 'User berhasil ditolak.');
    }


    public function update(Request $request)
    {
        $request->validate([
            'idCard' => 'required|string',  
            'datsta' => 'required|string', 
        ]);
        $user = User::where('id_card', $request->idCard)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
    
        // Update field sesuai kebutuhan
        $user->role = $request->datsta; // Sesuaikan field dengan database
        $user->save();
    
        return redirect()->back()->with('success', 'Data user berhasil diperbarui.');
    }
    

}
