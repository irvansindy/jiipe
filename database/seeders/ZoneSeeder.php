<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone;
use App\Models\ZoneTranslation;
class ZoneSeeder extends Seeder
{
    public function run()
    {
        // Define zones with translations
        $zones = [
            [
                'image' => '/images/static/benefit03.jpg',
                'zone_class_id' => 2,
                'translations' => [
                    'en' => [
                        'name' => 'PP No.71 th 2021 about KEK Gresik-JIIPE',
                        'subtitle' => 'Indonesia Special Economic Zone Gresik, JIIPE',
                        'description' => '<p><img src="/images/static/92/1.jpg" class="img img-fluid"></p><p>(As per PP No.71 / 2021)</p><p>JAKARTA, July 2, 2021 - Java Integrated Industrial & Ports Estate, or JIIPE, was founded by PT AKR Corporindo Tbk through its subsidiary PT Usaha Era Pratama Nusantara (AKR) and PT Pelindo III through its subsidiary PT Berlian Jasa Terminal Indonesia in order to accelerate job creation and economic development in Indonesia, particularly East Java. JIIPE has been officially designated as Gresik Special Economic Zone (SEZ) through the Government Regulation (PP) of the Republic of Indonesia.</p>',
                        'meta_title' => 'PP No.71 th 2021 - JIIPE SEZ',
                        'meta_keywords' => 'PP 71, KEK Gresik, JIIPE, Special Economic Zone',
                        'meta_description' => 'Information about Government Regulation No.71/2021 regarding Gresik SEZ',
                    ],
                    'id' => [
                        'name' => 'PP No.71 th 2021 tentang KEK Gresik-JIIPE',
                        'subtitle' => 'Kawasan Ekonomi Khusus Indonesia Gresik, JIIPE',
                        'description' => '<p><img src="/images/static/92/1.jpg" class="img img-fluid"></p><p>(Sesuai PP No.71 / 2021)</p><p>JAKARTA, 2 Juli 2021 - Java Integrated Industrial & Ports Estate, atau JIIPE, didirikan oleh PT AKR Corporindo Tbk melalui anak perusahaannya PT Usaha Era Pratama Nusantara (AKR) dan PT Pelindo III melalui anak perusahaannya PT Berlian Jasa Terminal Indonesia untuk mempercepat penciptaan lapangan kerja dan pembangunan ekonomi di Indonesia, khususnya Jawa Timur. JIIPE telah resmi ditetapkan sebagai Kawasan Ekonomi Khusus (KEK) Gresik melalui Peraturan Pemerintah (PP) Republik Indonesia.</p>',
                        'meta_title' => 'PP No.71 th 2021 - KEK JIIPE',
                        'meta_keywords' => 'PP 71, KEK Gresik, JIIPE, Kawasan Ekonomi Khusus',
                        'meta_description' => 'Informasi tentang Peraturan Pemerintah No.71/2021 tentang KEK Gresik',
                    ],
                    'zh' => [
                        'name' => '关于格雷西克经济特区-JIIPE的第71号政府法规',
                        'subtitle' => '印度尼西亚格雷西克经济特区，JIIPE',
                        'description' => '<p><img src="/images/static/92/1.jpg" class="img img-fluid"></p><p>(根据第71/2021号政府法规)</p><p>雅加达，2021年7月2日 - Java综合工业和港口区，或JIIPE，由PT AKR Corporindo Tbk通过其子公司PT Usaha Era Pratama Nusantara (AKR)和PT Pelindo III通过其子公司PT Berlian Jasa Terminal Indonesia创立，旨在加速印度尼西亚，特别是东爪哇的就业创造和经济发展。JIIPE已通过印度尼西亚共和国政府法规正式指定为格雷西克经济特区。</p>',
                        'meta_title' => '第71号政府法规 - JIIPE经济特区',
                        'meta_keywords' => '第71号政府法规, 格雷西克经济特区, JIIPE, 经济特区',
                        'meta_description' => '关于格雷西克经济特区第71/2021号政府法规的信息',
                    ],
                    'ja' => [
                        'name' => 'グレシック経済特区-JIIPEに関する政令第71号',
                        'subtitle' => 'インドネシア・グレシック経済特区、JIIPE',
                        'description' => '<p><img src="/images/static/92/1.jpg" class="img img-fluid"></p><p>(政令第71/2021号に基づく)</p><p>ジャカルタ、2021年7月2日 - Java統合工業・港湾地区、またはJIIPEは、特に東ジャワにおける雇用創出と経済発展を加速するため、PT AKR Corporindo Tbkがその子会社PT Usaha Era Pratama Nusantara (AKR)を通じて、PT Pelindo IIIがその子会社PT Berlian Jasa Terminal Indonesiaを通じて設立しました。JIIPEはインドネシア共和国政府規則により、グレシック経済特区（SEZ）として正式に指定されています。</p>',
                        'meta_title' => '政令第71号 - JIIPE経済特区',
                        'meta_keywords' => '政令71, グレシック経済特区, JIIPE, 経済特区',
                        'meta_description' => 'グレシック経済特区に関する政令第71/2021号の情報',
                    ],
                    'ko' => [
                        'name' => '그레식 경제특구-JIIPE에 관한 정부 규정 제71호',
                        'subtitle' => '인도네시아 그레식 경제특구, JIIPE',
                        'description' => '<p><img src="/images/static/92/1.jpg" class="img img-fluid"></p><p>(정부 규정 제71/2021호에 따름)</p><p>자카르타, 2021년 7월 2일 - Java 통합 산업 및 항만 단지, 또는 JIIPE는 PT AKR Corporindo Tbk가 자회사 PT Usaha Era Pratama Nusantara (AKR)를 통해, 그리고 PT Pelindo III가 자회사 PT Berlian Jasa Terminal Indonesia를 통해 인도네시아, 특히 동부 자바의 일자리 창출과 경제 발전을 가속화하기 위해 설립했습니다. JIIPE는 인도네시아 공화국 정부 규정을 통해 그레식 경제특구(SEZ)로 공식 지정되었습니다.</p>',
                        'meta_title' => '정부 규정 제71호 - JIIPE 경제특구',
                        'meta_keywords' => '정부 규정 71, 그레식 경제특구, JIIPE, 경제특구',
                        'meta_description' => '그레식 경제특구에 관한 정부 규정 제71/2021호 정보',
                    ],
                    'tw' => [
                        'name' => '關於格雷西克經濟特區-JIIPE的第71號政府法規',
                        'subtitle' => '印度尼西亞格雷西克經濟特區，JIIPE',
                        'description' => '<p><img src="/images/static/92/1.jpg" class="img img-fluid"></p><p>(根據第71/2021號政府法規)</p><p>雅加達，2021年7月2日 - Java綜合工業和港口區，或JIIPE，由PT AKR Corporindo Tbk通過其子公司PT Usaha Era Pratama Nusantara (AKR)和PT Pelindo III通過其子公司PT Berlian Jasa Terminal Indonesia創立，旨在加速印度尼西亞，特別是東爪哇的就業創造和經濟發展。JIIPE已通過印度尼西亞共和國政府法規正式指定為格雷西克經濟特區。</p>',
                        'meta_title' => '第71號政府法規 - JIIPE經濟特區',
                        'meta_keywords' => '第71號政府法規, 格雷西克經濟特區, JIIPE, 經濟特區',
                        'meta_description' => '關於格雷西克經濟特區第71/2021號政府法規的資訊',
                    ],
                ],
            ],
            [
                'image' => '/images/static/fiscal-benefits.jpg',
                'zone_class_id' => 2,
                'translations' => [
                    'en' => [
                        'name' => 'Fiscal and Non-fiscal Benefits',
                        'subtitle' => 'Investment Incentives in JIIPE SEZ',
                        'description' => '<p>JIIPE SEZ offers various fiscal and non-fiscal benefits including tax holidays, VAT exemptions, import duty facilities, and streamlined licensing processes. These incentives are designed to attract both domestic and international investors.</p>',
                        'meta_title' => 'Fiscal Benefits - JIIPE SEZ',
                        'meta_keywords' => 'fiscal incentives, tax benefits, JIIPE',
                        'meta_description' => 'Explore fiscal and non-fiscal benefits for investors in JIIPE SEZ',
                    ],
                    'id' => [
                        'name' => 'Manfaat Fiskal dan Non-fiskal',
                        'subtitle' => 'Insentif Investasi di KEK JIIPE',
                        'description' => '<p>KEK JIIPE menawarkan berbagai manfaat fiskal dan non-fiskal termasuk tax holiday, pembebasan PPN, fasilitas bea masuk, dan proses perizinan yang dipermudah. Insentif ini dirancang untuk menarik investor domestik maupun internasional.</p>',
                        'meta_title' => 'Manfaat Fiskal - KEK JIIPE',
                        'meta_keywords' => 'insentif fiskal, keringanan pajak, JIIPE',
                        'meta_description' => 'Jelajahi manfaat fiskal dan non-fiskal untuk investor di KEK JIIPE',
                    ],
                    'zh' => [
                        'name' => '财政和非财政优惠',
                        'subtitle' => 'JIIPE经济特区的投资激励',
                        'description' => '<p>JIIPE经济特区提供各种财政和非财政优惠，包括税收减免、增值税豁免、进口关税优惠和简化的许可流程。这些激励措施旨在吸引国内和国际投资者。</p>',
                        'meta_title' => '财政优惠 - JIIPE经济特区',
                        'meta_keywords' => '财政激励, 税收优惠, JIIPE',
                        'meta_description' => '探索JIIPE经济特区为投资者提供的财政和非财政优惠',
                    ],
                    'ja' => [
                        'name' => '財政・非財政優遇措置',
                        'subtitle' => 'JIIPE経済特区の投資インセンティブ',
                        'description' => '<p>JIIPE経済特区は、税制優遇、付加価値税免除、輸入関税優遇、簡素化された許認可プロセスなど、さまざまな財政・非財政優遇措置を提供しています。これらのインセンティブは、国内外の投資家を誘致するために設計されています。</p>',
                        'meta_title' => '財政優遇措置 - JIIPE経済特区',
                        'meta_keywords' => '財政インセンティブ, 税制優遇, JIIPE',
                        'meta_description' => 'JIIPE経済特区の投資家向け財政・非財政優遇措置を探る',
                    ],
                    'ko' => [
                        'name' => '재정 및 비재정 혜택',
                        'subtitle' => 'JIIPE 경제특구의 투자 인센티브',
                        'description' => '<p>JIIPE 경제특구는 세금 감면, 부가가치세 면제, 수입 관세 혜택 및 간소화된 허가 절차를 포함한 다양한 재정 및 비재정 혜택을 제공합니다. 이러한 인센티브는 국내외 투자자를 유치하기 위해 설계되었습니다.</p>',
                        'meta_title' => '재정 혜택 - JIIPE 경제특구',
                        'meta_keywords' => '재정 인센티브, 세금 혜택, JIIPE',
                        'meta_description' => 'JIIPE 경제특구의 투자자를 위한 재정 및 비재정 혜택 탐색',
                    ],
                    'tw' => [
                        'name' => '財政和非財政優惠',
                        'subtitle' => 'JIIPE經濟特區的投資激勵',
                        'description' => '<p>JIIPE經濟特區提供各種財政和非財政優惠，包括稅收減免、增值稅豁免、進口關稅優惠和簡化的許可流程。這些激勵措施旨在吸引國內和國際投資者。</p>',
                        'meta_title' => '財政優惠 - JIIPE經濟特區',
                        'meta_keywords' => '財政激勵, 稅收優惠, JIIPE',
                        'meta_description' => '探索JIIPE經濟特區為投資者提供的財政和非財政優惠',
                    ],
                ],
            ],
            [
                'image' => '/images/static/cluster-map.jpg',
                'zone_class_id' => 2,
                'translations' => [
                    'en' => [
                        'name' => 'KEK Gresik - JIIPE Clusters',
                        'subtitle' => 'Industrial Clustering System',
                        'description' => '<p>JIIPE SEZ is organized into several industrial clusters: Metal Industry, Electronic Industry, Chemical Industry, Energy Industry, and Support & Logistics Industry. This clustering system ensures efficient operations and sustainable industrial development.</p>',
                        'meta_title' => 'Industrial Clusters - JIIPE',
                        'meta_keywords' => 'industrial clusters, JIIPE zones, KEK Gresik',
                        'meta_description' => 'Learn about industrial clustering system in JIIPE SEZ',
                    ],
                    'id' => [
                        'name' => 'Klaster KEK Gresik - JIIPE',
                        'subtitle' => 'Sistem Klasterisasi Industri',
                        'description' => '<p>KEK JIIPE diorganisir dalam beberapa klaster industri: Industri Logam, Industri Elektronik, Industri Kimia, Industri Energi, dan Industri Pendukung & Logistik. Sistem klasterisasi ini memastikan operasi yang efisien dan pembangunan industri yang berkelanjutan.</p>',
                        'meta_title' => 'Klaster Industri - JIIPE',
                        'meta_keywords' => 'klaster industri, zona JIIPE, KEK Gresik',
                        'meta_description' => 'Pelajari sistem klasterisasi industri di KEK JIIPE',
                    ],
                    'zh' => [
                        'name' => '格雷西克经济特区 - JIIPE集群',
                        'subtitle' => '工业集群系统',
                        'description' => '<p>JIIPE经济特区组织为几个工业集群：金属工业、电子工业、化学工业、能源工业和支持与物流工业。这种集群系统确保高效运营和可持续的工业发展。</p>',
                        'meta_title' => '工业集群 - JIIPE',
                        'meta_keywords' => '工业集群, JIIPE区域, 格雷西克经济特区',
                        'meta_description' => '了解JIIPE经济特区的工业集群系统',
                    ],
                    'ja' => [
                        'name' => 'グレシック経済特区 - JIIPEクラスター',
                        'subtitle' => '産業クラスタリングシステム',
                        'description' => '<p>JIIPE経済特区は、金属産業、電子産業、化学産業、エネルギー産業、支援・物流産業などのいくつかの産業クラスターに組織されています。このクラスタリングシステムは、効率的な運営と持続可能な産業発展を保証します。</p>',
                        'meta_title' => '産業クラスター - JIIPE',
                        'meta_keywords' => '産業クラスター, JIIPEゾーン, グレシック経済特区',
                        'meta_description' => 'JIIPE経済特区の産業クラスタリングシステムについて学ぶ',
                    ],
                    'ko' => [
                        'name' => '그레식 경제특구 - JIIPE 클러스터',
                        'subtitle' => '산업 클러스터링 시스템',
                        'description' => '<p>JIIPE 경제특구는 금속 산업, 전자 산업, 화학 산업, 에너지 산업, 지원 및 물류 산업 등 여러 산업 클러스터로 구성되어 있습니다. 이 클러스터링 시스템은 효율적인 운영과 지속 가능한 산업 발전을 보장합니다.</p>',
                        'meta_title' => '산업 클러스터 - JIIPE',
                        'meta_keywords' => '산업 클러스터, JIIPE 구역, 그레식 경제특구',
                        'meta_description' => 'JIIPE 경제특구의 산업 클러스터링 시스템에 대해 알아보기',
                    ],
                    'tw' => [
                        'name' => '格雷西克經濟特區 - JIIPE集群',
                        'subtitle' => '工業集群系統',
                        'description' => '<p>JIIPE經濟特區組織為幾個工業集群：金屬工業、電子工業、化學工業、能源工業和支援與物流工業。這種集群系統確保高效營運和可持續的工業發展。</p>',
                        'meta_title' => '工業集群 - JIIPE',
                        'meta_keywords' => '工業集群, JIIPE區域, 格雷西克經濟特區',
                        'meta_description' => '了解JIIPE經濟特區的工業集群系統',
                    ],
                ],
            ],
            [
                'image' => '/images/static/khazanah.jpg',
                'zone_class_id' => 2,
                'translations' => [
                    'en' => [
                        'name' => 'Khazanah KEK Gresik',
                        'subtitle' => 'SEZ Features and Advantages',
                        'description' => '<p>Discover the unique features and advantages of JIIPE SEZ including strategic location, deep-sea port access, multimodal connectivity, complete utilities, green environment, and world-class infrastructure that supports Industry 4.0.</p>',
                        'meta_title' => 'Khazanah - JIIPE SEZ Features',
                        'meta_keywords' => 'JIIPE features, SEZ advantages, Gresik',
                        'meta_description' => 'Discover unique features and advantages of JIIPE Special Economic Zone',
                    ],
                    'id' => [
                        'name' => 'Khazanah KEK Gresik',
                        'subtitle' => 'Fitur dan Keunggulan KEK',
                        'description' => '<p>Temukan fitur dan keunggulan unik dari KEK JIIPE termasuk lokasi strategis, akses pelabuhan laut dalam, konektivitas multimodal, utilitas lengkap, lingkungan hijau, dan infrastruktur kelas dunia yang mendukung Industri 4.0.</p>',
                        'meta_title' => 'Khazanah - Fitur KEK JIIPE',
                        'meta_keywords' => 'fitur JIIPE, keunggulan KEK, Gresik',
                        'meta_description' => 'Temukan fitur dan keunggulan unik Kawasan Ekonomi Khusus JIIPE',
                    ],
                    'zh' => [
                        'name' => '格雷西克经济特区宝库',
                        'subtitle' => '经济特区特点和优势',
                        'description' => '<p>发现JIIPE经济特区的独特特点和优势，包括战略位置、深海港口通道、多式联运连接、完善的公用设施、绿色环境和支持工业4.0的世界级基础设施。</p>',
                        'meta_title' => '宝库 - JIIPE经济特区特点',
                        'meta_keywords' => 'JIIPE特点, 经济特区优势, 格雷西克',
                        'meta_description' => '发现JIIPE经济特区的独特特点和优势',
                    ],
                    'ja' => [
                        'name' => 'グレシック経済特区の宝庫',
                        'subtitle' => '経済特区の特徴と利点',
                        'description' => '<p>JIIPE経済特区の独自の特徴と利点を発見してください。戦略的な立地、深海港へのアクセス、マルチモーダル接続、完全なユーティリティ、グリーン環境、インダストリー4.0をサポートする世界クラスのインフラストラクチャが含まれます。</p>',
                        'meta_title' => '宝庫 - JIIPE経済特区の特徴',
                        'meta_keywords' => 'JIIPE特徴, 経済特区の利点, グレシック',
                        'meta_description' => 'JIIPE経済特区の独自の特徴と利点を発見',
                    ],
                    'ko' => [
                        'name' => '그레식 경제특구의 보물창고',
                        'subtitle' => '경제특구의 특징과 장점',
                        'description' => '<p>전략적 위치, 심해항 접근, 복합 운송 연결성, 완전한 유틸리티, 친환경 환경 및 산업 4.0을 지원하는 세계 수준의 인프라를 포함한 JIIPE 경제특구의 고유한 특징과 장점을 발견하십시오.</p>',
                        'meta_title' => '보물창고 - JIIPE 경제특구 특징',
                        'meta_keywords' => 'JIIPE 특징, 경제특구 장점, 그레식',
                        'meta_description' => 'JIIPE 경제특구의 고유한 특징과 장점 발견',
                    ],
                    'tw' => [
                        'name' => '格雷西克經濟特區寶庫',
                        'subtitle' => '經濟特區特點和優勢',
                        'description' => '<p>發現JIIPE經濟特區的獨特特點和優勢，包括戰略位置、深海港口通道、多式聯運連接、完善的公用設施、綠色環境和支援工業4.0的世界級基礎設施。</p>',
                        'meta_title' => '寶庫 - JIIPE經濟特區特點',
                        'meta_keywords' => 'JIIPE特點, 經濟特區優勢, 格雷西克',
                        'meta_description' => '發現JIIPE經濟特區的獨特特點和優勢',
                    ],
                ],
            ],
        ];

        foreach ($zones as $zoneData) {
            // Create zone
            $zone = Zone::create([
                'image' => $zoneData['image'],
                'zone_class_id' => $zoneData['zone_class_id'],
            ]);

            // Create translations
            foreach ($zoneData['translations'] as $locale => $translation) {
                ZoneTranslation::create([
                    'zone_id' => $zone->id,
                    'locale' => $locale,
                    'name' => $translation['name'],
                    'subtitle' => $translation['subtitle'] ?? null,
                    'description' => $translation['description'],
                    'meta_title' => $translation['meta_title'] ?? null,
                    'meta_keywords' => $translation['meta_keywords'] ?? null,
                    'meta_description' => $translation['meta_description'] ?? null,
                ]);
            }
        }

        $this->command->info('Zones and translations seeded successfully!');
    }
}
