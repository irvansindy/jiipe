<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\HomeSlider;
use App\Models\AreaShowCase;
use App\Models\Tenant;
use App\Models\VideoTour;
use App\Models\Review;
use App\Models\FrequentlyAskedQuestions;
use App\Models\News;

class HomeController extends Controller
{
    /**
     * ⚡ OPTIMIZED: Single method untuk fetch ALL data sekaligus
     * Mengurangi query dari 7 calls menjadi 1 call
     */
    public function index()
    {
        $locale = app()->getLocale();
        $cacheKey = "home_all_data_{$locale}";

        // Cache seluruh data home page selama 1 jam
        $data = Cache::remember($cacheKey, 3600, function () use ($locale) {
            return [
                'sliders' => $this->fetchSliders($locale),
                'showcases' => $this->fetchAreaShowcases($locale),
                'tenants' => $this->fetchTenants($locale),
                'videoTours' => $this->fetchVideoTours($locale),
                'reviews' => $this->fetchReviews($locale),
                'faqs' => $this->fetchFaqs($locale),
                'news' => $this->fetchNews($locale),
            ];
        });

        return view('layouts.client.home.index', $data);
    }

    /**
     * ⚡ OPTIMIZED: Eager loading translations untuk menghindari N+1
     */
    private function fetchSliders($locale)
    {
        $sliders = HomeSlider::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale);
            }])
            ->where('is_active', 1)
            ->orderBy('id', 'asc')
            ->get()
            ->map(function($slider) {
                $trans = $slider->translations->first();
                return [
                    'file' => $slider->file,
                    'title' => $trans?->title ?? '',
                    'description' => $trans?->description ?? '',
                ];
            });

        // ⚡ Convert Collection to Array untuk compatibility
        return $sliders->toArray();
    }

    private function fetchAreaShowcases($locale)
    {
        $showcases = AreaShowCase::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale);
            }])
            ->where('is_active', 1)
            ->orderBy('position', 'asc')
            ->get()
            ->map(function($showcase) {
                $trans = $showcase->translations->first();
                return [
                    'image' => $showcase->image,
                    'title' => $trans?->title ?? '',
                    'description' => $trans?->description ?? '',
                ];
            });

        return $showcases->toArray();
    }

    private function fetchTenants($locale)
    {
        $tenants = Tenant::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale);
            }])
            ->where('is_active', 1)
            ->orderBy('id', 'asc')
            ->get()
            ->map(function($tenant) {
                $trans = $tenant->translations->first();
                return [
                    'logo' => $tenant->logo,
                    'name' => $trans?->name ?? '',
                ];
            });

        return $tenants->toArray();
    }

    private function fetchVideoTours($locale)
    {
        $tours = VideoTour::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale);
            }])
            ->where('is_active', 1)
            ->orderBy('position', 'asc')
            ->limit(1)
            ->get()
            ->map(function($tour) {
                $trans = $tour->translations->first();
                return [
                    'embed_code' => $tour->embed_code,
                    'thumbnail' => $tour->thumbnail,
                    'title' => $trans?->title ?? '',
                    'description' => $trans?->description ?? '',
                ];
            });

        return $tours->toArray();
    }

    private function fetchReviews($locale)
    {
        $reviews = Review::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale);
            }])
            ->where('is_active', 1)
            ->orderBy('id', 'asc')
            ->get()
            ->map(function($review) {
                $trans = $review->translations->first();
                return [
                    'name' => $review->name,
                    'description' => $trans?->description ?? '',
                    'photo' => $review->photo,
                    'position' => $review->position,
                ];
            });

        return $reviews->toArray();
    }

    private function fetchFaqs($locale)
    {
        $faqs = FrequentlyAskedQuestions::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale);
            }])
            ->where('is_active', 1)
            ->orderBy('position', 'asc')
            ->get()
            ->map(function($faq) {
                $trans = $faq->translations->first();
                return [
                    'question' => $trans?->question ?? '',
                    'answer' => $trans?->answer ?? '',
                ];
            });

        return $faqs->toArray();
    }

    private function fetchNews($locale)
    {
        $news = News::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale);
            }])
            ->where('is_published', 1)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function($newsItem) {
                $trans = $newsItem->translations->first();
                return [
                    'id' => $newsItem->id,
                    'title' => $trans?->title ?? '',
                    'content' => $trans?->content ?? '',
                    'thumbnail' => $newsItem->thumbnail,
                    'created_at' => $newsItem->created_at?->format('F d, Y'),
                ];
            });

        return $news->toArray();
    }

    /**
     * ⚡ BACKWARD COMPATIBILITY: Keep old methods untuk legacy views
     * Tapi sekarang menggunakan cache yang sudah di-fetch di index()
     */
    public function getSliders()
    {
        $locale = app()->getLocale();
        $cacheKey = "home_all_data_{$locale}";
        $allData = Cache::get($cacheKey);

        return $allData['sliders'] ?? $this->fetchSliders($locale);
    }

    public function getAreaShowcases()
    {
        $locale = app()->getLocale();
        $cacheKey = "home_all_data_{$locale}";
        $allData = Cache::get($cacheKey);

        return $allData['showcases'] ?? $this->fetchAreaShowcases($locale);
    }

    public function getTenants()
    {
        $locale = app()->getLocale();
        $cacheKey = "home_all_data_{$locale}";
        $allData = Cache::get($cacheKey);

        return $allData['tenants'] ?? $this->fetchTenants($locale);
    }

    public function getVideoTours()
    {
        $locale = app()->getLocale();
        $cacheKey = "home_all_data_{$locale}";
        $allData = Cache::get($cacheKey);

        return $allData['videoTours'] ?? $this->fetchVideoTours($locale);
    }

    public function getReviews()
    {
        $locale = app()->getLocale();
        $cacheKey = "home_all_data_{$locale}";
        $allData = Cache::get($cacheKey);

        return $allData['reviews'] ?? $this->fetchReviews($locale);
    }

    public function getFaqs()
    {
        $locale = app()->getLocale();
        $cacheKey = "home_all_data_{$locale}";
        $allData = Cache::get($cacheKey);

        return $allData['faqs'] ?? $this->fetchFaqs($locale);
    }

    public function getNews()
    {
        $locale = app()->getLocale();
        $cacheKey = "home_all_data_{$locale}";
        $allData = Cache::get($cacheKey);

        return $allData['news'] ?? $this->fetchNews($locale);
    }

    /**
     * ⚡ HELPER: Clear cache when data updated
     */
    public static function clearCache()
    {
        $locales = ['en', 'id', 'zh', 'ja', 'ko', 'tw']; // Adjust sesuai locales Anda

        foreach ($locales as $locale) {
            Cache::forget("home_all_data_{$locale}");

            // Clear old individual caches juga
            Cache::forget("home_sliders_{$locale}");
            Cache::forget("area_showcases_{$locale}");
            Cache::forget("tenants_{$locale}");
            Cache::forget("video_tours_{$locale}");
            Cache::forget("reviews_{$locale}");
            Cache::forget("faqs_{$locale}");
            Cache::forget("home_news_{$locale}");
        }
    }
}