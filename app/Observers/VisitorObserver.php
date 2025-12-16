<?php

namespace App\Observers;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Cache;
class VisitorObserver
{
    public function created($visitor)
    {
        $this->clearCache();
    }

    public function deleted($visitor)
    {
        $this->clearCache();
    }

    protected function clearCache()
    {
        Cache::forget(DashboardService::CACHE_KEY_VISITORS_WEEKLY);
        Cache::forget(DashboardService::CACHE_KEY_VISITORS_MONTHLY);
        Cache::forget(DashboardService::CACHE_KEY_TOP_PAGES);
    }
}
