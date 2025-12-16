<?php

namespace App\Helpers;

use App\Models\GalleryBrochure;
use App\Models\BrochureDownload;
use Illuminate\Support\Facades\Cache;

class BrochureHelper
{
    /**
     * Get active brochure for current locale
     */
    public static function getActiveBrochure(string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        // Cache for 1 hour
        return Cache::remember("active_brochure_{$locale}", 3600, function () use ($locale) {
            return GalleryBrochure::with([
                'translations' => function($query) use ($locale) {
                    $query->where('locale', $locale);
                }
            ])
            ->where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->first();
        });
    }

    /**
     * Get brochure URL with tracking
     *
     * @param string|null $locale
     * @param bool $isMobile
     * @param string $method 'controller'|'direct'|'redirect'
     * @return string|null
     */
    public static function getBrochureUrl(string $locale = null, bool $isMobile = false, string $method = 'controller')
    {
        $brochure = self::getActiveBrochure($locale);

        if (!$brochure) {
            return null;
        }

        $translation = $brochure->translations->first();

        if (!$translation || !$translation->file) {
            return null;
        }

        $locale = $locale ?? app()->getLocale();

        // Method 1: Through controller (recommended - reliable tracking)
        if ($method === 'controller') {
            return route('brochure.download', [
                'id' => $brochure->id,
                'locale' => $locale
            ]);
        }

        // Method 2: Track and redirect (good compromise)
        if ($method === 'redirect') {
            return route('brochure.track', [
                'id' => $brochure->id,
                'locale' => $locale
            ]);
        }

        // Method 3: Direct file URL (requires JavaScript tracking)
        return url('uploads/brochures/files/' . $translation->file);
    }

    /**
     * Get direct file URL (for internal use or JavaScript tracking)
     */
    public static function getDirectFileUrl(string $locale = null)
    {
        $brochure = self::getActiveBrochure($locale);

        if (!$brochure) {
            return null;
        }

        $translation = $brochure->translations->first();

        if (!$translation || !$translation->file) {
            return null;
        }

        // Return direct file URL
        return url('uploads/brochures/files/' . $translation->file);
    }

    /**
     * Track brochure download manually
     */
    public static function trackDownload(int $brochureId, ?string $ipAddress = null, ?string $userAgent = null)
    {
        try {
            BrochureDownload::track(
                $brochureId,
                $ipAddress ?? request()->ip(),
                $userAgent ?? request()->userAgent()
            );
        } catch (\Exception $e) {
            // Silent fail - don't break download if tracking fails
            \Log::error('Brochure download tracking failed: ' . $e->getMessage());
        }
    }

    /**
     * Check if device is mobile
     */
    public static function isMobile()
    {
        $userAgent = request()->header('User-Agent');

        return preg_match('/(android|iphone|ipad|mobile)/i', $userAgent);
    }

    /**
     * Get brochure download link HTML
     *
     * @param string|null $locale
     * @param string $method 'controller'|'direct'|'redirect'
     * @return string
     */
    public static function getBrochureLinkHtml(string $locale = null, string $method = 'controller')
    {
        $locale = $locale ?? app()->getLocale();
        $isMobile = self::isMobile();
        $brochure = self::getActiveBrochure($locale);

        if (!$brochure) {
            return '';
        }

        $mobileClass = $isMobile ? '' : 'd-none';
        $desktopClass = $isMobile ? 'd-none' : '';

        // Method 1 & 2: Through controller or redirect (no JS needed)
        if ($method === 'controller' || $method === 'redirect') {
            $url = self::getBrochureUrl($locale, $isMobile, $method);

            return <<<HTML
                <a href="{$url}" target="_blank" class="hashmb {$mobileClass}">Download Brochure</a>
                <a href="{$url}" target="_blank" class="hashds {$desktopClass}">Download Brochure</a>
            HTML;
        }

        // Method 3: Direct link with JavaScript tracking
        $directUrl = self::getDirectFileUrl($locale);
        $brochureId = $brochure->id;

        return <<<HTML
            <a href="{$directUrl}"
               target="_blank"
               class="hashmb track-brochure-download {$mobileClass}"
               data-brochure-id="{$brochureId}">Download Brochure</a>
            <a href="{$directUrl}"
               target="_blank"
               class="hashds track-brochure-download {$desktopClass}"
               data-brochure-id="{$brochureId}">Download Brochure</a>
        HTML;
    }
}