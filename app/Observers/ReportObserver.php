<?php

namespace App\Observers;

use App\Models\Report;
use Illuminate\Support\Facades\Cache;

class ReportObserver
{
    public function updated(Report $report)
    {
        $this->clearCache($report);
    }

    public function deleted(Report $report)
    {
        $this->clearCache($report);
    }

    public function created(Report $report)
    {
        $this->clearCache($report);
    }

    private function clearCache(Report $report)
    {
        Cache::forget('reports');
        Cache::forget("reports-requests-{$report->username}");
    }
}
