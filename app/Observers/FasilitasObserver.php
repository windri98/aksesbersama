<?php

namespace App\Observers;

use App\Models\Fasilitas;
use Illuminate\Support\Facades\Cache;

class FasilitasObserver
{
    // Hapus cache saat fasilitas diubah, dibuat, atau dihapus
    public function updated(Fasilitas $fasilitas)
    {
        $this->clearCache($fasilitas);
    }

    public function deleted(Fasilitas $fasilitas)
    {
        $this->clearCache($fasilitas);
    }

    public function created(Fasilitas $fasilitas)
    {
        $this->clearCache($fasilitas);
    }

    // Fungsi untuk menghapus cache
    private function clearCache(Fasilitas $fasilitas)
    {
        Cache::forget("fasilitas-{$fasilitas->id_fasilitas}");
        Cache::forget('fasilitas');
        Cache::forget("bookings-last-{$fasilitas->id_fasilitas}");
        Cache::forget("bookings-total-{$fasilitas->id_fasilitas}");
    }
}
