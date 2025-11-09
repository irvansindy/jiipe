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
        // $news =News::create([
        //     'thumbnail' => 'path/to/thumbnail.jpg',
        //     'is_published' => true,
        // ]);

        // // Data dummy untuk tiap bahasa
        // $translations = [
        //     'id' => [
        //         'title'   => 'Judul Berita dalam Bahasa Indonesia',
        //         'content' => 'Konten berita dalam Bahasa Indonesia.',
        //     ],
        //     'en' => [
        //         'title'   => 'News Title in English',
        //         'content' => 'News content in English.',
        //     ],
        //     'zh' => [
        //         'title'   => '新闻标题（中文）',
        //         'content' => '新闻内容（中文）。',
        //     ],
        //     'ja' => [
        //         'title'   => 'ニュースのタイトル（日本語）',
        //         'content' => 'ニュースの内容（日本語）。',
        //     ],
        //     'ko' => [
        //         'title'   => '뉴스 제목 (한국어)',
        //         'content' => '뉴스 내용 (한국어).',
        //     ],
        //     'tw' => [
        //         'title'   => '新聞標題（繁體中文）',
        //         'content' => '新聞內容（繁體中文）。',
        //     ],
        // ];
        // foreach ($translations as $locale => $data) {
        //     NewsTranslation::create([
        //         'news_id' => $news->id,
        //         'locale'  => $locale,
        //         'title'   => $data['title'],
        //         'content' => $data['content'],
        //         'quote'   => null, // Atau isi dengan data yang sesuai
        //     ]);
        // }
        // Get category IDs
        $newsCategory = NewsCategories::whereHas('translations', function($q) {
            $q->where('locale', 'en')->where('name', 'News');
        })->first();

        $articleCategory = NewsCategories::whereHas('translations', function($q) {
            $q->where('locale', 'en')->where('name', 'Articles');
        })->first();

        $newsData = [
            [
                'category_id' => $newsCategory->id,
                'thumbnail' => 'images/blog/.tmb/thumb_4107d-beacukai_adaptiveResize_634_385.JPG',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 10, 17),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'Gresik SEZ Launches Auto Gate Customs System Pilot to Accelerate Logistics Flow',
                        'content' => '<p>Gresik, October 17, 2025 – The Gresik Special Economic Zone (SEZ) has begun implementing a digital-based logistics system through the pilot launch of the Customs Auto Gate System with the Directorate General of Customs and Excise (DGCE).</p><p>This innovative system is designed to streamline the flow of goods in and out of the SEZ by reducing manual inspection time and increasing operational efficiency.</p><p>The Auto Gate System uses advanced technology including RFID sensors, automated gates, and integrated customs clearance systems to enable seamless truck movement through customs checkpoints.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'KEK Gresik Meluncurkan Pilot Sistem Auto Gate Bea Cukai untuk Mempercepat Arus Logistik',
                        'content' => '<p>Gresik, 17 Oktober 2025 – Kawasan Ekonomi Khusus (KEK) Gresik telah memulai penerapan sistem logistik berbasis digital melalui peluncuran pilot Sistem Auto Gate Bea Cukai bersama Direktorat Jenderal Bea dan Cukai (DJBC).</p><p>Sistem inovatif ini dirancang untuk mempercepat arus keluar masuk barang di KEK dengan mengurangi waktu pemeriksaan manual dan meningkatkan efisiensi operasional.</p><p>Sistem Auto Gate menggunakan teknologi canggih termasuk sensor RFID, gerbang otomatis, dan sistem clearance bea cukai terintegrasi untuk memungkinkan pergerakan truk yang mulus melalui pos pemeriksaan bea cukai.</p>',
                        'quote' => null
                    ]
                ]
            ],
            // News 2
            [
                'category_id' => $newsCategory->id,
                'thumbnail' => 'images/blog/.tmb/thumb_f6dfc-thor6475-1_adaptiveResize_634_385.jpg',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 9, 25),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'East Java Police Chief Visits JIIPE Special Economic Zone to Review New Police Headquarters',
                        'content' => '<p>Gresik, September 25, 2025 – East Java Regional Police Chief (Kapolda Jatim), Inspector General Drs. Nanang Avianto, conducted an official visit to the Java Integrated Industrial and Ports Estate (JIIPE) Special Economic Zone.</p><p>The visit aimed to review the construction progress of the new police headquarters within the industrial area.</p><p>The new headquarters will enhance security capabilities and provide better law enforcement services to the rapidly growing industrial zone.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Kapolda Jawa Timur Mengunjungi KEK JIIPE untuk Meninjau Markas Polisi Baru',
                        'content' => '<p>Gresik, 25 September 2025 – Kepala Kepolisian Daerah Jawa Timur (Kapolda Jatim), Inspektur Jenderal Drs. Nanang Avianto, melakukan kunjungan resmi ke Kawasan Ekonomi Khusus Java Integrated Industrial and Ports Estate (JIIPE).</p><p>Kunjungan ini bertujuan untuk meninjau kemajuan pembangunan markas polisi baru di dalam kawasan industri.</p><p>Markas baru akan meningkatkan kemampuan keamanan dan memberikan layanan penegakan hukum yang lebih baik untuk kawasan industri yang berkembang pesat.</p>',
                        'quote' => null
                    ]
                ]
            ],
            // News 3
            [
                'category_id' => $newsCategory->id,
                'thumbnail' => 'images/blog/.tmb/thumb_7a1a6-dsc02292_adaptiveResize_634_385.JPG',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 9, 20),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'PLN Commissions 40 MVA High-Voltage Power Supply for BKMS in Gresik SEZ',
                        'content' => '<p>Gresik, September 20, 2025 – PT PLN (Persero) officially inaugurated the high-voltage (HV) power supply for PT Berkah Kawasan Manyar Sejahtera (BKMS) in the Gresik Special Economic Zone.</p><p>The 40 MVA power capacity will support the growing industrial activities and meet the increasing electricity demand from companies operating within JIIPE.</p><p>This infrastructure development demonstrates PLN\'s commitment to supporting Indonesia\'s industrial growth and energy security.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'PLN Resmikan Pasokan Listrik Tegangan Tinggi 40 MVA untuk BKMS di KEK Gresik',
                        'content' => '<p>Gresik, 20 September 2025 – PT PLN (Persero) secara resmi meresmikan pasokan listrik tegangan tinggi (TT) untuk PT Berkah Kawasan Manyar Sejahtera (BKMS) di Kawasan Ekonomi Khusus Gresik.</p><p>Kapasitas daya 40 MVA akan mendukung kegiatan industri yang berkembang dan memenuhi permintaan listrik yang meningkat dari perusahaan yang beroperasi di JIIPE.</p><p>Pengembangan infrastruktur ini menunjukkan komitmen PLN untuk mendukung pertumbuhan industri dan ketahanan energi Indonesia.</p>',
                        'quote' => null
                    ]
                ]
            ],
            // News 4
            [
                'category_id' => $newsCategory->id,
                'thumbnail' => 'images/blog/.tmb/thumb_6cd00-whatsapp-image-2025-10-02-at-12-33-18_adaptiveResize_634_385.jpg',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 10, 2),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'East Java Records Rp 74.69 Trillion Investment in H1 2025, JIIPE SEZ Wins Investment Award 2025 for Domestic Investment Category',
                        'content' => '<p>Surabaya, October 2, 2025 – East Java continues to strengthen its position as a key driver of Indonesia\'s national economic growth, recording Rp 74.69 trillion in investment during the first half of 2025.</p><p>In recognition of outstanding performance, the JIIPE Special Economic Zone received the Investment Award 2025 in the Domestic Investment Category.</p><p>This achievement highlights JIIPE\'s success in attracting domestic investors and contributing significantly to regional economic development.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Jawa Timur Catat Investasi Rp 74,69 Triliun di Semester I 2025, KEK JIIPE Raih Investment Award 2025 Kategori Investasi Dalam Negeri',
                        'content' => '<p>Surabaya, 2 Oktober 2025 – Jawa Timur terus memperkuat posisinya sebagai penggerak utama pertumbuhan ekonomi nasional Indonesia, mencatat investasi sebesar Rp 74,69 triliun selama semester pertama 2025.</p><p>Sebagai pengakuan atas kinerja yang luar biasa, Kawasan Ekonomi Khusus JIIPE menerima Investment Award 2025 dalam Kategori Investasi Dalam Negeri.</p><p>Pencapaian ini menyoroti keberhasilan JIIPE dalam menarik investor domestik dan berkontribusi signifikan terhadap pembangunan ekonomi daerah.</p>',
                        'quote' => null
                    ]
                ]
            ],
            // News 5
            [
                'category_id' => $newsCategory->id,
                'thumbnail' => 'images/blog/.tmb/thumb_05498-penandatanganan-jiipe_adaptiveResize_634_385.jpg',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 4, 25),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'Golden Elephant Sincerity (GESC) Officially Joins JIIPE, Marks Global Expansion in Indonesia',
                        'content' => '<p>Gresik, April 25, 2025 — Java Integrated Industrial and Ports Estate (JIIPE), a leading integrated industrial estate, marks another milestone with the entry of Golden Elephant Sincerity (GESC), a global leader in advanced materials and chemical solutions.</p><p>The signing ceremony represents GESC\'s strategic expansion into the Indonesian market and demonstrates growing international confidence in JIIPE\'s world-class facilities.</p><p>GESC will establish a state-of-the-art manufacturing facility within JIIPE, leveraging the zone\'s strategic location and comprehensive infrastructure.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Golden Elephant Sincerity (GESC) Resmi Bergabung dengan JIIPE, Menandai Ekspansi Global di Indonesia',
                        'content' => '<p>Gresik, 25 April 2025 — Java Integrated Industrial and Ports Estate (JIIPE), kawasan industri terintegrasi terkemuka, mencatat pencapaian lain dengan masuknya Golden Elephant Sincerity (GESC), pemimpin global dalam solusi material dan kimia canggih.</p><p>Upacara penandatanganan mewakili ekspansi strategis GESC ke pasar Indonesia dan menunjukkan meningkatnya kepercayaan internasional terhadap fasilitas kelas dunia JIIPE.</p><p>GESC akan mendirikan fasilitas manufaktur canggih di dalam JIIPE, memanfaatkan lokasi strategis dan infrastruktur komprehensif zona tersebut.</p>',
                        'quote' => null
                    ]
                ]
            ],
            // News 6
            [
                'category_id' => $newsCategory->id,
                'thumbnail' => 'images/blog/.tmb/thumb_1d3c1-presidenri-go-id-18032025093249-67d8db51d1a0d1-51054546_adaptiveResize_634_385.jpg',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 3, 17),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'JIIPE: Indonesia\'s Precious Metal Downstreaming Hub',
                        'content' => '<p>Gresik SEZ, March 17, 2025 – Indonesian President Prabowo Subianto inaugurated PT Freeport Indonesia\'s (PTFI) Precious Metals Refinery (PMR) at the JIIPE Special Economic Zone.</p><p>This world-class facility marks a significant milestone in Indonesia\'s downstreaming strategy, enabling the country to process precious metals domestically and add greater value to its natural resources.</p><p>The PMR facility will process gold, silver, and other precious metals extracted from PTFI mining operations, creating thousands of jobs and contributing significantly to the national economy.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'JIIPE: Pusat Hilirisasi Logam Mulia Indonesia',
                        'content' => '<p>KEK Gresik, 17 Maret 2025 – Presiden Indonesia Prabowo Subianto meresmikan Kilang Logam Mulia (Precious Metals Refinery/PMR) PT Freeport Indonesia (PTFI) di Kawasan Ekonomi Khusus JIIPE.</p><p>Fasilitas kelas dunia ini menandai tonggak penting dalam strategi hilirisasi Indonesia, memungkinkan negara untuk memproses logam mulia secara domestik dan menambah nilai lebih besar pada sumber daya alamnya.</p><p>Fasilitas PMR akan memproses emas, perak, dan logam mulia lainnya yang diekstraksi dari operasi pertambangan PTFI, menciptakan ribuan lapangan kerja dan berkontribusi signifikan terhadap ekonomi nasional.</p>',
                        'quote' => null
                    ]
                ]
            ],
            // News 7
            [
                'category_id' => $newsCategory->id,
                'thumbnail' => 'images/blog/.tmb/thumb_22ba9-001-23_adaptiveResize_634_385.jpg',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 1, 15),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'ANTAM OFFICIALLY JOINS JIIPE, READY TO BECOME A STRATEGIC LOCATION FOR THE METAL & MINERAL INDUSTRY',
                        'content' => '<p>ANTAM\'s entry into JIIPE marks a strategic step in advancing the downstream processing of metals and strengthening Indonesia\'s position in the global supply chain.</p><p>As one of Indonesia\'s largest mining companies, PT Aneka Tambang (ANTAM) will establish processing facilities within JIIPE to add value to the nation\'s mineral resources.</p><p>This investment aligns with the government\'s vision of transforming Indonesia from a raw material exporter to a processed product producer, creating higher economic value and more employment opportunities.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'ANTAM RESMI BERGABUNG DENGAN JIIPE, SIAP MENJADI LOKASI STRATEGIS UNTUK INDUSTRI LOGAM & MINERAL',
                        'content' => '<p>Masuknya ANTAM ke JIIPE menandai langkah strategis dalam memajukan pemrosesan hilir logam dan memperkuat posisi Indonesia dalam rantai pasokan global.</p><p>Sebagai salah satu perusahaan pertambangan terbesar Indonesia, PT Aneka Tambang (ANTAM) akan mendirikan fasilitas pemrosesan di dalam JIIPE untuk menambah nilai sumber daya mineral bangsa.</p><p>Investasi ini sejalan dengan visi pemerintah untuk mengubah Indonesia dari pengekspor bahan mentah menjadi produsen produk olahan, menciptakan nilai ekonomi yang lebih tinggi dan lebih banyak peluang kerja.</p>',
                        'quote' => null
                    ]
                ]
            ],
            // Article 1
            [
                'category_id' => $articleCategory->id,
                'thumbnail' => 'images/blog/article1.jpg',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 10, 10),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'Understanding the Benefits of Special Economic Zones for Industrial Development',
                        'content' => '<p>Special Economic Zones (SEZ) have become a crucial instrument in attracting foreign investment and boosting economic growth in Indonesia.</p><p>SEZs offer various incentives including tax holidays, customs facilities, and streamlined business processes that make them attractive to investors looking to establish operations in Southeast Asia.</p><p>JIIPE in Gresik is one example of a successful SEZ that has attracted major investments in various industrial sectors including metals processing, chemicals, and logistics.</p><p>The integrated nature of JIIPE, combining industrial estate with port facilities, provides unique competitive advantages that are difficult to find elsewhere in the region.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Memahami Manfaat Kawasan Ekonomi Khusus untuk Pengembangan Industri',
                        'content' => '<p>Kawasan Ekonomi Khusus (KEK) telah menjadi instrumen penting dalam menarik investasi asing dan mendorong pertumbuhan ekonomi di Indonesia.</p><p>KEK menawarkan berbagai insentif termasuk tax holiday, fasilitas kepabeanan, dan proses bisnis yang disederhanakan yang membuatnya menarik bagi investor yang ingin mendirikan operasi di Asia Tenggara.</p><p>JIIPE di Gresik adalah salah satu contoh KEK sukses yang telah menarik investasi besar di berbagai sektor industri termasuk pemrosesan logam, kimia, dan logistik.</p><p>Sifat terintegrasi JIIPE, menggabungkan kawasan industri dengan fasilitas pelabuhan, memberikan keunggulan kompetitif unik yang sulit ditemukan di tempat lain di kawasan.</p>',
                        'quote' => null
                    ]
                ]
            ],
            // Article 2
            [
                'category_id' => $articleCategory->id,
                'thumbnail' => 'images/blog/article2.jpg',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 9, 28),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'The Role of Port Infrastructure in Industrial Estate Competitiveness',
                        'content' => '<p>Modern industrial estates require integrated infrastructure, and port facilities play a critical role in ensuring supply chain efficiency.</p><p>JIIPE\'s strategic location with direct port access provides significant competitive advantages for companies operating within the zone, particularly those engaged in import-export activities.</p><p>This article explores how port integration reduces logistics costs and improves time-to-market for industrial products.</p><p>With dedicated berths capable of handling various vessel types and cargo categories, JIIPE\'s port infrastructure eliminates the need for companies to transport goods over long distances to reach seaports.</p><p>The seamless connection between manufacturing facilities and port operations creates a highly efficient value chain that benefits all stakeholders.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Peran Infrastruktur Pelabuhan dalam Daya Saing Kawasan Industri',
                        'content' => '<p>Kawasan industri modern membutuhkan infrastruktur terintegrasi, dan fasilitas pelabuhan memainkan peran kritis dalam memastikan efisiensi rantai pasokan.</p><p>Lokasi strategis JIIPE dengan akses pelabuhan langsung memberikan keunggulan kompetitif yang signifikan bagi perusahaan yang beroperasi di dalam zona, terutama yang terlibat dalam kegiatan impor-ekspor.</p><p>Artikel ini mengeksplorasi bagaimana integrasi pelabuhan mengurangi biaya logistik dan meningkatkan time-to-market untuk produk industri.</p><p>Dengan dermaga khusus yang mampu menangani berbagai jenis kapal dan kategori kargo, infrastruktur pelabuhan JIIPE menghilangkan kebutuhan perusahaan untuk mengangkut barang jarak jauh untuk mencapai pelabuhan laut.</p><p>Koneksi mulus antara fasilitas manufaktur dan operasi pelabuhan menciptakan rantai nilai yang sangat efisien yang menguntungkan semua pemangku kepentingan.</p>',
                        'quote' => null
                    ]
                ]
            ],
            // Article 3
            [
                'category_id' => $articleCategory->id,
                'thumbnail' => 'images/blog/article3.jpg',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 9, 15),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'Sustainability and Green Industry Practices in Modern Industrial Estates',
                        'content' => '<p>As global awareness of environmental issues grows, industrial estates are increasingly adopting sustainable practices and green technologies.</p><p>JIIPE has implemented various environmental management systems including wastewater treatment facilities, green spaces, and energy-efficient infrastructure.</p><p>This commitment to sustainability not only benefits the environment but also attracts environmentally-conscious investors and helps companies meet international ESG (Environmental, Social, and Governance) standards.</p><p>The article examines best practices in sustainable industrial development and how JIIPE serves as a model for future industrial estates in Indonesia.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Keberlanjutan dan Praktik Industri Hijau di Kawasan Industri Modern',
                        'content' => '<p>Seiring meningkatnya kesadaran global tentang isu lingkungan, kawasan industri semakin mengadopsi praktik berkelanjutan dan teknologi hijau.</p><p>JIIPE telah menerapkan berbagai sistem manajemen lingkungan termasuk fasilitas pengolahan air limbah, ruang hijau, dan infrastruktur hemat energi.</p><p>Komitmen terhadap keberlanjutan ini tidak hanya bermanfaat bagi lingkungan tetapi juga menarik investor yang sadar lingkungan dan membantu perusahaan memenuhi standar ESG (Environmental, Social, and Governance) internasional.</p><p>Artikel ini mengkaji praktik terbaik dalam pengembangan industri berkelanjutan dan bagaimana JIIPE menjadi model untuk kawasan industri masa depan di Indonesia.</p>',
                        'quote' => null
                    ]
                ]
            ],
            // Article 4
            [
                'category_id' => $articleCategory->id,
                'thumbnail' => 'images/blog/article4.jpg',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 8, 20),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'Digital Transformation in Industrial Operations: The Smart Factory Revolution',
                        'content' => '<p>Industry 4.0 technologies are reshaping manufacturing operations worldwide, and Indonesian industrial estates are embracing this digital revolution.</p><p>Smart factories leverage IoT sensors, artificial intelligence, and data analytics to optimize production processes, reduce waste, and improve product quality.</p><p>JIIPE supports companies in their digital transformation journey by providing advanced telecommunications infrastructure and collaborating with technology partners.</p><p>This article explores how digitalization is creating new competitive advantages for manufacturers and positioning Indonesia as a hub for advanced manufacturing in Southeast Asia.</p><p>From predictive maintenance to automated quality control, the possibilities of smart manufacturing are transforming traditional industrial operations.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Transformasi Digital dalam Operasi Industri: Revolusi Pabrik Pintar',
                        'content' => '<p>Teknologi Industri 4.0 membentuk kembali operasi manufaktur di seluruh dunia, dan kawasan industri Indonesia merangkul revolusi digital ini.</p><p>Pabrik pintar memanfaatkan sensor IoT, kecerdasan buatan, dan analitik data untuk mengoptimalkan proses produksi, mengurangi limbah, dan meningkatkan kualitas produk.</p><p>JIIPE mendukung perusahaan dalam perjalanan transformasi digital mereka dengan menyediakan infrastruktur telekomunikasi canggih dan berkolaborasi dengan mitra teknologi.</p><p>Artikel ini mengeksplorasi bagaimana digitalisasi menciptakan keunggulan kompetitif baru bagi produsen dan memposisikan Indonesia sebagai pusat manufaktur canggih di Asia Tenggara.</p><p>Dari pemeliharaan prediktif hingga kontrol kualitas otomatis, kemungkinan manufaktur pintar mengubah operasi industri tradisional.</p>',
                        'quote' => null
                    ]
                ]
            ],
            // Article 5
            [
                'category_id' => $articleCategory->id,
                'thumbnail' => 'images/blog/article5.jpg',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 7, 30),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'Supply Chain Resilience: Lessons from Global Disruptions',
                        'content' => '<p>Recent global events have highlighted the importance of supply chain resilience and the need for diversified manufacturing bases.</p><p>Indonesia\'s strategic location in Southeast Asia makes it an ideal hub for companies seeking to strengthen their supply chain resilience.</p><p>JIIPE offers manufacturers a secure and efficient base for operations with access to both domestic and international markets.</p><p>This article analyzes supply chain trends and explains why integrated industrial estates like JIIPE are becoming increasingly important in global manufacturing strategies.</p><p>With reliable infrastructure, skilled workforce, and government support, JIIPE provides the stability that companies need to navigate uncertain global conditions.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Ketahanan Rantai Pasokan: Pelajaran dari Gangguan Global',
                        'content' => '<p>Peristiwa global baru-baru ini telah menyoroti pentingnya ketahanan rantai pasokan dan kebutuhan untuk basis manufaktur yang terdiversifikasi.</p><p>Lokasi strategis Indonesia di Asia Tenggara menjadikannya pusat ideal bagi perusahaan yang ingin memperkuat ketahanan rantai pasokan mereka.</p><p>JIIPE menawarkan produsen basis operasi yang aman dan efisien dengan akses ke pasar domestik dan internasional.</p><p>Artikel ini menganalisis tren rantai pasokan dan menjelaskan mengapa kawasan industri terintegrasi seperti JIIPE menjadi semakin penting dalam strategi manufaktur global.</p><p>Dengan infrastruktur yang andal, tenaga kerja terampil, dan dukungan pemerintah, JIIPE memberikan stabilitas yang dibutuhkan perusahaan untuk menavigasi kondisi global yang tidak pasti.</p>',
                        'quote' => null
                    ]
                ]
            ],
            // Article 6
            [
                'category_id' => $articleCategory->id,
                'thumbnail' => 'images/blog/article6.jpg',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 7, 5),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'Indonesia\'s Downstreaming Strategy: Adding Value to Natural Resources',
                        'content' => '<p>Indonesia is rich in natural resources including minerals, metals, and agricultural products. The government\'s downstreaming policy aims to process these resources domestically rather than exporting raw materials.</p><p>This strategy creates more value, generates employment, and strengthens the industrial base.</p><p>JIIPE plays a crucial role in this transformation by hosting world-class processing facilities for copper, precious metals, and other commodities.</p><p>The article examines the economic benefits of downstreaming and how industrial estates contribute to Indonesia\'s ambition of becoming a developed nation.</p><p>From smelters to refineries, JIIPE is at the forefront of Indonesia\'s industrial transformation.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Strategi Hilirisasi Indonesia: Menambah Nilai pada Sumber Daya Alam',
                        'content' => '<p>Indonesia kaya akan sumber daya alam termasuk mineral, logam, dan produk pertanian. Kebijakan hilirisasi pemerintah bertujuan untuk memproses sumber daya ini secara domestik daripada mengekspor bahan mentah.</p><p>Strategi ini menciptakan lebih banyak nilai, menghasilkan lapangan kerja, dan memperkuat basis industri.</p><p>JIIPE memainkan peran penting dalam transformasi ini dengan menjadi tuan rumah fasilitas pemrosesan kelas dunia untuk tembaga, logam mulia, dan komoditas lainnya.</p><p>Artikel ini mengkaji manfaat ekonomi hilirisasi dan bagaimana kawasan industri berkontribusi pada ambisi Indonesia menjadi negara maju.</p><p>Dari smelter hingga kilang, JIIPE berada di garis depan transformasi industri Indonesia.</p>',
                        'quote' => null
                    ]
                ]
            ],
            // Article 7
            [
                'category_id' => $articleCategory->id,
                'thumbnail' => 'images/blog/article7.jpg',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 6, 15),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'Workforce Development and Industrial Skills Training',
                        'content' => '<p>A skilled workforce is essential for industrial competitiveness. Indonesia has a large young population that represents both an opportunity and a challenge.</p><p>Industrial estates like JIIPE collaborate with educational institutions and training centers to develop skilled workers who meet industry requirements.</p><p>Training programs cover various fields including welding, machine operation, quality control, and safety management.</p><p>This article discusses the importance of workforce development and how JIIPE contributes to building Indonesia\'s human capital for industrial growth.</p><p>By investing in people, JIIPE ensures that companies have access to the skilled labor they need to succeed.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Pengembangan Tenaga Kerja dan Pelatihan Keterampilan Industri',
                        'content' => '<p>Tenaga kerja terampil sangat penting untuk daya saing industri. Indonesia memiliki populasi muda yang besar yang mewakili peluang dan tantangan.</p><p>Kawasan industri seperti JIIPE berkolaborasi dengan lembaga pendidikan dan pusat pelatihan untuk mengembangkan pekerja terampil yang memenuhi persyaratan industri.</p><p>Program pelatihan mencakup berbagai bidang termasuk pengelasan, operasi mesin, kontrol kualitas, dan manajemen keselamatan.</p><p>Artikel ini membahas pentingnya pengembangan tenaga kerja dan bagaimana JIIPE berkontribusi membangun modal manusia Indonesia untuk pertumbuhan industri.</p><p>Dengan berinvestasi pada orang, JIIPE memastikan bahwa perusahaan memiliki akses ke tenaga kerja terampil yang mereka butuhkan untuk sukses.</p>',
                        'quote' => null
                    ]
                ]
            ],
            // Article 8
            [
                'category_id' => $articleCategory->id,
                'thumbnail' => 'images/blog/article8.jpg',
                'is_published' => true,
                'created_at' => Carbon::create(2025, 5, 25),
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => 'Energy Infrastructure for Heavy Industry: Meeting Power Demands',
                        'content' => '<p>Heavy industries such as smelters, refineries, and chemical plants require substantial and reliable power supplies.</p><p>JIIPE has developed robust energy infrastructure including high-voltage transmission lines and substations to meet these demanding requirements.</p><p>Partnership with PLN ensures that companies have access to stable electricity at competitive rates.</p><p>The article explores energy considerations for industrial development and how JIIPE\'s power infrastructure supports heavy industrial operations.</p><p>Reliable energy supply is not just about quantity but also quality - consistent voltage and frequency are critical for sensitive industrial processes.</p>',
                        'quote' => null
                    ],
                    [
                        'locale' => 'id',
                        'title' => 'Infrastruktur Energi untuk Industri Berat: Memenuhi Kebutuhan Daya',
                        'content' => '<p>Industri berat seperti smelter, kilang, dan pabrik kimia memerlukan pasokan listrik yang besar dan andal.</p><p>JIIPE telah mengembangkan infrastruktur energi yang kuat termasuk jalur transmisi tegangan tinggi dan gardu induk untuk memenuhi persyaratan yang menuntut ini.</p><p>Kemitraan dengan PLN memastikan bahwa perusahaan memiliki akses ke listrik stabil dengan tarif kompetitif.</p><p>Artikel ini mengeksplorasi pertimbangan energi untuk pengembangan industri dan bagaimana infrastruktur listrik JIIPE mendukung operasi industri berat.</p><p>Pasokan energi yang andal bukan hanya tentang kuantitas tetapi juga kualitas - tegangan dan frekuensi yang konsisten sangat penting untuk proses industri yang sensitif.</p>',
                        'quote' => null
                    ]
                ]
            ],
        ];
        foreach ($newsData as $data) {
            $news = News::create([
                'category_id' => $data['category_id'],
                'thumbnail' => $data['thumbnail'],
                'is_published' => $data['is_published'],
                'created_at' => $data['created_at'],
            ]);
            foreach ($data['translations'] as $translation) {
                NewsTranslation::create([
                    'news_id' => $news->id,
                    'locale' => $translation['locale'],
                    'title' => $translation['title'],
                    'content' => $translation['content'],
                    'quote' => $translation['quote'],
                ]);
            }
        }

    }
}