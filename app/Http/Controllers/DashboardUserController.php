<?php

namespace App\Http\Controllers;
use App\Models\Report;
use App\Models\fasilitas;
use Illuminate\Http\Request;
use App\Models\bookingpending;
use App\Models\bookingfasilitas;
use App\Models\Kategori;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class DashboardUserController extends Controller
{
    //
    public function dashboard(Request $request)
    {

        $cacheTime = 60 * 180; 
        $user = Auth::user();

        $bookings = Cache::remember('bookings-with-fasilitas', $cacheTime, function () {
            return bookingfasilitas::with('fasilitas')->has('fasilitas')->get();
        });

       Cache::remember('kategori', $cacheTime, function () use ($bookings){
           return 
                     Kategori::all();
                 
                });
  
    //---------------------------------------------------------------------------------------  
        $reports  = Cache::remember("reports-requests-{$user->username}", $cacheTime, function () use ($user) {
            return Report::where('username', $user->username)
                ->whereIn('status', ['Pending', 'Sedang Diproses', 'Selesai'])
                ->with(['reportImages'])
                ->get();
        });

    //---------------------------------------------------------------------------------------1
     
      
        Cache::remember('merged-bookings', $cacheTime, function () use ($bookings) {
            return $bookings->map(function ($booking) {
                $bookingPending = bookingpending::where('id_booking', $booking->id_booking)->first();
                return [
                    'booking' => $booking, 
                    'pending' => $bookingPending, 
                ];
            });
        });

    //---------------------------------------------------------------------------------------2
        $bookingsaya = Cache::remember("bookings-{$user->username}", $cacheTime, function () use ($user) {
            return bookingfasilitas::where('username', $user->username)
                ->with('fasilitas')
                ->has('fasilitas')
                ->get();
        });

    //---------------------------------------------------------------------------------------3
            return view('user.user.dashboard', [
                'reports' => $reports,
                'bookingsaya' => $bookingsaya,
                'iconname' => '',
            ]);

    }
    public function index()
    {
        $cacheTime = 60 * 180; 
        if (session()->has('username') && session()->has('id_card')) {
            return redirect()->route('dashboarduser');
        }

        Cache::remember('fasilitas', $cacheTime, function () {
            $fasilitas = Fasilitas::with([
                'bookings' => function ($query) {
                    $query->orderBy('id_booking', 'desc')->limit(1);
                }
            ])->get();
            
            return $fasilitas->map(function ($getdata) {
                return [
                    'fasilitas' => $getdata,
                    'last_booking' => $getdata->bookings->first() ?? null,
                    'total_booking' => $getdata->bookings->count(),
                ];
            });
        });
        Cache::remember('reports', $cacheTime, function ()  {
            return Report::whereIn('status', ['Pending', 'Sedang Diproses'])
                ->with(['reportImages'])
                ->get();
        });

            return view('User.home', [
                // 'hasilreq1' => !empty($data2) ? $data2 : [], // Pastikan selalu array
                // 'hasilreq2' => !empty($data1) ? $data1 : [], // Pastikan selalu array
                // 'iconname' => 'Akses',
            ]);
   
    }

}
