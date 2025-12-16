<?php

namespace App\Observers;

use App\Services\DashboardService;
use Illuminate\Support\Facades\Cache;
class CareerObserver
{
    public function created($career)
    {
        $this->clearCache();
    }

    public function updated($career)
    {
        $this->clearCache();
    }

    public function deleted($career)
    {
        $this->clearCache();
    }

    protected function clearCache()
    {
        Cache::forget(DashboardService::CACHE_KEY_JOB_VACANCIES_TOTAL);
    }
}
