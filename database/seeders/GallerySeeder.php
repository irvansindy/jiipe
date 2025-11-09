<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;
use App\Models\GalleryTranslations;
use Carbon\Carbon;

class GallerySeeder extends Seeder
{
    public function run()
    {
        $galleries = [
            // Video Gallery 1
            [
                'image' => 'images/gallery/f9bde-xq1pbtxflrahd.jpg',
                'is_active' => true,
                'date_input' => Carbon::create(2024, 11, 5),
                'date_update' => Carbon::create(2024, 11, 5),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => 1,
                'image_2' => null,
                'url_video' => 'https://www.youtube.com/embed/Xq1PBTxFLrA',
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'A Strategic Location for Downstream Industries and Renewable Energy',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Lokasi Strategis untuk Industri Hilir dan Energi Terbarukan',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ]
                ]
            ],
            // Video Gallery 2
            [
                'image' => 'images/gallery/7c418-ar1oojpozacsd.jpg',
                'is_active' => true,
                'date_input' => Carbon::create(2024, 9, 13),
                'date_update' => Carbon::create(2024, 9, 13),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => 1,
                'image_2' => null,
                'url_video' => 'https://www.youtube.com/embed/Ar1oojPozAc',
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'JIIPE: The Benchmark for Industrial SEZs in Indonesia',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'JIIPE: Tolok Ukur untuk KEK Industri di Indonesia',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ]
                ]
            ],
            // Video Gallery 3
            [
                'image' => 'images/gallery/64e33-bpyoisqp-mwhd-1.jpg',
                'is_active' => true,
                'date_input' => Carbon::create(2023, 7, 12),
                'date_update' => Carbon::create(2023, 7, 12),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => 1,
                'image_2' => null,
                'url_video' => 'https://www.youtube.com/embed/dcW7NEcGX_U',
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'Video Profile Java Integrated Industrial & Ports Estate - Gresik SEZ 2022',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Profil Video Java Integrated Industrial & Ports Estate - KEK Gresik 2022',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ]
                ]
            ],
            // Photo Gallery 1
            [
                'image' => 'images/gallery/photo1.jpg',
                'is_active' => true,
                'date_input' => Carbon::create(2025, 10, 1),
                'date_update' => Carbon::create(2025, 10, 1),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => 1,
                'image_2' => null,
                'url_video' => null,
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'JIIPE Infrastructure Development Progress',
                        'sub_title' => 'Industrial Zone Construction',
                        'sub_title_2' => 'October 2025',
                        'content' => 'Latest photos showing the progress of infrastructure development at JIIPE Special Economic Zone.',
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Kemajuan Pembangunan Infrastruktur JIIPE',
                        'sub_title' => 'Konstruksi Kawasan Industri',
                        'sub_title_2' => 'Oktober 2025',
                        'content' => 'Foto terbaru yang menunjukkan kemajuan pembangunan infrastruktur di Kawasan Ekonomi Khusus JIIPE.',
                    ]
                ]
            ],
            // Photo Gallery 2
            [
                'image' => 'images/gallery/photo2.jpg',
                'is_active' => true,
                'date_input' => Carbon::create(2025, 9, 15),
                'date_update' => Carbon::create(2025, 9, 15),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => 1,
                'image_2' => null,
                'url_video' => null,
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'Port Facilities Expansion',
                        'sub_title' => 'Maritime Infrastructure',
                        'sub_title_2' => 'September 2025',
                        'content' => 'Documentation of port expansion and maritime facilities development at JIIPE.',
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Perluasan Fasilitas Pelabuhan',
                        'sub_title' => 'Infrastruktur Maritim',
                        'sub_title_2' => 'September 2025',
                        'content' => 'Dokumentasi perluasan pelabuhan dan pengembangan fasilitas maritim di JIIPE.',
                    ]
                ]
            ],
            // Photo Gallery 3
            [
                'image' => 'images/gallery/photo3.jpg',
                'is_active' => true,
                'date_input' => Carbon::create(2025, 8, 20),
                'date_update' => Carbon::create(2025, 8, 20),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => 1,
                'image_2' => null,
                'url_video' => null,
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'Industrial Factory Construction',
                        'sub_title' => 'Manufacturing Facilities',
                        'sub_title_2' => 'August 2025',
                        'content' => 'Progress photos of various industrial facilities being constructed within JIIPE SEZ.',
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Pembangunan Pabrik Industri',
                        'sub_title' => 'Fasilitas Manufaktur',
                        'sub_title_2' => 'Agustus 2025',
                        'content' => 'Foto kemajuan berbagai fasilitas industri yang sedang dibangun di dalam KEK JIIPE.',
                    ]
                ]
            ],
        ];

        foreach ($galleries as $galleryData) {
            $gallery = Gallery::create([
                'topic_id' => 1,
                'image' => $galleryData['image'],
                'is_active' => $galleryData['is_active'],
                'date_input' => $galleryData['date_input'],
                'date_update' => $galleryData['date_update'],
                'created_by' => $galleryData['created_by'],
                'updated_by' => $galleryData['updated_by'],
                'writer' => $galleryData['writer'],
                'price' => $galleryData['price'],
                'orientation' => $galleryData['orientation'],
                'image_2' => $galleryData['image_2'],
                'url_video' => $galleryData['url_video'],
            ]);

            foreach ($galleryData['translations'] as $translation) {
                GalleryTranslations::create([
                    'gallery_id' => $gallery->id,
                    'locale' => $translation['locale'],
                    'title' => $translation['title'],
                    'sub_title' => $translation['sub_title'],
                    'sub_title_2' => $translation['sub_title_2'],
                    'content' => $translation['content'],
                ]);
            }
        }
    }
}