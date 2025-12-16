<?php

namespace App\Observers;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Cache;
class BrochureDownloadObserver
{
    public function created($download)
    {
        $this->clearCache();
    }

    public function deleted($download)
    {
        $this->clearCache();
    }

    protected function clearCache()
    {
        Cache::forget(DashboardService::CACHE_KEY_BROCHURE_TOTAL);
        Cache::forget(DashboardService::CACHE_KEY_BROCHURE_INCREASE);
    }
}
