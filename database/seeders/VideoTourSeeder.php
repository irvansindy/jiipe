<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VideoTour;
use App\Models\VideoTourTranslation;

class VideoTourSeeder extends Seeder
{
    public function run()
    {
        VideoTour::truncate();
        VideoTourTranslation::truncate();

        $videoTours = [
            [
                'embed_code' => '<div id="5Ss66DNIH"><script type="text/javascript" async data-short="5Ss66DNIH" data-path="tours" data-is-self-hosted="undefined" width="100%" height="500px" src="https://tours.jiipe.com/public/shareScript.js"></script></div>',
                'thumbnail' => 'thumbnail/video1.jpg',
                'position' => 1,
                'is_active' => 1,
                'translations' => [
                    'en' => [
                        'title' => 'JIIPE Industrial Estate Virtual Tour',
                        'description' => 'Experience a virtual journey through our state-of-the-art industrial estate'
                    ],
                    'id' => [
                        'title' => 'Tur Virtual Kawasan Industri JIIPE',
                        'description' => 'Rasakan perjalanan virtual melalui kawasan industri modern kami'
                    ],
                    'zh' => [
                        'title' => 'JIIPE工业区虚拟游览',
                        'description' => '体验我们最先进的工业区虚拟之旅'
                    ],
                    'ja' => [
                        'title' => 'JIIPE工業団地バーチャルツアー',
                        'description' => '最先端の工業団地をバーチャルで体験'
                    ],
                    'ko' => [
                        'title' => 'JIIPE 산업단지 가상 투어',
                        'description' => '최첨단 산업단지를 가상으로 체험하세요'
                    ],
                    'tw' => [
                        'title' => 'JIIPE工業區虛擬導覽',
                        'description' => '體驗我們最先進的工業區虛擬之旅'
                    ],
                ],
            ],
            // Tambahkan video tour lainnya di sini jika ada
        ];

        foreach ($videoTours as $tourData) {
            $videoTour = VideoTour::create([
                'embed_code' => $tourData['embed_code'],
                'thumbnail' => $tourData['thumbnail'],
                'position' => $tourData['position'],
                'is_active' => $tourData['is_active'],
            ]);

            foreach ($tourData['translations'] as $locale => $trans) {
                VideoTourTranslation::create([
                    'video_tour_id' => $videoTour->id,
                    'locale' => $locale,
                    'title' => $trans['title'],
                    'description' => $trans['description'],
                ]);
            }
        }
    }
}
