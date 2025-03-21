<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\bookingfasilitas;
use Carbon\Carbon;

class UpdateBookingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-booking-status';

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
        $currentDateTime = Carbon::now(); // Ambil waktu saat ini
        $this->info("Waktu sekarang: " . $currentDateTime);

        // Ambil semua data yang memenuhi syarat
        $expiredBookings = bookingfasilitas::whereIn('status', ['pending', 'berhasil'])
            ->whereRaw("STR_TO_DATE(CONCAT(date, ' ', end_time), '%Y-%m-%d %H:%i:%s') < ?", [$currentDateTime])
            ->get();

        $this->info("Jumlah booking yang akan diperbarui: " . $expiredBookings->count());
        $this->info("ID Booking yang akan diperbarui: " . $expiredBookings->pluck('id_booking')->implode(', '));

        // Proses data satu per satu
        foreach ($expiredBookings as $booking) {
            $booking->status = 'selesai';
            $booking->save();

            $this->info("Booking ID {$booking->id_booking} telah diperbarui ke status selesai.");
        }

        $this->info("Total " . $expiredBookings->count() . " booking telah diperbarui.");
        return self::SUCCESS;
    }
}
