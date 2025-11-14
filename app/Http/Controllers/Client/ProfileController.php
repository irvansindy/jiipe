<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Profile - JIIPE',
            'metaKey' => 'jiipe gresik, industrial estate...',
            'metaDesc' => 'Discover JIIPE Industrial Park...',

            // Cover Section
            'coverImage' => "{{ asset('asset/images/static/jembatan.jpg') }}",

            // Contributions Section
            'contributionsTitle' => 'JIIPE Contributions',
            'contributionsDescription' => 'The high logistics costs in Indonesia as an archipelagic country have an effect on the price of goods circulating in the market. Through domestic and international connectivity developed by JIIPE integrated areas, actors can save these costs and produce goods at more competitive prices.',
            'contributionsImage' => '/images/static/profil-sec1.jpg',
            'contributionsContent' => '<p>JIIPE is the first integrated area...</p>',
            'videoUrl' => 'https://www.youtube.com/watch?v=bPyOISQp_Mw',

            // Vision & Mission
            'vision' => 'To Support tenant to reduce logistic costs, provide reliable utilities and ease of doing business',
            'mission' => 'Optimizing our potential to build sustainable stakeholder value',

            // Developers
            'developers' => [
                [
                    'logo' => '/images/static/logo-profil.png',
                    'name' => 'PT Berkah Kawasan Manyar Sejahtera',
                    'description' => 'The developer of industrial estate...'
                ],
                // ... more developers
            ],

            // Shareholders
            'shareholders' => [
                [
                    'logo' => '/images/static/logo-akr.png',
                    'name' => 'PT AKR Corporindo',
                    'description' => 'PT AKR Corporindo TBk is...'
                ],
                // ... more shareholders
            ]
        ];

        return view('layouts.client.profile.index', $data);
    }
}
