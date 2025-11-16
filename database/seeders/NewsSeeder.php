<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\NewsTranslation;
use App\Models\NewsCategories;
use Carbon\Carbon;
class NewsSeeder extends Seeder
{
    public function run(): void
    {
        News::truncate();
        NewsTranslation::truncate();

        $newsData = [
            [
                'thumbnail' => 'thumb_fe8ff-dsc03506_adaptiveResize_634_385.jpg',
                'is_published' => true,
                'category_id' => 1,
                'translations' => [
                    'id' => [
                        'title' => 'Terobosan Besar: Layanan Imigrasi Kini Tersedia di Dalam KEK JIIPE Gresik untuk Meningkatkan Daya Saing Investasi',
                        'content' => 'GRESIK, 12 November 2025 — Kawasan Ekonomi Khusus (KEK) Gresik, yang terletak di kawasan industri terintegrasi kelas dunia JIIPE (Java Integrated Industrial and Ports Estate), terus...',
                        'quote' => null,
                    ],
                    'en' => [
                        'title' => 'A Major Breakthrough: Immigration Services Now Available Inside JIIPE Gresik SEZ to Boost Investment Competitiveness',
                        'content' => 'GRESIK, 12 November 2025 — The Gresik Special Economic Zone (SEZ), located within the world-class integrated industrial area JIIPE (Java Integrated Industrial and Ports Estate), cont...',
                        'quote' => null,
                    ],
                    'zh' => [
                        'title' => '重大突破：JIIPE格雷西克经济特区内现提供移民服务，提升投资竞争力',
                        'content' => '格雷西克，2025年11月12日——位于世界级综合工业区JIIPE（爪哇综合工业港口区）内的格雷西克经济特区（SEZ），继续...',
                        'quote' => null,
                    ],
                    'ja' => [
                        'title' => '大きな突破口：JIIPE グレシック経済特区内で入国管理サービスが利用可能に、投資競争力を向上',
                        'content' => 'グレシック、2025年11月12日 — 世界クラスの統合産業エリアJIIPE（ジャワ統合工業港湾エステート）内に位置するグレシック経済特区（SEZ）は、継続的に...',
                        'quote' => null,
                    ],
                    'ko' => [
                        'title' => '중요한 돌파구: JIIPE 그레식 경제특구 내 이민 서비스 제공으로 투자 경쟁력 강화',
                        'content' => '그레식, 2025년 11월 12일 — 세계적 수준의 통합 산업 지역 JIIPE(Java Integrated Industrial and Ports Estate) 내에 위치한 그레식 경제특구(SEZ)는 계속해서...',
                        'quote' => null,
                    ],
                    'tw' => [
                        'title' => '重大突破：JIIPE格雷西克經濟特區內現提供移民服務，提升投資競爭力',
                        'content' => '格雷西克，2025年11月12日——位於世界級綜合工業區JIIPE（爪哇綜合工業港口區）內的格雷西克經濟特區（SEZ），持續...',
                        'quote' => null,
                    ],
                ]
            ],
            [
                'thumbnail' => 'thumb_4107d-beacukai_adaptiveResize_634_385.JPG',
                'is_published' => true,
                'category_id' => 1,
                'translations' => [
                    'id' => [
                        'title' => 'KEK Gresik Luncurkan Pilot Sistem Bea Cukai Auto Gate untuk Percepat Arus Logistik',
                        'content' => 'Gresik, 17 Oktober 2025 – Kawasan Ekonomi Khusus (KEK) Gresik telah memulai implementasi sistem logistik berbasis digital...',
                        'quote' => null,
                    ],
                    'en' => [
                        'title' => 'Gresik SEZ Launches Auto Gate Customs System Pilot to Accelerate Logistics Flow',
                        'content' => 'Gresik, October 17, 2025 – The Gresik Special Economic Zone (SEZ) has begun implementing a digital-based logistics s...',
                        'quote' => null,
                    ],
                    'zh' => [
                        'title' => '格雷西克经济特区推出自动门海关系统试点，加速物流流动',
                        'content' => '格雷西克，2025年10月17日 – 格雷西克经济特区（SEZ）已开始实施基于数字的物流系统...',
                        'quote' => null,
                    ],
                    'ja' => [
                        'title' => 'グレシック経済特区、物流フローを加速するオートゲート税関システムのパイロットを開始',
                        'content' => 'グレシック、2025年10月17日 – グレシック経済特区（SEZ）は、デジタルベースの物流システムの実装を開始しました...',
                        'quote' => null,
                    ],
                    'ko' => [
                        'title' => '그레식 경제특구, 물류 흐름 가속화를 위한 자동 게이트 세관 시스템 파일럿 출시',
                        'content' => '그레식, 2025년 10월 17일 – 그레식 경제특구(SEZ)는 디지털 기반 물류 시스템 구현을 시작했습니다...',
                        'quote' => null,
                    ],
                    'tw' => [
                        'title' => '格雷西克經濟特區推出自動門海關系統試點，加速物流流動',
                        'content' => '格雷西克，2025年10月17日 – 格雷西克經濟特區（SEZ）已開始實施基於數位的物流系統...',
                        'quote' => null,
                    ],
                ]
            ],
            [
                'thumbnail' => 'thumb_f6dfc-thor6475-1_adaptiveResize_634_385.jpg',
                'is_published' => true,
                'category_id' => 1,
                'translations' => [
                    'id' => [
                        'title' => 'Kapolda Jatim Kunjungi Kawasan Ekonomi Khusus JIIPE untuk Tinjau Markas Kepolisian Baru',
                        'content' => 'Gresik, 25 September 2025 – Kepala Kepolisian Daerah Jawa Timur (Kapolda Jatim), Inspektur Jenderal Polisi Drs. Nanang Avianto...',
                        'quote' => null,
                    ],
                    'en' => [
                        'title' => 'East Java Police Chief Visits JIIPE Special Economic Zone to Review New Police Headquarters',
                        'content' => 'Gresik, September 25, 2025 – East Java Regional Police Chief (Kapolda Jatim), Inspector General Drs. Nanang Avianto, c...',
                        'quote' => null,
                    ],
                    'zh' => [
                        'title' => '东爪哇警察局长访问JIIPE经济特区，检查新警察总部',
                        'content' => '格雷西克，2025年9月25日 – 东爪哇地区警察局长（Kapolda Jatim），警监总监Drs. Nanang Avianto...',
                        'quote' => null,
                    ],
                    'ja' => [
                        'title' => '東ジャワ警察署長、新警察本部を視察するためJIIPE経済特区を訪問',
                        'content' => 'グレシック、2025年9月25日 – 東ジャワ地域警察署長（Kapolda Jatim）、警視総監Drs. Nanang Avianto...',
                        'quote' => null,
                    ],
                    'ko' => [
                        'title' => '동자바 경찰청장, 새 경찰 본부 검토를 위해 JIIPE 경제특구 방문',
                        'content' => '그레식, 2025년 9월 25일 – 동자바 지역 경찰청장(Kapolda Jatim), 경감총감 Drs. Nanang Avianto...',
                        'quote' => null,
                    ],
                    'tw' => [
                        'title' => '東爪哇警察局長訪問JIIPE經濟特區，檢查新警察總部',
                        'content' => '格雷西克，2025年9月25日 – 東爪哇地區警察局長（Kapolda Jatim），警監總監Drs. Nanang Avianto...',
                        'quote' => null,
                    ],
                ]
            ],
            [
                'thumbnail' => 'thumb_7a1a6-dsc02292_adaptiveResize_634_385.JPG',
                'is_published' => true,
                'category_id' => 1,
                'translations' => [
                    'id' => [
                        'title' => 'PLN Resmikan Pasokan Listrik Tegangan Tinggi 40 MVA untuk BKMS di KEK Gresik',
                        'content' => 'Gresik, 20 September 2025 – PT PLN (Persero) resmi meresmikan pasokan listrik tegangan tinggi (TT) untuk PT Berkah...',
                        'quote' => null,
                    ],
                    'en' => [
                        'title' => 'PLN Commissions 40 MVA High-Voltage Power Supply for BKMS in Gresik SEZ',
                        'content' => 'Gresik, September 20, 2025 – PT PLN (Persero) officially inaugurated the high-voltage (HV) power supply for PT Berkah ...',
                        'quote' => null,
                    ],
                    'zh' => [
                        'title' => 'PLN在格雷西克经济特区为BKMS启用40 MVA高压电源',
                        'content' => '格雷西克，2025年9月20日 – PT PLN（Persero）正式启用为PT Berkah的高压（HV）电源供应...',
                        'quote' => null,
                    ],
                    'ja' => [
                        'title' => 'PLN、グレシック経済特区のBKMS向け40 MVA高圧電源を稼働開始',
                        'content' => 'グレシック、2025年9月20日 – PT PLN（Persero）は、PT Berkah向けの高圧（HV）電源供給を正式に開始しました...',
                        'quote' => null,
                    ],
                    'ko' => [
                        'title' => 'PLN, 그레식 경제특구 BKMS를 위한 40 MVA 고압 전력 공급 시작',
                        'content' => '그레식, 2025년 9월 20일 – PT PLN（Persero）은 PT Berkah를 위한 고압（HV）전력 공급을 공식적으로 시작했습니다...',
                        'quote' => null,
                    ],
                    'tw' => [
                        'title' => 'PLN在格雷西克經濟特區為BKMS啟用40 MVA高壓電源',
                        'content' => '格雷西克，2025年9月20日 – PT PLN（Persero）正式啟用為PT Berkah的高壓（HV）電源供應...',
                        'quote' => null,
                    ],
                ]
            ],
            [
                'thumbnail' => 'thumb_6cd00-whatsapp-image-2025-10-02-at-12-33-18_adaptiveResize_634_385.jpg',
                'is_published' => true,
                'category_id' => 1,
                'translations' => [
                    'id' => [
                        'title' => 'Jawa Timur Catat Investasi Rp 74,69 Triliun di Semester I 2025, KEK JIIPE Raih Penghargaan Investasi 2025 Kategori Investasi Dalam Negeri',
                        'content' => 'Surabaya, 2 Oktober 2025 – Jawa Timur terus memperkuat posisinya sebagai pendorong utama ekonomi nasional Indonesia...',
                        'quote' => null,
                    ],
                    'en' => [
                        'title' => 'East Java Records Rp 74.69 Trillion Investment in H1 2025, JIIPE SEZ Wins Investment Award 2025 for Domestic Investment Category',
                        'content' => 'Surabaya, October 2, 2025 – East Java continues to strengthen its position as a key driver of Indonesia\'s national ec...',
                        'quote' => null,
                    ],
                    'zh' => [
                        'title' => '东爪哇2025年上半年投资达74.69万亿印尼盾，JIIPE经济特区荣获2025年国内投资类别投资奖',
                        'content' => '泗水，2025年10月2日 – 东爪哇继续巩固其作为印度尼西亚国民经济关键驱动力的地位...',
                        'quote' => null,
                    ],
                    'ja' => [
                        'title' => '東ジャワ、2025年上半期に74.69兆ルピアの投資を記録、JIIPE経済特区が国内投資部門で2025年投資賞を受賞',
                        'content' => 'スラバヤ、2025年10月2日 – 東ジャワは、インドネシアの国民経済の主要な推進力としての地位を強化し続けています...',
                        'quote' => null,
                    ],
                    'ko' => [
                        'title' => '동자바, 2025년 상반기 74.69조 루피아 투자 기록, JIIPE 경제특구 국내 투자 부문 2025년 투자상 수상',
                        'content' => '수라바야, 2025년 10월 2일 – 동자바는 인도네시아 국가 경제의 핵심 동력으로서의 입지를 계속 강화하고 있습니다...',
                        'quote' => null,
                    ],
                    'tw' => [
                        'title' => '東爪哇2025年上半年投資達74.69兆印尼盾，JIIPE經濟特區榮獲2025年國內投資類別投資獎',
                        'content' => '泗水，2025年10月2日 – 東爪哇持續鞏固其作為印度尼西亞國民經濟關鍵驅動力的地位...',
                        'quote' => null,
                    ],
                ]
            ],
            [
                'thumbnail' => 'thumb_05498-penandatanganan-jiipe_adaptiveResize_634_385.jpg',
                'is_published' => true,
                'category_id' => 1,
                'translations' => [
                    'id' => [
                        'title' => 'Golden Elephant Sincerity (GESC) Resmi Bergabung dengan JIIPE, Menandai Ekspansi Global di Indonesia',
                        'content' => 'Gresik, 25 April 2025 — Java Integrated Industrial and Ports Estate (JIIPE), kawasan industri terintegrasi terkemuka...',
                        'quote' => null,
                    ],
                    'en' => [
                        'title' => 'Golden Elephant Sincerity (GESC) Officially Joins JIIPE, Marks Global Expansion in Indonesia',
                        'content' => 'Gresik, April 25, 2025 — Java Integrated Industrial and Ports Estate (JIIPE), a leading integrated industrial estate, m...',
                        'quote' => null,
                    ],
                    'zh' => [
                        'title' => '金象诚信（GESC）正式加入JIIPE，标志着在印尼的全球扩张',
                        'content' => '格雷西克，2025年4月25日 — 爪哇综合工业港口区（JIIPE），一个领先的综合工业区...',
                        'quote' => null,
                    ],
                    'ja' => [
                        'title' => 'Golden Elephant Sincerity（GESC）がJIIPEに正式参加、インドネシアでのグローバル展開を開始',
                        'content' => 'グレシック、2025年4月25日 — ジャワ統合工業港湾エステート（JIIPE）、主要な統合工業団地...',
                        'quote' => null,
                    ],
                    'ko' => [
                        'title' => 'Golden Elephant Sincerity (GESC) JIIPE 공식 합류, 인도네시아에서 글로벌 확장 표시',
                        'content' => '그레식, 2025년 4월 25일 — Java Integrated Industrial and Ports Estate (JIIPE), 선도적인 통합 산업 단지...',
                        'quote' => null,
                    ],
                    'tw' => [
                        'title' => '金象誠信（GESC）正式加入JIIPE，標誌著在印尼的全球擴張',
                        'content' => '格雷西克，2025年4月25日 — 爪哇綜合工業港口區（JIIPE），一個領先的綜合工業區...',
                        'quote' => null,
                    ],
                ]
            ],
            [
                'thumbnail' => 'thumb_1d3c1-presidenri-go-id-18032025093249-67d8db51d1a0d1-51054546_adaptiveResize_634_385.jpg',
                'is_published' => true,
                'category_id' => 1,
                'translations' => [
                    'id' => [
                        'title' => 'JIIPE: Pusat Hilirisasi Logam Mulia Indonesia',
                        'content' => 'KEK Gresik, 17 Maret 2025 – Presiden Indonesia Prabowo Subianto meresmikan Pabrik Logam Mulia PT Freeport Indonesia (PTFI)...',
                        'quote' => null,
                    ],
                    'en' => [
                        'title' => 'JIIPE: Indonesia\'s Precious Metal Downstreaming Hub',
                        'content' => 'Gresik SEZ, March 17, 2025 – Indonesian President Prabowo Subianto inaugurated PT Freeport Indonesia\'s (PTFI) Preciou...',
                        'quote' => null,
                    ],
                    'zh' => [
                        'title' => 'JIIPE：印尼贵金属下游枢纽',
                        'content' => '格雷西克经济特区，2025年3月17日 – 印度尼西亚总统普拉博沃·苏比安托为PT Freeport Indonesia（PTFI）的贵金属工厂揭幕...',
                        'quote' => null,
                    ],
                    'ja' => [
                        'title' => 'JIIPE：インドネシアの貴金属下流化拠点',
                        'content' => 'グレシック経済特区、2025年3月17日 – インドネシア大統領プラボウォ・スビアントは、PT Freeport Indonesia（PTFI）の貴金属工場を開設しました...',
                        'quote' => null,
                    ],
                    'ko' => [
                        'title' => 'JIIPE: 인도네시아의 귀금속 다운스트림 허브',
                        'content' => '그레식 경제특구, 2025년 3월 17일 – 인도네시아 대통령 프라보워 수비안토는 PT Freeport Indonesia (PTFI)의 귀금속 공장을 개설했습니다...',
                        'quote' => null,
                    ],
                    'tw' => [
                        'title' => 'JIIPE：印尼貴金屬下游樞紐',
                        'content' => '格雷西克經濟特區，2025年3月17日 – 印度尼西亞總統普拉博沃·蘇比安托為PT Freeport Indonesia（PTFI）的貴金屬工廠揭幕...',
                        'quote' => null,
                    ],
                ]
            ],
        ];

        foreach ($newsData as $data) {
            $translations = $data['translations'];
            unset($data['translations']);

            $news = News::create($data);

            foreach ($translations as $locale => $translation) {
                NewsTranslation::create([
                    'news_id' => $news->id,
                    'locale' => $locale,
                    'title' => $translation['title'],
                    'content' => $translation['content'],
                    'quote' => $translation['quote'],
                ]);
            }
        }

        $newsData = [
            [
                'thumbnail' => 'thumb_6adfc-picture2_adaptiveResize_634_385.png',
                'is_published' => true,
                'category_id' => 4,
                'translations' => [
                    'id' => [
                        'title' => 'JIIPE Perkuat Konektivitas Industri dan Pelabuhan Melalui Pengembangan Jalan Akses Utama ROW 80',
                        'content' => 'Java Integrated Industrial and Ports Estate (JIIPE) memperkuat posisinya sebagai kawasan industri dan pelabuhan terintegrasi melalui pembangunan jalan akses utama selebar 80 meter...',
                        'quote' => null,
                    ],
                    'en' => [
                        'title' => 'JIIPE Strengthens Industrial and Port Connectivity Through the Development of the Main Access Road ROW 80',
                        'content' => 'Java Integrated Industrial and Ports Estate (JIIPE) reinforces its position as an integrated industrial and port estate through the construction of a main access road 80 meters wide, kn...',
                        'quote' => null,
                    ],
                    'zh' => [
                        'title' => 'JIIPE通过开发ROW 80主要通道道路加强工业和港口连通性',
                        'content' => '爪哇综合工业港口区（JIIPE）通过建设80米宽的主要通道道路，加强其作为综合工业和港口区的地位...',
                        'quote' => null,
                    ],
                    'ja' => [
                        'title' => 'JIIPE、主要アクセス道路ROW 80の開発を通じて工業と港湾の接続性を強化',
                        'content' => 'ジャワ統合工業港湾エステート（JIIPE）は、幅80メートルの主要アクセス道路の建設を通じて、統合工業港湾エステートとしての地位を強化しています...',
                        'quote' => null,
                    ],
                    'ko' => [
                        'title' => 'JIIPE, ROW 80 주요 진입로 개발을 통해 산업 및 항만 연결성 강화',
                        'content' => 'Java Integrated Industrial and Ports Estate (JIIPE)는 80미터 너비의 주요 진입로 건설을 통해 통합 산업 및 항만 단지로서의 입지를 강화하고 있습니다...',
                        'quote' => null,
                    ],
                    'tw' => [
                        'title' => 'JIIPE通過開發ROW 80主要通道道路加強工業和港口連通性',
                        'content' => '爪哇綜合工業港口區（JIIPE）通過建設80米寬的主要通道道路，加強其作為綜合工業和港口區的地位...',
                        'quote' => null,
                    ],
                ]
            ],
            [
                'thumbnail' => 'thumb_fa08b-close-up-mineral-background_adaptiveResize_634_385.jpg',
                'is_published' => true,
                'category_id' => 4,
                'translations' => [
                    'id' => [
                        'title' => '2025: Tahun Defisit Tembaga - Mengapa Dunia Beralih ke Indonesia',
                        'content' => 'Tembaga, "logam elektrifikasi," berada di pusat transisi global menuju masa depan yang lebih hijau dan lebih terhubung...',
                        'quote' => null,
                    ],
                    'en' => [
                        'title' => '2025: The Year of the Copper Deficit - Why the World is Turning to Indonesia',
                        'content' => 'Copper, the "metal of electrification," stands at the epicenter of the global transition towards a greener, more connecte...',
                        'quote' => null,
                    ],
                    'zh' => [
                        'title' => '2025年：铜短缺之年 - 为什么世界转向印度尼西亚',
                        'content' => '铜，"电气化金属"，处于全球向更绿色、更互联的未来转型的中心...',
                        'quote' => null,
                    ],
                    'ja' => [
                        'title' => '2025年：銅不足の年 - なぜ世界はインドネシアに注目するのか',
                        'content' => '銅、「電化の金属」は、よりグリーンで、より接続された未来へのグローバルな移行の震源地に立っています...',
                        'quote' => null,
                    ],
                    'ko' => [
                        'title' => '2025년: 구리 부족의 해 - 세계가 인도네시아로 눈을 돌리는 이유',
                        'content' => '"전기화의 금속"인 구리는 더 친환경적이고 더 연결된 미래를 향한 글로벌 전환의 진원지에 서 있습니다...',
                        'quote' => null,
                    ],
                    'tw' => [
                        'title' => '2025年：銅短缺之年 - 為什麼世界轉向印度尼西亞',
                        'content' => '銅，"電氣化金屬"，處於全球向更綠色、更互聯的未來轉型的中心...',
                        'quote' => null,
                    ],
                ]
            ],
            [
                'thumbnail' => 'thumb_55ec4-copper_adaptiveResize_634_385.png',
                'is_published' => true,
                'category_id' => 4,
                'translations' => [
                    'id' => [
                        'title' => 'Peran Strategis Indonesia dalam Masa Depan Pasokan Tembaga Global',
                        'content' => 'Di balik setiap kabel listrik, baterai kendaraan listrik (EV), dan turbin angin terdapat satu elemen kritis: tembaga...',
                        'quote' => null,
                    ],
                    'en' => [
                        'title' => 'Indonesia\'s Strategic Role in the Future of Global Copper Supply',
                        'content' => 'Behind every power cable, electric vehicle (EV) battery, and wind turbine lies one critical element: copper. This vers...',
                        'quote' => null,
                    ],
                    'zh' => [
                        'title' => '印度尼西亚在全球铜供应未来中的战略作用',
                        'content' => '在每一根电缆、电动汽车（EV）电池和风力涡轮机背后都有一个关键元素：铜...',
                        'quote' => null,
                    ],
                    'ja' => [
                        'title' => 'グローバル銅供給の未来におけるインドネシアの戦略的役割',
                        'content' => 'すべての電力ケーブル、電気自動車（EV）バッテリー、風力タービンの背後には、1つの重要な要素があります：銅...',
                        'quote' => null,
                    ],
                    'ko' => [
                        'title' => '글로벌 구리 공급의 미래에서 인도네시아의 전략적 역할',
                        'content' => '모든 전력 케이블, 전기 자동차(EV) 배터리 및 풍력 터빈 뒤에는 하나의 중요한 요소가 있습니다: 구리...',
                        'quote' => null,
                    ],
                    'tw' => [
                        'title' => '印度尼西亞在全球銅供應未來中的戰略作用',
                        'content' => '在每一根電纜、電動汽車（EV）電池和風力渦輪機背後都有一個關鍵元素：銅...',
                        'quote' => null,
                    ],
                ]
            ],
            [
                'thumbnail' => 'thumb_66f2f-chrm_adaptiveResize_634_385.png',
                'is_published' => true,
                'category_id' => 4,
                'translations' => [
                    'id' => [
                        'title' => 'Industri Kimia Indonesia Meningkat: Peluang Pasar US$1,5 Miliar+ di 2025',
                        'content' => 'Sebagai pilar dasar manufaktur modern, industri kimia berfungsi sebagai barometer langsung dari ekonomi suatu negara...',
                        'quote' => null,
                    ],
                    'en' => [
                        'title' => 'Indonesia\'s Chemical Industry on the Rise: A US$1.5B+ Market Opportunity in 2025',
                        'content' => 'As a foundational pillar of modern manufacturing, the chemical industry serves as a direct barometer of a nation\'s e...',
                        'quote' => null,
                    ],
                    'zh' => [
                        'title' => '印度尼西亚化学工业崛起：2025年15亿美元以上的市场机会',
                        'content' => '作为现代制造业的基础支柱，化学工业是一个国家经济的直接晴雨表...',
                        'quote' => null,
                    ],
                    'ja' => [
                        'title' => 'インドネシアの化学産業が上昇：2025年に15億ドル以上の市場機会',
                        'content' => '現代製造業の基礎的な柱として、化学産業は国の経済の直接的なバロメーターとして機能します...',
                        'quote' => null,
                    ],
                    'ko' => [
                        'title' => '인도네시아 화학 산업 부상: 2025년 15억 달러 이상의 시장 기회',
                        'content' => '현대 제조업의 기초 기둥으로서 화학 산업은 국가 경제의 직접적인 바로미터 역할을 합니다...',
                        'quote' => null,
                    ],
                    'tw' => [
                        'title' => '印度尼西亞化學工業崛起：2025年15億美元以上的市場機會',
                        'content' => '作為現代製造業的基礎支柱，化學工業是一個國家經濟的直接晴雨表...',
                        'quote' => null,
                    ],
                ]
            ],
            [
                'thumbnail' => 'thumb_f1c8b-cover-ch_adaptiveResize_634_385.jpg',
                'is_published' => true,
                'category_id' => 4,
                'translations' => [
                    'id' => [
                        'title' => 'Bangkitnya Indonesia sebagai Pusat Kimia Hijau Baru Global Selatan',
                        'content' => 'Industri kimia terkait erat dengan kehidupan modern. Dari plastik yang membungkus makanan kita, pupuk yang menumbuhkan...',
                        'quote' => null,
                    ],
                    'en' => [
                        'title' => 'Indonesia\'s Rise as the New Green Chemistry Hub of the Global South',
                        'content' => 'The chemical industry is deeply woven into modern life. From the plastics that wrap our food, the fertilizers that gro...',
                        'quote' => null,
                    ],
                    'zh' => [
                        'title' => '印度尼西亚崛起成为全球南方的新绿色化学中心',
                        'content' => '化学工业深深融入现代生活。从包裹我们食物的塑料，到种植的肥料...',
                        'quote' => null,
                    ],
                    'ja' => [
                        'title' => 'インドネシア、グローバルサウスの新しいグリーンケミストリーハブとして台頭',
                        'content' => '化学産業は現代生活に深く織り込まれています。私たちの食品を包むプラスチック、成長させる肥料から...',
                        'quote' => null,
                    ],
                    'ko' => [
                        'title' => '인도네시아, 글로벌 사우스의 새로운 그린 화학 허브로 부상',
                        'content' => '화학 산업은 현대 생활에 깊이 뿌리박혀 있습니다. 우리의 음식을 포장하는 플라스틱, 재배하는 비료에서...',
                        'quote' => null,
                    ],
                    'tw' => [
                        'title' => '印度尼西亞崛起成為全球南方的新綠色化學中心',
                        'content' => '化學工業深深融入現代生活。從包裹我們食物的塑料，到種植的肥料...',
                        'quote' => null,
                    ],
                ]
            ],
            [
                'thumbnail' => 'thumb_14133-cover-cp_adaptiveResize_634_385.png',
                'is_published' => true,
                'category_id' => 4,
                'translations' => [
                    'id' => [
                        'title' => 'Peran Indonesia dalam Mendorong Transisi Energi Terbarukan Global',
                        'content' => 'Seiring meningkatnya dorongan global untuk energi terbarukan, Indonesia muncul sebagai pemain penting dalam transisi menuju masa depan yang berkelanjutan...',
                        'quote' => null,
                    ],
                    'en' => [
                        'title' => 'Indonesia\'s Role in Powering the Global Renewable Energy Transition',
                        'content' => 'As the global push for renewable energy intensifies, Indonesia is emerging as a pivotal player in the transition to a s...',
                        'quote' => null,
                    ],
                    'zh' => [
                        'title' => '印度尼西亚在推动全球可再生能源转型中的作用',
                        'content' => '随着全球对可再生能源的推动加强，印度尼西亚正成为向可持续未来过渡的关键参与者...',
                        'quote' => null,
                    ],
                    'ja' => [
                        'title' => 'インドネシアのグローバル再生可能エネルギー転換を推進する役割',
                        'content' => 'グローバルな再生可能エネルギーへの推進が強まる中、インドネシアは持続可能な未来への移行において重要なプレーヤーとして浮上しています...',
                        'quote' => null,
                    ],
                    'ko' => [
                        'title' => '글로벌 재생 에너지 전환을 주도하는 인도네시아의 역할',
                        'content' => '재생 에너지에 대한 글로벌 추진이 강화됨에 따라 인도네시아는 지속 가능한 미래로의 전환에서 중요한 역할을 하는 국가로 부상하고 있습니다...',
                        'quote' => null,
                    ],
                    'tw' => [
                        'title' => '印度尼西亞在推動全球可再生能源轉型中的作用',
                        'content' => '隨著全球對可再生能源的推動加強，印度尼西亞正成為向可持續未來過渡的關鍵參與者...',
                        'quote' => null,
                    ],
                ]
            ],
            [
                'thumbnail' => 'thumb_2b84d-cover-rn_adaptiveResize_634_385.png',
                'is_published' => true,
                'category_id' => 4,
                'translations' => [
                    'id' => [
                        'title' => 'Samudra Tidak Pernah Tidur — Dan Mungkin Menggerakkan Masa Depan Kita',
                        'content' => 'Dalam pencarian energi bersih, kita telah beralih ke langit dan matahari — tetapi salah satu yang paling kuat, konsisten...',
                        'quote' => null,
                    ],
                    'en' => [
                        'title' => 'The Ocean Doesn\'t Sleep — And It Might Power Our Future',
                        'content' => 'In the quest for clean energy, we\'ve turned to the skies and the sun — but one of the most powerful, consistent ...',
                        'quote' => null,
                    ],
                    'zh' => [
                        'title' => '海洋永不眠 — 它可能为我们的未来提供动力',
                        'content' => '在寻求清洁能源的过程中，我们已经转向天空和太阳 — 但最强大、最一致的...',
                        'quote' => null,
                    ],
                    'ja' => [
                        'title' => '海は眠らない — そしてそれは私たちの未来を動かすかもしれない',
                        'content' => 'クリーンエネルギーの探求において、私たちは空と太陽に目を向けてきました — しかし最も強力で一貫した...',
                        'quote' => null,
                    ],
                    'ko' => [
                        'title' => '바다는 잠들지 않는다 — 그리고 우리의 미래를 움직일 수 있다',
                        'content' => '청정 에너지를 찾는 과정에서 우리는 하늘과 태양으로 눈을 돌렸습니다 — 하지만 가장 강력하고 일관된...',
                        'quote' => null,
                    ],
                    'tw' => [
                        'title' => '海洋永不眠 — 它可能為我們的未來提供動力',
                        'content' => '在尋求清潔能源的過程中，我們已經轉向天空和太陽 — 但最強大、最一致的...',
                        'quote' => null,
                    ],
                ]
            ],
        ];

        foreach ($newsData as $data) {
            $translations = $data['translations'];
            unset($data['translations']);

            $news = News::create($data);

            foreach ($translations as $locale => $translation) {
                NewsTranslation::create([
                    'news_id' => $news->id,
                    'locale' => $locale,
                    'title' => $translation['title'],
                    'content' => $translation['content'],
                    'quote' => $translation['quote'],
                ]);
            }
        }
    }
}