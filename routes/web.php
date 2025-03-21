<?php

use GuzzleHttp\Middleware;
use App\Exports\KeluhanKamar;
use App\Models\Complaintkamar;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReportUserController;
use App\Http\Controllers\UserProsesController;
use App\Http\Controllers\BookingUserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\BookingfasilitasController; 
use App\Http\Controllers\NotificationSetupController; 


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'Adminlogin']);

Route::fallback(function () {
    return redirect('/login');
});

Route::middleware('IsAdmin')->group(function () {
Route::get('/logoutadmin', [LoginController::class, 'logout'])->name('logoutadmin');
Route::get('/Admindashboard', [DashboardAdminController::class, 'Admindashboard'])->name('Admindashboard');
// Route::get('/dashboard', function () {
//     return view('dashboard.main.dashboard',[
//         'iconname' => 'Dashboard',
//     ]);
// })->name('dashboard')


Route::get('/export/{id}', [ReportController::class, 'export'])->name('export');
Route::post('/pushnotif', [NotificationSetupController::class, 'notification'])->name('pushnotif');
Route::get('/kelolapengguna', [RegisterController::class, 'kelolapengguna'])->name('kelolapengguna');
Route::get('/approve/{id}', [RegisterController::class, 'approve'])->name('approve');
Route::get('/delete/{id}', [RegisterController::class, 'delete'])->name('delete');
Route::put('/update', [RegisterController::class, 'update'])->name('update');
Route::get('/reject/{id}', [RegisterController::class, 'reject'])->name('reject');

Route::put('/proses/{id}', [ReportController::class, 'update'])->name('proses');
Route::get('/donecomplaint/{id}', [ReportController::class, 'donecomplaint'])->name('donecomplaint');
// Route::get('/export/{id}', [ReportController::class, 'export'])->name('export');
Route::get('/keluhanpengaduan', [ReportController::class, 'keluhanpengaduan'])->name('keluhanpengaduan');

Route::get('/kelolafasilitas', [FasilitasController::class, 'LihatSemuaFasilitas'])->name('kelolafasilitas');
Route::post('/TambahFasilitas', [FasilitasController::class, 'TambahFasilitas'])->name('TambahFasilitas');
Route::post('/UpdateFasilitas/{id}', [FasilitasController::class, 'UpdateFasilitas'])->name('UpdateFasilitas');
Route::get('/deletefasilitas/{id}', [FasilitasController::class, 'deletefasilitas'])->name('deletefasilitas1');

Route::get('/deletebooking/{id}', [BookingfasilitasController::class, 'deletebooking'])->name('deletefasilitas');
Route::get('/kelolabooking', [BookingfasilitasController::class, 'kelolabooking'])->name('kelolabooking');

Route::post('/reject', [BookingfasilitasController::class, 'reject'])->name('reject1');
Route::post('/approve', [BookingfasilitasController::class, 'approve'])->name('approve1');
Route::post('/updatebookingadmin', [BookingfasilitasController::class, 'updatebooking'])->name('updatebookingadmin');

});
Route::get('/bookings/last-six-months', [BookingfasilitasController::class, 'getBookingData']);
Route::get('/bookings/{filterType}', [BookingfasilitasController::class, 'getBookings']);
// Route::get('/kelolapengguna', function () {
//     return response()->view('dashboard.main.kelolapengguna');
// })->name('kelolapengguna');








Route::post('/regispage', [UserProsesController::class, 'register'])->name('regispage');
Route::post('/loginuser', [UserProsesController::class, 'login'])->name('loginuser');

// Route::middleware( 'throttle.redirect:5,1')->group(function () {
Route::middleware('authuser')->group(function () {

Route::get('/logout', [UserProsesController::class, 'logout'])->name('logout');

Route::get('/profil', [UserProsesController::class, 'profil'])->name('profil');

Route::get('/ubahpassword', [UserProsesController::class, 'ubahpassword'])->name('ubahpassword');

Route::get('/history', [UserProsesController::class, 'history'])->name('history');

Route::get('/jadwalsaya', [UserProsesController::class, 'jadwalsaya'])->name('jadwalsaya');

Route::post('/ubahpassword', [UserProsesController::class, 'updatePassword'])->name('ubahpassword12');
//----------------------------------------------------------------------------------------------
Route::get('/bookingfasilitas/{id}', [BookingUserController::class, 'index'])->name('bookingfasilitas');

Route::get('/detailreport/{id}', [ReportUserController::class, 'detail'])->name('detailreport');

//Route::middleware(['savePreviousUrl'])->group(function () {
Route::get('/back', function () {
    //$previousUrl = session('previous_url', url('/dashboard')); // Default ke dashboard
    //return redirect()->to($previousUrl);
    return redirect('/dashboarduser');
})->name('back');

Route::get('/editjadwal/{id}', [BookingUserController::class, 'editjadwal'])->name('editjadwal');

Route::Post('/createbooking/{id}', [BookingUserController::class, 'create'])->name('createbooking');

Route::Post('/createmetting/{id}', [BookingUserController::class, 'createmetting'])->name('createmetting');

Route::put('/updatebooking/{id}', [BookingUserController::class, 'update'])->name('updatebooking');

Route::put('/updatebookingmetting/{id}', [BookingUserController::class, 'updatemetting'])->name('updatebookingmetting');

Route::get('/deletebooking/{id}', [BookingUserController::class, 'delete'])->name('deletebooking');

Route::get('/cekjadwal', [BookingUserController::class, 'getUnavailableTimes'])->name('cekjadwal');

Route::get('/booking', [UserProsesController::class, 'showBookingPage'])->name('booking.page');

Route::get('/getkategori/{id}', [UserProsesController::class, 'GetKategori'])->name('getkategori');

Route::post('/createreport', [ReportUserController::class, 'create'])->name('createreport');

Route::get('/dashboarduser', [DashboardUserController::class, 'dashboard'])->name('dashboarduser');

});

Route::get('/list-fasilitas/{id}', [BookingUserController::class, 'LihatFasilitas']); 
Route::get('/unavailable-dates-1', [BookingUserController::class, 'getUnavailableDates1']);
Route::get('/unavailable-dates-2', [BookingUserController::class, 'getUnavailableDates2']);
Route::get('/fetch-unavailable-times', [BookingUserController::class, 'fetchUnavailableTimes']);
Route::get('/myriquesbeliar', [BookingUserController::class, 'myriquesbeliar'])->name('api.myriquesbeliar');
Route::get('/unavailable-times', [BookingUserController::class, 'getUnavailableTimes']);
// Route::middleware('auth:sanctum')->get('/validate', function (Request $request) {
//     return response()->json([
//         'message' => 'Token valid.',
//         'user' => $request->user(),
//     ]);
// });
Route::get('/', [DashboardUserController::class, 'index'])->name('index');

Route::get('/index', function () {
    return redirect('/');
});
