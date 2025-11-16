<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;
use App\Models\GalleryTranslations;
use Carbon\Carbon;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        Gallery::truncate();
        GalleryTranslations::truncate();

        $galleryData = [
            [
                'topic_id' => 0,
                'image' => 'thumb_f9bde-xq1pbtxflrahd_adaptiveResize_634_385.jpg',
                'is_active' => true,
                'date_input' => Carbon::parse('2024-11-05'),
                'date_update' => Carbon::parse('2024-11-05'),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => null,
                'image_2' => null,
                'url_video' => 'https://www.youtube.com/embed/Xq1PBTxFLrA?autoplay=1',
                'translations' => [
                    'id' => [
                        'title' => 'Lokasi Strategis untuk Industri Hilir dan Energi Terbarukan',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'en' => [
                        'title' => 'A Strategic Location for Downstream Industries and Renewable Energy',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'zh' => [
                        'title' => '下游产业和可再生能源的战略位置',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ja' => [
                        'title' => '下流産業と再生可能エネルギーの戦略的立地',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ko' => [
                        'title' => '다운스트림 산업 및 재생 에너지를 위한 전략적 위치',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'tw' => [
                        'title' => '下游產業和可再生能源的戰略位置',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                ]
            ],
            [
                'topic_id' => 0,
                'image' => 'thumb_7c418-ar1oojpozacsd_adaptiveResize_634_385.jpg',
                'is_active' => true,
                'date_input' => Carbon::parse('2024-09-13'),
                'date_update' => Carbon::parse('2024-09-13'),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => null,
                'image_2' => null,
                'url_video' => 'https://www.youtube.com/embed/Ar1oojPozAc?autoplay=1',
                'translations' => [
                    'id' => [
                        'title' => 'JIIPE: Tolok Ukur untuk KEK Industri di Indonesia',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'en' => [
                        'title' => 'JIIPE: The Benchmark for Industrial SEZs in Indonesia',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'zh' => [
                        'title' => 'JIIPE：印度尼西亚工业经济特区的标杆',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ja' => [
                        'title' => 'JIIPE：インドネシアの工業経済特区のベンチマーク',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ko' => [
                        'title' => 'JIIPE: 인도네시아 산업 경제특구의 벤치마크',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'tw' => [
                        'title' => 'JIIPE：印度尼西亞工業經濟特區的標竿',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                ]
            ],
            [
                'topic_id' => 0,
                'image' => 'thumb_64e33-bpyoisqp-mwhd-1_adaptiveResize_634_385.jpg',
                'is_active' => true,
                'date_input' => Carbon::parse('2023-07-12'),
                'date_update' => Carbon::parse('2023-07-12'),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => null,
                'image_2' => null,
                'url_video' => 'https://www.youtube.com/embed/dcW7NEcGX_U?autoplay=1',
                'translations' => [
                    'id' => [
                        'title' => 'Video Profil Java Integrated Industrial & Ports Estate - KEK Gresik 2022',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'en' => [
                        'title' => 'Video Profile Java Integrated Industrial & Ports Estate - Gresik SEZ 2022',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'zh' => [
                        'title' => '爪哇综合工业港口区视频简介 - 格雷西克经济特区 2022',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ja' => [
                        'title' => 'ジャワ統合工業港湾エステート ビデオプロフィール - グレシック経済特区 2022',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ko' => [
                        'title' => 'Java Integrated Industrial & Ports Estate 비디오 프로필 - 그레식 경제특구 2022',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'tw' => [
                        'title' => '爪哇綜合工業港口區視頻簡介 - 格雷西克經濟特區 2022',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                ]
            ],
            [
                'topic_id' => 0,
                'image' => 'thumb_44b92-9dipeyzq4m0sd_adaptiveResize_634_385.jpg',
                'is_active' => true,
                'date_input' => Carbon::parse('2023-02-11'),
                'date_update' => Carbon::parse('2023-02-11'),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => null,
                'image_2' => null,
                'url_video' => 'https://www.youtube.com/embed/9DiPEYZQ4M0?autoplay=1',
                'translations' => [
                    'id' => [
                        'title' => 'Pernyataan Perwakilan Wakil Presiden di JIIPE, Gresik, Jawa Timur',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'en' => [
                        'title' => 'Statement of the Vice President\'s representative at JIIPE, Gresik, East Java',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'zh' => [
                        'title' => '副总统代表在东爪哇格雷西克JIIPE的声明',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ja' => [
                        'title' => '東ジャワ州グレシックのJIIPEにおける副大統領代表の声明',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ko' => [
                        'title' => '동자바 그레식 JIIPE에서의 부통령 대표 성명',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'tw' => [
                        'title' => '副總統代表在東爪哇格雷西克JIIPE的聲明',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                ]
            ],
            [
                'topic_id' => 0,
                'image' => 'thumb_38c15-cva7l5ay0d0sd_adaptiveResize_634_385.jpg',
                'is_active' => true,
                'date_input' => Carbon::parse('2023-02-09'),
                'date_update' => Carbon::parse('2023-02-09'),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => null,
                'image_2' => null,
                'url_video' => 'https://www.youtube.com/embed/CvA7L5aY0D0?autoplay=1',
                'translations' => [
                    'id' => [
                        'title' => 'Menko Perekonomian Tinjau Progres KEK Gresik & Smelter Manyar Freeport',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'en' => [
                        'title' => 'Coordinating Minister for Economic Affairs Reviews Progress of Gresik SEZ & Manyar Smelter Freeport',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'zh' => [
                        'title' => '经济事务协调部长审查格雷西克经济特区和Manyar冶炼厂Freeport的进展',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ja' => [
                        'title' => '経済担当調整大臣がグレシック経済特区とManyar製錬所Freeportの進捗を視察',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ko' => [
                        'title' => '경제 조정부 장관, 그레식 경제특구 및 Manyar 제련소 Freeport 진행 상황 검토',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'tw' => [
                        'title' => '經濟事務協調部長審查格雷西克經濟特區和Manyar冶煉廠Freeport的進展',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                ]
            ],
            [
                'topic_id' => 0,
                'image' => 'thumb_02aaf-h0ymwfyatnchd_adaptiveResize_634_385.jpg',
                'is_active' => true,
                'date_input' => Carbon::parse('2023-01-10'),
                'date_update' => Carbon::parse('2023-01-10'),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => null,
                'image_2' => null,
                'url_video' => 'https://www.youtube.com/embed/H0YmwFYaTNc?autoplay=1',
                'translations' => [
                    'id' => [
                        'title' => 'Apa yang Dapat Diharapkan Investor dari JIIPE?',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'en' => [
                        'title' => 'What can investors expect from JIIPE ?',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'zh' => [
                        'title' => '投资者可以从JIIPE期待什么？',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ja' => [
                        'title' => '投資家はJIIPEに何を期待できるか？',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ko' => [
                        'title' => '투자자들은 JIIPE에서 무엇을 기대할 수 있습니까?',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'tw' => [
                        'title' => '投資者可以從JIIPE期待什麼？',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                ]
            ],
            [
                'topic_id' => 0,
                'image' => 'thumb_bab50-zf-pifn92vyhd_adaptiveResize_634_385.jpg',
                'is_active' => true,
                'date_input' => Carbon::parse('2022-03-15'),
                'date_update' => Carbon::parse('2022-03-15'),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => null,
                'image_2' => null,
                'url_video' => 'https://www.youtube.com/embed/zF_piFn92VY?autoplay=1',
                'translations' => [
                    'id' => [
                        'title' => 'Presiden Jokowi Resmikan Groundbreaking Smelter PT Freeport Indonesia di KEK Gresik',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'en' => [
                        'title' => 'President Jokowi Inaugurates the Groundbreaking of PT Freeport Indonesia\'s Smelter at Gresik SEZ',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'zh' => [
                        'title' => 'Jokowi总统在格雷西克经济特区为PT Freeport Indonesia的冶炼厂举行奠基仪式',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ja' => [
                        'title' => 'Jokowi大統領がグレシック経済特区でPT Freeport Indonesiaの製錬所の起工式を行う',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ko' => [
                        'title' => 'Jokowi 대통령, 그레식 경제특구에서 PT Freeport Indonesia 제련소 기공식 개최',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'tw' => [
                        'title' => 'Jokowi總統在格雷西克經濟特區為PT Freeport Indonesia的冶煉廠舉行奠基儀式',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                ]
            ],
            [
                'topic_id' => 0,
                'image' => 'thumb_135f5-m4-cs9hzkxwhd_adaptiveResize_634_385.jpg',
                'is_active' => true,
                'date_input' => Carbon::parse('2022-03-14'),
                'date_update' => Carbon::parse('2022-03-14'),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => null,
                'image_2' => null,
                'url_video' => 'https://www.youtube.com/embed/M4-CS9HZKXw?autoplay=1',
                'translations' => [
                    'id' => [
                        'title' => 'Pemerintah Dorong Industri Melalui Pengembangan KEK',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'en' => [
                        'title' => 'The Government Encourages Industry Through SEZ Development',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'zh' => [
                        'title' => '政府通过经济特区发展鼓励产业',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ja' => [
                        'title' => '政府が経済特区の開発を通じて産業を奨励',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ko' => [
                        'title' => '정부는 경제특구 개발을 통해 산업을 장려합니다',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'tw' => [
                        'title' => '政府通過經濟特區發展鼓勵產業',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                ]
            ],
            [
                'topic_id' => 0,
                'image' => 'thumb_52e41-xgdwv1idk28hd_adaptiveResize_634_385.jpg',
                'is_active' => true,
                'date_input' => Carbon::parse('2022-03-14'),
                'date_update' => Carbon::parse('2022-03-14'),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => null,
                'image_2' => null,
                'url_video' => 'https://www.youtube.com/embed/XgDWV1idK28?autoplay=1',
                'translations' => [
                    'id' => [
                        'title' => 'Potensi & Keunggulan JIIPE Sebagai Kawasan Ekonomi Khusus',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'en' => [
                        'title' => 'JIIPE Potential & Advantages As Special Economic Zone',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'zh' => [
                        'title' => 'JIIPE作为经济特区的潜力和优势',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ja' => [
                        'title' => 'JIIPEの経済特区としての可能性と利点',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ko' => [
                        'title' => '경제특구로서의 JIIPE 잠재력 및 이점',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'tw' => [
                        'title' => 'JIIPE作為經濟特區的潛力和優勢',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                ]
            ],
            [
                'topic_id' => 0,
                'image' => 'thumb_188ae-imxnrrzxmp4hd_adaptiveResize_634_385.jpg',
                'is_active' => true,
                'date_input' => Carbon::parse('2022-03-14'),
                'date_update' => Carbon::parse('2022-03-14'),
                'created_by' => 1,
                'updated_by' => 1,
                'writer' => 1,
                'price' => null,
                'orientation' => null,
                'image_2' => null,
                'url_video' => 'https://www.youtube.com/embed/imxNrRZxmP4?autoplay=1',
                'translations' => [
                    'id' => [
                        'title' => 'Strategi BKMS Mengelola 5 Klaster Industri di KEK Gresik JIIPE',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'en' => [
                        'title' => 'BKMS Strategy to Manage 5 Industrial Clusters in SEZ Gresik JIIPE',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'zh' => [
                        'title' => 'BKMS管理格雷西克JIIPE经济特区5个产业集群的策略',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ja' => [
                        'title' => 'グレシックJIIPE経済特区の5つの産業クラスターを管理するBKMS戦略',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'ko' => [
                        'title' => '그레식 JIIPE 경제특구의 5개 산업 클러스터를 관리하는 BKMS 전략',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                    'tw' => [
                        'title' => 'BKMS管理格雷西克JIIPE經濟特區5個產業集群的策略',
                        'sub_title' => null,
                        'sub_title_2' => null,
                        'content' => null,
                    ],
                ]
            ],
        ];

        foreach ($galleryData as $data) {
            $translations = $data['translations'];
            unset($data['translations']);

            $gallery = Gallery::create($data);

            foreach ($translations as $locale => $translation) {
                GalleryTranslations::create([
                    'gallery_id' => $gallery->id,
                    'locale' => $locale,
                    'title' => $translation['title'],
                    'sub_title' => $translation['sub_title'],
                    'sub_title_2' => $translation['sub_title_2'],
                    'content' => $translation['content'],
                ]);
            }
        }
    }
}