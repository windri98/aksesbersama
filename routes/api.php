<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationSetupController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


/* ================== Notifikasi ============== */
Route::post('/save-device/{website?}', [NotificationSetupController::class, 'saveDevice']);
Route::post('/notification', [NotificationSetupController::class, 'notification']);
Route::post('/send_notification/device/{token}', [NotificationSetupController::class, 'oneDeviceNotification']);
