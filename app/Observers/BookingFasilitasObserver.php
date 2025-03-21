<?php

namespace App\Observers;

use App\Models\bookingfasilitas;
use Illuminate\Support\Facades\Cache;

class BookingFasilitasObserver
{
    public function updated(bookingfasilitas $booking)
    {
        $this->clearCache($booking);
    }

    public function deleted(bookingfasilitas $booking)
    {
        $this->clearCache($booking);
    }

    public function created(bookingfasilitas $booking)
    {
        $this->clearCache($booking);
    }
    public function insert(bookingfasilitas $booking)
    {
        $this->clearCache($booking);
    }
    private function clearCache(bookingfasilitas $booking)
    {
        $cacheTime = 60 * 180; 
        Cache::forget("bookings-{$booking->username}");
        Cache::remember("bookings-{$booking->username}", $cacheTime, function () use ($booking) {
            return bookingfasilitas::where('username', $booking->username)
                ->with('fasilitas')
                ->has('fasilitas')
                ->get();
            });
        Cache::forget("bookings-last-{$booking->id_fasilitas}");
        Cache::forget("bookings-total-{$booking->id_fasilitas}");
        Cache::forget('bookings-with-fasilitas');
        Cache::forget('merged-bookings');
    }
}
