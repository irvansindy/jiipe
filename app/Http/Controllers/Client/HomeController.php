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
    public function getVideoTours()
    {
        $locale = app()->getLocale();
        $cacheKey = "video_tours_{$locale}";
        $tours = Cache::remember($cacheKey, 3600, function () use ($locale) {
            return VideoTour::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale);
            }])
            ->where('is_active', 1)
            ->orderBy('position')
            ->get()
            ->map(function($tour) use ($locale) {
                $trans = $tour->translations->first();
                return [
                    'embed_code' => $tour->embed_code,
                    'thumbnail' => $tour->thumbnail,
                    'title' => $trans ? $trans->title : '',
                    'description' => $trans ? $trans->description : '',
                ];
            });
        });
        return $tours;
    }
    public function getReviews()
    {
        $locale = app()->getLocale();
        $cacheKey = "reviews_{$locale}";
        $reviews = Cache::remember($cacheKey, 3600, function () use ($locale) {
            return Review::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale);
            }])
            ->where('is_active', 1)
            ->get()
            ->map(function($review) use ($locale) {
                $trans = $review->translations->first();
                return [
                    'name' => $review ? $review->name : '',
                    'description' => $trans ? $trans->description : '',
                    'photo' => $review->photo,
                    'position' => $review ? $review->position : '',
                ];
            });
        });
        return $reviews;
    }

    public function getFaqs()
    {
        $locale = app()->getLocale();
        $cacheKey = "faqs_{$locale}";
        $faqs = Cache::remember($cacheKey, 3600, function () use ($locale) {
            return FrequentlyAskedQuestions::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale);
            }])
            ->where('is_active', 1)
            ->orderBy('position')
            ->get()
            ->map(function($faq) use ($locale) {
                $trans = $faq->translations->first();
                return [
                    'question' => $trans ? $trans->question : '',
                    'answer' => $trans ? $trans->answer : '',
                ];
            });
        });
        return $faqs;
    }

    public function getNews()
{
    $locale = app()->getLocale();
    $cacheKey = "home_news_{$locale}";

    $news = Cache::remember($cacheKey, 3600, function () use ($locale) {
        return News::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale);
            }])
            ->where('is_published', 1)
            ->orderBy('created_at', 'desc') // ✅ gunakan kolom pengurutan yang benar
            ->take(3)
            ->get()
            ->map(function($newsItem) use ($locale) {
                $trans = $newsItem->translations->first();

                return [
                    'id'         => $newsItem->id,
                    'title'       => $trans?->title ?? '',
                    'content'     => $trans?->content ?? '',
                    'thumbnail'   => $newsItem->thumbnail,
                    'created_at'  => optional($newsItem->created_at)->format('F d, Y'), // opsional format
                ];
            });
    });

    return $news;
}

}
