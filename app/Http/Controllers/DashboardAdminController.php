<?php


namespace App\Http\Controllers;

use App\Models\bookingfasilitas;
use App\Models\Fasilitas;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function Admindashboard(Request $request)
    { 
        $today = now()->toDateString();
        $totalbooking = bookingfasilitas::all()->count();
        $totalfasilitas = Fasilitas::all()->count();
        $totaluser = User::all()->count();
        $totalreport = Report::all()->count();
        $totaldone = Report::where('status',['Selesai'])->count();
        $totalpending = Report::where('status',['Pending'])->count();
        $totalproses = Report::where('status',['Sedang Diproses'])->count();
        $totalBookings = DB::table('bookingfasilitas')
        ->whereDate('created_at', '=', $today)
        ->count();
        $Bookingstoday = DB::table('bookingfasilitas')
        ->join('fasilitas', 'bookingfasilitas.id_fasilitas', '=', 'fasilitas.id_fasilitas')
        ->select('fasilitas.fasilitas as nama_fasilitas', DB::raw('COUNT(bookingfasilitas.id_booking) as total_bookings')) 
        ->whereDate('bookingfasilitas.created_at', '=', $today)
        ->groupBy('fasilitas.fasilitas') 
        ->orderByDesc('total_bookings') 
        ->first(); 
        $reportPengguna = DB::table('users')
        ->select(
            DB::raw('COUNT(*) as total_user'), 
            DB::raw('SUM(CASE WHEN role = "user" THEN 1 ELSE 0 END) as user'), 
            DB::raw('SUM(CASE WHEN role = "pending" THEN 1 ELSE 0 END) as pending'),
        )
        ->whereDate('created_at', '=', $today) 
        ->first(); 

        $reportSummary = DB::table('reports')
        ->select(
            DB::raw('COUNT(*) as total_reports'),
            DB::raw('SUM(CASE WHEN status = "Pending" THEN 1 ELSE 0 END) as pending'),  
        )
        ->whereDate('created_at', '=', $today) 
        ->first(); 

        $reportupdate = DB::table('reports')
        ->select(
        DB::raw('SUM(CASE WHEN status = "Selesai" THEN 1 ELSE 0 END) as selesai'), 
        DB::raw('SUM(CASE WHEN status = "Sedang Diproses" THEN 1 ELSE 0 END) as sedang_diproses') 
        )
        ->whereDate('updated_at', '=', $today) 
        ->first(); 
        // ->groupBy('username', 'kategori')
        // ->get();
        $fasilitas = DB::table('fasilitas')
        ->leftJoin('bookingfasilitas', function ($join) use ($today) {
            $join->on('fasilitas.id_fasilitas', '=', 'bookingfasilitas.id_fasilitas')
                ->whereDate('bookingfasilitas.created_at', '=', $today);
                //->where('bookingfasilitas.status', '=', 'berhasil')
        })
        ->select(
            DB::raw('COUNT(DISTINCT fasilitas.id_fasilitas) as total_fasilitas'),
            DB::raw('COUNT(DISTINCT bookingfasilitas.id_fasilitas) as fasilitas_digunakan')
        )
        ->first();


        return view('Admin.dashboard.main.dashboard', [
            'iconname' => 'Dashboard',
            'totals' => [
                'total_booking' => $totalbooking ?? 0,
                'total_fasilitas' => $totalfasilitas ?? 0,
                'total_user' => $totaluser ?? 0,
                'total_report' => $totalreport ?? 0,
                'total_done' => $totaldone ?? 0,
                'total_pending' => $totalpending ?? 0,
                'total_proses' => $totalproses ?? 0,
            ],
            'top_facility_today' => $totalBookings ?? 0,
            'topBookings' => [
                'nama_fasilitas' => $Bookingstoday->nama_fasilitas ?? 0,
                'topBookings' => $Bookingstoday->total_bookings ?? 0,
            ],
            'user_summary' => [
                'total_user' => $reportPengguna->total_user ?? 0,
                'user_role' => $reportPengguna->user ?? 0,
                'pending_role' => $reportPengguna->pending ?? 0,
            ],
            'report_summary' => [
                'total_reports' => $reportSummary->total_reports ?? 0,
                'selesai' => $reportupdate->selesai ?? 0,
                'pending' => $reportSummary->pending ?? 0,
                'sedang_diproses' => $reportupdate->sedang_diproses ?? 0,
            ],
            'facility_summary' => [
                'total_fasilitas' => $fasilitas->total_fasilitas ?? 0,
                'fasilitas_digunakan' => $fasilitas->fasilitas_digunakan ?? 0,
            ],

        ]);
        
    }
}