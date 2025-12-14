<?php

namespace App\Helpers;

use App\Models\GalleryBrochure;
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
     * Get brochure file URL for current locale
     */
    public static function getBrochureUrl(string $locale = null, bool $isMobile = false)
    {
        $brochure = self::getActiveBrochure($locale);

        if (!$brochure) {
            return null;
        }

        $translation = $brochure->translations->first();

        if (!$translation || !$translation->file) {
            return null;
        }

        // Return full URL
        return url('uploads/brochures/files/' . $translation->file);
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
     */
    public static function getBrochureLinkHtml(string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $isMobile = self::isMobile();
        $url = self::getBrochureUrl($locale, $isMobile);

        if (!$url) {
            return '';
        }

        $mobileClass = $isMobile ? '' : 'd-none';
        $desktopClass = $isMobile ? 'd-none' : '';

        return <<<HTML
            <a href="{$url}" target="_blank" class="hashmb {$mobileClass}">Download Brochure</a>
            <a href="{$url}" target="_blank" class="hashds {$desktopClass}">Download Brochure</a>
        HTML;
    }
}