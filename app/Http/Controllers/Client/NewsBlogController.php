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
        $perPage = 9;

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

        // Get all published news
        $newsQuery = News::with([
            'translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'category.translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])
        ->where('is_published', 1)
        ->orderBy('created_at', 'desc');

        $newsPaginated = $newsQuery->paginate($perPage);

        // Format posts
        $formattedPosts = $newsPaginated->getCollection()->map(function($news) use ($locale) {
            return $this->formatNewsPost($news, $locale);
        })->filter();

        $newsPaginated->setCollection($formattedPosts);

        // Get latest post for featured section
        $latestPost = $formattedPosts->first();

        // Get latest articles
        $articleCategory = NewsCategories::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])
        ->whereHas('translations', function($query) use ($locale) {
            $query->where('locale', $locale)
                  ->where('name', 'like', '%article%');
        })
        ->first();

        $latestArticles = collect([]);
        if ($articleCategory) {
            $latestArticles = News::with([
                'translations' => function($query) use ($locale) {
                    $query->where('locale', $locale);
                }
            ])
            ->where('category_id', $articleCategory->id)
            ->where('is_published', 1)
            ->orderBy('created_at', 'desc')
            ->take(9)
            ->get()
            ->map(function($news) use ($locale) {
                return $this->formatNewsPost($news, $locale);
            })
            ->filter();
        }

        $data = [
            'title' => __('News & Articles - JIIPE'),
            'metaKey' => 'jiipe news, jiipe articles, industrial estate news',
            'metaDesc' => __('Latest news and articles about JIIPE Industrial Estate'),
            'pageTitle' => __('News'),
            'activeFilter' => 'all',
            'categories' => $categories,
            'latestPost' => $latestPost,
            'posts' => $newsPaginated,
            'latestArticles' => $latestArticles,
            'articlesPagination' => null,
        ];
        return view('layouts.client.blog.index', compact('data'));
    }

    public function category($categorySlug, Request $request)
    {
        $locale = app()->getLocale();
        $perPage = 9;

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

        // Find category by slug
        $category = NewsCategories::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])
        ->whereHas('translations', function($query) use ($locale, $categorySlug) {
            $query->where('locale', $locale)
                  ->where(DB::raw('LOWER(name)'), 'like', '%' . strtolower(str_replace('-', ' ', $categorySlug)) . '%');
        })
        ->firstOrFail();

        $categoryTranslation = $category->translations->firstWhere('locale', $locale);

        // Get news by category
        $newsQuery = News::with([
            'translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'category.translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])
        ->where('category_id', $category->id)
        ->where('is_published', 1)
        ->orderBy('created_at', 'desc');

        $newsPaginated = $newsQuery->paginate($perPage);

        // Format posts
        $formattedPosts = $newsPaginated->getCollection()->map(function($news) use ($locale) {
            return $this->formatNewsPost($news, $locale);
        })->filter();

        $newsPaginated->setCollection($formattedPosts);

        // Get latest post
        $latestPost = $formattedPosts->first();

        // Get latest articles if viewing news category
        $latestArticles = collect([]);
        $isNewsCategory = Str::contains(strtolower($categoryTranslation->name ?? ''), 'news') ||
                         Str::contains(strtolower($categoryTranslation->name ?? ''), 'berita');

        if ($isNewsCategory) {
            $articleCategory = NewsCategories::with(['translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }])
            ->whereHas('translations', function($query) use ($locale) {
                $query->where('locale', $locale)
                      ->where(function($q) {
                          $q->where('name', 'like', '%article%')
                            ->orWhere('name', 'like', '%artikel%');
                      });
            })
            ->first();

            if ($articleCategory) {
                $latestArticles = News::with([
                    'translations' => function($query) use ($locale) {
                        $query->where('locale', $locale);
                    }
                ])
                ->where('category_id', $articleCategory->id)
                ->where('is_published', 1)
                ->orderBy('created_at', 'desc')
                ->take(9)
                ->get()
                ->map(function($news) use ($locale) {
                    return $this->formatNewsPost($news, $locale);
                })
                ->filter();
            }
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
            return [
                'id' => $category->id,
                'name' => $translation ? $translation->name : '',
                'slug' => $translation ? Str::slug($translation->name) : '',
            ];
        })->filter(function($cat) {
            return !empty($cat['name']);
        });

        $data = [
            'title' => ($translation->title ?? 'News Detail') . ' - JIIPE',
            'metaKey' => $translation->title ?? '',
            'metaDesc' => Str::limit(strip_tags($translation->content ?? ''), 160),
            'pageTitle' => $translation->title ?? 'News Detail',
            'activeFilter' => 'detail', // Added for consistency
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

        if (!$translation) {
            return null;
        }

        $categoryTranslation = $news->category && $news->category->translations
            ? $news->category->translations->firstWhere('locale', $locale)
            : null;

        return [
            'id' => $news->id,
            'title' => $translation->title,
            'excerpt' => Str::limit(strip_tags($translation->content), 150),
            'thumbnail' => $news->thumbnail
                ? (filter_var($news->thumbnail, FILTER_VALIDATE_URL)
                    ? $news->thumbnail
                    : asset('storage/blog/' . $news->thumbnail))
                : asset('asset/images/default-blog.jpg'),
            'date' => $news->created_at ? $news->created_at->format('M d, Y') : '',
            'category' => $categoryTranslation ? $categoryTranslation->name : '',
            'categorySlug' => $categoryTranslation ? Str::slug($categoryTranslation->name) : '',
            'quote' => $translation->quote ?? '',
        ];
    }
}
