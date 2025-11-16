<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUsHeader;
use App\Models\AboutUsVisionMision;
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

        // dd([
        //     'aboutUsContentDetailCategories' => $aboutUsContentDetailCategories,
        //     'developers' => $developers,
        //     'shareholders' => $shareholders,
        // ]);
        // $data = [
        //     'title' => 'Profile - JIIPE',
        //     'metaKey' => 'jiipe gresik, industrial estate...',
        //     'metaDesc' => 'Discover JIIPE Industrial Park...',

        //     // Cover Section
        //     'coverImage' => "{{ asset('asset/images/static/jembatan.jpg') }}",

        //     // Contributions Section
        //     'contributionsTitle' => 'JIIPE Contributions',
        //     'contributionsDescription' => 'The high logistics costs in Indonesia as an archipelagic country have an effect on the price of goods circulating in the market. Through domestic and international connectivity developed by JIIPE integrated areas, actors can save these costs and produce goods at more competitive prices.',
        //     'contributionsImage' => '/images/static/profil-sec1.jpg',
        //     'contributionsContent' => '<p>JIIPE is the first integrated area...</p>',
        //     'videoUrl' => 'https://www.youtube.com/watch?v=bPyOISQp_Mw',

        //     // Vision & Mission
        //     'vision' => 'To Support tenant to reduce logistic costs, provide reliable utilities and ease of doing business',
        //     'mission' => 'Optimizing our potential to build sustainable stakeholder value',

        //     // Developers
        //     'developers' => [
        //         [
        //             'logo' => '/images/static/logo-profil.png',
        //             'name' => 'PT Berkah Kawasan Manyar Sejahtera',
        //             'description' => 'The developer of industrial estate...'
        //         ],
        //         // ... more developers
        //     ],

        //     // Shareholders
        //     'shareholders' => [
        //         [
        //             'logo' => '/images/static/logo-akr.png',
        //             'name' => 'PT AKR Corporindo',
        //             'description' => 'PT AKR Corporindo TBk is...'
        //         ],
        //         // ... more shareholders
        //     ]
        // ];

        $data = [
            'title' => 'Profile - JIIPE',
            'metaKey' => 'jiipe gresik, industrial estate...',
            'metaDesc' => 'Discover JIIPE Industrial Park...',
            'aboutUsHeader' => $aboutUsHeader,
            'vision' => $aboutUsVisionMision->translations[0]->vision ?? '',
            'mission' => $aboutUsVisionMision->translations[0]->mission ?? '',
            // 'content_detail' => $contentDetail,
            // For backward compatibility
            'developers' => $developers,
            'shareholders' => $shareholders,
        ];
        return view('layouts.client.profile.index', $data);
    }
}
