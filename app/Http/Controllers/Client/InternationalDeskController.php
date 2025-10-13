<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InternationalDeskController extends Controller
{
    public function index()
    {
        $data = [
            'title' => __('International Desk - JIIPE'),
            'metaKey' => 'jiipe international desk, international investment, foreign investors',
            'metaDesc' => __('Contact JIIPE International Desk for multilingual support in English, Chinese, and Japanese'),
            'pageTitle' => __('International Desk'),
            'desks' => [
                [
                    'language' => 'English',
                    'display_name' => 'English',
                    'contact_link' => '#contact',
                ],
                [
                    'language' => 'Chinese Simplified',
                    'display_name' => 'Chinese Simplified （筒体版）',
                    'contact_link' => '#contact',
                ],
                [
                    'language' => 'Chinese Traditional',
                    'display_name' => 'Chinese Traditional（繁體版）',
                    'contact_link' => '#contact',
                ],
                [
                    'language' => 'Japanese',
                    'display_name' => 'Japanese （日本語)',
                    'contact_link' => '#contact',
                ],
            ],
        ];

        return view('layouts.client.international-desk.index', compact('data'));
    }
}
