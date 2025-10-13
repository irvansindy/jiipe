<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\ZoneClass;
class SezController extends Controller
{
    // public function index()
    // {
    //     $locale = app()->getLocale();

    //     // Get all zones for SEZ (you can filter by zone_class_id if needed)
    //     $zones = Zone::with(['translations' => function($query) use ($locale) {
    //         $query->whereIn('locale', [$locale]);
    //     }])->get();

    //     $sezPages = $zones->map(function($zone) use ($locale) {
    //         // Get translation for current locale or fallback to default
    //         $translation = $zone->translations->firstWhere('locale', $locale);

    //         if (!$translation) {
    //             return null;
    //         }

    //         return [
    //             'id' => $zone->id,
    //             'slug' => \Illuminate\Support\Str::slug($translation->name),
    //             'title' => $translation->name,
    //             'menu_title' => $translation->name,
    //             'subtitle' => $translation->subtitle,
    //             'description' => $translation->description ?
    //                 \Illuminate\Support\Str::limit(strip_tags($translation->description), 200) : '',
    //             'thumbnail' => $zone->image,
    //         ];
    //     })->filter(); // Remove null values

    //     $data = [
    //         'title' => __('Special Economic Zone - JIIPE'),
    //         'metaKey' => 'jiipe sez, special economic zone, kawasan ekonomi khusus',
    //         'metaDesc' => __('Explore JIIPE Special Economic Zone benefits and facilities'),
    //         'sezPages' => $sezPages,
    //     ];
    //     return view("layouts.client.sez.index", compact('data'));
    // }
    public function index()
    {
        $locale = app()->getLocale();

        // Get all zones for SEZ
        $zones = Zone::with(['translations' => function($query) use ($locale) {
            $query->whereIn('locale', [$locale]);
        }])->get();

        $sezPages = $zones->map(function($zone) use ($locale) {
            $translation = $zone->translations->firstWhere('locale', $locale);

            if (!$translation) {
                return null;
            }

            return [
                'id' => $zone->id,
                'slug' => \Illuminate\Support\Str::slug($translation->name),
                'title' => $translation->name,
                'menu_title' => $translation->name,
                'subtitle' => $translation->subtitle,
                'description' => $translation->description,
                'thumbnail' => $zone->image,
            ];
        })->filter()->values(); // Remove null values and reindex

        $data = [
            'title' => __('Special Economic Zone - JIIPE'),
            'metaKey' => 'jiipe sez, special economic zone, kawasan ekonomi khusus',
            'metaDesc' => __('Explore JIIPE Special Economic Zone benefits and facilities'),
            'sezPages' => $sezPages,
        ];

        return view("layouts.client.sez.index", compact('data'));
    }
    public function detail($id)
    {
        $locale = app()->getLocale();

        // Get current zone with translations
        $zone = Zone::with(['translations' => function($query) use ($locale) {
            $query->whereIn('locale', [$locale]);
        }])->findOrFail($id);

        // Get current zone translation
        $translation = $zone->translations->firstWhere('locale', $locale)
                    ?? $zone->translations->firstWhere('locale');

        if (!$translation) {
            abort(404, 'Translation not found');
        }

        // Get all zones for sidebar
        $allZones = Zone::with(['translations' => function($query) use ($locale) {
            $query->whereIn('locale', [$locale]);
        }])->get();

        $sezPages = $allZones->map(function($z) use ($locale) {
            $trans = $z->translations->firstWhere('locale', $locale) ?? $z->translations->firstWhere('locale');

            if (!$trans) {
                return null;
            }

            return [
                'id' => $z->id,
                'slug' => \Illuminate\Support\Str::slug($trans->name),
                'title' => $trans->name,
                'menu_title' => $trans->name,
            ];
        })->filter();

        $data = [
            'title' => $translation->meta_title ?? $translation->name,
            'metaKey' => $translation->meta_keywords ?? '',
            'metaDesc' => $translation->meta_description ?? '',
            'page' => [
                'id' => $zone->id,
                'slug' => \Illuminate\Support\Str::slug($translation->name),
                'title' => $translation->name,
                'page_title' => $translation->name,
                'subtitle' => $translation->subtitle,
                'cover_image' => $zone->image,
                'content' => $translation->description,
                'note' => $translation->note,
            ],
            'sezPages' => $sezPages,
        ];

        return view('pages.sez.detail', $data);
    }
}
