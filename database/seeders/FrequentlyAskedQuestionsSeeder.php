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
                    'id' => [
                        'question' => 'Informasi atau pengumuman resmi dari JIIPE',
                        'answer' => '<p>Semua informasi resmi dari JIIPE hanya disampaikan melalui situs web resmi www.jiipe.com dan saluran resmi JIIPE.</p><p>WASPADA PENIPUAN! mengatasnamakan JIIPE, kami tidak pernah memberikan informasi melalui pesan pribadi, grup, atau kode QR tidak resmi. Jika Anda menerima pesan atau dokumen mencurigakan, jangan melakukan pembayaran atau membagikan data pribadi. Segera abaikan atau laporkan ke kontak resmi JIIPE. JIIPE tidak bertanggung jawab atas kerugian yang timbul dari penggunaan informasi di luar saluran resmi kami.</p>'
                    ],
                    'en' => [
                        'question' => 'Official information or announcements from JIIPE',
                        'answer' => '<p>All official information from JIIPE is only delivered through the official website www.jiipe.com and JIIPE\'s official channels.</p><p>BEWARE OF FRAUD! impersonating JIIPE, we never provide information via private messages, groups, or unofficial QR codes. If you receive a suspicious message or document, do not make any payments or share personal data. Immediately ignore or report it to JIIPE\'s official contact. JIIPE is not responsible for any losses arising from the use of information outside our official channels.</p>'
                    ],
                    'zh' => [
                        'question' => 'JIIPE的官方信息或公告',
                        'answer' => '<p>JIIPE的所有官方信息仅通过官方网站www.jiipe.com和JIIPE的官方渠道发布。</p><p>谨防诈骗！冒充JIIPE，我们从不通过私信、群组或非官方二维码提供信息。如果您收到可疑信息或文件，请勿付款或分享个人数据。请立即忽略或向JIIPE官方联系方式举报。对于使用我们官方渠道以外的信息所造成的任何损失，JIIPE概不负责。</p>'
                    ],
                    'ja' => [
                        'question' => 'JIIPEからの公式情報またはお知らせ',
                        'answer' => '<p>JIIPEからの公式情報は、公式ウェブサイトwww.jiipe.comおよびJIIPEの公式チャンネルを通じてのみ配信されます。</p><p>詐欺にご注意ください！JIIPEを装って、プライベートメッセージ、グループ、または非公式のQRコードを通じて情報を提供することは決してありません。疑わしいメッセージや書類を受け取った場合は、支払いを行ったり、個人データを共有したりしないでください。すぐに無視するか、JIIPEの公式連絡先に報告してください。公式チャンネル以外の情報の使用により生じた損失については、JIIPEは責任を負いません。</p>'
                    ],
                    'ko' => [
                        'question' => 'JIIPE의 공식 정보 또는 공지사항',
                        'answer' => '<p>JIIPE의 모든 공식 정보는 공식 웹사이트 www.jiipe.com 및 JIIPE의 공식 채널을 통해서만 제공됩니다.</p><p>사기 주의! JIIPE를 사칭하여 개인 메시지, 그룹 또는 비공식 QR 코드를 통해 정보를 제공하는 경우는 절대 없습니다. 의심스러운 메시지나 문서를 받으면 결제하거나 개인 데이터를 공유하지 마십시오. 즉시 무시하거나 JIIPE의 공식 연락처로 신고하십시오. 공식 채널 외부의 정보 사용으로 인한 손실에 대해 JIIPE는 책임지지 않습니다.</p>'
                    ],
                    'tw' => [
                        'question' => 'JIIPE的官方資訊或公告',
                        'answer' => '<p>JIIPE的所有官方資訊僅通過官方網站www.jiipe.com和JIIPE的官方管道發布。</p><p>謹防詐騙！冒充JIIPE，我們從不通過私訊、群組或非官方二維碼提供資訊。如果您收到可疑訊息或文件，請勿付款或分享個人資料。請立即忽略或向JIIPE官方聯絡方式舉報。對於使用我們官方管道以外的資訊所造成的任何損失，JIIPE概不負責。</p>'
                    ]
                ]
            ],
            [
                'position' => 2,
                'translations' => [
                    'id' => [
                        'question' => 'Saya ingin berinvestasi di Indonesia. Apa hal-hal dasar yang harus saya ketahui terlebih dahulu?',
                        'answer' => '<p>Untuk mendirikan perusahaan penanaman modal asing di Indonesia, Anda harus terlebih dahulu menentukan sektor usaha yang akan Anda investasikan berdasarkan Klasifikasi Baku Lapangan Usaha Indonesia "KBLI". Kemudian, Anda harus memeriksa apakah sektor usaha tersebut terbuka dengan persyaratan atau tertutup untuk penanaman modal asing berdasarkan Peraturan Presiden No. 44 Tahun 2016 tentang "DNI" (Daftar Negatif Investasi). Jika sektor usaha yang Anda minati tidak diatur, dan tidak ada pembatasan lain dari kementerian teknis terkait, maka berarti sektor usaha tersebut terbuka untuk penanaman modal asing dengan kepemilikan asing maksimal 100%. Badan hukum Perusahaan PMA harus berbentuk Perseroan Terbatas atau PT. Perusahaan \'PT\' harus dimiliki minimal 2 pemegang saham. Bisa berupa pemegang saham perorangan atau badan hukum atau kombinasi keduanya.</p>'
                    ],
                    'en' => [
                        'question' => 'I want to invest in Indonesia. What are the basic things I should know first?',
                        'answer' => '<p>To establish a foreign direct investment company in Indonesia you must first decide what business sector you are going to invest in based on Klasifikasi Baku Lapangan Usaha Indonesia "KBLI" (Indonesian Classification for Business Sector). Then, you must check whether the business sector is open with requirements or closed for foreign direct investment based on Presidential Regulation No. 44 the Year 2016 about "DNI" (Negative Investment List). If the business sector in which you are interested is not regulated, and no other restrictions from related technical ministries, then it means the business sector is open for foreign direct investment with maximum foreign ownership of 100%. The legal entity of the FDI Company should be a Limited Liability Company or Ltd. Perseroan Terbatas or PT. The \'PT\' company should be owned by a minimum of 2 shareholders. Those can be individual or corporate shareholders or a combination of both.</p>'
                    ],
                    'zh' => [
                        'question' => '我想在印度尼西亚投资。我首先应该了解哪些基本事项？',
                        'answer' => '<p>要在印度尼西亚设立外商直接投资公司，您必须首先根据印度尼西亚商业领域标准分类"KBLI"决定您要投资的商业领域。然后，您必须根据2016年第44号总统令关于"DNI"（负面投资清单）检查该商业领域是否有条件开放或对外商直接投资关闭。如果您感兴趣的商业领域未受监管，且相关技术部门没有其他限制，则意味着该商业领域对外商直接投资开放，外资持股比例最高可达100%。外商投资公司的法律实体应为有限责任公司或PT（Perseroan Terbatas）。PT公司至少应由2名股东拥有。这些股东可以是个人或企业股东，或两者的组合。</p>'
                    ],
                    'ja' => [
                        'question' => 'インドネシアに投資したいのですが、まず知っておくべき基本事項は何ですか？',
                        'answer' => '<p>インドネシアで外国直接投資会社を設立するには、まずインドネシア事業分野標準分類「KBLI」に基づいて投資する事業分野を決定する必要があります。次に、2016年第44号大統領令の「DNI」（ネガティブ投資リスト）に基づいて、その事業分野が要件付きで開放されているか、外国直接投資に閉鎖されているかを確認する必要があります。関心のある事業分野が規制されておらず、関連技術省庁からの他の制限がない場合、その事業分野は外国直接投資に開放されており、外資所有権は最大100％となります。外国直接投資会社の法人格は、有限責任会社またはPT（Perseroan Terbatas）でなければなりません。PT会社は最低2名の株主が所有する必要があります。個人株主または法人株主、またはその両方の組み合わせが可能です。</p>'
                    ],
                    'ko' => [
                        'question' => '인도네시아에 투자하고 싶습니다. 먼저 알아야 할 기본 사항은 무엇입니까?',
                        'answer' => '<p>인도네시아에서 외국인 직접 투자 회사를 설립하려면 먼저 인도네시아 사업 분야 표준 분류 "KBLI"에 따라 투자할 사업 분야를 결정해야 합니다. 그런 다음 2016년 제44호 대통령령의 "DNI"(네거티브 투자 목록)에 따라 해당 사업 분야가 요건과 함께 개방되어 있는지 또는 외국인 직접 투자에 폐쇄되어 있는지 확인해야 합니다. 관심 있는 사업 분야가 규제되지 않고 관련 기술 부처의 다른 제한이 없다면 해당 사업 분야는 최대 100%의 외국인 소유권으로 외국인 직접 투자에 개방된 것입니다. 외국인 직접 투자 회사의 법인은 유한 책임 회사 또는 PT(Perseroan Terbatas)여야 합니다. PT 회사는 최소 2명의 주주가 소유해야 합니다. 개인 주주 또는 법인 주주 또는 둘의 조합이 가능합니다.</p>'
                    ],
                    'tw' => [
                        'question' => '我想在印尼投資。我首先應該了解哪些基本事項？',
                        'answer' => '<p>要在印尼設立外商直接投資公司，您必須首先根據印尼商業領域標準分類"KBLI"決定您要投資的商業領域。然後，您必須根據2016年第44號總統令關於"DNI"（負面投資清單）檢查該商業領域是否有條件開放或對外商直接投資關閉。如果您感興趣的商業領域未受監管，且相關技術部門沒有其他限制，則意味著該商業領域對外商直接投資開放，外資持股比例最高可達100%。外商投資公司的法律實體應為有限責任公司或PT（Perseroan Terbatas）。PT公司至少應由2名股東擁有。這些股東可以是個人或企業股東，或兩者的組合。</p>'
                    ]
                ]
            ],
            [
                'position' => 3,
                'translations' => [
                    'id' => [
                        'question' => 'Apakah saya bisa mendirikan perusahaan di lokasi mana saja di Indonesia?',
                        'answer' => 'Ya, Anda dapat mendirikan perusahaan di bagian mana pun di Indonesia. Namun, ada pembatasan untuk beberapa sektor usaha di daerah tertentu, UU Perindustrian No. 3 Tahun 2014 dan PP No. 142 Tahun 2015 telah mewajibkan setiap kegiatan industri harus berlokasi di kawasan industri. Saat ini, Himpunan Kawasan Industri Indonesia (HKI) memiliki 87 perusahaan anggota, di 18 provinsi, dengan total luas kotor sekitar 86.059 hektar. Terdapat lebih dari 9.950 perusahaan manufaktur yang beroperasi dan angka ini belum termasuk kawasan industri atau anggota non-HKI. Daya tarik utama kawasan industri adalah bahwa pengembangannya direncanakan secara komprehensif untuk menjamin lokasi strategis, aksesibilitas, rasio bangunan, infrastruktur, dan layanan pendukung, hak atas tanah yang aman, dan pemeliharaan berkelanjutan dan manajemen operasi, serta pengelolaan lingkungan yang terintegrasi.'
                    ],
                    'en' => [
                        'question' => 'Can I set up a company in any location in Indonesia?',
                        'answer' => 'Yes, you can set up a company in any part of Indonesia. However, there are restrictions for some business sectors in certain regions, Industrial Law No. 3 the Year 2014 and Government Regulation No. 142 the Year 2015 have mandated that any industrial activities shall be located in industrial estates. Today, the Indonesian Industrial Estates Association (Himpunan Kawasan Industri Indonesia or HKI) has 87 company members, in 18 provinces, covering a total gross area of about 86,059 hectares. There are more than 9,950 manufacturing companies operating and these figures do not include industrial estates or non-HKI members. The main attractions of industrial estates are that the development is comprehensively planned to assure a strategic location, accessibility, building ratio, infrastructure, and supporting services, secured land titles, and continuous maintenance and operation management, as well as integrated environmental management.'
                    ],
                    'zh' => [
                        'question' => '我可以在印度尼西亚的任何地方设立公司吗？',
                        'answer' => '是的，您可以在印度尼西亚的任何地方设立公司。但是，某些地区的某些商业领域存在限制，2014年第3号工业法和2015年第142号政府法规规定，任何工业活动都必须位于工业园区。目前，印度尼西亚工业园区协会（HKI）在18个省拥有87家成员公司，总面积约86,059公顷。有超过9,950家制造公司在运营，这些数字不包括工业园区或非HKI成员。工业园区的主要吸引力在于其开发经过全面规划，以确保战略位置、可达性、建筑比率、基础设施和配套服务、安全的土地所有权、持续的维护和运营管理以及综合环境管理。'
                    ],
                    'ja' => [
                        'question' => 'インドネシアのどこにでも会社を設立できますか？',
                        'answer' => 'はい、インドネシアのどこにでも会社を設立できます。ただし、特定の地域の一部の事業分野には制限があり、2014年第3号工業法および2015年第142号政府規則は、すべての工業活動が工業団地に位置することを義務付けています。現在、インドネシア工業団地協会（HKI）は18州に87社の会員企業を擁し、総面積は約86,059ヘクタールです。9,950社以上の製造会社が操業しており、これらの数字には工業団地または非HKI会員は含まれていません。工業団地の主な魅力は、戦略的な場所、アクセス性、建築比率、インフラストラクチャ、サポートサービス、安全な土地所有権、継続的なメンテナンスと運用管理、および統合された環境管理を保証するために開発が包括的に計画されていることです。'
                    ],
                    'ko' => [
                        'question' => '인도네시아의 어느 곳에나 회사를 설립할 수 있습니까?',
                        'answer' => '예, 인도네시아의 어느 곳에나 회사를 설립할 수 있습니다. 그러나 특정 지역의 일부 사업 분야에는 제한이 있으며, 2014년 제3호 산업법 및 2015년 제142호 정부 규정은 모든 산업 활동이 산업 단지에 위치해야 한다고 규정하고 있습니다. 현재 인도네시아 산업 단지 협회(HKI)는 18개 주에 87개 회원사를 보유하고 있으며 총 면적은 약 86,059헥타르입니다. 9,950개 이상의 제조 회사가 운영되고 있으며 이 수치에는 산업 단지 또는 비 HKI 회원은 포함되지 않습니다. 산업 단지의 주요 매력은 전략적 위치, 접근성, 건물 비율, 인프라 및 지원 서비스, 안전한 토지 소유권, 지속적인 유지 보수 및 운영 관리, 통합 환경 관리를 보장하기 위해 개발이 포괄적으로 계획되어 있다는 것입니다.'
                    ],
                    'tw' => [
                        'question' => '我可以在印尼的任何地方設立公司嗎？',
                        'answer' => '是的，您可以在印尼的任何地方設立公司。但是，某些地區的某些商業領域存在限制，2014年第3號工業法和2015年第142號政府法規規定，任何工業活動都必須位於工業園區。目前，印尼工業園區協會（HKI）在18個省擁有87家成員公司，總面積約86,059公頃。有超過9,950家製造公司在運營，這些數字不包括工業園區或非HKI成員。工業園區的主要吸引力在於其開發經過全面規劃，以確保戰略位置、可達性、建築比率、基礎設施和配套服務、安全的土地所有權、持續的維護和運營管理以及綜合環境管理。'
                    ]
                ]
            ],
            [
                'position' => 4,
                'translations' => [
                    'id' => [
                        'question' => 'Apa yang membedakan JIIPE dari yang lain?',
                        'answer' => 'Kawasan industri yang berkembang pesat saat ini adalah Java Integrated Industrial and Port Estate (JIIPE), yang berlokasi di Gresik, Jawa Timur-Indonesia, provinsi yang pertumbuhan ekonominya sebagian besar didorong oleh perdagangan dan industri. Dengan total luas 3.000 hektar, terdiri dari kawasan industri, pelabuhan umum multifungsi, dan kota pemukiman. Kawasan industri JIIPE meliputi 1.761 hektar.'
                    ],
                    'en' => [
                        'question' => 'What differentiates JIIPE from others?',
                        'answer' => 'A thriving industrial estate currently at center stage is Java Integrated Industrial and Port Estate (JIIPE), located in Gresik, East Java-Indonesia, a province whose economic growth is largely driven by trade and industry. With a total area of 3,000 hectares, comprising industrial estates, multifunctional public ports, and residential cities. The JIIPE industrial area covers 1,761 hectares.'
                    ],
                    'zh' => [
                        'question' => 'JIIPE与其他工业区有何不同？',
                        'answer' => '目前处于中心舞台的繁荣工业区是爪哇综合工业和港口园区（JIIPE），位于印度尼西亚东爪哇格雷西克，该省的经济增长主要由贸易和工业推动。总面积为3,000公顷，包括工业园区、多功能公共港口和住宅城市。JIIPE工业区占地1,761公顷。'
                    ],
                    'ja' => [
                        'question' => 'JIIPEは他と何が違うのですか？',
                        'answer' => '現在中心的な役割を果たしている繁栄する工業団地は、インドネシア東ジャワ州グレシックに位置するジャワ統合工業港湾地区（JIIPE）であり、この州の経済成長は主に貿易と産業によって推進されています。総面積3,000ヘクタールで、工業団地、多機能公共港、住宅都市で構成されています。JIIPE工業地域は1,761ヘクタールをカバーしています。'
                    ],
                    'ko' => [
                        'question' => 'JIIPE는 다른 곳과 무엇이 다릅니까?',
                        'answer' => '현재 중심 무대에 있는 번성하는 산업 단지는 인도네시아 동자바 그레식에 위치한 자바 통합 산업 및 항만 단지(JIIPE)로, 이 지역의 경제 성장은 주로 무역과 산업에 의해 주도됩니다. 총 면적 3,000헥타르로 산업 단지, 다기능 공공 항구 및 주거 도시로 구성되어 있습니다. JIIPE 산업 지역은 1,761헥타르를 차지합니다.'
                    ],
                    'tw' => [
                        'question' => 'JIIPE與其他工業區有何不同？',
                        'answer' => '目前處於中心舞台的繁榮工業區是爪哇綜合工業和港口園區（JIIPE），位於印尼東爪哇格雷西克，該省的經濟增長主要由貿易和工業推動。總面積為3,000公頃，包括工業園區、多功能公共港口和住宅城市。JIIPE工業區佔地1,761公頃。'
                    ]
                ]
            ],
            [
                'position' => 5,
                'translations' => [
                    'id' => [
                        'question' => 'Apa itu JIIPE - Kawasan Ekonomi Khusus (KEK)?',
                        'answer' => 'JIIPE Kawasan Ekonomi Khusus (KEK) berlokasi di Kabupaten Gresik, Provinsi Jawa Timur. KEK ini didirikan melalui Peraturan Pemerintah Nomor 71 Tahun 2021. Kawasan KEK seluas 2.167 hektar dan dikelola oleh PT JIIPE, anak perusahaan PT AKR Corporindo Tbk dan PT Pelindo III. Pengembangan KEK JIIPE diarahkan untuk menjadi kawasan ekonomi terintegrasi yang berfokus pada industri pengolahan, logistik, maritim, teknologi digital, dan pariwisata.'
                    ],
                    'en' => [
                        'question' => 'What is JIIPE - Indonesia Special Economic Zone (SEZ)?',
                        'answer' => 'JIIPE Special Economic Zone (SEZ) is located in Gresik Regency, East Java Province. This SEZ was established through Government Regulation Number 71 of 2021. The SEZ area covers 2,167 hectares and is managed by PT JIIPE, a subsidiary of PT AKR Corporindo Tbk and PT Pelindo III. The development of JIIPE SEZ is directed to become an integrated economic zone that focuses on processing industries, logistics, maritime, digital technology, and tourism.'
                    ],
                    'zh' => [
                        'question' => '什么是JIIPE - 印度尼西亚经济特区（SEZ）？',
                        'answer' => 'JIIPE经济特区（SEZ）位于东爪哇省格雷西克县。该经济特区是通过2021年第71号政府法规设立的。经济特区面积为2,167公顷，由PT AKR Corporindo Tbk和PT Pelindo III的子公司PT JIIPE管理。JIIPE经济特区的发展旨在成为一个专注于加工工业、物流、海事、数字技术和旅游的综合经济区。'
                    ],
                    'ja' => [
                        'question' => 'JIIPE - インドネシア経済特区（SEZ）とは何ですか？',
                        'answer' => 'JIIPE経済特区（SEZ）は、東ジャワ州グレシック県に位置しています。このSEZは2021年第71号政府規則により設立されました。SEZ地域は2,167ヘクタールをカバーし、PT AKR Corporindo TbkとPT Pelindo IIIの子会社であるPT JIIPEによって管理されています。JIIPE SEZの開発は、加工産業、物流、海事、デジタル技術、観光に焦点を当てた統合経済ゾーンになることを目指しています。'
                    ],
                    'ko' => [
                        'question' => 'JIIPE - 인도네시아 경제 특구(SEZ)란 무엇입니까?',
                        'answer' => 'JIIPE 경제 특구(SEZ)는 동자바 주 그레식 지역에 위치하고 있습니다. 이 SEZ는 2021년 제71호 정부 규정을 통해 설립되었습니다. SEZ 지역은 2,167헥타르를 차지하며 PT AKR Corporindo Tbk 및 PT Pelindo III의 자회사인 PT JIIPE가 관리합니다. JIIPE SEZ의 개발은 가공 산업, 물류, 해양, 디지털 기술 및 관광에 초점을 맞춘 통합 경제 구역이 되는 것을 목표로 합니다.'
                    ],
                    'tw' => [
                        'question' => '什麼是JIIPE - 印尼經濟特區（SEZ）？',
                        'answer' => 'JIIPE經濟特區（SEZ）位於東爪哇省格雷西克縣。該經濟特區是通過2021年第71號政府法規設立的。經濟特區面積為2,167公頃，由PT AKR Corporindo Tbk和PT Pelindo III的子公司PT JIIPE管理。JIIPE經濟特區的發展旨在成為一個專注於加工工業、物流、海事、數位技術和旅遊的綜合經濟區。'
                    ]
                ]
            ],
            [
                'position' => 6,
                'translations' => [
                    'id' => [
                        'question' => 'Bisakah saya mendapatkan tur area JIIPE? Apa prosedurnya?',
                        'answer' => 'Ya, Anda bisa mendapatkan tur area JIIPE. Silakan hubungi tim marketing kami atau ajukan permintaan Anda melalui website kami. Tim kami akan mengatur jadwal dan memandu Anda melalui area tersebut.'
                    ],
                    'en' => [
                        'question' => 'Can I have a JIIPE area tour? What is the procedure?',
                        'answer' => 'Yes, you can have a JIIPE area tour. Please contact our marketing team or submit your request through our website. Our team will arrange a schedule and guide you through the area.'
                    ],
                    'zh' => [
                        'question' => '我可以参观JIIPE园区吗？流程是什么？',
                        'answer' => '是的，您可以参观JIIPE园区。请联系我们的营销团队或通过我们的网站提交您的请求。我们的团队将安排时间表并引导您参观园区。'
                    ],
                    'ja' => [
                        'question' => 'JIIPEエリアのツアーはできますか？手続きは何ですか？',
                        'answer' => 'はい、JIIPEエリアのツアーができます。マーケティングチームにお問い合わせいただくか、ウェブサイトからリクエストを送信してください。チームがスケジュールを調整し、エリアをご案内します。'
                    ],
                    'ko' => [
                        'question' => 'JIIPE 지역 투어를 할 수 있습니까? 절차는 무엇입니까?',
                        'answer' => '예, JIIPE 지역 투어를 할 수 있습니다. 마케팅 팀에 문의하거나 웹사이트를 통해 요청을 제출하십시오. 팀이 일정을 조정하고 지역을 안내해 드립니다.'
                    ],
                    'tw' => [
                        'question' => '我可以參觀JIIPE園區嗎？流程是什麼？',
                        'answer' => '是的，您可以參觀JIIPE園區。請聯繫我們的行銷團隊或通過我們的網站提交您的請求。我們的團隊將安排時間表並引導您參觀園區。'
                    ]
                ],
            ],
            [
                'position' => 7,
                'translations' => [
                    'id' => [
                        'question' => 'Saya membutuhkan informasi tentang Utilitas di JIIPE',
                        'answer' => 'JIIPE menyediakan layanan utilitas komprehensif termasuk pasokan listrik, fasilitas pengolahan air, pengelolaan limbah, dan infrastruktur telekomunikasi. Untuk spesifikasi detail dan informasi kapasitas, silakan hubungi tim teknis kami.'
                    ],
                    'en' => [
                        'question' => 'I need information about Utilities in JIIPE',
                        'answer' => 'JIIPE provides comprehensive utility services including electricity supply, water treatment facilities, waste management, and telecommunications infrastructure. For detailed specifications and capacity information, please contact our technical team.'
                    ],
                    'zh' => [
                        'question' => '我需要有关JIIPE公用设施的信息',
                        'answer' => 'JIIPE提供全面的公用设施服务，包括电力供应、水处理设施、废物管理和通信基础设施。有关详细规格和容量信息，请联系我们的技术团队。'
                    ],
                    'ja' => [
                        'question' => 'JIIPEのユーティリティに関する情報が必要です',
                        'answer' => 'JIIPEは、電力供給、水処理施設、廃棄物管理、通信インフラを含む包括的なユーティリティサービスを提供しています。詳細な仕様と容量情報については、技術チームにお問い合わせください。'
                    ],
                    'ko' => [
                        'question' => 'JIIPE의 유틸리티에 대한 정보가 필요합니다',
                        'answer' => 'JIIPE는 전력 공급, 수처리 시설, 폐기물 관리 및 통신 인프라를 포함한 포괄적인 유틸리티 서비스를 제공합니다. 자세한 사양 및 용량 정보는 기술 팀에 문의하십시오.'
                    ],
                    'tw' => [
                        'question' => '我需要有關JIIPE公用設施的資訊',
                        'answer' => 'JIIPE提供全面的公用設施服務，包括電力供應、水處理設施、廢物管理和通訊基礎設施。有關詳細規格和容量資訊，請聯繫我們的技術團隊。'
                    ]
                ]
            ],
            [
                'position' => 8,
                'translations' => [
                    'id' => [
                        'question' => 'Saya membutuhkan informasi tentang pelabuhan dalam JIIPE',
                        'answer' => 'Pelabuhan dalam JIIPE dilengkapi dengan fasilitas modern dan dapat menampung kapal-kapal besar. Pelabuhan ini memiliki beberapa dermaga dan terintegrasi dengan kawasan industri untuk operasi logistik yang efisien.'
                    ],
                    'en' => [
                        'question' => 'I need information about JIIPE deep seaport',
                        'answer' => 'JIIPE\'s deep seaport is equipped with modern facilities and can accommodate large vessels. The port has multiple berths and is integrated with the industrial estate for efficient logistics operations.'
                    ],
                    'zh' => [
                        'question' => '我需要有关JIIPE深水港的信息',
                        'answer' => 'JIIPE的深水港配备了现代化设施，可容纳大型船舶。该港口拥有多个泊位，并与工业园区集成，以实现高效的物流运营。'
                    ],
                    'ja' => [
                        'question' => 'JIIPEの深海港に関する情報が必要です',
                        'answer' => 'JIIPEの深海港は最新の施設を備えており、大型船舶を収容できます。港には複数の岸壁があり、効率的な物流運用のために工業団地と統合されています。'
                    ],
                    'ko' => [
                        'question' => 'JIIPE 심해항에 대한 정보가 필요합니다',
                        'answer' => 'JIIPE의 심해항은 현대적인 시설을 갖추고 있으며 대형 선박을 수용할 수 있습니다. 항구에는 여러 선석이 있으며 효율적인 물류 운영을 위해 산업 단지와 통합되어 있습니다.'
                    ],
                    'tw' => [
                        'question' => '我需要有關JIIPE深水港的資訊',
                        'answer' => 'JIIPE的深水港配備了現代化設施，可容納大型船舶。該港口擁有多個泊位，並與工業園區整合，以實現高效的物流運營。'
                    ]
                ]
            ],
            [
                'position' => 9,
                'translations' => [
                    'id' => [
                        'question' => 'Berapa banyak tenant di JIIPE dan apa industri mereka?',
                        'answer' => 'Saat ini, JIIPE memiliki 17 tenant dari industri pengolahan kimia, makanan, konstruksi, dan smelter'
                    ],
                    'en' => [
                        'question' => 'How many tenants at JIIPE and what are their industries?',
                        'answer' => 'Currently, JIIPE has 17 tenants from the chemical processing, food, construction, and smelter industries'
                    ],
                    'zh' => [
                        'question' => 'JIIPE有多少租户，他们的行业是什么？',
                        'answer' => '目前，JIIPE拥有17个租户，来自化学加工、食品、建筑和冶炼行业'
                    ],
                    'ja' => [
                        'question' => 'JIIPEのテナント数と業種は何ですか？',
                        'answer' => '現在、JIIPEには化学処理、食品、建設、製錬業界の17のテナントがあります'
                    ],
                    'ko' => [
                        'question' => 'JIIPE에는 몇 개의 임차인이 있으며 그들의 산업은 무엇입니까?',
                        'answer' => '현재 JIIPE에는 화학 가공, 식품, 건설 및 제련 산업의 17개 임차인이 있습니다'
                    ],
                    'tw' => [
                        'question' => 'JIIPE有多少租戶，他們的行業是什麼？',
                        'answer' => '目前，JIIPE擁有17個租戶，來自化學加工、食品、建築和冶煉行業'
                    ]
                ]
            ],
            [
                'position' => 10,
                'translations' => [
                    'id' => [
                        'question' => 'Apa saja Fakta Energi & utilitas di JIIPE?',
                        'answer' => '<p><u><strong>FASE 1 (sudah sepenuhnya dikembangkan dan tersedia)</strong></u><br>LISTRIK: Pembangkit Listrik Dual Fuel 23 MW (Gas & bahan bakar minyak cair)<br>AIR BERSIH INDUSTRI: 100 m3/jam /(2400 m3/hari) – fasilitas Sea Water Reverse Osmosis (SWRO) dan 1500 m3/hari dari fasilitas BWRO (Daur Ulang)<br>INSTALASI PENGOLAHAN AIR LIMBAH: 2500 m3/hari (Teknologi MBR)<br>PIPA GAS ALAM: Kapasitas hingga 85 MMSCFD</p><p><strong><u>FASE 2</u></strong><br>LISTRIK: 250 MW Dual-source, Dual feeder (Akan siap tahun 2023) dan 250 MW Dual-source, Dual feeder (Akan siap tahun 2025)<br>AIR BERSIH INDUSTRI: 600 lps atau 2160 m3/jam (51840 m3/hari)</p><p><strong><u>FASE 3</u></strong><br>LISTRIK: 660 MW<br>ENERGI TERBARUKAN: Gas/LNG sesuai permintaan<br>AIR BERSIH INDUSTRI: 1000 lps (86.400m3/hari)<br>PUSAT UTILITAS untuk Layanan ICTInternet & Telekomunikasi dengan Kabel Fiber Optik – Gigabyte enabled dan Menara BTS untuk komunikasi seluler</p>'
                    ],
                    'en' => [
                        'question' => 'What are Energy & utility Facts in JIIPE?',
                        'answer' => '<p><u><strong>PHASE 1 (fully developed and available)</strong></u><br>ELECTRICITY: 23 MW Dual Fuel Power Plant (Gas & liquid fuel oil)<br>INDUSTRIAL FRESHWATER :100 m3/hour /( 2400 m3/day ) – Sea Water Reverse Osmosis (SWRO) facility and 1500 m3/day from BWRO facility (Recycle)<br>WASTEWATER TREATMENT PLANT: 2500 m3/day (MBR Technology)<br>NATURAL GAS PIPELINE: Capacity up to 85 MMSCFD</p><p><strong><u>PHASE 2</u></strong><br>ELECTRICITY: 250 MW Dual-source, Dual feeder (Will be ready in 2023) and 250 MW Dual-source, Dual feeder (Will be ready in 2025)<br>INDUSTRIAL FRESHWATER: 600 lps or 2160 m3/hour ( 51840 m3/day)</p><p><strong><u>PHASE 3</u></strong><br>ELECTRICITY: 660 MW<br>RENEWABLE ENERGY: Gas/ LNG to match demand<br>INDUSTRIAL FRESHWATER: 1000 lps ( 86,400m3/day )<br>UTILITY CENTER for ICTInternet & Telecommunication Service with Fiber Optic Cables – Gigabyte enabled and BTS Tower for cellular communication</p>'
                    ],
                    'zh' => [
                        'question' => 'JIIPE的能源和公用设施情况如何？',
                        'answer' => '<p><u><strong>第1阶段（已完全开发并可用）</strong></u><br>电力：23兆瓦双燃料发电厂（天然气和液体燃料油）<br>工业淡水：100立方米/小时（2400立方米/天）- 海水反渗透（SWRO）设施和1500立方米/天来自BWRO设施（回收）<br>废水处理厂：2500立方米/天（MBR技术）<br>天然气管道：容量高达85 MMSCFD</p><p><strong><u>第2阶段</u></strong><br>电力：250兆瓦双源双馈线（将于2023年准备就绪）和250兆瓦双源双馈线（将于2025年准备就绪）<br>工业淡水：600升/秒或2160立方米/小时（51840立方米/天）</p><p><strong><u>第3阶段</u></strong><br>电力：660兆瓦<br>可再生能源：天然气/液化天然气按需供应<br>工业淡水：1000升/秒（86,400立方米/天）<br>ICT互联网和电信服务公用设施中心，配备光纤电缆 - 千兆字节支持和用于蜂窝通信的BTS塔</p>'
                    ],
                    'ja' => [
                        'question' => 'JIIPEのエネルギーとユーティリティの事実は何ですか？',
                        'answer' => '<p><u><strong>フェーズ1（完全に開発され利用可能）</strong></u><br>電力：23 MW デュアル燃料発電所（ガス＆液体燃料油）<br>工業用淡水：100 m3/時間（2400 m3/日）- 海水逆浸透（SWRO）施設および1500 m3/日 BWROファシリティ（リサイクル）から<br>排水処理プラント：2500 m3/日（MBR技術）<br>天然ガスパイプライン：最大85 MMSCFDの容量</p><p><strong><u>フェーズ2</u></strong><br>電力：250 MW デュアルソース、デュアルフィーダー（2023年に準備完了）および250 MW デュアルソース、デュアルフィーダー（2025年に準備完了）<br>工業用淡水：600リットル/秒または2160 m3/時間（51840 m3/日）</p><p><strong><u>フェーズ3</u></strong><br>電力：660 MW<br>再生可能エネルギー：需要に応じたガス/LNG<br>工業用淡水：1000リットル/秒（86,400m3/日）<br>光ファイバーケーブルを使用したICTインターネット＆通信サービスのユーティリティセンター - ギガバイト対応およびセルラー通信用BTSタワー</p>'
                    ],
                    'ko' => [
                        'question' => 'JIIPE의 에너지 및 유틸리티 사실은 무엇입니까?',
                        'answer' => '<p><u><strong>1단계 (완전히 개발되어 사용 가능)</strong></u><br>전기: 23 MW 이중 연료 발전소 (가스 및 액체 연료유)<br>산업용 담수: 100 m3/시간 (2400 m3/일) – 해수 역삼투압 (SWRO) 시설 및 1500 m3/일 BWRO 시설 (재활용)에서<br>폐수 처리 시설: 2500 m3/일 (MBR 기술)<br>천연 가스 파이프라인: 최대 85 MMSCFD 용량</p><p><strong><u>2단계</u></strong><br>전기: 250 MW 이중 소스, 이중 피더 (2023년 준비 예정) 및 250 MW 이중 소스, 이중 피더 (2025년 준비 예정)<br>산업용 담수: 600 리터/초 또는 2160 m3/시간 (51840 m3/일)</p><p><strong><u>3단계</u></strong><br>전기: 660 MW<br>재생 에너지: 수요에 맞춘 가스/LNG<br>산업용 담수: 1000 리터/초 (86,400m3/일)<br>광섬유 케이블을 사용한 ICT 인터넷 및 통신 서비스용 유틸리티 센터 - 기가바이트 지원 및 셀룰러 통신용 BTS 타워</p>'
                    ],
                    'tw' => [
                        'question' => 'JIIPE的能源和公用設施情況如何？',
                        'answer' => '<p><u><strong>第1階段（已完全開發並可用）</strong></u><br>電力：23兆瓦雙燃料發電廠（天然氣和液體燃料油）<br>工業淡水：100立方米/小時（2400立方米/天）- 海水反滲透（SWRO）設施和1500立方米/天來自BWRO設施（回收）<br>廢水處理廠：2500立方米/天（MBR技術）<br>天然氣管道：容量高達85 MMSCFD</p><p><strong><u>第2階段</u></strong><br>電力：250兆瓦雙源雙饋線（將於2023年準備就緒）和250兆瓦雙源雙饋線（將於2025年準備就緒）<br>工業淡水：600升/秒或2160立方米/小時（51840立方米/天）</p><p><strong><u>第3階段</u></strong><br>電力：660兆瓦<br>可再生能源：天然氣/液化天然氣按需供應<br>工業淡水：1000升/秒（86,400立方米/天）<br>ICT互聯網和電信服務公用設施中心，配備光纖電纜 - 千兆字節支援和用於蜂窩通訊的BTS塔</p>'
                    ]
                ]
            ],
            [
                'position' => 11,
                'translations' => [
                    'id' => [
                        'question' => 'Apa yang membuat Indonesia menjadi tujuan investasi yang menjanjikan?',
                        'answer' => 'Indonesia adalah negara dengan populasi terbesar keempat di dunia dengan tenaga kerja muda dan pasar domestik yang besar dan terus berkembang karena bonus demografi, menjadikan Indonesia salah satu ekonomi terkemuka dunia. Meskipun ketidakpastian global meningkat, prospek ekonomi Indonesia terus positif, dengan permintaan domestik menjadi pendorong utama pertumbuhan. Sebagai satu-satunya anggota G-20 di Asia Tenggara dan suara aktif untuk mengembangkan kepentingan dunia, Indonesia memainkan peran yang lebih penting di panggung global. Standard Chartered memperkirakan masuknya Indonesia ke G-7 pada 2030 dan memproyeksikan bahwa ekonomi Indonesia bisa menjadi yang ke-10 terbesar pada 2020 dan ke-5 terbesar pada 2030. Sebagai demokrasi berkembang terbesar ke-3 di dunia dengan populasi Muslim terbesar, Indonesia memiliki situasi kebijakan yang stabil dengan komitmen tinggi untuk menerapkan reformasi struktural. Survei Worldwide Governance Indicators yang dilakukan Bank Dunia menunjukkan bahwa Indonesia memiliki peningkatan dalam beberapa indikator seperti Efektivitas Pemerintahan, Kualitas Regulasi, dan Pengendalian Korupsi.'
                    ],
                    'en' => [
                        'question' => 'What makes Indonesia the promising destination for investment?',
                        'answer' => 'Indonesia is the fourth most populous country in the world with a young workforce and a large and growing domestic market due to the demographic bonus, making Indonesia one of the world\'s leading economies. Despite heightened global uncertainty, Indonesia\'s economic outlook continues to be positive, with domestic demand being the main driver of growth. As the only G-20 member in Southeast Asia and an active voice to develop world concerns, Indonesia plays a more significant role on the global stage. Standard Chartered foresees Indonesia\'s entry into the G-7 by 2030 and projects that the Indonesian economy could become the 10th largest by 2020 and the 5th largest by 2030. Being the world\'s 3rd largest flourishing democracy with the largest Muslim population, Indonesia has a stable policy situation with a high commitment to implement structural reforms. Worldwide Governance Indicators Survey conducted by World Bank indicated that Indonesia has improvements in several indicators such as Government Effectiveness, Regulatory Quality, and Control of Corruption.'
                    ],
                    'zh' => [
                        'question' => '是什么使印度尼西亚成为有前景的投资目的地？',
                        'answer' => '印度尼西亚是世界第四大人口大国，拥有年轻的劳动力和由于人口红利而不断增长的庞大国内市场，使印度尼西亚成为世界领先的经济体之一。尽管全球不确定性加剧，但印度尼西亚的经济前景继续保持积极，国内需求是增长的主要驱动力。作为东南亚唯一的G-20成员国和积极发展世界关注的声音，印度尼西亚在全球舞台上发挥着更重要的作用。渣打银行预计印度尼西亚将在2030年进入G-7，并预测印度尼西亚经济可能在2020年成为第10大经济体，到2030年成为第5大经济体。作为世界第三大繁荣的民主国家，拥有最大的穆斯林人口，印度尼西亚具有稳定的政策局势，高度致力于实施结构性改革。世界银行进行的全球治理指标调查表明，印度尼西亚在政府效能、监管质量和腐败控制等几个指标上有所改善。'
                    ],
                    'ja' => [
                        'question' => 'インドネシアが有望な投資先となる理由は何ですか？',
                        'answer' => 'インドネシアは世界第4位の人口を持つ国で、若い労働力と人口ボーナスによる大きく成長する国内市場を持ち、インドネシアを世界有数の経済大国の1つにしています。世界的な不確実性が高まっているにもかかわらず、インドネシアの経済見通しは引き続き前向きであり、国内需要が成長の主な原動力となっています。東南アジアで唯一のG-20メンバーとして、また世界の懸念を発展させる積極的な声として、インドネシアは世界の舞台でより重要な役割を果たしています。スタンダードチャータード銀行は、インドネシアが2030年までにG-7に参加すると予測し、インドネシア経済が2020年までに世界第10位、2030年までに第5位になる可能性があると予測しています。世界第3位の繁栄する民主主義国であり、最大のイスラム教人口を持つインドネシアは、構造改革を実施する高いコミットメントを持つ安定した政策状況を持っています。世界銀行が実施した世界ガバナンス指標調査は、インドネシアが政府の有効性、規制の質、腐敗の管理などいくつかの指標で改善していることを示しています。'
                    ],
                    'ko' => [
                        'question' => '인도네시아가 유망한 투자 목적지가 되는 이유는 무엇입니까?',
                        'answer' => '인도네시아는 세계에서 네 번째로 인구가 많은 국가로 젊은 노동력과 인구 보너스로 인한 크고 성장하는 국내 시장을 보유하고 있어 인도네시아를 세계 주요 경제 국가 중 하나로 만들고 있습니다. 전 세계적인 불확실성이 높아지고 있음에도 불구하고 인도네시아의 경제 전망은 계속 긍정적이며 국내 수요가 성장의 주요 원동력입니다. 동남아시아에서 유일한 G-20 회원국이자 세계 문제를 발전시키는 적극적인 목소리로서 인도네시아는 세계 무대에서 더 중요한 역할을 하고 있습니다. 스탠다드 차타드는 인도네시아가 2030년까지 G-7에 진입할 것으로 예상하며 인도네시아 경제가 2020년까지 세계 10위, 2030년까지 5위가 될 수 있다고 예측합니다. 세계에서 세 번째로 큰 번영하는 민주주의 국가이자 가장 큰 무슬림 인구를 가진 인도네시아는 구조 개혁을 시행하겠다는 높은 의지를 가진 안정적인 정책 상황을 가지고 있습니다. 세계은행이 실시한 전 세계 거버넌스 지표 조사에 따르면 인도네시아는 정부 효율성, 규제 품질 및 부패 통제와 같은 여러 지표에서 개선을 보였습니다.'
                    ],
                    'tw' => [
                        'question' => '是什麼使印尼成為有前景的投資目的地？',
                        'answer' => '印尼是世界第四大人口大國，擁有年輕的勞動力和由於人口紅利而不斷增長的龐大國內市場，使印尼成為世界領先的經濟體之一。儘管全球不確定性加劇，但印尼的經濟前景繼續保持積極，國內需求是增長的主要驅動力。作為東南亞唯一的G-20成員國和積極發展世界關注的聲音，印尼在全球舞台上發揮著更重要的作用。渣打銀行預計印尼將在2030年進入G-7，並預測印尼經濟可能在2020年成為第10大經濟體，到2030年成為第5大經濟體。作為世界第三大繁榮的民主國家，擁有最大的穆斯林人口，印尼具有穩定的政策局勢，高度致力於實施結構性改革。世界銀行進行的全球治理指標調查表明，印尼在政府效能、監管品質和腐敗控制等幾個指標上有所改善。'
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