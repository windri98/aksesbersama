<?php

namespace App\Observers;

use App\Models\Kategori;
use Illuminate\Support\Facades\Cache;

class KategoriObserver
{
    public function updated(Kategori $kategori)
    {
        Cache::forget('kategori');
    }

    public function deleted(Kategori $kategori)
    {
        Cache::forget('kategori');
    }

    public function created(Kategori $kategori)
    {
        Cache::forget('kategori');
    }
}

