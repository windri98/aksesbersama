<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        // Validasi ID Card
        $request->validate([
            'id_card' => 'required|exists:users,id_card',
        ]);     
        // Mengirim token ke email
        $status = Password::sendResetLink(
            $request->only('id_card')
        );
        
        return $this->responseMessage($status, 'Link reset password telah dikirim!', 'Gagal mengirim link reset password.');
    }
    public function resetPassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_card' => 'required|exists:users,id_card',
            'password' => 'required|confirmed|min:6',
            'token' => 'required',
        ]);
        
        // Melakukan reset password
        $status = Password::reset(
            $request->only('id_card', 'password', 'token'),
            function ($user) use ($request) {
                // Mengubah password pengguna
                $user->forceFill([
                    'password' => Hash::make($request->password),
                ])->setRememberToken(Str::random(60));
                $user->save();
                // Login otomatis setelah reset password
                Auth::login($user);
            }
        );
        
        return $this->responseMessage($status, 'Password berhasil diubah!', __('passwords.user'));
    }
    protected function responseMessage($status, $successMessage, $errorMessage)
    {
        if ($status == Password::RESET_LINK_SENT || $status == Password::PASSWORD_RESET) {
            return response()->json(['status' => $successMessage], 200);
        }

        return response()->json(['error' => $errorMessage], 500);
    }
}