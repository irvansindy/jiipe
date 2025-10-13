<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndustrialEstateController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'JIIPE Industrial Estate - Gresik, Indonesia',
            'metaKey' => 'jiipe gresik, industrial estate...',
            'metaDesc' => 'Kawasan Industri Terintegrasi JIIPE...',

            // Cover
            'coverImage' => "{{ asset('images/static/cover-industrial.jpg') }}",

            // Introduction
            'pageTitle' => 'Independent Integrated Industrial Estate in Gresik...',
            'pageDescription' => '<p>The main objective of JIIPE is to contribute positively to the emphasis on logistics cost efficiency. The JIPE area combines a complete infrastructure that includes deep seaports, dry ports and direct toll access to various domestic and international market distribution channels.</p>',

            // Areas
            'areas' => [
                [
                    'id' => 1,
                    'name' => 'Industrial Area',
                    'subtitle' => 'Competitive and Sustainable Utilities',
                    'description' => 'Eco-friendly environment of 1761 hectares area...',
                    'size' => '1761',
                    'image' => "asset/masterplant-picture/.tmb/thumb_f8e62-industrial-estate_resize_1312_662.jpg",
                    'image_thumb' => "asset/masterplant-picture/.tmb/thumb_f8e62-industrial-estate_resize_1312_662.jpg",
                    'thumbnail' => "asset/masterplant-picture/.tmb/thumb_f8e62-industrial-estate_resize_1312_662.jpg"
                ],
                [
                    'id' => 2,
                    'name' => 'Port Area',
                    'subtitle' => 'Practical integration and efficiency',
                    'description' => '400 ha integrated deep seaport estate...',
                    'size' => '400',
                    'image' => "asset/masterplant-picture/.tmb/thumb_0efdc-ports-masterplan-2024_resize_1312_500.jpg",
                    'image_thumb' => "asset/masterplant-picture/.tmb/thumb_0efdc-ports-masterplan-2024_resize_1312_500.jpg",
                    'thumbnail' => "asset/masterplant-picture/.tmb/thumb_0efdc-ports-masterplan-2024_resize_1312_500.jpg"
                ],
                [
                    'id' => 3,
                    'name' => 'Residential Area',
                    'subtitle' => 'Magnificent Infrastructure',
                    'description' => 'Grand Estate Marina City (GEM City)...',
                    'size' => '800',
                    'image' => "asset/masterplant-picture/.tmb/thumb_0472d-residential-estate_resize_1312_500.jpg",
                    'image_thumb' => "asset/masterplant-picture/.tmb/thumb_0472d-residential-estate_resize_1312_500.jpg",
                    'thumbnail' => "asset/masterplant-picture/.tmb/thumb_0472d-residential-estate_resize_1312_500.jpg"
                ]
            ]
        ];
        return view('layouts.client.industrial-estate.index', $data);
    }
    public function areaDetail($id)
    {
        // Get area detail by ID
        $area = $this->getAreaById($id);

        return view('layouts.client.industrial-estate.detail', compact('area'));
    }
    public function show($id)
    {
        $area = $this->getAreaData($id);
        $allAreas = $this->getAllAreas();

        return view('layouts.client.industrial-estate.detail', compact('area', 'allAreas'));
    }
    private function getAreaData($id)
    {
        $areas = [
            1 => [ // Industrial Area
                'id' => 1,
                'name' => 'Industrial Area',
                'subtitle' => 'Competitive and Sustainable Utilities',
                'description' => 'Eco-friendly environment of 1761 hectares area...',
                'size' => '1761',
                'cover_image' => '/images/product/.tmb/thumb_industrial-area_adaptiveResize_1920_591.jpg',

                'clusterings' => [
                    ['name' => 'Heavy Industries', 'image' => '/images/kawasan/.tmb/thumb_heavy-industry.jpg'],
                    ['name' => 'Medium Industries', 'image' => '/images/kawasan/.tmb/thumb_medium-industry.jpg'],
                    ['name' => 'Light Industries', 'image' => '/images/kawasan/.tmb/thumb_light-industry.jpg'],
                    ['name' => 'Utilities', 'image' => '/images/kawasan/.tmb/thumb_utility.jpg'],
                ],

                'features' => [
                    [
                        'title' => 'Complete Facilities and Infrastructure',
                        'image' => '/images/kawasan/.tmb/thumb_n-unggul-2.jpg',
                        'description' => '<ul><li>International standard road system...</li></ul>'
                    ],
                    // ... more features
                ],

                'facilities' => [
                    [
                        'title' => 'Power Plant',
                        'icon' => '/images/kawasan/.tmb/thumb_power-plant.png',
                        'description' => '<p>Gas power plant...</p>'
                    ],
                    // ... more facilities
                ],

                'business_efficiency' => [
                    [
                        'title' => 'Single Window Processing System',
                        'icon' => '/images/kawasan/.tmb/thumb_timer.png',
                        'description' => '<p>3 Hour Service...</p>'
                    ],
                    // ... more efficiency
                ]
            ],

            2 => [ // Port Area
                'id' => 3,
                'name' => 'Industrial Area',
                'subtitle' => 'Competitive and Sustainable Utilities',
                'description' => 'Eco-friendly environment of 1761 hectares area...',
                'size' => '1761',
                'cover_image' => '/images/product/.tmb/thumb_industrial-area_adaptiveResize_1920_591.jpg',

                'clusterings' => [
                    ['name' => 'Heavy Industries', 'image' => '/images/kawasan/.tmb/thumb_heavy-industry.jpg'],
                    ['name' => 'Medium Industries', 'image' => '/images/kawasan/.tmb/thumb_medium-industry.jpg'],
                    ['name' => 'Light Industries', 'image' => '/images/kawasan/.tmb/thumb_light-industry.jpg'],
                    ['name' => 'Utilities', 'image' => '/images/kawasan/.tmb/thumb_utility.jpg'],
                ],

                'features' => [
                    [
                        'title' => 'Complete Facilities and Infrastructure',
                        'image' => '/images/kawasan/.tmb/thumb_n-unggul-2.jpg',
                        'description' => '<ul><li>International standard road system...</li></ul>'
                    ],
                    // ... more features
                ],

                'facilities' => [
                    [
                        'title' => 'Power Plant',
                        'icon' => '/images/kawasan/.tmb/thumb_power-plant.png',
                        'description' => '<p>Gas power plant...</p>'
                    ],
                    // ... more facilities
                ],

                'business_efficiency' => [
                    [
                        'title' => 'Single Window Processing System',
                        'icon' => '/images/kawasan/.tmb/thumb_timer.png',
                        'description' => '<p>3 Hour Service...</p>'
                    ],
                    // ... more efficiency
                ]
            ],

            3 => [ // Residential Area
                'id' => 3,
                'name' => 'Industrial Area',
                'subtitle' => 'Competitive and Sustainable Utilities',
                'description' => 'Eco-friendly environment of 1761 hectares area...',
                'size' => '1761',
                'cover_image' => '/images/product/.tmb/thumb_industrial-area_adaptiveResize_1920_591.jpg',

                'clusterings' => [
                    ['name' => 'Heavy Industries', 'image' => '/images/kawasan/.tmb/thumb_heavy-industry.jpg'],
                    ['name' => 'Medium Industries', 'image' => '/images/kawasan/.tmb/thumb_medium-industry.jpg'],
                    ['name' => 'Light Industries', 'image' => '/images/kawasan/.tmb/thumb_light-industry.jpg'],
                    ['name' => 'Utilities', 'image' => '/images/kawasan/.tmb/thumb_utility.jpg'],
                ],

                'features' => [
                    [
                        'title' => 'Complete Facilities and Infrastructure',
                        'image' => '/images/kawasan/.tmb/thumb_n-unggul-2.jpg',
                        'description' => '<ul><li>International standard road system...</li></ul>'
                    ],
                    // ... more features
                ],

                'facilities' => [
                    [
                        'title' => 'Power Plant',
                        'icon' => '/images/kawasan/.tmb/thumb_power-plant.png',
                        'description' => '<p>Gas power plant...</p>'
                    ],
                    // ... more facilities
                ],

                'business_efficiency' => [
                    [
                        'title' => 'Single Window Processing System',
                        'icon' => '/images/kawasan/.tmb/thumb_timer.png',
                        'description' => '<p>3 Hour Service...</p>'
                    ],
                    // ... more efficiency
                ]
            ]
        ];

        return $areas[$id] ?? abort(404);
    }
    private function getAllAreas()
    {
        return [
            ['id' => 1, 'name' => 'Industrial Area'],
            ['id' => 2, 'name' => 'Port Area'],
            ['id' => 3, 'name' => 'Residential Area'],
        ];
    }
}
