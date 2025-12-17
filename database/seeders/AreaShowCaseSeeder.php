<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AreaShowCase;
use App\Models\AreaShowCaseTranslation;

class AreaShowCaseSeeder extends Seeder
{
    public function run()
    {
        AreaShowCase::truncate();
        AreaShowCaseTranslation::truncate();
        $showcases = [
            [
                'image' => 'thumb_48b7b-masterplan-industri-des-2024_resize_1312_500.jpg',
                'position' => 1,
                'is_active' => 1,
                'translations' => [
                    'en' => [
                        'title' => 'Industrial Area',
                        'description' => '1761 Ha',
                    ],
                    'id' => [
                        'title' => 'Kawasan Industri',
                        'description' => '1761 Ha',
                    ],
                    'zh' => [
                        'title' => '工业区',
                        'description' => '1761公顷',
                    ],
                    'ja' => [
                        'title' => '工業エリア',
                        'description' => '1761ヘクタール',
                    ],
                    'ko' => [
                        'title' => '산업 지역',
                        'description' => '1761헥타르',
                    ],
                    'tw' => [
                        'title' => '工業區',
                        'description' => '1761公頃',
                    ],
                ],
            ],
            [
                'image' => 'thumb_0efdc-ports-masterplan-2024_resize_1312_500.jpg',
                'position' => 2,
                'is_active' => 1,
                'translations' => [
                    'en' => [
                        'title' => 'Port Area',
                        'description' => '406 Ha',
                    ],
                    'id' => [
                        'title' => 'Kawasan Pelabuhan',
                        'description' => '406 Ha',
                    ],
                    'zh' => [
                        'title' => '港口区',
                        'description' => '406公顷',
                    ],
                    'ja' => [
                        'title' => '港エリア',
                        'description' => '406ヘクタール',
                    ],
                    'ko' => [
                        'title' => '항만 지역',
                        'description' => '406헥타르',
                    ],
                    'tw' => [
                        'title' => '港口區',
                        'description' => '406公頃',
                    ],
                ],
            ],
            [
                'image' => 'thumb_a34c9-residential_resize_1312_500.jpg',
                'position' => 3,
                'is_active' => 1,
                'translations' => [
                    'en' => [
                        'title' => 'Residential Area',
                        'description' => '800 Ha',
                    ],
                    'id' => [
                        'title' => 'Kawasan Hunian',
                        'description' => '800 Ha',
                    ],
                    'zh' => [
                        'title' => '住宅区',
                        'description' => '800公顷',
                    ],
                    'ja' => [
                        'title' => '住宅エリア',
                        'description' => '800ヘクタール',
                    ],
                    'ko' => [
                        'title' => '주거 지역',
                        'description' => '800헥타르',
                    ],
                    'tw' => [
                        'title' => '住宅區',
                        'description' => '800公頃',
                    ],
                ],
            ],
        ];

        foreach ($showcases as $showcaseData) {
            $showcase = AreaShowCase::create([
                'image' => $showcaseData['image'],
                'position' => $showcaseData['position'],
                'is_active' => $showcaseData['is_active'],
            ]);
            foreach ($showcaseData['translations'] as $locale => $trans) {
                AreaShowCaseTranslation::create([
                    'area_show_case_id' => $showcase->id,
                    'locale' => $locale,
                    'title' => $trans['title'],
                    'description' => $trans['description'],
                ]);
            }
        }
    }
}
