<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class authuser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!session()->has('id_card')) {
            return redirect()->route('index')->with('errorlogin', 'Anda harus login terlebih dahulu.');
        }
        // $apiToken = session('api_token');
        // if (!$apiToken) {
        //     session()->flush();
        //     return redirect()->route('index')->with('errorlogin', 'Sesi Anda telah berakhir. Silakan login ulang.');
        // }
        if (!Auth::check()) {
            $request->session()->flush();
            $request->session()->regenerateToken();
            return redirect()->route('index')->with('errorlogin', 'Silakan login terlebih dahulu.');
        }

        // $response = Http::withToken($apiToken)
        // ->get(env('API_BASE_URL') . '/validate');
        // if ($response->failed()) {
        //     session()->flush();
        //     return redirect()->route('index')->with('errorlogin', 'Sesi Anda telah berakhir. Silakan login ulang.');
        // }
        return $next($request);
    }
}
