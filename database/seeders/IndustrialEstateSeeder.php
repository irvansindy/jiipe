<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class IndustrialEstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $zones = [
            [
                'id' => 5,
                'zone_class_id' => 1,
                'image' => 'thumb_f8e62-industrial-estate_resize_1312_662.jpg',
                'image_detail' => 'thumb_c9629-industrial-area-thumb_adaptiveResize_419_284.jpg',
                'image_cover'=> 'thumb_c9629-industrial-area_adaptiveResize_1920_591.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'zone_class_id' => 1,
                'image' => 'thumb_3b01a-port-estate_resize_1312_662.jpg',
                'image_detail' => 'thumb_3c4e5-port-area-thumb_adaptiveResize_419_284.jpg',
                'image_cover'=> 'thumb_3c4e5-port-area_adaptiveResize_1920_591.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'zone_class_id' => 1,
                'image' => 'thumb_0472d-residential-estate_resize_1312_662.jpg',
                'image_detail' => 'thumb_8917c-residential-area-thumb_adaptiveResize_419_284.jpg',
                'image_cover'=> 'thumb_7d49c-residential-area_adaptiveResize_1920_591.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('zones')->insert($zones);

        // Insert Zone Translations
        $zoneTranslations = [
            // Industrial Area - Indonesian
            [
                'zone_id' => 5,
                'locale' => 'id',
                'name' => 'Kawasan Industri',
                'subtitle' => 'Utilitas Kompetitif dan Berkelanjutan',
                'description' => 'Lingkungan ramah lingkungan seluas 1761 hektar, menawarkan utilitas dan fasilitas lengkap. Terletak strategis sebagai pusat perdagangan dan manufaktur untuk Indonesia dan Asia Pasifik. Kompleks terintegrasi bebas banjir dengan area residensial yang hijau dan asri.',
                'area_size' => '1761 ha',
                'meta_title' => 'Kawasan Industri - JIIPE',
                'meta_description' => 'Kawasan industri ramah lingkungan dengan utilitas dan fasilitas lengkap',
                'meta_keywords' => 'kawasan industri, jiipe, gresik, manufaktur',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Industrial Area - English
            [
                'zone_id' => 5,
                'locale' => 'en',
                'name' => 'Industrial Area',
                'subtitle' => 'Competitive and Sustainable Utilities',
                'description' => 'Eco-friendly environment of 1761 hectares area, offering complete utilities and amenities. Located strategically to be trading hub and manufacturing center for Indonesia and Asia Pacific. An integrated flood-free complex with lush and green residential areas.',
                'area_size' => '1761 ha',
                'meta_title' => 'Industrial Area - JIIPE',
                'meta_description' => 'Eco-friendly industrial area with complete utilities and amenities',
                'meta_keywords' => 'industrial area, jiipe, gresik, manufacturing',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Industrial Area - Chinese Simplified
            [
                'zone_id' => 5,
                'locale' => 'zh',
                'name' => '工业区',
                'subtitle' => '具有竞争力和可持续的公用设施',
                'description' => '占地1761公顷的环保区域，提供完整的公用设施和便利设施。战略位置优越，是印度尼西亚和亚太地区的贸易枢纽和制造中心。一个集成的无洪水综合体，拥有郁郁葱葱的绿色住宅区。',
                'area_size' => '1761公顷',
                'meta_title' => '工业区 - JIIPE',
                'meta_description' => '拥有完整公用设施和便利设施的环保工业区',
                'meta_keywords' => '工业区, jiipe, 格雷西克, 制造业',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Industrial Area - Japanese
            [
                'zone_id' => 5,
                'locale' => 'ja',
                'name' => '工業地域',
                'subtitle' => '競争力のある持続可能なユーティリティ',
                'description' => '1761ヘクタールの環境に優しいエリアで、完全なユーティリティと設備を提供しています。インドネシアとアジア太平洋地域の貿易ハブおよび製造センターとして戦略的に位置しています。緑豊かな住宅地域を備えた統合された洪水のない複合施設です。',
                'area_size' => '1761ヘクタール',
                'meta_title' => '工業地域 - JIIPE',
                'meta_description' => '完全なユーティリティと設備を備えた環境に優しい工業地域',
                'meta_keywords' => '工業地域, jiipe, グレシック, 製造業',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Industrial Area - Korean
            [
                'zone_id' => 5,
                'locale' => 'ko',
                'name' => '산업 지역',
                'subtitle' => '경쟁력 있고 지속 가능한 유틸리티',
                'description' => '1761헥타르의 친환경 지역으로 완벽한 유틸리티와 편의시설을 제공합니다. 인도네시아와 아시아 태평양 지역의 무역 허브 및 제조 센터로 전략적으로 위치해 있습니다. 녹지가 풍부한 주거 지역이 있는 통합된 홍수 없는 복합 단지입니다.',
                'area_size' => '1761헥타르',
                'meta_title' => '산업 지역 - JIIPE',
                'meta_description' => '완벽한 유틸리티와 편의시설을 갖춘 친환경 산업 지역',
                'meta_keywords' => '산업 지역, jiipe, 그레식, 제조업',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Industrial Area - Chinese Traditional
            [
                'zone_id' => 5,
                'locale' => 'tw',
                'name' => '工業區',
                'subtitle' => '具有競爭力和可持續的公用設施',
                'description' => '佔地1761公頃的環保區域，提供完整的公用設施和便利設施。戰略位置優越，是印度尼西亞和亞太地區的貿易樞紐和製造中心。一個集成的無洪水綜合體，擁有鬱鬱蔥蔥的綠色住宅區。',
                'area_size' => '1761公頃',
                'meta_title' => '工業區 - JIIPE',
                'meta_description' => '擁有完整公用設施和便利設施的環保工業區',
                'meta_keywords' => '工業區, jiipe, 格雷西克, 製造業',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Port Area - Indonesian
            [
                'zone_id' => 6,
                'locale' => 'id',
                'name' => 'Kawasan Pelabuhan',
                'subtitle' => 'Integrasi praktis dan efisiensi perjalanan kargo Anda',
                'description' => 'Kawasan pelabuhan laut dalam terintegrasi seluas 400 ha yang berlokasi strategis di Selat Madura. Dengan panjang dermaga total 6200 m, kedalaman air laut dermaga: -7.00 LWS; -11.00 LWS; -14.00 LWS; -16.00 LWS dapat menampung kapal hingga 100.000 DWT dan bagian dari ekosistem logistik yang hebat.',
                'area_size' => '400 ha',
                'meta_title' => 'Kawasan Pelabuhan - JIIPE',
                'meta_description' => 'Kawasan pelabuhan laut dalam terintegrasi di Selat Madura',
                'meta_keywords' => 'kawasan pelabuhan, jiipe, pelabuhan laut, selat madura',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Port Area - English
            [
                'zone_id' => 6,
                'locale' => 'en',
                'name' => 'Port Area',
                'subtitle' => 'Practical integration and efficiency of your cargo trip',
                'description' => '400 ha integrated deep seaport estate strategically located in Madura Strait. With 6200 m of total berth length, sea water depth of jetty: -7.00 LWS; -11.00 LWS; -14.00 LWS; -16.00 LWS could cater capsize vessel until 100,000 DWT and a part of great logistics ecosystem.',
                'area_size' => '400 ha',
                'meta_title' => 'Port Area - JIIPE',
                'meta_description' => 'Integrated deep seaport estate in Madura Strait',
                'meta_keywords' => 'port area, jiipe, seaport, madura strait',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Port Area - Chinese Simplified
            [
                'zone_id' => 6,
                'locale' => 'zh',
                'name' => '港口区',
                'subtitle' => '货物运输的实用整合和效率',
                'description' => '占地400公顷的综合深水海港，战略性地位于马都拉海峡。总泊位长度6200米，码头水深：-7.00 LWS；-11.00 LWS；-14.00 LWS；-16.00 LWS，可容纳高达100,000载重吨的大型船舶，是优秀物流生态系统的一部分。',
                'area_size' => '400公顷',
                'meta_title' => '港口区 - JIIPE',
                'meta_description' => '马都拉海峡的综合深水海港',
                'meta_keywords' => '港口区, jiipe, 海港, 马都拉海峡',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Port Area - Japanese
            [
                'zone_id' => 6,
                'locale' => 'ja',
                'name' => '港湾地域',
                'subtitle' => '貨物輸送の実用的な統合と効率',
                'description' => 'マドゥラ海峡に戦略的に位置する400ヘクタールの統合深海港エリア。総バース長6200m、桟橋の水深：-7.00 LWS；-11.00 LWS；-14.00 LWS；-16.00 LWSで、最大100,000 DWTの大型船舶に対応でき、優れた物流エコシステムの一部です。',
                'area_size' => '400ヘクタール',
                'meta_title' => '港湾地域 - JIIPE',
                'meta_description' => 'マドゥラ海峡の統合深海港',
                'meta_keywords' => '港湾地域, jiipe, 海港, マドゥラ海峡',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Port Area - Korean
            [
                'zone_id' => 6,
                'locale' => 'ko',
                'name' => '항구 지역',
                'subtitle' => '화물 운송의 실용적인 통합 및 효율성',
                'description' => '마두라 해협에 전략적으로 위치한 400헥타르의 통합 심해항 단지. 총 선석 길이 6200m, 부두 수심: -7.00 LWS; -11.00 LWS; -14.00 LWS; -16.00 LWS로 최대 100,000 DWT의 대형 선박을 수용할 수 있으며 훌륭한 물류 생태계의 일부입니다.',
                'area_size' => '400헥타르',
                'meta_title' => '항구 지역 - JIIPE',
                'meta_description' => '마두라 해협의 통합 심해항',
                'meta_keywords' => '항구 지역, jiipe, 해항, 마두라 해협',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Port Area - Chinese Traditional
            [
                'zone_id' => 6,
                'locale' => 'tw',
                'name' => '港口區',
                'subtitle' => '貨物運輸的實用整合和效率',
                'description' => '佔地400公頃的綜合深水海港，戰略性地位於馬都拉海峽。總泊位長度6200米，碼頭水深：-7.00 LWS；-11.00 LWS；-14.00 LWS；-16.00 LWS，可容納高達100,000載重噸的大型船舶，是優秀物流生態系統的一部分。',
                'area_size' => '400公頃',
                'meta_title' => '港口區 - JIIPE',
                'meta_description' => '馬都拉海峽的綜合深水海港',
                'meta_keywords' => '港口區, jiipe, 海港, 馬都拉海峽',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Residential Area - Indonesian
            [
                'zone_id' => 7,
                'locale' => 'id',
                'name' => 'Kawasan Perumahan',
                'subtitle' => 'Infrastruktur Megah, Fasilitas Mewah, Kehidupan Terintegrasi.',
                'description' => 'Grand Estate Marina City (GEM City) adalah kota dengan proyek masterplan seluas 800 hektar yang terhubung dengan kawasan Industri yang terintegrasi dengan salah satu pelabuhan terdalam dan terbesar di Provinsi Jawa Timur, Indonesia. Fasilitas terbaik untuk kehidupan terintegrasi.',
                'area_size' => '800 ha',
                'meta_title' => 'Kawasan Perumahan - JIIPE',
                'meta_description' => 'Grand Estate Marina City dengan infrastruktur yang megah',
                'meta_keywords' => 'kawasan perumahan, jiipe, gem city, marina city',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Residential Area - English
            [
                'zone_id' => 7,
                'locale' => 'en',
                'name' => 'Residential Area',
                'subtitle' => 'Magnificent Infrastructure, Luxurious Facilities, Integrated Life.',
                'description' => 'Grand Estate Marina City (GEM City) is a city with a masterplan project covering an area of 800 hectares which is connected to the Industrial area that integrates with one of the deepest and largest port in East Java Province, Indonesia. The best facilities for integrated living.',
                'area_size' => '800 ha',
                'meta_title' => 'Residential Area - JIIPE',
                'meta_description' => 'Grand Estate Marina City with magnificent infrastructure',
                'meta_keywords' => 'residential area, jiipe, gem city, marina city',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Residential Area - Chinese Simplified
            [
                'zone_id' => 7,
                'locale' => 'zh',
                'name' => '住宅区',
                'subtitle' => '宏伟的基础设施、豪华的设施、一体化生活',
                'description' => '格兰德滨海城（GEM City）是一个占地800公顷的总体规划项目城市，与工业区相连，并整合了印度尼西亚东爪哇省最深、最大的港口之一。为一体化生活提供最佳设施。',
                'area_size' => '800公顷',
                'meta_title' => '住宅区 - JIIPE',
                'meta_description' => '拥有宏伟基础设施的格兰德滨海城',
                'meta_keywords' => '住宅区, jiipe, gem城市, 滨海城',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Residential Area - Japanese
            [
                'zone_id' => 7,
                'locale' => 'ja',
                'name' => '住宅地域',
                'subtitle' => '壮大なインフラ、豪華な施設、統合された生活',
                'description' => 'グランドエステートマリーナシティ（GEM City）は、800ヘクタールをカバーするマスタープランプロジェクトの都市で、インドネシア東ジャワ州で最も深く最大の港の1つと統合された工業地域に接続されています。統合された生活のための最高の施設を提供します。',
                'area_size' => '800ヘクタール',
                'meta_title' => '住宅地域 - JIIPE',
                'meta_description' => '壮大なインフラを持つグランドエステートマリーナシティ',
                'meta_keywords' => '住宅地域, jiipe, gemシティ, マリーナシティ',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Residential Area - Korean
            [
                'zone_id' => 7,
                'locale' => 'ko',
                'name' => '주거 지역',
                'subtitle' => '웅장한 인프라, 고급 시설, 통합 생활',
                'description' => '그랜드 에스테이트 마리나 시티(GEM City)는 800헥타르 면적을 커버하는 마스터플랜 프로젝트 도시로, 인도네시아 동자바 주에서 가장 깊고 큰 항구 중 하나와 통합된 산업 지역과 연결되어 있습니다. 통합 생활을 위한 최고의 시설을 제공합니다.',
                'area_size' => '800헥타르',
                'meta_title' => '주거 지역 - JIIPE',
                'meta_description' => '웅장한 인프라를 갖춘 그랜드 에스테이트 마리나 시티',
                'meta_keywords' => '주거 지역, jiipe, gem 시티, 마리나 시티',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Residential Area - Chinese Traditional
            [
                'zone_id' => 7,
                'locale' => 'tw',
                'name' => '住宅區',
                'subtitle' => '宏偉的基礎設施、豪華的設施、一體化生活',
                'description' => '格蘭德濱海城（GEM City）是一個佔地800公頃的總體規劃項目城市，與工業區相連，並整合了印度尼西亞東爪哇省最深、最大的港口之一。為一體化生活提供最佳設施。',
                'area_size' => '800公頃',
                'meta_title' => '住宅區 - JIIPE',
                'meta_description' => '擁有宏偉基礎設施的格蘭德濱海城',
                'meta_keywords' => '住宅區, jiipe, gem城市, 濱海城',
                'note' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('zone_translations')->insert($zoneTranslations);
    }
}
