<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Fasilitas;
use App\Models\Kategori;
use App\Models\Report;
use App\Models\bookingfasilitas;
use App\Observers\FasilitasObserver;
use App\Observers\KategoriObserver;
use App\Observers\ReportObserver;
use App\Observers\BookingFasilitasObserver;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Fasilitas::observe(FasilitasObserver::class);
        Kategori::observe(KategoriObserver::class);
        Report::observe(ReportObserver::class);
        bookingfasilitas::observe(BookingFasilitasObserver::class);
        Paginator::useBootstrap();
        
        config([
            'app.api_base_url' => config('services.api_base_url'),
            'app.storage_url' => config('services.storage_url'),
        ]);
    }
}
