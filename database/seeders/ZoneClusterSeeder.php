<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\ZoneCluster;
use App\Models\ZoneClusterTranslation;
class ZoneClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ZoneCluster::truncate();
        ZoneClusterTranslation::truncate();

        $now = Carbon::now();

        // Data zone clusters
        $clusters = [
            [
                'id' => 1,
                'zone_id' => 5, // Sesuaikan dengan zone_id yang ada
                'image' => 'thumb_0d2d0-heavy-industry_adaptiveResize_1313_492.jpg',
                'area_size' => '500 Ha',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Industri Berat',
                        'subtitle' => 'Kawasan Industri Berat',
                        'description' => 'Kawasan khusus untuk industri berat dengan infrastruktur lengkap dan akses logistik yang strategis.',
                        'meta_title' => 'Kawasan Industri Berat - JIIPE',
                        'meta_description' => 'Kawasan industri berat dengan fasilitas modern dan infrastruktur terbaik di JIIPE',
                        'meta_keywords' => 'industri berat, heavy industry, kawasan industri, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Heavy Industries',
                        'subtitle' => 'Heavy Industries Zone',
                        'description' => 'Dedicated zone for heavy industries with complete infrastructure and strategic logistics access.',
                        'meta_title' => 'Heavy Industries Zone - JIIPE',
                        'meta_description' => 'Heavy industries zone with modern facilities and best infrastructure at JIIPE',
                        'meta_keywords' => 'heavy industry, industrial zone, JIIPE',
                    ],
                    'zh' => [
                        'name' => '重工业',
                        'subtitle' => '重工业区',
                        'description' => '专为重工业设计的区域，配备完善的基础设施和战略物流通道。',
                        'meta_title' => '重工业区 - JIIPE',
                        'meta_description' => 'JIIPE重工业区拥有现代化设施和最佳基础设施',
                        'meta_keywords' => '重工业, 工业区, JIIPE',
                    ],
                    'ja' => [
                        'name' => '重工業',
                        'subtitle' => '重工業ゾーン',
                        'description' => '完全なインフラと戦略的な物流アクセスを備えた重工業専用ゾーン。',
                        'meta_title' => '重工業ゾーン - JIIPE',
                        'meta_description' => 'JIIPEの現代的な施設と最高のインフラを備えた重工業ゾーン',
                        'meta_keywords' => '重工業, 工業地帯, JIIPE',
                    ],
                    'ko' => [
                        'name' => '중공업',
                        'subtitle' => '중공업 구역',
                        'description' => '완벽한 인프라와 전략적 물류 접근성을 갖춘 중공업 전용 구역입니다.',
                        'meta_title' => '중공업 구역 - JIIPE',
                        'meta_description' => 'JIIPE의 현대적인 시설과 최고의 인프라를 갖춘 중공업 구역',
                        'meta_keywords' => '중공업, 산업단지, JIIPE',
                    ],
                    'tw' => [
                        'name' => '重工業',
                        'subtitle' => '重工業區',
                        'description' => '專為重工業設計的區域，配備完善的基礎設施和戰略物流通道。',
                        'meta_title' => '重工業區 - JIIPE',
                        'meta_description' => 'JIIPE重工業區擁有現代化設施和最佳基礎設施',
                        'meta_keywords' => '重工業, 工業區, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 2,
                'zone_id' => 5,
                'image' => 'thumb_18593-medium-industry_adaptiveResize_1313_492.jpg',
                'area_size' => '350 Ha',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Industri Menengah',
                        'subtitle' => 'Kawasan Industri Menengah',
                        'description' => 'Kawasan yang ideal untuk industri menengah dengan fasilitas pendukung yang memadai.',
                        'meta_title' => 'Kawasan Industri Menengah - JIIPE',
                        'meta_description' => 'Kawasan industri menengah dengan fasilitas lengkap dan lokasi strategis di JIIPE',
                        'meta_keywords' => 'industri menengah, medium industry, kawasan industri, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Medium Industries',
                        'subtitle' => 'Medium Industries Zone',
                        'description' => 'Ideal zone for medium industries with adequate supporting facilities.',
                        'meta_title' => 'Medium Industries Zone - JIIPE',
                        'meta_description' => 'Medium industries zone with complete facilities and strategic location at JIIPE',
                        'meta_keywords' => 'medium industry, industrial zone, JIIPE',
                    ],
                    'zh' => [
                        'name' => '中型工业',
                        'subtitle' => '中型工业区',
                        'description' => '配备充足配套设施的中型工业理想区域。',
                        'meta_title' => '中型工业区 - JIIPE',
                        'meta_description' => 'JIIPE中型工业区拥有完善的设施和战略位置',
                        'meta_keywords' => '中型工业, 工业区, JIIPE',
                    ],
                    'ja' => [
                        'name' => '中規模産業',
                        'subtitle' => '中規模産業ゾーン',
                        'description' => '適切なサポート施設を備えた中規模産業に最適なゾーン。',
                        'meta_title' => '中規模産業ゾーン - JIIPE',
                        'meta_description' => 'JIIPEの完全な施設と戦略的な場所を備えた中規模産業ゾーン',
                        'meta_keywords' => '中規模産業, 工業地帯, JIIPE',
                    ],
                    'ko' => [
                        'name' => '중규모 산업',
                        'subtitle' => '중규모 산업 구역',
                        'description' => '적절한 지원 시설을 갖춘 중규모 산업에 이상적인 구역입니다.',
                        'meta_title' => '중규모 산업 구역 - JIIPE',
                        'meta_description' => 'JIIPE의 완벽한 시설과 전략적 위치를 갖춘 중규모 산업 구역',
                        'meta_keywords' => '중규모 산업, 산업단지, JIIPE',
                    ],
                    'tw' => [
                        'name' => '中型工業',
                        'subtitle' => '中型工業區',
                        'description' => '配備充足配套設施的中型工業理想區域。',
                        'meta_title' => '中型工業區 - JIIPE',
                        'meta_description' => 'JIIPE中型工業區擁有完善的設施和戰略位置',
                        'meta_keywords' => '中型工業, 工業區, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 3,
                'zone_id' => 5,
                'image' => 'thumb_a1ea3-light-industry-1_adaptiveResize_1313_492.jpg',
                'area_size' => '250 Ha',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Industri Ringan',
                        'subtitle' => 'Kawasan Industri Ringan',
                        'description' => 'Kawasan untuk industri ringan dengan lingkungan yang bersih dan teratur.',
                        'meta_title' => 'Kawasan Industri Ringan - JIIPE',
                        'meta_description' => 'Kawasan industri ringan dengan lingkungan bersih dan fasilitas modern di JIIPE',
                        'meta_keywords' => 'industri ringan, light industry, kawasan industri, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Light Industries',
                        'subtitle' => 'Light Industries Zone',
                        'description' => 'Zone for light industries with clean and organized environment.',
                        'meta_title' => 'Light Industries Zone - JIIPE',
                        'meta_description' => 'Light industries zone with clean environment and modern facilities at JIIPE',
                        'meta_keywords' => 'light industry, industrial zone, JIIPE',
                    ],
                    'zh' => [
                        'name' => '轻工业',
                        'subtitle' => '轻工业区',
                        'description' => '环境清洁有序的轻工业区域。',
                        'meta_title' => '轻工业区 - JIIPE',
                        'meta_description' => 'JIIPE轻工业区拥有清洁的环境和现代化设施',
                        'meta_keywords' => '轻工业, 工业区, JIIPE',
                    ],
                    'ja' => [
                        'name' => '軽工業',
                        'subtitle' => '軽工業ゾーン',
                        'description' => '清潔で整然とした環境を備えた軽工業のゾーン。',
                        'meta_title' => '軽工業ゾーン - JIIPE',
                        'meta_description' => 'JIIPEのクリーンな環境と現代的な施設を備えた軽工業ゾーン',
                        'meta_keywords' => '軽工業, 工業地帯, JIIPE',
                    ],
                    'ko' => [
                        'name' => '경공업',
                        'subtitle' => '경공업 구역',
                        'description' => '깨끗하고 정돈된 환경을 갖춘 경공업 구역입니다.',
                        'meta_title' => '경공업 구역 - JIIPE',
                        'meta_description' => 'JIIPE의 깨끗한 환경과 현대적인 시설을 갖춘 경공업 구역',
                        'meta_keywords' => '경공업, 산업단지, JIIPE',
                    ],
                    'tw' => [
                        'name' => '輕工業',
                        'subtitle' => '輕工業區',
                        'description' => '環境清潔有序的輕工業區域。',
                        'meta_title' => '輕工業區 - JIIPE',
                        'meta_description' => 'JIIPE輕工業區擁有清潔的環境和現代化設施',
                        'meta_keywords' => '輕工業, 工業區, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 4,
                'zone_id' => 5,
                'image' => 'thumb_4466a-utlity_adaptiveResize_1313_492.jpg',
                'area_size' => '150 Ha',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Utilitas',
                        'subtitle' => 'Kawasan Utilitas',
                        'description' => 'Kawasan utilitas yang menyediakan infrastruktur pendukung untuk semua zona industri.',
                        'meta_title' => 'Kawasan Utilitas - JIIPE',
                        'meta_description' => 'Kawasan utilitas dengan infrastruktur lengkap untuk mendukung operasional industri di JIIPE',
                        'meta_keywords' => 'utilitas, utilities, kawasan pendukung, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Utilities',
                        'subtitle' => 'Utilities Zone',
                        'description' => 'Utilities zone providing supporting infrastructure for all industrial zones.',
                        'meta_title' => 'Utilities Zone - JIIPE',
                        'meta_description' => 'Utilities zone with complete infrastructure to support industrial operations at JIIPE',
                        'meta_keywords' => 'utilities, supporting zone, JIIPE',
                    ],
                    'zh' => [
                        'name' => '公用设施',
                        'subtitle' => '公用设施区',
                        'description' => '为所有工业区提供配套基础设施的公用设施区域。',
                        'meta_title' => '公用设施区 - JIIPE',
                        'meta_description' => 'JIIPE公用设施区拥有完善的基础设施以支持工业运营',
                        'meta_keywords' => '公用设施, 配套区, JIIPE',
                    ],
                    'ja' => [
                        'name' => 'ユーティリティ',
                        'subtitle' => 'ユーティリティゾーン',
                        'description' => 'すべての工業ゾーンに支援インフラを提供するユーティリティゾーン。',
                        'meta_title' => 'ユーティリティゾーン - JIIPE',
                        'meta_description' => 'JIIPEの産業運営をサポートする完全なインフラを備えたユーティリティゾーン',
                        'meta_keywords' => 'ユーティリティ, サポートゾーン, JIIPE',
                    ],
                    'ko' => [
                        'name' => '유틸리티',
                        'subtitle' => '유틸리티 구역',
                        'description' => '모든 산업 구역을 위한 지원 인프라를 제공하는 유틸리티 구역입니다.',
                        'meta_title' => '유틸리티 구역 - JIIPE',
                        'meta_description' => 'JIIPE의 산업 운영을 지원하는 완벽한 인프라를 갖춘 유틸리티 구역',
                        'meta_keywords' => '유틸리티, 지원 구역, JIIPE',
                    ],
                    'tw' => [
                        'name' => '公用設施',
                        'subtitle' => '公用設施區',
                        'description' => '為所有工業區提供配套基礎設施的公用設施區域。',
                        'meta_title' => '公用設施區 - JIIPE',
                        'meta_description' => 'JIIPE公用設施區擁有完善的基礎設施以支持工業運營',
                        'meta_keywords' => '公用設施, 配套區, JIIPE',
                    ],
                ],
            ],
        ];

        // Insert zone clusters dan translations
        foreach ($clusters as $cluster) {
            $translations = $cluster['translations'];
            unset($cluster['translations']);

            // Insert cluster
            DB::table('zone_clusters')->insert($cluster);

            // Insert translations
            foreach ($translations as $locale => $translation) {
                DB::table('zone_cluster_translations')->insert([
                    'zone_clusters_id' => $cluster['id'],
                    'locale' => $locale,
                    'name' => $translation['name'],
                    'subtitle' => $translation['subtitle'],
                    'description' => $translation['description'],
                    'meta_title' => $translation['meta_title'],
                    'meta_description' => $translation['meta_description'],
                    'meta_keywords' => $translation['meta_keywords'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // Data zone clusters untuk infrastruktur
        $clusters = [
            [
                'id' => 5,
                'zone_id' => 6, // Sesuaikan dengan zone_id yang ada
                'image' => 'thumb_e128d-jetty_adaptiveResize_1313_492.jpg',
                'area_size' => '5 Units',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Dermaga',
                        'subtitle' => 'Fasilitas Dermaga',
                        'description' => 'Fasilitas dermaga modern untuk bongkar muat kargo dengan kapasitas besar dan akses langsung ke pelabuhan internasional.',
                        'meta_title' => 'Fasilitas Dermaga - JIIPE',
                        'meta_description' => 'Dermaga modern dengan fasilitas bongkar muat lengkap di JIIPE Gresik',
                        'meta_keywords' => 'dermaga, jetty, pelabuhan, bongkar muat, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Jetty',
                        'subtitle' => 'Jetty Facilities',
                        'description' => 'Modern jetty facilities for cargo loading and unloading with large capacity and direct access to international ports.',
                        'meta_title' => 'Jetty Facilities - JIIPE',
                        'meta_description' => 'Modern jetty with complete loading and unloading facilities at JIIPE Gresik',
                        'meta_keywords' => 'jetty, port, cargo loading, JIIPE',
                    ],
                    'zh' => [
                        'name' => '码头',
                        'subtitle' => '码头设施',
                        'description' => '现代化码头设施，用于大容量货物装卸，可直接通往国际港口。',
                        'meta_title' => '码头设施 - JIIPE',
                        'meta_description' => 'JIIPE格雷西克的现代化码头配备完善的装卸设施',
                        'meta_keywords' => '码头, 港口, 货物装卸, JIIPE',
                    ],
                    'ja' => [
                        'name' => '桟橋',
                        'subtitle' => '桟橋施設',
                        'description' => '大容量の貨物積み降ろしのための最新の桟橋施設で、国際港への直接アクセスが可能です。',
                        'meta_title' => '桟橋施設 - JIIPE',
                        'meta_description' => 'JIIPEグレシックの完全な積み降ろし施設を備えた最新の桟橋',
                        'meta_keywords' => '桟橋, 港, 貨物積み降ろし, JIIPE',
                    ],
                    'ko' => [
                        'name' => '부두',
                        'subtitle' => '부두 시설',
                        'description' => '대용량 화물 적하 및 양하를 위한 현대적인 부두 시설로 국제 항구에 직접 접근할 수 있습니다.',
                        'meta_title' => '부두 시설 - JIIPE',
                        'meta_description' => 'JIIPE 그레식의 완벽한 적하 및 양하 시설을 갖춘 현대적인 부두',
                        'meta_keywords' => '부두, 항구, 화물 적재, JIIPE',
                    ],
                    'tw' => [
                        'name' => '碼頭',
                        'subtitle' => '碼頭設施',
                        'description' => '現代化碼頭設施，用於大容量貨物裝卸，可直接通往國際港口。',
                        'meta_title' => '碼頭設施 - JIIPE',
                        'meta_description' => 'JIIPE格雷西克的現代化碼頭配備完善的裝卸設施',
                        'meta_keywords' => '碼頭, 港口, 貨物裝卸, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 6,
                'zone_id' => 6,
                'image' => 'thumb_9fe2a-road-access_adaptiveResize_1313_492.jpg',
                'area_size' => '50 Km',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Akses Jalan / Bongkar Muat',
                        'subtitle' => 'Infrastruktur Akses Jalan',
                        'description' => 'Jaringan jalan yang luas dengan area bongkar muat yang efisien untuk mendukung distribusi dan logistik yang lancar.',
                        'meta_title' => 'Akses Jalan & Bongkar Muat - JIIPE',
                        'meta_description' => 'Infrastruktur jalan modern dan area bongkar muat yang efisien di JIIPE',
                        'meta_keywords' => 'akses jalan, road access, bongkar muat, logistik, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Road Access / Load & Unload',
                        'subtitle' => 'Road Access Infrastructure',
                        'description' => 'Extensive road network with efficient loading and unloading areas to support smooth distribution and logistics.',
                        'meta_title' => 'Road Access & Load Unload - JIIPE',
                        'meta_description' => 'Modern road infrastructure and efficient loading areas at JIIPE',
                        'meta_keywords' => 'road access, loading unloading, logistics, JIIPE',
                    ],
                    'zh' => [
                        'name' => '道路通道 / 装卸',
                        'subtitle' => '道路通道基础设施',
                        'description' => '广泛的道路网络配备高效的装卸区域，以支持顺畅的配送和物流。',
                        'meta_title' => '道路通道与装卸 - JIIPE',
                        'meta_description' => 'JIIPE的现代道路基础设施和高效装卸区域',
                        'meta_keywords' => '道路通道, 装卸, 物流, JIIPE',
                    ],
                    'ja' => [
                        'name' => '道路アクセス / 積み降ろし',
                        'subtitle' => '道路アクセスインフラ',
                        'description' => '効率的な積み降ろしエリアを備えた広範な道路ネットワークで、スムーズな配送と物流をサポートします。',
                        'meta_title' => '道路アクセスと積み降ろし - JIIPE',
                        'meta_description' => 'JIIPEの最新の道路インフラと効率的な積み降ろしエリア',
                        'meta_keywords' => '道路アクセス, 積み降ろし, 物流, JIIPE',
                    ],
                    'ko' => [
                        'name' => '도로 접근 / 적하 및 양하',
                        'subtitle' => '도로 접근 인프라',
                        'description' => '효율적인 적하 및 양하 구역을 갖춘 광범위한 도로 네트워크로 원활한 유통 및 물류를 지원합니다.',
                        'meta_title' => '도로 접근 및 적하양하 - JIIPE',
                        'meta_description' => 'JIIPE의 현대적인 도로 인프라와 효율적인 적하 구역',
                        'meta_keywords' => '도로 접근, 적하양하, 물류, JIIPE',
                    ],
                    'tw' => [
                        'name' => '道路通道 / 裝卸',
                        'subtitle' => '道路通道基礎設施',
                        'description' => '廣泛的道路網絡配備高效的裝卸區域，以支持順暢的配送和物流。',
                        'meta_title' => '道路通道與裝卸 - JIIPE',
                        'meta_description' => 'JIIPE的現代道路基礎設施和高效裝卸區域',
                        'meta_keywords' => '道路通道, 裝卸, 物流, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 7,
                'zone_id' => 6,
                'image' => 'thumb_7497b-pipeline_adaptiveResize_1313_492.jpg',
                'area_size' => '25 Km',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Pipa',
                        'subtitle' => 'Sistem Perpipaan',
                        'description' => 'Sistem perpipaan modern untuk distribusi bahan baku dan utilitas dengan teknologi terkini dan sistem monitoring yang canggih.',
                        'meta_title' => 'Sistem Perpipaan - JIIPE',
                        'meta_description' => 'Sistem perpipaan modern dengan teknologi canggih di JIIPE',
                        'meta_keywords' => 'pipa, pipeline, distribusi, utilitas, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Pipeline',
                        'subtitle' => 'Pipeline System',
                        'description' => 'Modern pipeline system for raw material and utility distribution with latest technology and advanced monitoring system.',
                        'meta_title' => 'Pipeline System - JIIPE',
                        'meta_description' => 'Modern pipeline system with advanced technology at JIIPE',
                        'meta_keywords' => 'pipeline, distribution, utilities, JIIPE',
                    ],
                    'zh' => [
                        'name' => '管道',
                        'subtitle' => '管道系统',
                        'description' => '采用最新技术和先进监控系统的现代化管道系统，用于原材料和公用设施的分配。',
                        'meta_title' => '管道系统 - JIIPE',
                        'meta_description' => 'JIIPE采用先进技术的现代化管道系统',
                        'meta_keywords' => '管道, 分配, 公用设施, JIIPE',
                    ],
                    'ja' => [
                        'name' => 'パイプライン',
                        'subtitle' => 'パイプラインシステム',
                        'description' => '最新技術と高度な監視システムを備えた、原材料とユーティリティ配給のための最新のパイプラインシステム。',
                        'meta_title' => 'パイプラインシステム - JIIPE',
                        'meta_description' => 'JIIPEの先進技術を備えた最新のパイプラインシステム',
                        'meta_keywords' => 'パイプライン, 配給, ユーティリティ, JIIPE',
                    ],
                    'ko' => [
                        'name' => '파이프라인',
                        'subtitle' => '파이프라인 시스템',
                        'description' => '최신 기술과 고급 모니터링 시스템을 갖춘 원자재 및 유틸리티 배급을 위한 현대적인 파이프라인 시스템입니다.',
                        'meta_title' => '파이프라인 시스템 - JIIPE',
                        'meta_description' => 'JIIPE의 첨단 기술을 갖춘 현대적인 파이프라인 시스템',
                        'meta_keywords' => '파이프라인, 배급, 유틸리티, JIIPE',
                    ],
                    'tw' => [
                        'name' => '管道',
                        'subtitle' => '管道系統',
                        'description' => '採用最新技術和先進監控系統的現代化管道系統，用於原材料和公用設施的分配。',
                        'meta_title' => '管道系統 - JIIPE',
                        'meta_description' => 'JIIPE採用先進技術的現代化管道系統',
                        'meta_keywords' => '管道, 分配, 公用設施, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 8,
                'zone_id' => 6,
                'image' => 'thumb_3de01-conveyor_adaptiveResize_1313_492.jpg',
                'area_size' => '15 Km',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Konveyor',
                        'subtitle' => 'Sistem Konveyor',
                        'description' => 'Sistem konveyor otomatis untuk transportasi material yang efisien dan mengurangi biaya operasional dengan kapasitas tinggi.',
                        'meta_title' => 'Sistem Konveyor - JIIPE',
                        'meta_description' => 'Sistem konveyor otomatis dengan kapasitas tinggi di JIIPE',
                        'meta_keywords' => 'konveyor, conveyor, transportasi material, otomatis, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Conveyor',
                        'subtitle' => 'Conveyor System',
                        'description' => 'Automated conveyor system for efficient material transportation and reduced operational costs with high capacity.',
                        'meta_title' => 'Conveyor System - JIIPE',
                        'meta_description' => 'Automated conveyor system with high capacity at JIIPE',
                        'meta_keywords' => 'conveyor, material transportation, automated, JIIPE',
                    ],
                    'zh' => [
                        'name' => '输送带',
                        'subtitle' => '输送带系统',
                        'description' => '自动化输送带系统，用于高效的物料运输和降低运营成本，具有高容量。',
                        'meta_title' => '输送带系统 - JIIPE',
                        'meta_description' => 'JIIPE的高容量自动化输送带系统',
                        'meta_keywords' => '输送带, 物料运输, 自动化, JIIPE',
                    ],
                    'ja' => [
                        'name' => 'コンベア',
                        'subtitle' => 'コンベアシステム',
                        'description' => '効率的な資材輸送と運用コストの削減を実現する高容量の自動コンベアシステム。',
                        'meta_title' => 'コンベアシステム - JIIPE',
                        'meta_description' => 'JIIPEの高容量自動コンベアシステム',
                        'meta_keywords' => 'コンベア, 資材輸送, 自動化, JIIPE',
                    ],
                    'ko' => [
                        'name' => '컨베이어',
                        'subtitle' => '컨베이어 시스템',
                        'description' => '효율적인 자재 운송과 운영 비용 절감을 위한 고용량 자동화 컨베이어 시스템입니다.',
                        'meta_title' => '컨베이어 시스템 - JIIPE',
                        'meta_description' => 'JIIPE의 고용량 자동화 컨베이어 시스템',
                        'meta_keywords' => '컨베이어, 자재 운송, 자동화, JIIPE',
                    ],
                    'tw' => [
                        'name' => '輸送帶',
                        'subtitle' => '輸送帶系統',
                        'description' => '自動化輸送帶系統，用於高效的物料運輸和降低運營成本，具有高容量。',
                        'meta_title' => '輸送帶系統 - JIIPE',
                        'meta_description' => 'JIIPE的高容量自動化輸送帶系統',
                        'meta_keywords' => '輸送帶, 物料運輸, 自動化, JIIPE',
                    ],
                ],
            ],
        ];

        // Insert zone clusters dan translations
        foreach ($clusters as $cluster) {
            $translations = $cluster['translations'];
            unset($cluster['translations']);

            // Insert cluster
            DB::table('zone_clusters')->insert($cluster);

            // Insert translations
            foreach ($translations as $locale => $translation) {
                DB::table('zone_cluster_translations')->insert([
                    'zone_clusters_id' => $cluster['id'],
                    'locale' => $locale,
                    'name' => $translation['name'],
                    'subtitle' => $translation['subtitle'],
                    'description' => $translation['description'],
                    'meta_title' => $translation['meta_title'],
                    'meta_description' => $translation['meta_description'],
                    'meta_keywords' => $translation['meta_keywords'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // Data zone clusters untuk fasilitas
        $clusters = [
            [
                'id' => 9,
                'zone_id' => 7, //7 Sesuaikan dengan zone_id yang ada
                'image' => 'thumb_fbf84-marina_adaptiveResize_1313_492.jpg',
                'area_size' => '20 Ha',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Marina',
                        'subtitle' => 'Marina dan Pelabuhan Wisata',
                        'description' => 'Fasilitas marina modern dengan dermaga yacht dan perahu pesiar, dilengkapi dengan fasilitas rekreasi dan restoran tepi laut.',
                        'meta_title' => 'Marina - JIIPE',
                        'meta_description' => 'Marina modern dengan fasilitas yacht dan rekreasi tepi laut di JIIPE',
                        'meta_keywords' => 'marina, yacht, pelabuhan wisata, rekreasi, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Marina',
                        'subtitle' => 'Marina and Recreation Port',
                        'description' => 'Modern marina facility with yacht and cruise boat docks, equipped with recreational facilities and waterfront restaurants.',
                        'meta_title' => 'Marina - JIIPE',
                        'meta_description' => 'Modern marina with yacht facilities and waterfront recreation at JIIPE',
                        'meta_keywords' => 'marina, yacht, recreation port, JIIPE',
                    ],
                    'zh' => [
                        'name' => '码头',
                        'subtitle' => '码头和休闲港',
                        'description' => '现代化码头设施配备游艇和游船停靠处，设有休闲设施和海滨餐厅。',
                        'meta_title' => '码头 - JIIPE',
                        'meta_description' => 'JIIPE的现代化码头配备游艇设施和海滨休闲区',
                        'meta_keywords' => '码头, 游艇, 休闲港, JIIPE',
                    ],
                    'ja' => [
                        'name' => 'マリーナ',
                        'subtitle' => 'マリーナとレクリエーション港',
                        'description' => 'ヨットやクルーズ船のドックを備えた最新のマリーナ施設で、レクリエーション施設とウォーターフロントレストランが完備されています。',
                        'meta_title' => 'マリーナ - JIIPE',
                        'meta_description' => 'JIIPEのヨット施設とウォーターフロントレクリエーションを備えた最新のマリーナ',
                        'meta_keywords' => 'マリーナ, ヨット, レクリエーション港, JIIPE',
                    ],
                    'ko' => [
                        'name' => '마리나',
                        'subtitle' => '마리나 및 레크리에이션 항구',
                        'description' => '요트 및 유람선 선착장을 갖춘 현대적인 마리나 시설로 레크리에이션 시설과 해안가 레스토랑이 구비되어 있습니다.',
                        'meta_title' => '마리나 - JIIPE',
                        'meta_description' => 'JIIPE의 요트 시설과 해안가 레크리에이션을 갖춘 현대적인 마리나',
                        'meta_keywords' => '마리나, 요트, 레크리에이션 항구, JIIPE',
                    ],
                    'tw' => [
                        'name' => '碼頭',
                        'subtitle' => '碼頭和休閒港',
                        'description' => '現代化碼頭設施配備遊艇和遊船停靠處，設有休閒設施和海濱餐廳。',
                        'meta_title' => '碼頭 - JIIPE',
                        'meta_description' => 'JIIPE的現代化碼頭配備遊艇設施和海濱休閒區',
                        'meta_keywords' => '碼頭, 遊艇, 休閒港, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 10,
                'zone_id' => 7,
                'image' => 'thumb_14715-west-gate_adaptiveResize_1313_492.jpg',
                'area_size' => '5 Ha',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Gerbang Barat',
                        'subtitle' => 'Pintu Masuk Barat',
                        'description' => 'Gerbang masuk utama di sisi barat kawasan industri dengan sistem keamanan modern dan fasilitas pemeriksaan yang lengkap.',
                        'meta_title' => 'Gerbang Barat - JIIPE',
                        'meta_description' => 'Pintu masuk utama sisi barat dengan sistem keamanan modern di JIIPE',
                        'meta_keywords' => 'gerbang barat, west gate, pintu masuk, keamanan, JIIPE',
                    ],
                    'en' => [
                        'name' => 'West Gate',
                        'subtitle' => 'West Entrance',
                        'description' => 'Main entrance gate on the west side of the industrial area with modern security system and complete inspection facilities.',
                        'meta_title' => 'West Gate - JIIPE',
                        'meta_description' => 'Main west side entrance with modern security system at JIIPE',
                        'meta_keywords' => 'west gate, entrance, security, JIIPE',
                    ],
                    'zh' => [
                        'name' => '西门',
                        'subtitle' => '西入口',
                        'description' => '工业区西侧主要入口门，配备现代安全系统和完整的检查设施。',
                        'meta_title' => '西门 - JIIPE',
                        'meta_description' => 'JIIPE西侧主要入口配备现代安全系统',
                        'meta_keywords' => '西门, 入口, 安全, JIIPE',
                    ],
                    'ja' => [
                        'name' => 'ウエストゲート',
                        'subtitle' => '西側入口',
                        'description' => '工業地帯の西側にある主要な入口ゲートで、最新のセキュリティシステムと完全な検査施設を備えています。',
                        'meta_title' => 'ウエストゲート - JIIPE',
                        'meta_description' => 'JIIPEの最新のセキュリティシステムを備えた西側メインエントランス',
                        'meta_keywords' => 'ウエストゲート, 入口, セキュリティ, JIIPE',
                    ],
                    'ko' => [
                        'name' => '서쪽 게이트',
                        'subtitle' => '서쪽 입구',
                        'description' => '현대적인 보안 시스템과 완벽한 검사 시설을 갖춘 산업 지역 서쪽의 주요 출입구 게이트입니다.',
                        'meta_title' => '서쪽 게이트 - JIIPE',
                        'meta_description' => 'JIIPE의 현대적인 보안 시스템을 갖춘 서쪽 주요 입구',
                        'meta_keywords' => '서쪽 게이트, 입구, 보안, JIIPE',
                    ],
                    'tw' => [
                        'name' => '西門',
                        'subtitle' => '西入口',
                        'description' => '工業區西側主要入口門，配備現代安全系統和完整的檢查設施。',
                        'meta_title' => '西門 - JIIPE',
                        'meta_description' => 'JIIPE西側主要入口配備現代安全系統',
                        'meta_keywords' => '西門, 入口, 安全, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 11,
                'zone_id' => 7,
                'image' => 'thumb_58818-cbd_adaptiveResize_1313_492.jpg',
                'area_size' => '100 Ha',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'CBD',
                        'subtitle' => 'Kawasan Pusat Bisnis',
                        'description' => 'Central Business District yang menjadi pusat kegiatan bisnis dan perkantoran dengan gedung-gedung modern dan fasilitas komersial lengkap.',
                        'meta_title' => 'CBD - Kawasan Pusat Bisnis JIIPE',
                        'meta_description' => 'Central Business District dengan gedung modern dan fasilitas komersial di JIIPE',
                        'meta_keywords' => 'CBD, central business district, pusat bisnis, perkantoran, JIIPE',
                    ],
                    'en' => [
                        'name' => 'CBD',
                        'subtitle' => 'Central Business District',
                        'description' => 'Central Business District serving as the center for business and office activities with modern buildings and complete commercial facilities.',
                        'meta_title' => 'CBD - Central Business District JIIPE',
                        'meta_description' => 'Central Business District with modern buildings and commercial facilities at JIIPE',
                        'meta_keywords' => 'CBD, central business district, business center, office, JIIPE',
                    ],
                    'zh' => [
                        'name' => 'CBD',
                        'subtitle' => '中央商务区',
                        'description' => '中央商务区作为商业和办公活动的中心，拥有现代化建筑和完善的商业设施。',
                        'meta_title' => 'CBD - JIIPE中央商务区',
                        'meta_description' => 'JIIPE的中央商务区拥有现代化建筑和商业设施',
                        'meta_keywords' => 'CBD, 中央商务区, 商业中心, 办公, JIIPE',
                    ],
                    'ja' => [
                        'name' => 'CBD',
                        'subtitle' => '中央ビジネス地区',
                        'description' => 'ビジネスとオフィス活動の中心として機能する中央ビジネス地区で、最新の建物と完全な商業施設を備えています。',
                        'meta_title' => 'CBD - JIIPE中央ビジネス地区',
                        'meta_description' => 'JIIPEの最新の建物と商業施設を備えた中央ビジネス地区',
                        'meta_keywords' => 'CBD, 中央ビジネス地区, ビジネスセンター, オフィス, JIIPE',
                    ],
                    'ko' => [
                        'name' => 'CBD',
                        'subtitle' => '중앙 업무 지구',
                        'description' => '현대적인 건물과 완벽한 상업 시설을 갖춘 비즈니스 및 사무 활동의 중심 역할을 하는 중앙 업무 지구입니다.',
                        'meta_title' => 'CBD - JIIPE 중앙 업무 지구',
                        'meta_description' => 'JIIPE의 현대적인 건물과 상업 시설을 갖춘 중앙 업무 지구',
                        'meta_keywords' => 'CBD, 중앙 업무 지구, 비즈니스 센터, 사무실, JIIPE',
                    ],
                    'tw' => [
                        'name' => 'CBD',
                        'subtitle' => '中央商務區',
                        'description' => '中央商務區作為商業和辦公活動的中心，擁有現代化建築和完善的商業設施。',
                        'meta_title' => 'CBD - JIIPE中央商務區',
                        'meta_description' => 'JIIPE的中央商務區擁有現代化建築和商業設施',
                        'meta_keywords' => 'CBD, 中央商務區, 商業中心, 辦公, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 12,
                'zone_id' => 7,
                'image' => 'thumb_1b152-east-gate_adaptiveResize_1313_492.jpg',
                'area_size' => '5 Ha',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Gerbang Timur',
                        'subtitle' => 'Pintu Masuk Timur',
                        'description' => 'Gerbang masuk strategis di sisi timur dengan akses langsung ke pelabuhan dan area logistik serta sistem keamanan terintegrasi.',
                        'meta_title' => 'Gerbang Timur - JIIPE',
                        'meta_description' => 'Pintu masuk strategis sisi timur dengan akses pelabuhan di JIIPE',
                        'meta_keywords' => 'gerbang timur, east gate, pintu masuk, pelabuhan, JIIPE',
                    ],
                    'en' => [
                        'name' => 'East Gate',
                        'subtitle' => 'East Entrance',
                        'description' => 'Strategic entrance gate on the east side with direct access to port and logistics area with integrated security system.',
                        'meta_title' => 'East Gate - JIIPE',
                        'meta_description' => 'Strategic east side entrance with port access at JIIPE',
                        'meta_keywords' => 'east gate, entrance, port, JIIPE',
                    ],
                    'zh' => [
                        'name' => '东门',
                        'subtitle' => '东入口',
                        'description' => '东侧战略入口门，可直接通往港口和物流区域，配备集成安全系统。',
                        'meta_title' => '东门 - JIIPE',
                        'meta_description' => 'JIIPE东侧战略入口可直接通往港口',
                        'meta_keywords' => '东门, 入口, 港口, JIIPE',
                    ],
                    'ja' => [
                        'name' => 'イーストゲート',
                        'subtitle' => '東側入口',
                        'description' => '港と物流エリアへの直接アクセスを備えた東側の戦略的な入口ゲートで、統合セキュリティシステムを備えています。',
                        'meta_title' => 'イーストゲート - JIIPE',
                        'meta_description' => 'JIIPEの港へのアクセスを備えた東側戦略的エントランス',
                        'meta_keywords' => 'イーストゲート, 入口, 港, JIIPE',
                    ],
                    'ko' => [
                        'name' => '동쪽 게이트',
                        'subtitle' => '동쪽 입구',
                        'description' => '통합 보안 시스템을 갖춘 항구 및 물류 지역으로 직접 접근할 수 있는 동쪽의 전략적 출입구 게이트입니다.',
                        'meta_title' => '동쪽 게이트 - JIIPE',
                        'meta_description' => 'JIIPE의 항구 접근이 가능한 동쪽 전략적 입구',
                        'meta_keywords' => '동쪽 게이트, 입구, 항구, JIIPE',
                    ],
                    'tw' => [
                        'name' => '東門',
                        'subtitle' => '東入口',
                        'description' => '東側戰略入口門，可直接通往港口和物流區域，配備集成安全系統。',
                        'meta_title' => '東門 - JIIPE',
                        'meta_description' => 'JIIPE東側戰略入口可直接通往港口',
                        'meta_keywords' => '東門, 入口, 港口, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 13,
                'zone_id' => 7,
                'image' => 'thumb_7a0d5-golf_adaptiveResize_1313_492.jpg',
                'area_size' => '75 Ha',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Golf',
                        'subtitle' => 'Lapangan Golf',
                        'description' => 'Lapangan golf bertaraf internasional dengan 18 holes yang dirancang secara profesional, dilengkapi dengan clubhouse dan fasilitas premium.',
                        'meta_title' => 'Lapangan Golf - JIIPE',
                        'meta_description' => 'Lapangan golf internasional 18 holes dengan fasilitas premium di JIIPE',
                        'meta_keywords' => 'golf, lapangan golf, 18 holes, rekreasi, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Golf',
                        'subtitle' => 'Golf Course',
                        'description' => 'International standard golf course with professionally designed 18 holes, equipped with clubhouse and premium facilities.',
                        'meta_title' => 'Golf Course - JIIPE',
                        'meta_description' => 'International 18-hole golf course with premium facilities at JIIPE',
                        'meta_keywords' => 'golf, golf course, 18 holes, recreation, JIIPE',
                    ],
                    'zh' => [
                        'name' => '高尔夫',
                        'subtitle' => '高尔夫球场',
                        'description' => '国际标准高尔夫球场，配备专业设计的18洞球场，设有俱乐部会所和高级设施。',
                        'meta_title' => '高尔夫球场 - JIIPE',
                        'meta_description' => 'JIIPE的国际18洞高尔夫球场配备高级设施',
                        'meta_keywords' => '高尔夫, 高尔夫球场, 18洞, 休闲, JIIPE',
                    ],
                    'ja' => [
                        'name' => 'ゴルフ',
                        'subtitle' => 'ゴルフコース',
                        'description' => 'プロフェッショナルに設計された18ホールを備えた国際標準のゴルフコースで、クラブハウスとプレミアム施設を完備しています。',
                        'meta_title' => 'ゴルフコース - JIIPE',
                        'meta_description' => 'JIIPEのプレミアム施設を備えた国際18ホールゴルフコース',
                        'meta_keywords' => 'ゴルフ, ゴルフコース, 18ホール, レクリエーション, JIIPE',
                    ],
                    'ko' => [
                        'name' => '골프',
                        'subtitle' => '골프 코스',
                        'description' => '전문적으로 설계된 18홀을 갖춘 국제 표준 골프 코스로 클럽하우스와 프리미엄 시설이 구비되어 있습니다.',
                        'meta_title' => '골프 코스 - JIIPE',
                        'meta_description' => 'JIIPE의 프리미엄 시설을 갖춘 국제 18홀 골프 코스',
                        'meta_keywords' => '골프, 골프 코스, 18홀, 레크리에이션, JIIPE',
                    ],
                    'tw' => [
                        'name' => '高爾夫',
                        'subtitle' => '高爾夫球場',
                        'description' => '國際標準高爾夫球場，配備專業設計的18洞球場，設有俱樂部會所和高級設施。',
                        'meta_title' => '高爾夫球場 - JIIPE',
                        'meta_description' => 'JIIPE的國際18洞高爾夫球場配備高級設施',
                        'meta_keywords' => '高爾夫, 高爾夫球場, 18洞, 休閒, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 14,
                'zone_id' => 7,
                'image' => 'thumb_5c1d1-parl_adaptiveResize_1313_492.jpg',
                'area_size' => '30 Ha',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Taman',
                        'subtitle' => 'Taman dan Ruang Terbuka Hijau',
                        'description' => 'Taman hijau yang luas dengan berbagai fasilitas rekreasi outdoor, jogging track, dan area bermain untuk keluarga.',
                        'meta_title' => 'Taman - JIIPE',
                        'meta_description' => 'Taman dan ruang terbuka hijau dengan fasilitas rekreasi di JIIPE',
                        'meta_keywords' => 'taman, park, ruang terbuka hijau, rekreasi, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Park',
                        'subtitle' => 'Park and Green Open Space',
                        'description' => 'Extensive green park with various outdoor recreational facilities, jogging track, and family play areas.',
                        'meta_title' => 'Park - JIIPE',
                        'meta_description' => 'Park and green open space with recreational facilities at JIIPE',
                        'meta_keywords' => 'park, green space, recreation, JIIPE',
                    ],
                    'zh' => [
                        'name' => '公园',
                        'subtitle' => '公园和绿色开放空间',
                        'description' => '广阔的绿色公园配备各种户外休闲设施、慢跑道和家庭游乐区。',
                        'meta_title' => '公园 - JIIPE',
                        'meta_description' => 'JIIPE的公园和绿色开放空间配备休闲设施',
                        'meta_keywords' => '公园, 绿色空间, 休闲, JIIPE',
                    ],
                    'ja' => [
                        'name' => 'パーク',
                        'subtitle' => 'パークと緑地',
                        'description' => 'さまざまな屋外レクリエーション施設、ジョギングトラック、家族向け遊び場を備えた広大な緑地公園。',
                        'meta_title' => 'パーク - JIIPE',
                        'meta_description' => 'JIIPEのレクリエーション施設を備えたパークと緑地',
                        'meta_keywords' => 'パーク, 緑地, レクリエーション, JIIPE',
                    ],
                    'ko' => [
                        'name' => '공원',
                        'subtitle' => '공원 및 녹지 공간',
                        'description' => '다양한 야외 레크리에이션 시설, 조깅 트랙, 가족 놀이 공간을 갖춘 광활한 녹색 공원입니다.',
                        'meta_title' => '공원 - JIIPE',
                        'meta_description' => 'JIIPE의 레크리에이션 시설을 갖춘 공원 및 녹지 공간',
                        'meta_keywords' => '공원, 녹지 공간, 레크리에이션, JIIPE',
                    ],
                    'tw' => [
                        'name' => '公園',
                        'subtitle' => '公園和綠色開放空間',
                        'description' => '廣闊的綠色公園配備各種戶外休閒設施、慢跑道和家庭遊樂區。',
                        'meta_title' => '公園 - JIIPE',
                        'meta_description' => 'JIIPE的公園和綠色開放空間配備休閒設施',
                        'meta_keywords' => '公園, 綠色空間, 休閒, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 15,
                'zone_id' => 7,
                'image' => 'thumb_2bd97-univ_adaptiveResize_1313_492.jpg',
                'area_size' => '50 Ha',
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Universitas',
                        'subtitle' => 'Kampus dan Pusat Pendidikan',
                        'description' => 'Kawasan kampus modern dengan fasilitas pendidikan tinggi, laboratorium, perpustakaan, dan pusat penelitian yang mendukung pengembangan SDM industri.',
                        'meta_title' => 'Universitas - JIIPE',
                        'meta_description' => 'Kampus modern dengan fasilitas pendidikan dan penelitian di JIIPE',
                        'meta_keywords' => 'universitas, university, kampus, pendidikan, penelitian, JIIPE',
                    ],
                    'en' => [
                        'name' => 'University',
                        'subtitle' => 'Campus and Education Center',
                        'description' => 'Modern campus area with higher education facilities, laboratories, library, and research center supporting industrial human resource development.',
                        'meta_title' => 'University - JIIPE',
                        'meta_description' => 'Modern campus with education and research facilities at JIIPE',
                        'meta_keywords' => 'university, campus, education, research, JIIPE',
                    ],
                    'zh' => [
                        'name' => '大学',
                        'subtitle' => '校园和教育中心',
                        'description' => '现代化校园区域配备高等教育设施、实验室、图书馆和研究中心，支持工业人力资源发展。',
                        'meta_title' => '大学 - JIIPE',
                        'meta_description' => 'JIIPE的现代化校园配备教育和研究设施',
                        'meta_keywords' => '大学, 校园, 教育, 研究, JIIPE',
                    ],
                    'ja' => [
                        'name' => '大学',
                        'subtitle' => 'キャンパスと教育センター',
                        'description' => '高等教育施設、実験室、図書館、産業人材育成をサポートする研究センターを備えた最新のキャンパスエリア。',
                        'meta_title' => '大学 - JIIPE',
                        'meta_description' => 'JIIPEの教育・研究施設を備えた最新のキャンパス',
                        'meta_keywords' => '大学, キャンパス, 教育, 研究, JIIPE',
                    ],
                    'ko' => [
                        'name' => '대학교',
                        'subtitle' => '캠퍼스 및 교육 센터',
                        'description' => '고등 교육 시설, 실험실, 도서관, 산업 인적 자원 개발을 지원하는 연구 센터를 갖춘 현대적인 캠퍼스 지역입니다.',
                        'meta_title' => '대학교 - JIIPE',
                        'meta_description' => 'JIIPE의 교육 및 연구 시설을 갖춘 현대적인 캠퍼스',
                        'meta_keywords' => '대학교, 캠퍼스, 교육, 연구, JIIPE',
                    ],
                    'tw' => [
                        'name' => '大學區',
                        'subtitle' => '校園與教育中心',
                        'description' => '這是一個現代化的校園區，設有高等教育設施、實驗室、圖書館，以及支援產業人力資源培育的研究中心。',
                        'meta_title' => '大學區 - JIIPE',
                        'meta_description' => 'JIIPE 擁有教育與研究設施的現代化校園區',
                        'meta_keywords' => '大學, 校園, 教育, 研究, JIIPE',
                    ],
                ],
            ],
        ];
        foreach ($clusters as $cluster) {
            // Sisipkan data utama ke tabel zone_cluster_facilities
            DB::table('zone_clusters')->insert([
                'id' => $cluster['id'],
                'zone_id' => $cluster['zone_id'],
                'image' => $cluster['image'],
                'area_size' => $cluster['area_size'],
                'created_at' => $cluster['created_at'],
                'updated_at' => $cluster['updated_at'],
            ]);

            // Sisipkan data terjemahan ke tabel zone_cluster_facility_translations
            foreach ($cluster['translations'] as $locale => $translation) {
                DB::table('zone_cluster_translations')->insert([
                    'zone_clusters_id' => $cluster['id'],
                    'locale' => $locale,
                    'name' => $translation['name'],
                    'subtitle' => $translation['subtitle'],
                    'description' => $translation['description'],
                    'meta_title' => $translation['meta_title'],
                    'meta_description' => $translation['meta_description'],
                    'meta_keywords' => $translation['meta_keywords'],
                ]);
            }
        }
    }
}
