<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\HomeSlider;
use App\Models\HomeSliderTranslation;
use App\Models\AreaShowCase;
use App\Models\AreaShowCaseTranslation;


use App\Models\Tenant;
use App\Models\TenantTranslation;

class HomeController extends Controller
{
    public function getSliders()
    {
        $locale = app()->getLocale();
        $cacheKey = "home_sliders_{$locale}";
        $sliders = Cache::remember($cacheKey, 3600, function () use ($locale) {
            return HomeSlider::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale)->where('is_active', 1);
            }])->get()->map(function($slider) use ($locale) {
                $trans = $slider->translations->first();
                return [
                    'file' => $slider->file,
                    'title' => $trans ? $trans->title : '',
                    'description' => $trans ? $trans->description : '',
                ];
            });
        });
        return $sliders;
    }

    public function getAreaShowcases()
    {
        $locale = app()->getLocale();
        $cacheKey = "area_showcases_{$locale}";
        $showcases = Cache::remember($cacheKey, 3600, function () use ($locale) {
            return AreaShowCase::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale);
            }])
            ->where('is_active', 1)
            ->orderBy('position')
            ->get()
            ->map(function($showcase) use ($locale) {
                $trans = $showcase->translations->first();
                return [
                    'image' => $showcase->image,
                    'title' => $trans ? $trans->title : '',
                    'description' => $trans ? $trans->description : '',
                ];
            });
        });
        return $showcases;
    }

    public function getTenants()
    {
        $locale = app()->getLocale();
        $cacheKey = "tenants_{$locale}";
        $tenants = Cache::remember($cacheKey, 3600, function () use ($locale) {
            return Tenant::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale);
            }])
            ->where('is_active', 1)
            ->get()
            ->map(function($tenant) use ($locale) {
                $trans = $tenant->translations->first();
                return [
                    'logo' => $tenant->logo,
                    'name' => $trans ? $trans->name : '',
                ];
            });
        });
        return $tenants;
    }
}
