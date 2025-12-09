<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUsHeader;
use App\Models\AboutUsVisionMision;
use App\Models\AboutUsContent;
use App\Models\AboutUsContentDetail;
use App\Models\AboutUsContentDetailCategories;
use Illuminate\Support\Facades\DB;
use Cache;
class ProfileController extends Controller
{
    public function index()
    {
        $aboutUsHeader = Cache::remember('about_us_header_'.app()->getLocale(), 60*60, function () {
            return AboutUsHeader::with(['translations' => function($query) {
                $query->where('locale', app()->getLocale());
            }])->first();
        });

        $aboutUsContent = Cache::remember('about_us_content'.app()->getLocale(), 60*60, function () {
            return AboutUsContent::with(['translations' => function($query) {
                $query->where('locale', app()->getLocale());
            }])->first();
        });

        $aboutUsVisionMision = AboutUsVisionMision::with(['translations' => function($query) {
            $query->where('locale', app()->getLocale());
        }])->first();

        $aboutUsContentDetailCategories = AboutUsContentDetailCategories::with(['translations'=> function($query) {
            $query->where('locale', app()->getLocale());
        }])->orderBy('id', 'asc')->get();

        $developers = AboutUsContentDetail::with(['translations'=> function($query) {
            $query->where('locale', app()->getLocale());
        }, 'category.translations' => function($query) {
            $query->where('locale', app()->getLocale());
        }])
        ->where('category_id', 1)
        ->orderBy('id', 'asc')->get();

        $shareholders = AboutUsContentDetail::with(['translations'=> function($query) {
            $query->where('locale', app()->getLocale());
        }, 'category.translations' => function($query) {
            $query->where('locale', app()->getLocale());
        }])
        ->where('category_id', 2)
        ->orderBy('id', 'asc')->get();

        $data = [
            'title' => 'Profile - JIIPE',
            'metaKey' => 'jiipe gresik, industrial estate...',
            'metaDesc' => 'Discover JIIPE Industrial Park...',
            'aboutUsHeader' => $aboutUsHeader,
            'aboutUsContent' => $aboutUsContent,
            'vision' => $aboutUsVisionMision->translations[0]->vision ?? '',
            'mission' => $aboutUsVisionMision->translations[0]->mission ?? '',
            // 'content_detail' => $contentDetail,
            // For backward compatibility
            'developers' => $developers,
            'shareholders' => $shareholders,
        ];
        // dd($data);
        return view('layouts.client.profile.index', $data);
    }
}
