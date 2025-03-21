<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\UserActivityEvent;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function index()
    {
        if (session()->has('username') && session()->has('id_card')) {
            return redirect()->route('Admindashboard');
        }
        return view('Admin.auth.login');
    }

    public function Adminlogin(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            // Cek kredensial menggunakan Auth
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                $user = Auth::user();

                // Simpan data user ke dalam session
                session([
                    'id_card' => $user->id_card,
                    'username' => $user->username,
                    'no_kamar' => $user->room_number,
                    'role' => $user->role,
                ]);

                return redirect()->route('Admindashboard')->with('success', 'Login berhasil.');
            }

            return back()->withErrors(['login' => 'Username atau password salah.']);
        } catch (\Exception $e) {
            return back()->withErrors(['login' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        try {
            if (!session()->has('username')) {
                return redirect()->route('login')->withErrors(['logout' => 'Tidak ada sesi login yang aktif.']);
            }

            Auth::logout();
            session()->flush();

            return redirect()->route('login')->with('success', 'Logout berhasil.');
        } catch (\Exception $e) {
            return redirect()->route('Admindashboard')->withErrors(['logout' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }


    // public function logout(Request $request)
    // {
    //     $user = $request->user();
    //     if (!$user) {
    //         return response()->json(['message' => 'Unauthenticated.'], 401);
    //     }
    //     $user->tokens()->delete();
    //     return response()->json(['message' => 'Logout berhasil'], 200);
    // }

    public function getUser(Request $request): JsonResponse
    {
        $user = Auth::user();
        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function pushnotif(Request $request)
    { 
     

        $response1 = Http::post(env('API_BASE_URL') .'/api' . '/notification', [
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        if ($response1->successful()) {
            return redirect()->back()->with('success', 'Notification berhasil diupdate');
        } else {
            $errorMessage = $response1->json()['message'] ?? 'Terjadi kesalahan.';
            $errors = $response1->json()['errors'] ?? [];
            if (!empty($errors)) {
                return back()->with('errors', $errorMessage)->withErrors($errors)->withInput();
            }
            return back()->with('errors', $errorMessage)->withInput();
        }
    }

    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Kata sandi saat ini salah'
            ], 400);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Password Berhasil Diubah'
        ]);
    }
}
