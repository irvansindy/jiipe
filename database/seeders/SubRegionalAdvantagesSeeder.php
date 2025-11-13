<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\SubRegionalAdvantages;
use App\Models\SubRegionalAdvantagesTranslation;
use Illuminate\Support\Facades\DB;
class SubRegionalAdvantagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubRegionalAdvantages::truncate();
        SubRegionalAdvantagesTranslation::truncate();
        $now = Carbon::now();

        // Data untuk Zone ID 5
        $advantagesZone5 = [
            [
                'id' => 1,
                'zone_id' => 5,
                'image' => 'thumb_4d1e8-n-unggul-2_adaptiveResize_420_212.jpg',
                'icon' => null,
                'order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Fasilitas dan Infrastruktur Lengkap',
                        'subtitle' => 'Infrastruktur Bertaraf Internasional',
                        'description' => '<ul><li>Jalan berstandar internasional, dengan lebar 80 m, 50 m, 30 m</li><li>Klasifikasi lokasi untuk industri berat, menengah dan ringan</li><li>Fasilitas perkantoran dan area komersial</li><li>Sistem pemipaan dan konveyor untuk efisiensi bongkar muat</li><li>Fasilitas kepabeanan lengkap</li><li>Sistem Perijinan Terpadu untuk kemudahan investasi</li><li>Kemudahan Langsung Ijin Konstruksi (KLIK)</li></ul>',
                        'meta_title' => 'Fasilitas dan Infrastruktur Lengkap - JIIPE',
                        'meta_description' => 'Fasilitas dan infrastruktur bertaraf internasional dengan jalan lebar, sistem pemipaan, konveyor, dan perizinan terpadu',
                        'meta_keywords' => 'fasilitas, infrastruktur, jalan internasional, pemipaan, konveyor, perizinan, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Complete Facilities and Infrastructure',
                        'subtitle' => 'International Standard Infrastructure',
                        'description' => '<ul><li>International standard roads with widths of 80m, 50m, 30m</li><li>Location classification for heavy, medium and light industries</li><li>Office facilities and commercial areas</li><li>Piping and conveyor systems for loading and unloading efficiency</li><li>Complete customs facilities</li><li>Integrated Licensing System for investment convenience</li><li>Direct Construction Permit Convenience (KLIK)</li></ul>',
                        'meta_title' => 'Complete Facilities and Infrastructure - JIIPE',
                        'meta_description' => 'International standard facilities and infrastructure with wide roads, piping systems, conveyors, and integrated licensing',
                        'meta_keywords' => 'facilities, infrastructure, international roads, piping, conveyor, licensing, JIIPE',
                    ],
                    'zh' => [
                        'name' => '完善的设施和基础设施',
                        'subtitle' => '国际标准基础设施',
                        'description' => '<ul><li>国际标准道路，宽度为80米、50米、30米</li><li>重工业、中型工业和轻工业的位置分类</li><li>办公设施和商业区</li><li>管道和输送系统以提高装卸效率</li><li>完整的海关设施</li><li>综合许可系统，方便投资</li><li>直接建筑许可便利（KLIK）</li></ul>',
                        'meta_title' => '完善的设施和基础设施 - JIIPE',
                        'meta_description' => '国际标准设施和基础设施，配备宽阔道路、管道系统、输送带和综合许可',
                        'meta_keywords' => '设施, 基础设施, 国际道路, 管道, 输送带, 许可, JIIPE',
                    ],
                    'ja' => [
                        'name' => '完全な施設とインフラ',
                        'subtitle' => '国際基準のインフラ',
                        'description' => '<ul><li>幅80m、50m、30mの国際基準道路</li><li>重工業、中規模産業、軽工業の立地分類</li><li>オフィス施設と商業エリア</li><li>積み降ろし効率のための配管とコンベアシステム</li><li>完全な税関施設</li><li>投資の利便性のための統合ライセンスシステム</li><li>直接建設許可の利便性（KLIK）</li></ul>',
                        'meta_title' => '完全な施設とインフラ - JIIPE',
                        'meta_description' => '広い道路、配管システム、コンベア、統合ライセンスを備えた国際基準の施設とインフラ',
                        'meta_keywords' => '施設, インフラ, 国際道路, 配管, コンベア, ライセンス, JIIPE',
                    ],
                    'ko' => [
                        'name' => '완벽한 시설 및 인프라',
                        'subtitle' => '국제 표준 인프라',
                        'description' => '<ul><li>폭 80m, 50m, 30m의 국제 표준 도로</li><li>중공업, 중규모 산업 및 경공업을 위한 위치 분류</li><li>사무실 시설 및 상업 지역</li><li>적하 및 양하 효율성을 위한 배관 및 컨베이어 시스템</li><li>완벽한 세관 시설</li><li>투자 편의를 위한 통합 라이센스 시스템</li><li>직접 건설 허가 편의성（KLIK）</li></ul>',
                        'meta_title' => '완벽한 시설 및 인프라 - JIIPE',
                        'meta_description' => '넓은 도로, 배관 시스템, 컨베이어 및 통합 라이센스를 갖춘 국제 표준 시설 및 인프라',
                        'meta_keywords' => '시설, 인프라, 국제 도로, 배관, 컨베이어, 라이센스, JIIPE',
                    ],
                    'tw' => [
                        'name' => '完善的設施和基礎設施',
                        'subtitle' => '國際標準基礎設施',
                        'description' => '<ul><li>國際標準道路，寬度為80米、50米、30米</li><li>重工業、中型工業和輕工業的位置分類</li><li>辦公設施和商業區</li><li>管道和輸送系統以提高裝卸效率</li><li>完整的海關設施</li><li>綜合許可系統，方便投資</li><li>直接建築許可便利（KLIK）</li></ul>',
                        'meta_title' => '完善的設施和基礎設施 - JIIPE',
                        'meta_description' => '國際標準設施和基礎設施，配備寬闊道路、管道系統、輸送帶和綜合許可',
                        'meta_keywords' => '設施, 基礎設施, 國際道路, 管道, 輸送帶, 許可, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 2,
                'zone_id' => 5,
                'image' => 'thumb_ea14b-n-unggul-3_adaptiveResize_420_212.jpg',
                'icon' => null,
                'order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Efisiensi Logistik',
                        'subtitle' => 'Sistem Logistik Terintegrasi',
                        'description' => '<ul><li>Sistem klasterisasi untuk mencegah kontradiktif operasi antar perusahaan industri dan menjamin kelangsungan operasional jangka panjang</li><li>Sistem pemipaan dan dermaga curah cair untuk mendukung sektor industri berbahan cair</li><li>Biaya logistik untuk bahan baku dan distribusi barang jadi akan lebih hemat dengan pemanfaatan 3 moda konektivitas laut dan darat (pelabuhan laut dalam, kereta api, dan jalan tol)</li></ul>',
                        'meta_title' => 'Efisiensi Logistik - JIIPE',
                        'meta_description' => 'Sistem logistik terintegrasi dengan klasterisasi industri, pemipaan curah cair, dan 3 moda konektivitas',
                        'meta_keywords' => 'efisiensi logistik, klasterisasi, pemipaan, dermaga, konektivitas, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Logistics Efficiency',
                        'subtitle' => 'Integrated Logistics System',
                        'description' => '<ul><li>Clustering system to prevent contradictory operations between industrial companies and ensure long-term operational continuity</li><li>Piping system and liquid bulk jetty to support liquid-based industrial sectors</li><li>Logistics costs for raw materials and finished goods distribution will be more efficient with the utilization of 3 sea and land connectivity modes (deep sea port, railway, and toll road)</li></ul>',
                        'meta_title' => 'Logistics Efficiency - JIIPE',
                        'meta_description' => 'Integrated logistics system with industrial clustering, liquid bulk piping, and 3 connectivity modes',
                        'meta_keywords' => 'logistics efficiency, clustering, piping, jetty, connectivity, JIIPE',
                    ],
                    'zh' => [
                        'name' => '物流效率',
                        'subtitle' => '综合物流系统',
                        'description' => '<ul><li>集群系统防止工业公司之间的矛盾操作，确保长期运营连续性</li><li>管道系统和液体散货码头支持液体工业部门</li><li>利用3种海陆连接模式（深海港口、铁路和收费公路），原材料和成品配送的物流成本将更加高效</li></ul>',
                        'meta_title' => '物流效率 - JIIPE',
                        'meta_description' => '综合物流系统，包括工业集群、液体散货管道和3种连接模式',
                        'meta_keywords' => '物流效率, 集群, 管道, 码头, 连接性, JIIPE',
                    ],
                    'ja' => [
                        'name' => '物流効率',
                        'subtitle' => '統合物流システム',
                        'description' => '<ul><li>産業企業間の矛盾する操作を防ぎ、長期的な運用継続性を確保するクラスタリングシステム</li><li>液体ベースの産業セクターをサポートする配管システムと液体バルク桟橋</li><li>原材料と完成品の配送の物流コストは、3つの海と陸の接続モード（深海港、鉄道、有料道路）の利用でより効率的になります</li></ul>',
                        'meta_title' => '物流効率 - JIIPE',
                        'meta_description' => '産業クラスタリング、液体バルク配管、3つの接続モードを備えた統合物流システム',
                        'meta_keywords' => '物流効率, クラスタリング, 配管, 桟橋, 接続性, JIIPE',
                    ],
                    'ko' => [
                        'name' => '물류 효율성',
                        'subtitle' => '통합 물류 시스템',
                        'description' => '<ul><li>산업 기업 간의 모순된 운영을 방지하고 장기적인 운영 연속성을 보장하는 클러스터링 시스템</li><li>액체 기반 산업 부문을 지원하는 배관 시스템 및 액체 벌크 부두</li><li>3가지 해상 및 육상 연결 모드（심해 항구, 철도 및 유료 도로）활용으로 원자재 및 완제품 유통의 물류 비용이 더욱 효율적입니다</li></ul>',
                        'meta_title' => '물류 효율성 - JIIPE',
                        'meta_description' => '산업 클러스터링, 액체 벌크 배관 및 3가지 연결 모드를 갖춘 통합 물류 시스템',
                        'meta_keywords' => '물류 효율성, 클러스터링, 배관, 부두, 연결성, JIIPE',
                    ],
                    'tw' => [
                        'name' => '物流效率',
                        'subtitle' => '綜合物流系統',
                        'description' => '<ul><li>集群系統防止工業公司之間的矛盾操作，確保長期運營連續性</li><li>管道系統和液體散貨碼頭支持液體工業部門</li><li>利用3種海陸連接模式（深海港口、鐵路和收費公路），原材料和成品配送的物流成本將更加高效</li></ul>',
                        'meta_title' => '物流效率 - JIIPE',
                        'meta_description' => '綜合物流系統，包括工業集群、液體散貨管道和3種連接模式',
                        'meta_keywords' => '物流效率, 集群, 管道, 碼頭, 連接性, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 3,
                'zone_id' => 5,
                'image' => 'thumb_0c458-n-unggul-1_adaptiveResize_420_212.jpg',
                'icon' => null,
                'order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Konektivitas',
                        'subtitle' => 'Akses Multimodal',
                        'description' => '<ul><li>Pelabuhan laut dalam –16 LWS</li><li>Koneksi jalan tol langsung dari Surabaya sebagai kota terbesar kedua di Indonesia</li><li>Akses kereta api jalur ganda langsung, terhubung ke titik akses di Pulau Jawa</li></ul>',
                        'meta_title' => 'Konektivitas - JIIPE',
                        'meta_description' => 'Konektivitas multimodal dengan pelabuhan laut dalam, jalan tol, dan jalur kereta api ganda',
                        'meta_keywords' => 'konektivitas, pelabuhan, jalan tol, kereta api, akses, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Connectivity',
                        'subtitle' => 'Multimodal Access',
                        'description' => '<ul><li>Deep sea port –16 LWS</li><li>Direct toll road connection from Surabaya as Indonesia\'s second largest city</li><li>Direct double track railway access, connected to access points across Java Island</li></ul>',
                        'meta_title' => 'Connectivity - JIIPE',
                        'meta_description' => 'Multimodal connectivity with deep sea port, toll road, and double track railway',
                        'meta_keywords' => 'connectivity, port, toll road, railway, access, JIIPE',
                    ],
                    'zh' => [
                        'name' => '连接性',
                        'subtitle' => '多式联运通道',
                        'description' => '<ul><li>深海港口 –16 LWS</li><li>直接连接印度尼西亚第二大城市泗水的收费公路</li><li>直接双轨铁路通道，连接爪哇岛各接入点</li></ul>',
                        'meta_title' => '连接性 - JIIPE',
                        'meta_description' => '多式联运连接，包括深海港口、收费公路和双轨铁路',
                        'meta_keywords' => '连接性, 港口, 收费公路, 铁路, 通道, JIIPE',
                    ],
                    'ja' => [
                        'name' => '接続性',
                        'subtitle' => 'マルチモーダルアクセス',
                        'description' => '<ul><li>深海港 –16 LWS</li><li>インドネシア第2の都市スラバヤからの直接有料道路接続</li><li>ジャワ島全体のアクセスポイントに接続された直接複線鉄道アクセス</li></ul>',
                        'meta_title' => '接続性 - JIIPE',
                        'meta_description' => '深海港、有料道路、複線鉄道を備えたマルチモーダル接続',
                        'meta_keywords' => '接続性, 港, 有料道路, 鉄道, アクセス, JIIPE',
                    ],
                    'ko' => [
                        'name' => '연결성',
                        'subtitle' => '복합 운송 접근',
                        'description' => '<ul><li>심해 항구 –16 LWS</li><li>인도네시아 제2의 도시 수라바야에서 직접 유료 도로 연결</li><li>자바 섬 전역의 접근 지점에 연결된 직접 복선 철도 접근</li></ul>',
                        'meta_title' => '연결성 - JIIPE',
                        'meta_description' => '심해 항구, 유료 도로 및 복선 철도를 갖춘 복합 운송 연결',
                        'meta_keywords' => '연결성, 항구, 유료 도로, 철도, 접근, JIIPE',
                    ],
                    'tw' => [
                        'name' => '連接性',
                        'subtitle' => '多式聯運通道',
                        'description' => '<ul><li>深海港口 –16 LWS</li><li>直接連接印度尼西亞第二大城市泗水的收費公路</li><li>直接雙軌鐵路通道，連接爪哇島各接入點</li></ul>',
                        'meta_title' => '連接性 - JIIPE',
                        'meta_description' => '多式聯運連接，包括深海港口、收費公路和雙軌鐵路',
                        'meta_keywords' => '連接性, 港口, 收費公路, 鐵路, 通道, JIIPE',
                    ],
                ],
            ],
        ];

        // Data untuk Zone ID 6
        $advantagesZone6 = [
            [
                'id' => 4,
                'zone_id' => 6,
                'image' => 'thumb_4b6d7-n-unggul-1_adaptiveResize_420_212.jpg',
                'icon' => null,
                'order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Multifungsi',
                        'subtitle' => 'Pelabuhan Serbaguna',
                        'description' => '<ul><li>Pengangkutan, curah kering, container/peti kemas, kargo umum, pengangkutan kendaraan, fasilitas perikanan serba guna, tangki cair dan gas</li><li>Pusat Logistik Berikat</li><li>Pemeliharaan Lepas Pantai</li></ul>',
                        'meta_title' => 'Multifungsi - JIIPE',
                        'meta_description' => 'Pelabuhan multifungsi dengan fasilitas curah kering, container, kargo umum, dan pusat logistik berikat',
                        'meta_keywords' => 'multifungsi, pelabuhan, container, kargo, logistik berikat, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Multifunction',
                        'subtitle' => 'Multipurpose Port',
                        'description' => '<ul><li>Transportation, dry bulk, container, general cargo, vehicle transportation, multipurpose fishing facilities, liquid and gas tanks</li><li>Bonded Logistics Center</li><li>Offshore Maintenance</li></ul>',
                        'meta_title' => 'Multifunction - JIIPE',
                        'meta_description' => 'Multifunction port with dry bulk, container, general cargo facilities, and bonded logistics center',
                        'meta_keywords' => 'multifunction, port, container, cargo, bonded logistics, JIIPE',
                    ],
                    'zh' => [
                        'name' => '多功能',
                        'subtitle' => '多用途港口',
                        'description' => '<ul><li>运输、干散货、集装箱、普通货物、车辆运输、多用途渔业设施、液体和气体罐</li><li>保税物流中心</li><li>海上维护</li></ul>',
                        'meta_title' => '多功能 - JIIPE',
                        'meta_description' => '多功能港口，配备干散货、集装箱、普通货物设施和保税物流中心',
                        'meta_keywords' => '多功能, 港口, 集装箱, 货物, 保税物流, JIIPE',
                    ],
                    'ja' => [
                        'name' => '多機能',
                        'subtitle' => '多目的港',
                        'description' => '<ul><li>輸送、ドライバルク、コンテナ、一般貨物、車両輸送、多目的漁業施設、液体およびガスタンク</li><li>保税物流センター</li><li>オフショアメンテナンス</li></ul>',
                        'meta_title' => '多機能 - JIIPE',
                        'meta_description' => 'ドライバルク、コンテナ、一般貨物施設、保税物流センターを備えた多機能港',
                        'meta_keywords' => '多機能, 港, コンテナ, 貨物, 保税物流, JIIPE',
                    ],
                    'ko' => [
                        'name' => '다기능',
                        'subtitle' => '다목적 항구',
                        'description' => '<ul><li>운송, 건조 벌크, 컨테이너, 일반 화물, 차량 운송, 다목적 어업 시설, 액체 및 가스 탱크</li><li>보세 물류 센터</li><li>해양 유지보수</li></ul>',
                        'meta_title' => '다기능 - JIIPE',
                        'meta_description' => '건조 벌크, 컨테이너, 일반 화물 시설 및 보세 물류 센터를 갖춘 다기능 항구',
                        'meta_keywords' => '다기능, 항구, 컨테이너, 화물, 보세 물류, JIIPE',
                    ],
                    'tw' => [
                        'name' => '多功能',
                        'subtitle' => '多用途港口',
                        'description' => '<ul><li>運輸、乾散貨、集裝箱、普通貨物、車輛運輸、多用途漁業設施、液體和氣體罐</li><li>保稅物流中心</li><li>海上維護</li></ul>',
                        'meta_title' => '多功能 - JIIPE',
                        'meta_description' => '多功能港口，配備乾散貨、集裝箱、普通貨物設施和保稅物流中心',
                        'meta_keywords' => '多功能, 港口, 集裝箱, 貨物, 保稅物流, JIIPE',
                    ],
                ],
            ],
            [
                'id' => 5,
                'zone_id' => 6,
                'image' => 'thumb_7d1b9-n-unggul-2_adaptiveResize_420_212.jpg',
                'icon' => null,
                'order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Fasilitas',
                        'subtitle' => 'Fasilitas Bertaraf Internasional',
                        'description' => '<ul><li>ISO 9001 untuk Manajemen Mutu; ISO 14001 untuk Manajemen Lingkungan; OHSAS 18001 / ISO 45001 untuk Keselamatan Kerja</li><li>Kedalaman alamiah -14 LWS akan dikeruk menjadi -16 LWS pada tahun 2021 dengan total panjang area dermaga 6200 m</li><li>Terminal energi untuk batubara, minyak dan gas</li><li>Tangki penyimpanan dan fasilitas pendingin</li><li>Proses kepabeanan yang efisien</li><li>Sistem konveyor, pemipaan untuk efisiensi bongkar muat</li><li>Pasokan air bersih</li></ul>',
                        'meta_title' => 'Fasilitas - JIIPE',
                        'meta_description' => 'Fasilitas bertaraf internasional dengan sertifikasi ISO, terminal energi, dan sistem bongkar muat modern',
                        'meta_keywords' => 'fasilitas, ISO, terminal energi, dermaga, konveyor, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Facilities',
                        'subtitle' => 'International Standard Facilities',
                        'description' => '<ul><li>ISO 9001 for Quality Management; ISO 14001 for Environmental Management; OHSAS 18001 / ISO 45001 for Occupational Safety</li><li>Natural depth of -14 LWS will be dredged to -16 LWS in 2021 with a total jetty area length of 6200 m</li><li>Energy terminal for coal, oil and gas</li><li>Storage tanks and cooling facilities</li><li>Efficient customs processes</li><li>Conveyor system, piping for loading and unloading efficiency</li><li>Clean water supply</li></ul>',
                        'meta_title' => 'Facilities - JIIPE',
                        'meta_description' => 'International standard facilities with ISO certification, energy terminal, and modern loading systems',
                        'meta_keywords' => 'facilities, ISO, energy terminal, jetty, conveyor, JIIPE',
                    ],
                    'zh' => [
                        'name' => '设施',
                        'subtitle' => '国际标准设施',
                        'description' => '<ul><li>ISO 9001质量管理；ISO 14001环境管理；OHSAS 18001 / ISO 45001职业安全</li><li>自然深度-14 LWS将在2021年疏浚至-16 LWS，码头区总长度为6200米</li><li>煤炭、石油和天然气能源码头</li><li>储罐和冷却设施</li><li>高效的海关流程</li><li>输送系统、管道以提高装卸效率</li><li>清洁水供应</li></ul>',
                        'meta_title' => '设施 - JIIPE',
                        'meta_description' => '国际标准设施，配备ISO认证、能源码头和现代装卸系统',
                        'meta_keywords' => '设施, ISO, 能源码头, 码头, 输送带, JIIPE',
                    ],
                    'ja' => [
                        'name' => '施設',
                        'subtitle' => '国際標準施設',
                        'description' => '<ul><li>品質管理のためのISO 9001；環境管理のためのISO 14001；労働安全のためのOHSAS 18001 / ISO 45001</li><li>自然深度-14 LWSは2021年に-16 LWSに浚渫され、桟橋エリアの総延長は6200m</li><li>石炭、石油、ガスのエネルギーターミナル</li><li>貯蔵タンクと冷却施設</li><li>効率的な税関プロセス</li><li>積み降ろし効率のためのコンベアシステム、配管</li><li>清浄水供給</li></ul>',
                        'meta_title' => '施設 - JIIPE',
                        'meta_description' => 'ISO認証、エネルギーターミナル、最新の積み降ろしシステムを備えた国際基準施設',
                        'meta_keywords' => '施設, ISO, エネルギーターミナル, 桟橋, コンベア, JIIPE',
                    ],
                    'ko' => [
                        'name' => '시설',
                        'subtitle' => '국제 표준 시설',
                        'description' => '<ul><li>품질 관리를 위한 ISO 9001; 환경 관리를 위한 ISO 14001; 산업 안전을 위한 OHSAS 18001 / ISO 45001</li><li>자연 깊이 -14 LWS는 2021년에 -16 LWS로 준설되며 부두 지역 총 길이는 6200m</li><li>석탄, 석유 및 가스 에너지 터미널</li><li>저장 탱크 및 냉각 시설</li><li>효율적인 세관 프로세스</li><li>적하 및 양하 효율성을 위한 컨베이어 시스템, 배관</li><li>깨끗한 물 공급</li></ul>',
                        'meta_title' => '시설 - JIIPE',
                        'meta_description' => 'ISO 인증, 에너지 터미널 및 현대적인 적하 시스템을 갖춘 국제 표준 시설',
                        'meta_keywords' => '시설, ISO, 에너지 터미널, 부두, 컨베이어, JIIPE',
                    ],
                    'tw' => [
                        'name' => '設施',
                        'subtitle' => '國際標準設施',
                        'description' => '<ul><li>ISO 9001質量管理；ISO 14001環境管理；OHSAS 18001 / ISO 45001職業安全</li><li>自然深度-14 LWS將在2021年疏浚至-16 LWS，碼頭區總長度為6200米</li><li>煤炭、石油和天然氣能源碼頭</li><li>儲罐和冷卻設施</li><li>高效的海關流程</li><li>輸送系統、管道以提高裝卸效率</li><li>清潔水供應</li></ul>',
                        'meta_title' => '設施 - JIIPE',
                        'meta_description' => '國際標準設施，配備ISO認證、能源碼頭和現代裝卸系統',
                        'meta_keywords' => '設施, ISO, 能源碼頭, 碼頭, 輸送帶, JIIPE',
                    ],
                ],
            ],
        ];

        // Data untuk Zone ID 7
        $advantagesZone7 = [
            [
                'id' => 6,
                'zone_id' => 7,
                'image' => 'thumb_88f1a-thumb-4d1e8-n-unggul-2-adaptiveresize-790-500_adaptiveResize_420_212.jpg',
                'icon' => null,
                'order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
                'translations' => [
                    'id' => [
                        'name' => 'Fasilitas dan Infrastruktur Lengkap',
                        'subtitle' => 'Infrastruktur Kota Modern',
                        'description' => '<ul><li>Pembangkit listrik mandiri. GEM City akan menyuplai listrik dari pembangkit listrik independen JIIPE. "Tidak ada lagi pemadaman listrik" akan menjadi layanan komitmen untuk para penghuni.</li><li>Ketersediaan air. Air sebagai kebutuhan dasar untuk area perumahan akan menggunakan sistem desalinasi dengan kualitas terjamin.</li><li>Sistem mitigasi banjir.</li></ul>',
                        'meta_title' => 'Fasilitas dan Infrastruktur Lengkap - GEM City JIIPE',
                        'meta_description' => 'Infrastruktur lengkap dengan pembangkit listrik mandiri, sistem desalinasi air, dan mitigasi banjir di GEM City',
                        'meta_keywords' => 'fasilitas, infrastruktur, listrik mandiri, desalinasi, mitigasi banjir, GEM City, JIIPE',
                    ],
                    'en' => [
                        'name' => 'Complete Facilities and Infrastructure',
                        'subtitle' => 'Modern City Infrastructure',
                        'description' => '<ul><li>Independent power plant. GEM City will supply electricity from JIIPE\'s independent power plant. "No more power outages" will be a commitment service for residents.</li><li>Water availability. Water as a basic need for residential areas will use a desalination system with guaranteed quality.</li><li>Flood mitigation system.</li></ul>',
                        'meta_title' => 'Complete Facilities and Infrastructure - GEM City JIIPE',
                        'meta_description' => 'Complete infrastructure with independent power plant, water desalination system, and flood mitigation in GEM City',
                        'meta_keywords' => 'facilities, infrastructure, independent power, desalination, flood mitigation, GEM City, JIIPE',
                    ],
                    'zh' => [
                        'name' => '完善的設施和基礎設施',
                        'subtitle' => '現代城市基礎設施',
                        'description' => '<ul><li>獨立發電廠。GEM City將從JIIPE的獨立發電廠供電。"不再停電"將成為居民的承諾服務。</li><li>水供應。作為住宅區基本需求的水將使用有質量保證的海水淡化系統。</li><li>防洪系統。</li></ul>',
                        'meta_title' => '完善的設施和基礎設施 - GEM City JIIPE',
                        'meta_description' => 'GEM City擁有獨立發電廠、海水淡化系統和防洪設施的完善基礎設施',
                        'meta_keywords' => '設施, 基礎設施, 獨立電力, 海水淡化, 防洪, GEM City, JIIPE',
                    ],
                    'ja' => [
                        'name' => '完全な施設とインフラ',
                        'subtitle' => '現代都市インフラ',
                        'description' => '<ul><li>独立発電所。GEM CityはJIIPEの独立発電所から電力を供給します。「停電なし」が住民への約束サービスとなります。</li><li>水の利用可能性。住宅地の基本的なニーズとしての水は、品質保証された淡水化システムを使用します。</li><li>洪水緩和システム。</li></ul>',
                        'meta_title' => '完全な施設とインフラ - GEM City JIIPE',
                        'meta_description' => 'GEM Cityの独立発電所、淡水化システム、洪水緩和を備えた完全なインフラ',
                        'meta_keywords' => '施設, インフラ, 独立電力, 淡水化, 洪水緩和, GEM City, JIIPE',
                    ],
                    'ko' => [
                        'name' => '완벽한 시설 및 인프라',
                        'subtitle' => '현대 도시 인프라',
                        'description' => '<ul><li>독립 발전소. GEM City는 JIIPE의 독립 발전소에서 전기를 공급받습니다. "더 이상 정전 없음"이 거주자를 위한 약속 서비스가 될 것입니다.</li><li>물 가용성. 주거 지역의 기본 필요로서의 물은 품질이 보장된 담수화 시스템을 사용합니다.</li><li>홍수 완화 시스템.</li></ul>',
                        'meta_title' => '완벽한 시설 및 인프라 - GEM City JIIPE',
                        'meta_description' => 'GEM City의 독립 발전소, 담수화 시스템 및 홍수 완화를 갖춘 완벽한 인프라',
                        'meta_keywords' => '시설, 인프라, 독립 전력, 담수화, 홍수 완화, GEM City, JIIPE',
                    ],
                    'tw' => [
                        'name' => '完善的設施和基礎設施',
                        'subtitle' => '現代城市基礎設施',
                        'description' => '<ul><li>獨立發電廠。GEM City將從JIIPE的獨立發電廠供電。"不再停電"將成為居民的承諾服務。</li><li>水供應。作為住宅區基本需求的水將使用有質量保證的海水淡化系統。</li><li>防洪系統。</li></ul>',
                        'meta_title' => '完善的設施和基礎設施 - GEM City JIIPE',
                        'meta_description' => 'GEM City擁有獨立發電廠、海水淡化系統和防洪設施的完善基礎設施',
                        'meta_keywords' => '設施, 基礎設施, 獨立電力, 海水淡化, 防洪, GEM City, JIIPE',
                    ],
                ],
            ],
        ];

        // Gabungkan semua data
        $allAdvantages = array_merge($advantagesZone5, $advantagesZone6, $advantagesZone7);

        // Insert data
        foreach ($allAdvantages as $advantage) {
            $translations = $advantage['translations'];
            unset($advantage['translations']);

            // Insert advantage
            DB::table('sub_regional_advantages')->insert($advantage);

            // Insert translations
            foreach ($translations as $locale => $translation) {
                DB::table('sub_regional_advantages_translations')->insert([
                    'sub_regional_advantages_id' => $advantage['id'],
                    'locale' => $locale,
                    'name' => $translation['name'],
                    'subtitle' => $translation['subtitle'] ?? null,
                    'description' => $translation['description'],
                    'meta_title' => $translation['meta_title'] ?? null,
                    'meta_description' => $translation['meta_description'] ?? null,
                    'meta_keywords' => $translation['meta_keywords'] ?? null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
