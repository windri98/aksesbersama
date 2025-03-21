<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\bookingfasilitas;
use Carbon\Carbon;

class ClearExpiredBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear-expired-bookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ambil waktu 3 bulan yang lalu
        $threeMonthsAgo = Carbon::now()->subMonths(3)->format('Y-m-d H:i:s');
        $this->info("Waktu 3 bulan yang lalu: $threeMonthsAgo");

        // Ambil data yang akan dihapus (DEBUG)
        $toDelete = BookingFasilitas::where('status', 'selesai')
            ->whereRaw("STR_TO_DATE(CONCAT(date, ' ', end_time), '%Y-%m-%d %H:%i:%s') < ?", [$threeMonthsAgo])
            ->get();

        if ($toDelete->isEmpty()) {
            $this->info("Tidak ada pemesanan kadaluarsa dengan status 'selesai' untuk dihapus.");
            return;
        }

        // Log ID booking yang akan dihapus
        $this->info("ID Booking yang akan dihapus: " . $toDelete->pluck('id_booking')->implode(', '));
        $this->info("Total data yang akan dihapus: " . $toDelete->count());

        // Hapus data
        $deletedCount = BookingFasilitas::whereIn('id_booking', $toDelete->pluck('id_booking'))->delete();

        // Log hasil eksekusi
        $this->info("$deletedCount pemesanan dengan status 'selesai' yang kadaluarsa telah dihapus.");
    }
}
