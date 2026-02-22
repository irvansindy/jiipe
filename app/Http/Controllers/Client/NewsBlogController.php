<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsTranslation;
use App\Models\NewsCategories;
use App\Models\NewsCategoriesTranslation;
use App\Models\Gallery;
use App\Models\GalleryTranslations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsBlogController extends Controller
{
    public function index(Request $request)
    {
        $locale = app()->getLocale();
        $perPage = 6;

        // Get all categories for navigation
        $categories = NewsCategories::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])
        ->whereIn('id', [1,4])
        ->get()->map(function($category) use ($locale) {
            $translation = $category->translations->firstWhere('locale', $locale);

            // Map ID to type (HARDCODE)
            $typeSlug = $category->id == 1 ? 'news' : 'article';

            return [
                'id' => $category->id,
                'name' => $translation ? $translation->name : '',
                'type' => $typeSlug,
            ];
        })->filter(function($cat) {
            return !empty($cat['name']);
        });

        // Get latest post for featured section (ambil terpisah)
        // LOAD ALL translations, jangan filter di query (untuk avoid eager loading issues)
        $latestNews = News::with(['translations', 'category.translations'])
        ->join('news_translations', 'news.id', '=', 'news_translations.news_id')
        ->where('news.is_published', 1)
        ->orderBy('news.created_at', 'desc')
        ->select('news.*')
        ->distinct()
        ->first();

        $latestPost = $latestNews ? $this->formatNewsPost($latestNews, $locale) : null;

        // Get all published news KECUALI latest post
        // LOAD ALL translations, jangan filter di query (untuk avoid eager loading issues saat pagination)
        // PENTING: Join dengan news_translations untuk ensure relasi bekerja dengan baik
        $newsQuery = News::with(['translations', 'category.translations'])
        ->join('news_translations', 'news.id', '=', 'news_translations.news_id')
        ->where('news.is_published', 1)
        ->when($latestNews, function($query) use ($latestNews) {
            $query->where('news.id', '!=', $latestNews->id);
        })
        ->orderBy('news.created_at', 'desc')
        ->select('news.*');

        $newsPaginated = $newsQuery->paginate($perPage);

        // Format posts
        $formattedPosts = $newsPaginated->getCollection()->map(function($news) use ($locale) {
            return $this->formatNewsPost($news, $locale);
        })->filter(function($item) {
            return $item !== null;
        })->values();

        $newsPaginated->setCollection($formattedPosts);

        // Get latest articles
        // LOAD ALL translations, jangan filter di query
        $articleCategory = NewsCategories::with(['translations'])
        ->whereHas('translations', function($query) use ($locale) {
            $query->where('locale', $locale)
                  ->where('name', 'like', '%article%');
        })
        ->first();

        $latestArticles = collect([]);
        if ($articleCategory) {
            $latestArticles = News::with(['translations', 'category.translations'])
            ->join('news_translations', 'news.id', '=', 'news_translations.news_id')
            ->where('news.category_id', $articleCategory->id)
            ->where('news.is_published', 1)
            ->orderBy('news.created_at', 'desc')
            ->select('news.*')
            ->distinct()
            ->take(9)
            ->get()
            ->map(function($news) use ($locale) {
                return $this->formatNewsPost($news, $locale);
            })
            ->filter(function($item) {
                return $item !== null;
            });
        }

        $data = [
            'title' => __('News & Articles - JIIPE'),
            'metaKey' => 'jiipe news, jiipe articles, industrial estate news',
            'metaDesc' => __('Latest news and articles about JIIPE Industrial Estate'),
            'pageTitle' => __('system.news'),
            'activeFilter' => 'all',
            'categories' => $categories,
            'latestPost' => $latestPost,
            'posts' => $newsPaginated,
            'latestArticles' => $latestArticles,
            'articlesPagination' => null,
        ];

        return view('layouts.client.blog.index', compact('data'));
    }

    /**
     * ✅ METHOD BARU - Handle category by ID, redirect ke slug
     */
    public function categoryById($categoryId, Request $request)
    {
        $locale = app()->getLocale();

        // Get category by ID
        $category = NewsCategories::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])->find($categoryId);

        // Jika category tidak ditemukan, redirect ke blog index
        if (!$category) {
            return redirect()->route('blog.index');
        }

        // Get translation untuk locale saat ini
        $categoryTranslation = $category->translations->firstWhere('locale', $locale);

        // Jika tidak ada translation untuk locale ini, ambil translation pertama yang ada
        if (!$categoryTranslation) {
            $categoryTranslation = $category->translations->first();
        }

        // Jika masih tidak ada translation sama sekali, redirect
        if (!$categoryTranslation) {
            return redirect()->route('blog.index');
        }

        // Generate slug dari translation
        $categorySlug = Str::slug($categoryTranslation->name);

        // Redirect ke route dengan slug (untuk SEO-friendly URL)
        return redirect()->route('blog.category', ['categorySlug' => $categorySlug]);
    }

    /**
     * ✅ METHOD YANG SUDAH DIUPDATE - Handle category by slug
     */
    public function category($categorySlug, Request $request)
    {
        $locale = app()->getLocale();
        $perPage = 6;

        // Get all categories for navigation
        $categories = NewsCategories::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])
        ->whereIn('id', [1,4])
        ->get()->map(function($category) use ($locale) {
            $translation = $category->translations->firstWhere('locale', $locale);
            return [
                'id' => $category->id,
                'name' => $translation ? $translation->name : '',
                'slug' => $translation ? Str::slug($translation->name) : '',
            ];
        })->filter(function($cat) {
            return !empty($cat['name']);
        });

        // Find category by slug - lebih flexible untuk handle multi-language
        $category = NewsCategories::with(['translations'])
            ->whereHas('translations', function($query) use ($categorySlug) {
                $query->whereRaw('LOWER(REPLACE(name, " ", "-")) LIKE ?',
                    ['%' . strtolower($categorySlug) . '%']);
            })
            ->first();

        // Jika tidak ketemu, redirect ke blog index
        if (!$category) {
            return redirect()->route('blog.index');
        }

        // Get translation untuk locale saat ini
        $categoryTranslation = $category->translations->firstWhere('locale', $locale);

        // Jika tidak ada translation untuk locale saat ini, ambil translation pertama yang ada
        if (!$categoryTranslation) {
            $categoryTranslation = $category->translations->first();
        }

        // Jika masih null, redirect
        if (!$categoryTranslation) {
            return redirect()->route('blog.index');
        }

        // Get latest post for featured section (ambil terpisah)
        $latestNews = News::with(['translations', 'category.translations'])
        ->join('news_translations', 'news.id', '=', 'news_translations.news_id')
        ->where('news.category_id', $category->id)
        ->where('news.is_published', 1)
        ->orderBy('news.created_at', 'desc')
        ->select('news.*')
        ->distinct()
        ->first();

        $latestPost = $latestNews ? $this->formatNewsPost($latestNews, $locale) : null;

        // Get news by category KECUALI latest post
        $newsQuery = News::with(['translations', 'category.translations'])
        ->join('news_translations', 'news.id', '=', 'news_translations.news_id')
        ->where('news.category_id', $category->id)
        ->where('news.is_published', 1)
        ->when($latestNews, function($query) use ($latestNews) {
            $query->where('news.id', '!=', $latestNews->id);
        })
        ->orderBy('news.created_at', 'desc')
        ->select('news.*')
        ->distinct();

        $newsPaginated = $newsQuery->paginate($perPage);

        // Format posts
        $formattedPosts = $newsPaginated->getCollection()->map(function($news) use ($locale) {
            return $this->formatNewsPost($news, $locale);
        })->filter(function($item) {
            return $item !== null;
        })->values();

        $newsPaginated->setCollection($formattedPosts);

        // Get latest articles if viewing news category
        $latestArticles = collect([]);
        $isNewsCategory = $category->id == 1; // ID 1 untuk News category

        if ($isNewsCategory) {
            $latestArticles = News::with(['translations', 'category.translations'])
            ->join('news_translations', 'news.id', '=', 'news_translations.news_id')
            ->where('news.category_id', 4) // ID 4 untuk Articles category
            ->where('news.is_published', 1)
            ->orderBy('news.created_at', 'desc')
            ->select('news.*')
            ->distinct()
            ->take(9)
            ->get()
            ->map(function($news) use ($locale) {
                return $this->formatNewsPost($news, $locale);
            })
            ->filter(function($item) {
                return $item !== null;
            });
        }

        $data = [
            'title' => ($categoryTranslation->name ?? 'News') . ' - JIIPE',
            'metaKey' => "jiipe {$categoryTranslation->name}, industrial estate news",
            'metaDesc' => __("Latest {$categoryTranslation->name} about JIIPE Industrial Estate"),
            'pageTitle' => $categoryTranslation->name ?? 'News',
            'activeFilter' => strtolower($categorySlug),
            'categories' => $categories,
            'latestPost' => $latestPost,
            'posts' => $newsPaginated,
            'latestArticles' => $latestArticles,
            'articlesPagination' => null,
        ];
        return view('layouts.client.blog.index', compact('data'));
    }

    public function type($type, Request $request)
    {
        $locale = app()->getLocale();
        $perPage = 6;

        // Map type ke category ID (HARDCODE)
        $typeMap = [
            'news' => 1,
            'article' => 4,
            'articles' => 4,
        ];

        $categoryId = $typeMap[strtolower($type)] ?? null;

        if (!$categoryId) {
            return redirect()->route('blog.index');
        }

        $category = NewsCategories::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])->find($categoryId);

        if (!$category) {
            return redirect()->route('blog.index');
        }

        $categoryTranslation = $category->translations->firstWhere('locale', $locale);

        if (!$categoryTranslation) {
            $categoryTranslation = $category->translations->first();
        }

        // Get all categories for navigation
        $categories = NewsCategories::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])
        ->whereIn('id', [1,4])
        ->get()->map(function($category) use ($locale) {
            $translation = $category->translations->firstWhere('locale', $locale);

            // Map ID to type (HARDCODE)
            $typeSlug = $category->id == 1 ? 'news' : 'article';

            return [
                'id' => $category->id,
                'name' => $translation ? $translation->name : '',
                'type' => $typeSlug,
            ];
        })->filter(function($cat) {
            return !empty($cat['name']);
        });

        // Get latest post for featured section (ambil terpisah)
        $latestNews = News::with(['translations', 'category.translations'])
        ->join('news_translations', 'news.id', '=', 'news_translations.news_id')
        ->where('news.category_id', $category->id)
        ->where('news.is_published', 1)
        ->orderBy('news.created_at', 'desc')
        ->select('news.*')
        ->distinct()
        ->first();

        $latestPost = $latestNews ? $this->formatNewsPost($latestNews, $locale) : null;

        // Get news by category KECUALI latest post
        $newsQuery = News::with(['translations', 'category.translations'])
        ->join('news_translations', 'news.id', '=', 'news_translations.news_id')
        ->where('news.category_id', $category->id)
        ->where('news.is_published', 1)
        ->when($latestNews, function($query) use ($latestNews) {
            $query->where('news.id', '!=', $latestNews->id);
        })
        ->orderBy('news.created_at', 'desc')
        ->select('news.*')
        ->distinct();

        $newsPaginated = $newsQuery->paginate($perPage);

        $formattedPosts = $newsPaginated->getCollection()->map(function($news) use ($locale) {
            return $this->formatNewsPost($news, $locale);
        })->filter(function($item) {
            return $item !== null;
        })->values();

        $newsPaginated->setCollection($formattedPosts);

        $latestArticles = collect([]);
        $isNewsCategory = $category->id == 1;

        if ($isNewsCategory) {
            $latestArticles = News::with(['translations', 'category.translations'])
            ->join('news_translations', 'news.id', '=', 'news_translations.news_id')
            ->where('news.category_id', 4)
            ->where('news.is_published', 1)
            ->orderBy('news.created_at', 'desc')
            ->select('news.*')
            ->distinct()
            ->take(9)
            ->get()
            ->map(function($news) use ($locale) {
                return $this->formatNewsPost($news, $locale);
            })
            ->filter(function($item) {
                return $item !== null;
            });
        }

        $data = [
            'title' => ($categoryTranslation->name ?? 'News') . ' - JIIPE',
            'metaKey' => "jiipe {$categoryTranslation->name}, industrial estate news",
            'metaDesc' => __("Latest {$categoryTranslation->name} about JIIPE Industrial Estate"),
            'pageTitle' => $categoryTranslation->name ?? 'News',
            'activeFilter' => strtolower($type),
            'categories' => $categories,
            'latestPost' => $latestPost,
            'posts' => $newsPaginated,
            'latestArticles' => $latestArticles,
            'articlesPagination' => null,
        ];

        return view('layouts.client.blog.index', compact('data'));
    }

    public function detail($id)
    {
        $locale = app()->getLocale();

        $news = News::with([
            'translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'category.translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])
        ->where('id', $id)
        ->where('is_published', 1)
        ->firstOrFail();

        $translation = $news->translations->firstWhere('locale', $locale);

        if (!$translation) {
            abort(404);
        }

        $categoryTranslation = $news->category && $news->category->translations
            ? $news->category->translations->firstWhere('locale', $locale)
            : null;

        // Get all categories for navigation
        $categories = NewsCategories::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])
        ->whereIn('id', [1,4])
        ->get()->map(function($category) use ($locale) {
            $translation = $category->translations->firstWhere('locale', $locale);

            // Map ID to type (HARDCODE)
            $typeSlug = $category->id == 1 ? 'news' : 'article';

            return [
                'id' => $category->id,
                'name' => $translation ? $translation->name : '',
                'type' => $typeSlug,
            ];
        })->filter(function($cat) {
            return !empty($cat['name']);
        });
        $data = [
            'title' => ($translation->title ?? 'News Detail') . ' - JIIPE',
            'metaKey' => $translation->title ?? '',
            'metaDesc' => Str::limit(strip_tags($translation->content ?? ''), 160),
            'pageTitle' => $translation->title ?? 'News Detail',
            'activeFilter' => 'detail',
            'categories' => $categories,
            'news' => $news,
            'translation' => $translation,
            'category' => $news->category,
            'categoryName' => $categoryTranslation ? $categoryTranslation->name : '',
        ];

        return view('layouts.client.blog.detail', compact('data'));
    }

    private function formatNewsPost($news, $locale)
    {
        $translation = $news->translations->firstWhere('locale', $locale);

        // Fallback ke translation pertama jika tidak ada untuk locale saat ini
        if (!$translation) {
            $translation = $news->translations->first();
        }

        if (!$translation) {
            return null;
        }

        $categoryTranslation = $news->category && $news->category->translations
            ? $news->category->translations->firstWhere('locale', $locale)
            : null;

        // Fallback category translation ke translation pertama
        if (!$categoryTranslation && $news->category && $news->category->translations) {
            $categoryTranslation = $news->category->translations->first();
        }

        return [
            'id' => $news->id,
            'title' => $translation->title,
            'excerpt' => Str::limit(strip_tags($translation->content), 150),
            'thumbnail' => $news->thumbnail
                ? (filter_var($news->thumbnail, FILTER_VALIDATE_URL)
                    ? $news->thumbnail
                    : asset('uploads/blog/' . $news->thumbnail))
                : asset('asset/images/default-blog.jpg'),
            'date' => $news->created_at ? $news->created_at->format('M d, Y') : '',
            'category' => $categoryTranslation ? $categoryTranslation->name : '',
            'categorySlug' => $categoryTranslation ? Str::slug($categoryTranslation->name) : '',
            'quote' => $translation->quote ?? '',
        ];
    }
}
