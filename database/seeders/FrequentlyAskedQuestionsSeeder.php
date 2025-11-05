<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FrequentlyAskedQuestions;
use App\Models\FrequentlyAskedQuestionsTranslation;

class FrequentlyAskedQuestionsSeeder extends Seeder
{
    public function run(): void
    {
        FrequentlyAskedQuestions::truncate();
        FrequentlyAskedQuestionsTranslation::truncate();
        $faqs = [
            [
                'position' => 1,
                'translations' => [
                    'en' => [
                        'question' => 'Official information or announcements from JIIPE',
                        'answer' => '<p>All official information from JIIPE is only delivered through the official website www.jiipe.com and JIIPE\'s official channels.</p><p>BEWARE OF FRAUD! impersonating JIIPE, we never provide information via private messages, groups, or unofficial QR codes. If you receive a suspicious message or document, do not make any payments or share personal data. Immediately ignore or report it to JIIPE\'s official contact. JIIPE is not responsible for any losses arising from the use of information outside our official channels.</p>'
                    ],
                    'id' => [
                        'question' => 'Informasi atau pengumuman resmi dari JIIPE',
                        'answer' => '<p>Semua informasi resmi dari JIIPE hanya disampaikan melalui situs web resmi www.jiipe.com dan saluran resmi JIIPE.</p><p>WASPADA PENIPUAN! mengatasnamakan JIIPE, kami tidak pernah memberikan informasi melalui pesan pribadi, grup, atau kode QR tidak resmi. Jika Anda menerima pesan atau dokumen mencurigakan, jangan melakukan pembayaran atau membagikan data pribadi. Segera abaikan atau laporkan ke kontak resmi JIIPE. JIIPE tidak bertanggung jawab atas kerugian yang timbul dari penggunaan informasi di luar saluran resmi kami.</p>'
                    ]
                ]
            ],
            [
                'position' => 2,
                'translations' => [
                    'en' => [
                        'question' => 'I want to invest in Indonesia. What are the basic things I should know first?',
                        'answer' => '<p>To establish a foreign direct investment company in Indonesia you must first decide what business sector you are going to invest in based on Klasifikasi Baku Lapangan Usaha Indonesia "KBLI" (Indonesian Classification for Business Sector). Then, you must check whether the business sector is open with requirements or closed for foreign direct investment based on Presidential Regulation No. 44 the Year 2016 about "DNI" (Negative Investment List). If the business sector in which you are interested is not regulated, and no other restrictions from related technical ministries, then it means the business sector is open for foreign direct investment with maximum foreign ownership of 100%. The legal entity of the FDI Company should be a Limited Liability Company or Ltd. Perseroan Terbatas or PT. The \'PT\' company should be owned by a minimum of 2 shareholders. Those can be individual or corporate shareholders or a combination of both.</p>'
                    ],
                    'id' => [
                        'question' => 'Saya ingin berinvestasi di Indonesia. Apa hal-hal dasar yang harus saya ketahui terlebih dahulu?',
                        'answer' => '<p>Untuk mendirikan perusahaan penanaman modal asing di Indonesia, Anda harus terlebih dahulu menentukan sektor usaha yang akan Anda investasikan berdasarkan Klasifikasi Baku Lapangan Usaha Indonesia "KBLI". Kemudian, Anda harus memeriksa apakah sektor usaha tersebut terbuka dengan persyaratan atau tertutup untuk penanaman modal asing berdasarkan Peraturan Presiden No. 44 Tahun 2016 tentang "DNI" (Daftar Negatif Investasi). Jika sektor usaha yang Anda minati tidak diatur, dan tidak ada pembatasan lain dari kementerian teknis terkait, maka berarti sektor usaha tersebut terbuka untuk penanaman modal asing dengan kepemilikan asing maksimal 100%. Badan hukum Perusahaan PMA harus berbentuk Perseroan Terbatas atau PT. Perusahaan \'PT\' harus dimiliki minimal 2 pemegang saham. Bisa berupa pemegang saham perorangan atau badan hukum atau kombinasi keduanya.</p>'
                    ]
                ]
            ],
            [
                'position' => 3,
                'translations' => [
                    'en' => [
                        'question' => 'Can I set up a company in any location in Indonesia?',
                        'answer' => 'Yes, you can set up a company in any part of Indonesia. However, there are restrictions for some business sectors in certain regions, Industrial Law No. 3 the Year 2014 and Government Regulation No. 142 the Year 2015 have mandated that any industrial activities shall be located in industrial estates. Today, the Indonesian Industrial Estates Association (Himpunan Kawasan Industri Indonesia or HKI) has 87 company members, in 18 provinces, covering a total gross area of about 86,059 hectares. There are more than 9,950 manufacturing companies operating and these figures do not include industrial estates or non-HKI members. The main attractions of industrial estates are that the development is comprehensively planned to assure a strategic location, accessibility, building ratio, infrastructure, and supporting services, secured land titles, and continuous maintenance and operation management, as well as integrated environmental management.'
                    ],
                    'id' => [
                        'question' => 'Apakah saya bisa mendirikan perusahaan di lokasi mana saja di Indonesia?',
                        'answer' => 'Ya, Anda dapat mendirikan perusahaan di bagian mana pun di Indonesia. Namun, ada pembatasan untuk beberapa sektor usaha di daerah tertentu, UU Perindustrian No. 3 Tahun 2014 dan PP No. 142 Tahun 2015 telah mewajibkan setiap kegiatan industri harus berlokasi di kawasan industri. Saat ini, Himpunan Kawasan Industri Indonesia (HKI) memiliki 87 perusahaan anggota, di 18 provinsi, dengan total luas kotor sekitar 86.059 hektar. Terdapat lebih dari 9.950 perusahaan manufaktur yang beroperasi dan angka ini belum termasuk kawasan industri atau anggota non-HKI. Daya tarik utama kawasan industri adalah bahwa pengembangannya direncanakan secara komprehensif untuk menjamin lokasi strategis, aksesibilitas, rasio bangunan, infrastruktur, dan layanan pendukung, hak atas tanah yang aman, dan pemeliharaan berkelanjutan dan manajemen operasi, serta pengelolaan lingkungan yang terintegrasi.'
                    ]
                ]
            ],
            [
                'position' => 4,
                'translations' => [
                    'en' => [
                        'question' => 'What differentiates JIIPE from others?',
                        'answer' => 'A thriving industrial estate currently at center stage is Java Integrated Industrial and Port Estate (JIIPE), located in Gresik, East Java-Indonesia, a province whose economic growth is largely driven by trade and industry. With a total area of 3,000 hectares, comprising industrial estates, multifunctional public ports, and residential cities. The JIIPE industrial area covers 1,761 hectares.'
                    ],
                    'id' => [
                        'question' => 'Apa yang membedakan JIIPE dari yang lain?',
                        'answer' => 'Kawasan industri yang berkembang pesat saat ini adalah Java Integrated Industrial and Port Estate (JIIPE), yang berlokasi di Gresik, Jawa Timur-Indonesia, provinsi yang pertumbuhan ekonominya sebagian besar didorong oleh perdagangan dan industri. Dengan total luas 3.000 hektar, terdiri dari kawasan industri, pelabuhan umum multifungsi, dan kota pemukiman. Kawasan industri JIIPE meliputi 1.761 hektar.'
                    ]
                ]
            ],
            [
                'position' => 5,
                'translations' => [
                    'en' => [
                        'question' => 'What is JIIPE - Indonesia Special Economic Zone (SEZ)?',
                        'answer' => 'JIIPE Special Economic Zone (SEZ) is located in Gresik Regency, East Java Province. This SEZ was established through Government Regulation Number 71 of 2021. The SEZ area covers 2,167 hectares and is managed by PT JIIPE, a subsidiary of PT AKR Corporindo Tbk and PT Pelindo III. The development of JIIPE SEZ is directed to become an integrated economic zone that focuses on processing industries, logistics, maritime, digital technology, and tourism.'
                    ],
                    'id' => [
                        'question' => 'Apa itu JIIPE - Kawasan Ekonomi Khusus (KEK)?',
                        'answer' => 'JIIPE Kawasan Ekonomi Khusus (KEK) berlokasi di Kabupaten Gresik, Provinsi Jawa Timur. KEK ini didirikan melalui Peraturan Pemerintah Nomor 71 Tahun 2021. Kawasan KEK seluas 2.167 hektar dan dikelola oleh PT JIIPE, anak perusahaan PT AKR Corporindo Tbk dan PT Pelindo III. Pengembangan KEK JIIPE diarahkan untuk menjadi kawasan ekonomi terintegrasi yang berfokus pada industri pengolahan, logistik, maritim, teknologi digital, dan pariwisata.'
                    ]
                ]
            ],
            [
                'position' => 6,
                'translations' => [
                    'en' => [
                        'question' => 'Can I have a JIIPE area tour? What is the procedure?',
                        'answer' => 'Yes, you can have a JIIPE area tour. Please contact our marketing team or submit your request through our website. Our team will arrange a schedule and guide you through the area.'
                    ],
                    'id' => [
                        'question' => 'Bisakah saya mendapatkan tur area JIIPE? Apa prosedurnya?',
                        'answer' => 'Ya, Anda bisa mendapatkan tur area JIIPE. Silakan hubungi tim marketing kami atau ajukan permintaan Anda melalui website kami. Tim kami akan mengatur jadwal dan memandu Anda melalui area tersebut.'
                    ]
                ]
            ],
            [
                'position' => 7,
                'translations' => [
                    'en' => [
                        'question' => 'I need information about Utilities in JIIPE',
                        'answer' => 'JIIPE provides comprehensive utility services including electricity supply, water treatment facilities, waste management, and telecommunications infrastructure. For detailed specifications and capacity information, please contact our technical team.'
                    ],
                    'id' => [
                        'question' => 'Saya membutuhkan informasi tentang Utilitas di JIIPE',
                        'answer' => 'JIIPE menyediakan layanan utilitas komprehensif termasuk pasokan listrik, fasilitas pengolahan air, pengelolaan limbah, dan infrastruktur telekomunikasi. Untuk spesifikasi detail dan informasi kapasitas, silakan hubungi tim teknis kami.'
                    ]
                ]
            ],
            [
                'position' => 8,
                'translations' => [
                    'en' => [
                        'question' => 'I need information about JIIPE deep seaport',
                        'answer' => 'JIIPE\'s deep seaport is equipped with modern facilities and can accommodate large vessels. The port has multiple berths and is integrated with the industrial estate for efficient logistics operations.'
                    ],
                    'id' => [
                        'question' => 'Saya membutuhkan informasi tentang pelabuhan dalam JIIPE',
                        'answer' => 'Pelabuhan dalam JIIPE dilengkapi dengan fasilitas modern dan dapat menampung kapal-kapal besar. Pelabuhan ini memiliki beberapa dermaga dan terintegrasi dengan kawasan industri untuk operasi logistik yang efisien.'
                    ]
                ]
            ],
            [
                'position' => 9,
                'translations' => [
                    'en' => [
                        'question' => 'How many tenants at JIIPE and what are their industries?',
                        'answer' => 'Currently, JIIPE has 17 tenants from the chemical processing, food, construction, and smelter industries'
                    ],
                    'id' => [
                        'question' => 'Berapa banyak tenant di JIIPE dan apa industri mereka?',
                        'answer' => 'Saat ini, JIIPE memiliki 17 tenant dari industri pengolahan kimia, makanan, konstruksi, dan smelter'
                    ]
                ]
            ],
            [
                'position' => 10,
                'translations' => [
                    'en' => [
                        'question' => 'What are Energy & utility Facts in JIIPE?',
                        'answer' => '<p><u><strong>PHASE 1 (fully developed and available)</strong></u><br>ELECTRICITY: 23 MW Dual Fuel Power Plant (Gas & liquid fuel oil)<br>INDUSTRIAL FRESHWATER :100 m3/hour /( 2400 m3/day ) – Sea Water Reverse Osmosis (SWRO) facility and 1500 m3/day from BWRO facility (Recycle)<br>WASTEWATER TREATMENT PLANT: 2500 m3/day (MBR Technology)<br>NATURAL GAS PIPELINE: Capacity up to 85 MMSCFD</p><p><strong><u>PHASE 2</u></strong><br>ELECTRICITY: 250 MW Dual-source, Dual feeder (Will be ready in 2023) and 250 MW Dual-source, Dual feeder (Will be ready in 2025)<br>INDUSTRIAL FRESHWATER: 600 lps or 2160 m3/hour ( 51840 m3/day)</p><p><strong><u>PHASE 3</u></strong><br>ELECTRICITY: 660 MW<br>RENEWABLE ENERGY: Gas/ LNG to match demand<br>INDUSTRIAL FRESHWATER: 1000 lps ( 86,400m3/day )<br>UTILITY CENTER for ICTInternet & Telecommunication Service with Fiber Optic Cables – Gigabyte enabled and BTS Tower for cellular communication</p>'
                    ],
                    'id' => [
                        'question' => 'Apa saja Fakta Energi & utilitas di JIIPE?',
                        'answer' => '<p><u><strong>FASE 1 (sudah sepenuhnya dikembangkan dan tersedia)</strong></u><br>LISTRIK: Pembangkit Listrik Dual Fuel 23 MW (Gas & bahan bakar minyak cair)<br>AIR BERSIH INDUSTRI: 100 m3/jam /(2400 m3/hari) – fasilitas Sea Water Reverse Osmosis (SWRO) dan 1500 m3/hari dari fasilitas BWRO (Daur Ulang)<br>INSTALASI PENGOLAHAN AIR LIMBAH: 2500 m3/hari (Teknologi MBR)<br>PIPA GAS ALAM: Kapasitas hingga 85 MMSCFD</p><p><strong><u>FASE 2</u></strong><br>LISTRIK: 250 MW Dual-source, Dual feeder (Akan siap tahun 2023) dan 250 MW Dual-source, Dual feeder (Akan siap tahun 2025)<br>AIR BERSIH INDUSTRI: 600 lps atau 2160 m3/jam (51840 m3/hari)</p><p><strong><u>FASE 3</u></strong><br>LISTRIK: 660 MW<br>ENERGI TERBARUKAN: Gas/LNG sesuai permintaan<br>AIR BERSIH INDUSTRI: 1000 lps (86.400m3/hari)<br>PUSAT UTILITAS untuk Layanan ICTInternet & Telekomunikasi dengan Kabel Fiber Optik – Gigabyte enabled dan Menara BTS untuk komunikasi seluler</p>'
                    ]
                ]
            ],
            [
                'position' => 11,
                'translations' => [
                    'en' => [
                        'question' => 'What makes Indonesia the promising destination for investment?',
                        'answer' => 'Indonesia is the fourth most populous country in the world with a young workforce and a large and growing domestic market due to the demographic bonus, making Indonesia one of the world\'s leading economies. Despite heightened global uncertainty, Indonesia\'s economic outlook continues to be positive, with domestic demand being the main driver of growth. As the only G-20 member in Southeast Asia and an active voice to develop world concerns, Indonesia plays a more significant role on the global stage. Standard Chartered foresees Indonesia\'s entry into the G-7 by 2030 and projects that the Indonesian economy could become the 10th largest by 2020 and the 5th largest by 2030. Being the world\'s 3rd largest flourishing democracy with the largest Muslim population, Indonesia has a stable policy situation with a high commitment to implement structural reforms. Worldwide Governance Indicators Survey conducted by World Bank indicated that Indonesia has improvements in several indicators such as Government Effectiveness, Regulatory Quality, and Control of Corruption.'
                    ],
                    'id' => [
                        'question' => 'Apa yang membuat Indonesia menjadi tujuan investasi yang menjanjikan?',
                        'answer' => 'Indonesia adalah negara dengan populasi terbesar keempat di dunia dengan tenaga kerja muda dan pasar domestik yang besar dan terus berkembang karena bonus demografi, menjadikan Indonesia salah satu ekonomi terkemuka dunia. Meskipun ketidakpastian global meningkat, prospek ekonomi Indonesia terus positif, dengan permintaan domestik menjadi pendorong utama pertumbuhan. Sebagai satu-satunya anggota G-20 di Asia Tenggara dan suara aktif untuk mengembangkan kepentingan dunia, Indonesia memainkan peran yang lebih penting di panggung global. Standard Chartered memperkirakan masuknya Indonesia ke G-7 pada 2030 dan memproyeksikan bahwa ekonomi Indonesia bisa menjadi yang ke-10 terbesar pada 2020 dan ke-5 terbesar pada 2030. Sebagai demokrasi berkembang terbesar ke-3 di dunia dengan populasi Muslim terbesar, Indonesia memiliki situasi kebijakan yang stabil dengan komitmen tinggi untuk menerapkan reformasi struktural. Survei Worldwide Governance Indicators yang dilakukan Bank Dunia menunjukkan bahwa Indonesia memiliki peningkatan dalam beberapa indikator seperti Efektivitas Pemerintahan, Kualitas Regulasi, dan Pengendalian Korupsi.'
                    ]
                ]
            ]
        ];

        foreach ($faqs as $faq) {
            $faqModel = FrequentlyAskedQuestions::create([
                'is_active' => true,
                'position' => $faq['position']
            ]);

            foreach ($faq['translations'] as $locale => $translation) {
                FrequentlyAskedQuestionsTranslation::create([
                    'faq_id' => $faqModel->id,
                    'locale' => $locale,
                    'question' => $translation['question'],
                    'answer' => $translation['answer']
                ]);
            }
        }
    }
}
