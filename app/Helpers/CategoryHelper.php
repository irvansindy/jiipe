<?php

namespace App\Helpers;

use App\Models\NewsCategories;
use Illuminate\Support\Str;

class CategoryHelper
{
    public static function getCategoryRoute($identifier, $locale = null)
    {
        $categoryMap = [
            'news' => 1,
            'articles' => 4,
        ];

        $categoryId = $categoryMap[$identifier] ?? null;

        if (!$categoryId) {
            return route('blog.index');
        }

        return route('blog.category.id', ['categoryId' => $categoryId]);
    }
    public static function getCategorySlug($categoryId, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        $category = NewsCategories::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])->find($categoryId);

        if (!$category) {
            return null;
        }

        $translation = $category->translations->firstWhere('locale', $locale);

        return $translation ? Str::slug($translation->name) : null;
    }
}