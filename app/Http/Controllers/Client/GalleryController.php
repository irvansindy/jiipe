<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryTranslations;
use App\Models\NewsCategories;
use Illuminate\Support\Str;
use Carbon\Carbon;
class GalleryController extends Controller
{
    /**
     * Display gallery index page with latest videos and option to show photos
     */
    public function index(Request $request)
    {
        $locale = app()->getLocale();
        $type = $request->get('type', 'video');
        // ✅ Deteksi request AJAX dari jQuery (baik by header atau by query string)
        $isAjax = $request->ajax() || $request->get('ajax') == 1 || $request->get('ajax') === '1';


        $categories = NewsCategories::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->get()->map(function ($category) use ($locale) {
            $translation = $category->translations->firstWhere('locale', $locale);
            return [
                'id' => $category->id,
                'name' => $translation?->name ?? '',
                'slug' => $translation ? Str::slug($translation->name) : '',
            ];
        })->filter(fn($cat) => !empty($cat['name']));

        $query = Gallery::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->where('is_active', 1)
            ->whereNotNull('url_video')
            ->orderBy('date_input', 'desc');

        // dd($isAjax);
        // ✅ Default load hanya 3 item
        if ($isAjax) {
            // Saat AJAX (klik View All) → tampilkan semua
            $galleries = $query->get();
        } else {
            // Saat pertama kali load → hanya 3
            $galleries = $query->take(3)->get();
        }

        $videos = $galleries->map(fn($gallery) => $this->formatGallery($gallery, $locale))->filter();

        // Jika AJAX → return partial HTML
        if ($isAjax) {
            return view('layouts.client.gallery._video_items', ['videos' => $videos])->render();
        }

        $data = [
            'title' => __('Gallery - JIIPE'),
            'metaKey' => 'jiipe gallery, jiipe photos, jiipe videos, industrial estate gallery',
            'metaDesc' => __('View photos and videos documenting the development of various industries at JIIPE Gresik'),
            'pageTitle' => __('Gallery'),
            'activeFilter' => 'gallery',
            'categories' => $categories,
            'videos' => $videos,
            'currentType' => $type,
        ];

        return view('layouts.client.gallery.index', compact('data'));
    }

    /**
     * Display all videos page
     */
    public function video(Request $request)
    {
        $locale = app()->getLocale();
        $perPage = 9;

        // Get all categories for navigation
        $categories = NewsCategories::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])->get()->map(function($category) use ($locale) {
            $translation = $category->translations->firstWhere('locale', $locale);
            return [
                'id' => $category->id,
                'name' => $translation ? $translation->name : '',
                'slug' => $translation ? Str::slug($translation->name) : '',
            ];
        })->filter(function($cat) {
            return !empty($cat['name']);
        });

        // Get all videos
        $videosQuery = Gallery::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])
        ->where('is_active', 1)
        ->whereNotNull('url_video')
        ->orderBy('date_input', 'desc');

        $videos = $videosQuery->paginate($perPage);

        // Format videos
        $formattedVideos = $videos->getCollection()->map(function($gallery) use ($locale) {
            return $this->formatGallery($gallery, $locale);
        })->filter();

        $videos->setCollection($formattedVideos);

        $data = [
            'title' => __('Video Gallery - JIIPE'),
            'metaKey' => 'jiipe videos, industrial estate videos, construction videos',
            'metaDesc' => __('Watch videos documenting the development and progress at JIIPE Industrial Estate'),
            'pageTitle' => __('Video Gallery'),
            'activeFilter' => 'gallery',
            'categories' => $categories,
            'videos' => $videos,
            'currentType' => 'video',
        ];

        return view('layouts.client.gallery.video', compact('data'));
    }

    /**
     * Display all photos page
     */
    public function photo(Request $request)
    {
        $locale = app()->getLocale();
        $perPage = 12;

        // Get all categories for navigation
        $categories = NewsCategories::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])->get()->map(function($category) use ($locale) {
            $translation = $category->translations->firstWhere('locale', $locale);
            return [
                'id' => $category->id,
                'name' => $translation ? $translation->name : '',
                'slug' => $translation ? Str::slug($translation->name) : '',
            ];
        })->filter(function($cat) {
            return !empty($cat['name']);
        });

        // Get all photos
        $photosQuery = Gallery::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])
        ->where('is_active', 1)
        ->whereNull('url_video')
        ->orderBy('date_input', 'desc');

        $photos = $photosQuery->paginate($perPage);

        // Format photos
        $formattedPhotos = $photos->getCollection()->map(function($gallery) use ($locale) {
            return $this->formatGallery($gallery, $locale);
        })->filter();

        $photos->setCollection($formattedPhotos);

        $data = [
            'title' => __('Photo Gallery - JIIPE'),
            'metaKey' => 'jiipe photos, industrial estate photos, construction photos',
            'metaDesc' => __('View photos documenting the development and progress at JIIPE Industrial Estate'),
            'pageTitle' => __('Photo Gallery'),
            'activeFilter' => 'gallery',
            'categories' => $categories,
            'photos' => $photos,
            'currentType' => 'photo',
        ];

        return view('layouts.client.gallery.photo', compact('data'));
    }

    /**
     * Format gallery data for view
     *
     * @param Gallery $gallery
     * @param string $locale
     * @return array|null
     */
    private function formatGallery($gallery, $locale)
    {
        $translation = $gallery->translations->firstWhere('locale', $locale);

        if (!$translation) {
            return null;
        }

        return [
            'id' => $gallery->id,
            'title' => $translation->title,
            'sub_title' => $translation->sub_title,
            'sub_title_2' => $translation->sub_title_2,
            'content' => $translation->content,
            'image' => $gallery->image
                ? (filter_var($gallery->image, FILTER_VALIDATE_URL)
                    ? $gallery->image
                    : asset('storage/' . $gallery->image))
                : asset('asset/images/default-gallery.jpg'),
            'url_video' => $gallery->url_video,
            'date' => $gallery->date_input
    ? Carbon::parse($gallery->date_input)->format('F d - Y')
    : '',
            'is_video' => !empty($gallery->url_video),
        ];
    }
}
