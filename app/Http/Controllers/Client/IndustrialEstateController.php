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
}
