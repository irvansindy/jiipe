<?php

namespace App\Observers;

use App\Http\Controllers\Client\HomeController;

/**
 * ⚡ CACHE OBSERVER
 * Auto-clear home page cache ketika data diupdate
 *
 * Usage: Daftarkan observer ini di AppServiceProvider
 */
class HomeCacheObserver
{
    /**
     * Handle "created" event
     */
    public function created($model)
    {
        $this->clearHomeCache();
    }

    /**
     * Handle "updated" event
     */
    public function updated($model)
    {
        $this->clearHomeCache();
    }

    /**
     * Handle "deleted" event
     */
    public function deleted($model)
    {
        $this->clearHomeCache();
    }

    /**
     * Clear all home page caches
     */
    private function clearHomeCache()
    {
        HomeController::clearCache();
    }
}