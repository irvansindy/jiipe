<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeSlider;
use App\Models\HomeSliderTranslation;

class HomeSliderSeeder extends Seeder
{
    public function run()
    {
        HomeSlider::truncate();
        HomeSliderTranslation::truncate();
        $sliders = [
            [
                'file' => '344f5-Office_1.mp4',
                'translations' => [
                    'en' => [
                        'title' => "JIIPE's Central Administration & Management Hub",
                        'description' => "Serving as the heartbeat of operations and area management, this building ensures that JIIPE operates efficiently, effectively, and in alignment with the vision of JIIPE."
                    ],
                    'id' => [
                        'title' => "Pusat Administrasi & Manajemen JIIPE",
                        'description' => "Menjadi pusat pengelolaan dan operasional, gedung ini memastikan JIIPE berjalan efisien dan sesuai visi."
                    ],
                    'zh' => [
                        'title' => "JIIPE中央管理中心",
                        'description' => "作为运营和区域管理的心脏，这座建筑确保JIIPE高效、有效地运作，并与JIIPE的愿景保持一致。"
                    ],
                    'ja' => [
                        'title' => "JIIPEの中央管理ハブ",
                        'description' => "運営とエリア管理の中心として、この建物はJIIPEが効率的かつ効果的に運営され、JIIPEのビジョンに沿っていることを保証します。"
                    ],
                    'ko' => [
                        'title' => "JIIPE 중앙 관리 허브",
                        'description' => "운영과 지역 관리의 중심지로서 이 건물은 JIIPE가 효율적이고 효과적으로 운영되며 JIIPE의 비전에 부합하도록 보장합니다."
                    ],
                    'tw' => [
                        'title' => "JIIPE中央管理樞紐",
                        'description' => "作為運營和區域管理的心臟，這座建築確保JIIPE高效、有效地運作，並與JIIPE的願景保持一致。"
                    ],
                ],
            ],
            [
                'file' => '896d3-POWER PLANT.mp4',
                'translations' => [
                    'en' => [
                        'title' => "Utility Center: The Backbone of JIIPE's Industry",
                        'description' => "Providing essential utilities such as power generation, industrial water supply, and waste management, the JIIPE Utility Center ensures sustainability and efficiency for industries within the estate."
                    ],
                    'id' => [
                        'title' => "Pusat Utilitas: Tulang Punggung Industri JIIPE",
                        'description' => "Menyediakan utilitas penting seperti listrik, air industri, dan pengelolaan limbah, Pusat Utilitas JIIPE memastikan keberlanjutan dan efisiensi industri di kawasan."
                    ],
                    'zh' => [
                        'title' => "公用中心：JIIPE产业的支柱",
                        'description' => "提供发电、工业供水和废物管理等基本设施，JIIPE公用中心确保园区内产业的可持续性和高效性。"
                    ],
                    'ja' => [
                        'title' => "ユーティリティセンター：JIIPE産業の基盤",
                        'description' => "発電、工業用水供給、廃棄物管理などの重要なユーティリティを提供し、JIIPEユーティリティセンターは園内産業の持続可能性と効率性を確保します。"
                    ],
                    'ko' => [
                        'title' => "유틸리티 센터: JIIPE 산업의 중추",
                        'description' => "전력 생산, 산업용수 공급, 폐기물 관리 등 필수 유틸리티를 제공하여 JIIPE 유틸리티 센터는 단지 내 산업의 지속 가능성과 효율성을 보장합니다."
                    ],
                    'tw' => [
                        'title' => "公用中心：JIIPE產業的支柱",
                        'description' => "提供發電、工業用水和廢棄物管理等基本設施，JIIPE公用中心確保園區內產業的可持續性和高效性。"
                    ],
                ],
            ],
            [
                'file' => 'bc6b9-PORTS.mp4',
                'translations' => [
                    'en' => [
                        'title' => "JIIPE Port: Indonesia's Logistics Gateway",
                        'description' => "As one of the integrated deep-sea ports, JIIPE Port facilitates trade with superior multimodal connectivity, ensuring logistical efficiency for investors."
                    ],
                    'id' => [
                        'title' => "Pelabuhan JIIPE: Gerbang Logistik Indonesia",
                        'description' => "Sebagai pelabuhan laut dalam terintegrasi, Pelabuhan JIIPE memfasilitasi perdagangan dengan konektivitas multimoda unggul, memastikan efisiensi logistik bagi investor."
                    ],
                    'zh' => [
                        'title' => "JIIPE港口：印尼物流門戶",
                        'description' => "作為綜合深水港之一，JIIPE港口以卓越的多式聯運連接促進貿易，確保投資者的物流效率。"
                    ],
                    'ja' => [
                        'title' => "JIIPE港：インドネシアの物流ゲートウェイ",
                        'description' => "統合型深海港の一つとして、JIIPE港は優れたマルチモーダル接続で貿易を促進し、投資家の物流効率を保証します。"
                    ],
                    'ko' => [
                        'title' => "JIIPE 항만: 인도네시아 물류 관문",
                        'description' => "통합 심해항 중 하나인 JIIPE 항만은 우수한 복합 운송 연결로 무역을 촉진하며 투자자에게 물류 효율성을 보장합니다."
                    ],
                    'tw' => [
                        'title' => "JIIPE港口：印尼物流門戶",
                        'description' => "作為綜合深水港之一，JIIPE港口以卓越的多式聯運連接促進貿易，確保投資者的物流效率。"
                    ],
                ],
            ],
            [
                'file' => '7c380-Gate_1.mp4',
                'translations' => [
                    'en' => [
                        'title' => "Grand Entrance to JIIPE",
                        'description' => "As the gateway to the integrated industrial area, the JIIPE entrance greets every visitor with architectural beauty and signifies the economic advancement of the Gresik Special Economic Zone."
                    ],
                    'id' => [
                        'title' => "Gerbang Utama JIIPE",
                        'description' => "Sebagai pintu gerbang kawasan industri terintegrasi, gerbang JIIPE menyambut setiap tamu dengan keindahan arsitektur dan menandakan kemajuan ekonomi Kawasan Ekonomi Khusus Gresik."
                    ],
                    'zh' => [
                        'title' => "JIIPE大門入口",
                        'description' => "作為綜合工業區的入口，JIIPE大門以建築美學迎接每一位訪客，象徵著格雷西克經濟特區的發展。"
                    ],
                    'ja' => [
                        'title' => "JIIPEへのグランドエントランス",
                        'description' => "統合型工業エリアへのゲートウェイとして、JIIPEの入口は建築美で訪問者を迎え、グレシック特別経済区の経済発展を象徴します。"
                    ],
                    'ko' => [
                        'title' => "JIIPE의 그랜드 입구",
                        'description' => "통합 산업 지역의 관문으로서 JIIPE 입구는 건축미로 모든 방문객을 맞이하며 그레식 경제특구의 발전을 상징합니다."
                    ],
                    'tw' => [
                        'title' => "JIIPE大門入口",
                        'description' => "作為綜合工業區的入口，JIIPE大門以建築美學迎接每一位訪客，象徵著格雷西克經濟特區的發展。"
                    ],
                ],
            ],
            [
                'file' => '75eed-Infrastructure_1.mp4',
                'translations' => [
                    'en' => [
                        'title' => "JIIPE's Advanced Infrastructure",
                        'description' => "Featuring state-of-the-art utility bridges and spacious main roads, we guarantee seamless industrial activities and enhanced connectivity throughout the estate."
                    ],
                    'id' => [
                        'title' => "Infrastruktur Canggih JIIPE",
                        'description' => "Dengan jembatan utilitas modern dan jalan utama yang luas, kami menjamin kelancaran aktivitas industri dan konektivitas di seluruh kawasan."
                    ],
                    'zh' => [
                        'title' => "JIIPE先進基礎設施",
                        'description' => "擁有先進的公用橋樑和寬敞的主幹道，我們保證園區內工業活動順暢並提升連接性。"
                    ],
                    'ja' => [
                        'title' => "JIIPEの先進的なインフラ",
                        'description' => "最新のユーティリティブリッジと広々としたメインロードを備え、園内の産業活動の円滑さと接続性の向上を保証します。"
                    ],
                    'ko' => [
                        'title' => "JIIPE의 첨단 인프라",
                        'description' => "최첨단 유틸리티 브릿지와 넓은 메인 도로를 갖추고 있어 단지 내 산업 활동의 원활함과 연결성 향상을 보장합니다."
                    ],
                    'tw' => [
                        'title' => "JIIPE先進基礎設施",
                        'description' => "擁有先進的公用橋樑和寬敞的主幹道，我們保證園區內工業活動順暢並提升連接性。"
                    ],
                ],
            ],
        ];

        foreach ($sliders as $sliderData) {
            $slider = HomeSlider::create([
                'file' => $sliderData['file'],
                'is_active' => 1,
            ]);
            foreach ($sliderData['translations'] as $locale => $trans) {
                HomeSliderTranslation::create([
                    'home_sliders' => $slider->id,
                    'locale' => $locale,
                    'title' => $trans['title'],
                    'description' => $trans['description'],
                ]);
            }
        }
    }
}