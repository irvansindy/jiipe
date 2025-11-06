<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\CareerHeader;
use App\Models\CareerHeaderTranslation;
use App\Models\CareerSection;
use App\Models\CareerSectionTranslation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $locale = App::getLocale();
        $sortBy = $request->get('sort', 'date');

        // Cache key berdasarkan locale dan sort
        $cacheKey = "careers_{$locale}_{$sortBy}";

        // Cache header data selama 1 jam
        $careerHeader = Cache::remember("career_header_{$locale}", 3600, function () use ($locale) {
            return CareerHeader::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])->first();
        });

        // Cache section data selama 1 jam
        $careerSection = Cache::remember("career_section_{$locale}", 3600, function () use ($locale) {
            return CareerSection::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])->first();
        });

        // Query careers dengan eager loading
        $careersQuery = Career::with([
            'factory',
            'location',
            'education',
            'jobLevel'
        ])->where('is_active', true);

        // Sorting
        switch ($sortBy) {
            case 'education':
                $careersQuery->orderBy('education_id', 'asc');
                break;
            case 'experience':
                $careersQuery->orderBy('min_experience', 'desc');
                break;
            default: // date
                $careersQuery->orderBy('created_at', 'desc');
                break;
        }

        // Cache careers dengan pagination selama 30 menit
        $careers = Cache::remember($cacheKey, 1800, function () use ($careersQuery) {
            return $careersQuery->paginate(10);
        });

        // Get translations
        $headerTranslation = $careerHeader?->translations->first();
        $sectionTranslation = $careerSection?->translations->first();

        return view('layouts.client.career.index', compact(
            'careers',
            'careerHeader',
            'careerSection',
            'headerTranslation',
            'sectionTranslation',
            'sortBy'
        ));
    }

    public function detail($id)
    {
        $locale = App::getLocale();

        // Cache career detail selama 1 jam
        $career = Cache::remember("career_detail_{$id}_{$locale}", 3600, function () use ($id) {
            return Career::with([
                'factory',
                'location',
                'education',
                'jobLevel'
            ])->findOrFail($id);
        });

        return view('layouts.client.career.detail', compact('career'));
    }
}