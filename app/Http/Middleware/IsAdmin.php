<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('id_card')) {
            return redirect()->route('login')->with('errorlogin', 'Anda harus login terlebih dahulu.');
        }
        

        if (session('role') !== 'admin') {
            return back()->withErrors(['login' => 'Anda Bukan Admin ']);
        }
        return $next($request);
    }
}
