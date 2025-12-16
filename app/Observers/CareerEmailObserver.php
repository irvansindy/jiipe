<?php

namespace App\Observers;

use App\Services\DashboardService;
use Illuminate\Support\Facades\Cache;
class CareerEmailObserver
{
    public function created($careerEmail)
    {
        $this->clearCache();
    }

    public function updated($careerEmail)
    {
        $this->clearCache();
    }

    public function deleted($careerEmail)
    {
        $this->clearCache();
    }

    protected function clearCache()
    {
        Cache::forget(DashboardService::CACHE_KEY_APPLICANTS_TOTAL);
        Cache::forget(DashboardService::CACHE_KEY_APPLICANTS_INCREASE);
    }
}
