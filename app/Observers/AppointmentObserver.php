<?php

namespace App\Observers;

use App\Services\DashboardService;
use Illuminate\Support\Facades\Cache;

/**
 * AppointmentObserver
 * Auto clear cache when appointments are created/updated/deleted
 */
class AppointmentObserver
{
    public function created($appointment)
    {
        $this->clearCache();
    }

    public function updated($appointment)
    {
        $this->clearCache();
    }

    public function deleted($appointment)
    {
        $this->clearCache();
    }

    protected function clearCache()
    {
        Cache::forget(DashboardService::CACHE_KEY_APPOINTMENTS_TOTAL);
        Cache::forget(DashboardService::CACHE_KEY_APPOINTMENTS_INCREASE);
    }
}