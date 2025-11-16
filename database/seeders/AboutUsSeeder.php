<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutUsHeader;
use App\Models\AboutUsHeaderTranslation;
use App\Models\AboutUsVisionMision;
use App\Models\AboutUsVisionMisionTranslation;
use App\Models\AboutUsContentDetailTranslation;
use App\Models\AboutUsContentDetail;
use App\Models\AboutUsContentDetailCategoriesTranslation;
use App\Models\AboutUsContentDetailCategories;
class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        AboutUsHeaderTranslation::truncate();
        AboutUsHeader::truncate();
        AboutUsVisionMisionTranslation::truncate();
        AboutUsVisionMision::truncate();
        AboutUsContentDetailTranslation::truncate();
        AboutUsContentDetail::truncate();
        AboutUsContentDetailCategoriesTranslation::truncate();
        AboutUsContentDetailCategories::truncate();

        // Create About Us Header
        $aboutUsHeader = AboutUsHeader::create([
            'image' => 'thumb_457e8ef010profil-sec1_adaptiveResize_686_426.jpg'
        ]);

        // Translations data
        $aboutUsHeaderTranslations = [
            [
                'locale' => 'id',
                'title' => 'Kontribusi JIIPE',
                'description' => '<p>Tingginya biaya logistik di Indonesia sebagai negara kepulauan berdampak pada harga barang yang beredar di pasar. Melalui konektivitas domestik dan internasional yang dikembangkan oleh kawasan terpadu JIIPE, pelaku usaha dapat menghemat biaya tersebut dan menghasilkan barang dengan harga yang lebih kompetitif.</p>
<p>JIIPE adalah kawasan terpadu pertama di Indonesia, dengan luas total 3.000 hektar, yang terdiri dari kawasan industri, pelabuhan umum multifungsi, dan kota hunian. Berlokasi di Gresik, Provinsi Jawa Timur, JIIPE merupakan kawasan percontohan pengembangan industri di Indonesia.</p>
<p>Kawasan industri JIIPE seluas 1761 ha dengan fasilitas pelabuhan laut seluas 400 ha, dan hunian dengan konsep kota mandiri seluas 800 ha merupakan proyek swasta pemerintah bersama antara Pelabuhan Indonesia III (Pelindo III melalui anak perusahaannya PT Berlian Jasa Terminal Indonesia yang dikenal sebagai BJTI Port) dengan PT Aneka Kimia Raya Corporindo Tbk (AKR Corp melalui anak perusahaannya PT Usaha Era Pratama Nusantara).</p>
<p>JIIPE Port adalah yang terdalam di Jawa Timur dengan -16 LWS, 4 dermaga multifungsi dengan panjang sandar 6.200 meter, yang diharapkan dapat melayani kapal-kapal besar dengan muatan lebih dari 100.000 DWT. Akses internasional dan domestik difasilitasi dengan konektivitas laut, tol, dan kereta api.</p>'
            ],
            [
                'locale' => 'en',
                'title' => 'JIIPE Contributions',
                'description' => '<p>The high logistics costs in Indonesia as an archipelagic country have an effect on the price of goods circulating in the market. Through domestic and international connectivity developed by JIIPE integrated areas, actors can save these costs and produce goods at more competitive prices.</p>
<p>JIIPE is the first integrated area in Indonesia, with a total area of 3,000 hectares, consisting of industrial estates, multifunctional public ports, and residential cities. Located in Gresik, East Java province, JIIPE is a pilot area for industrial development in Indonesia.</p>
<p>JIIPE industrial area covering 1761 ha with sea port facilities in an area of 400 ha, and occupancy with the concept of an independent city in an area of 800 ha is a joint government private project between Pelabuhan Indonesia III (Pelindo III through its subsidiary PT Berlian Jasa Terminal Indonesia known as BJTI Port) with PT Aneka Kimia Raya Corporindo Tbk (AKR Corp through its subsidiary PT Usaha Era Pratama Nusantara).</p>
<p>JIIPE Port is the deepest in East Java with -16 LWS, 4 multifunction piers with 6,200 meters of berth, which are expected to be able to serve large vessels with loads of more than 100,000 DWT. International and domestic access is accommodated with sea, toll and train connectivity.</p>'
            ],
            [
                'locale' => 'zh',
                'title' => 'JIIPE 贡献',
                'description' => '<p>印度尼西亚作为群岛国家的高昂物流成本对市场上流通的商品价格产生影响。通过JIIPE综合区开发的国内和国际连通性，企业可以节省这些成本并以更具竞争力的价格生产商品。</p>
<p>JIIPE是印度尼西亚第一个综合区，总面积3000公顷，由工业园区、多功能公共港口和住宅城市组成。JIIPE位于东爪哇省格雷西克，是印度尼西亚工业发展的试点区域。</p>
<p>JIIPE工业区占地1761公顷，海港设施占地400公顷，独立城市概念的居住区占地800公顷，是印度尼西亚港口三公司（Pelindo III通过其子公司PT Berlian Jasa Terminal Indonesia即BJTI Port）与PT Aneka Kimia Raya Corporindo Tbk（AKR Corp通过其子公司PT Usaha Era Pratama Nusantara）之间的政府私营联合项目。</p>
<p>JIIPE港口是东爪哇最深的港口，水深-16 LWS，拥有4个多功能码头，泊位长6200米，预计能够为装载量超过100,000吨的大型船舶提供服务。国际和国内通道通过海运、高速公路和铁路连通性得到满足。</p>'
            ],
            [
                'locale' => 'ja',
                'title' => 'JIIPEの貢献',
                'description' => '<p>群島国家であるインドネシアの高い物流コストは、市場で流通する商品の価格に影響を与えています。JIIPE統合エリアが開発する国内外の接続性を通じて、事業者はこれらのコストを節約し、より競争力のある価格で商品を生産できます。</p>
<p>JIIPEはインドネシア初の統合エリアで、総面積3,000ヘクタール、工業団地、多機能公共港、住宅都市で構成されています。東ジャワ州グレシックに位置するJIIPEは、インドネシアの産業開発のパイロットエリアです。</p>
<p>1761ヘクタールのJIIPE工業地域、400ヘクタールの海港施設、800ヘクタールの独立都市コンセプトの居住区は、Pelabuhan Indonesia III（Pelindo IIIの子会社PT Berlian Jasa Terminal Indonesia、通称BJTI Port）とPT Aneka Kimia Raya Corporindo Tbk（AKR Corpの子会社PT Usaha Era Pratama Nusantara）の官民共同プロジェクトです。</p>
<p>JIIPE港は東ジャワで最も深い港で、-16 LWS、4つの多機能埠頭、6,200メートルの係船岸を持ち、100,000 DWT以上の積載量を持つ大型船舶にサービスを提供できることが期待されています。国際および国内のアクセスは、海上、高速道路、鉄道の接続性によって対応されています。</p>'
            ],
            [
                'locale' => 'ko',
                'title' => 'JIIPE 기여',
                'description' => '<p>군도 국가인 인도네시아의 높은 물류 비용은 시장에서 유통되는 상품 가격에 영향을 미칩니다. JIIPE 통합 지역이 개발한 국내 및 국제 연결성을 통해 기업은 이러한 비용을 절감하고 더 경쟁력 있는 가격으로 상품을 생산할 수 있습니다.</p>
<p>JIIPE는 인도네시아 최초의 통합 지역으로, 총 면적 3,000헥타르로 산업 단지, 다기능 공공 항구 및 주거 도시로 구성되어 있습니다. 동자바 주 그레식에 위치한 JIIPE는 인도네시아의 산업 개발 시범 지역입니다.</p>
<p>1761헥타르의 JIIPE 산업 지역, 400헥타르의 해상 항구 시설, 800헥타르의 독립 도시 개념의 거주 지역은 Pelabuhan Indonesia III(자회사 PT Berlian Jasa Terminal Indonesia, BJTI Port로 알려진 Pelindo III)와 PT Aneka Kimia Raya Corporindo Tbk(자회사 PT Usaha Era Pratama Nusantara를 통한 AKR Corp) 간의 정부 민간 합작 프로젝트입니다.</p>
<p>JIIPE 항구는 -16 LWS로 동자바에서 가장 깊으며, 6,200미터의 접안 시설을 갖춘 4개의 다기능 부두를 보유하고 있어 100,000 DWT 이상의 화물을 실은 대형 선박에 서비스를 제공할 것으로 예상됩니다. 국제 및 국내 접근은 해상, 고속도로 및 철도 연결성으로 수용됩니다.</p>'
            ],
            [
                'locale' => 'tw',
                'title' => 'JIIPE 貢獻',
                'description' => '<p>印尼作為群島國家的高昂物流成本對市場上流通的商品價格產生影響。通過JIIPE綜合區開發的國內和國際連通性，企業可以節省這些成本並以更具競爭力的價格生產商品。</p>
<p>JIIPE是印尼第一個綜合區，總面積3000公頃，由工業園區、多功能公共港口和住宅城市組成。JIIPE位於東爪哇省格雷西克，是印尼工業發展的試點區域。</p>
<p>JIIPE工業區佔地1761公頃，海港設施佔地400公頃，獨立城市概念的居住區佔地800公頃，是印尼港口三公司（Pelindo III通過其子公司PT Berlian Jasa Terminal Indonesia即BJTI Port）與PT Aneka Kimia Raya Corporindo Tbk（AKR Corp通過其子公司PT Usaha Era Pratama Nusantara）之間的政府私營聯合項目。</p>
<p>JIIPE港口是東爪哇最深的港口，水深-16 LWS，擁有4個多功能碼頭，泊位長6200米，預計能夠為裝載量超過100,000噸的大型船舶提供服務。國際和國內通道通過海運、高速公路和鐵路連通性得到滿足。</p>'
            ]
        ];

        // Insert translations
        foreach ($aboutUsHeaderTranslations as $translation) {
            AboutUsHeaderTranslation::create([
                'about_us_header_id' => $aboutUsHeader->id,
                'locale' => $translation['locale'],
                'title' => $translation['title'],
                'description' => $translation['description']
            ]);
        }

        $this->command->info('About Us Header seeder completed successfully!');

        // about us visi misi
        // Create About Us Vision Mission
        $visionMision = AboutUsVisionMision::create([]);

        // Translations data
        $visionMisionTranslations = [
            [
                'locale' => 'id',
                'title' => 'Visi & Misi',
                'vision' => 'Mendukung penyewa untuk mengurangi biaya logistik, menyediakan utilitas yang handal dan kemudahan dalam berbisnis',
                'mission' => 'Mengoptimalkan potensi kami untuk membangun nilai pemangku kepentingan yang berkelanjutan'
            ],
            [
                'locale' => 'en',
                'title' => 'Vision & Mission',
                'vision' => 'To Support tenant to reduce logistic costs, provide reliable utilities and ease of doing business',
                'mission' => 'Optimizing our potential to build sustainable stakeholder value'
            ],
            [
                'locale' => 'zh',
                'title' => '愿景与使命',
                'vision' => '支持租户降低物流成本，提供可靠的公用设施和便利的营商环境',
                'mission' => '优化我们的潜力以建立可持续的利益相关者价值'
            ],
            [
                'locale' => 'ja',
                'title' => 'ビジョン＆ミッション',
                'vision' => 'テナントの物流コスト削減を支援し、信頼性の高いユーティリティとビジネスのしやすさを提供する',
                'mission' => '持続可能なステークホルダー価値を構築するために私たちの潜在能力を最適化する'
            ],
            [
                'locale' => 'ko',
                'title' => '비전 & 미션',
                'vision' => '임차인의 물류 비용 절감을 지원하고 신뢰할 수 있는 유틸리티와 비즈니스 편의성을 제공합니다',
                'mission' => '지속 가능한 이해관계자 가치를 구축하기 위해 우리의 잠재력을 최적화합니다'
            ],
            [
                'locale' => 'tw',
                'title' => '願景與使命',
                'vision' => '支持租戶降低物流成本，提供可靠的公用設施和便利的營商環境',
                'mission' => '優化我們的潛力以建立可持續的利益相關者價值'
            ]
        ];

        // Insert translations
        foreach ($visionMisionTranslations as $translation) {
            AboutUsVisionMisionTranslation::create([
                'about_us_vision_mision_id' => $visionMision->id,
                'locale' => $translation['locale'],
                'title' => $translation['title'],
                'vision' => $translation['vision'],
                'mission' => $translation['mission']
            ]);
        }

        $this->command->info('About Us Vision Mission seeder completed successfully!');

        // content detail seeder
        // ========== CATEGORY 1: JIIPE Industrial Estate Developer ==========
        $category1 = AboutUsContentDetailCategories::create([]);

        $category1Translations = [
            ['locale' => 'id', 'name' => 'Pengembang Kawasan Industri JIIPE di Gresik'],
            ['locale' => 'en', 'name' => 'JIIPE Industrial Estate Developer in Gresik'],
            ['locale' => 'zh', 'name' => 'JIIPE格雷西克工业园区开发商'],
            ['locale' => 'ja', 'name' => 'JIIPEグレシック工業団地開発者'],
            ['locale' => 'ko', 'name' => 'JIIPE 그레식 산업 단지 개발자'],
            ['locale' => 'tw', 'name' => 'JIIPE格雷西克工業園區開發商'],
        ];

        foreach ($category1Translations as $translation) {
            AboutUsContentDetailCategoriesTranslation::create([
                'about_us_content_detail_category_id' => $category1->id,
                'locale' => $translation['locale'],
                'name' => $translation['name']
            ]);
        }

        // Content Detail 1.1: PT Berkah Kawasan Manyar Sejahtera
        $content1_1 = AboutUsContentDetail::create([
            'icon' => 'a45286c7f8logo-profil.png',
            'category_id' => $category1->id
        ]);

        $content1_1Translations = [
            [
                'locale' => 'id',
                'title' => 'PT Berkah Kawasan Manyar Sejahtera',
                'description' => '<p>Pengembang kawasan industri dengan luas total 1761 Ha, dibentuk sebagai kemitraan publik-swasta antara PT. AKR Corporindo Tbk (60% - melalui anak perusahaannya, PT Usaha Era Pratama Nusantara) dan PT Pelabuhan Indonesia (40% - melalui anak perusahaannya PT Berlian Jasa Terminal Indonesia)</p>'
            ],
            [
                'locale' => 'en',
                'title' => 'PT Berkah Kawasan Manyar Sejahtera',
                'description' => '<p>The developer of industrial estate with total area of 1761 Ha, formed as a public private partnership between PT. AKR Corporindo Tbk (60% - through its subsidiary, PT Usaha Era Pratama Nusantara) and PT Pelabuhan Indonesia (40% - through its subsidiary PT Berlian Jasa Terminal Indonesia)</p>'
            ],
            [
                'locale' => 'zh',
                'title' => 'PT Berkah Kawasan Manyar Sejahtera',
                'description' => '<p>总面积1761公顷的工业园区开发商，由PT. AKR Corporindo Tbk（60% - 通过其子公司PT Usaha Era Pratama Nusantara）和PT Pelabuhan Indonesia（40% - 通过其子公司PT Berlian Jasa Terminal Indonesia）组成的公私合作伙伴关系</p>'
            ],
            [
                'locale' => 'ja',
                'title' => 'PT Berkah Kawasan Manyar Sejahtera',
                'description' => '<p>総面積1761ヘクタールの工業団地開発者。PT. AKR Corporindo Tbk（60% - 子会社PT Usaha Era Pratama Nusantara経由）とPT Pelabuhan Indonesia（40% - 子会社PT Berlian Jasa Terminal Indonesia経由）の官民パートナーシップとして設立</p>'
            ],
            [
                'locale' => 'ko',
                'title' => 'PT Berkah Kawasan Manyar Sejahtera',
                'description' => '<p>총 면적 1761헥타르의 산업 단지 개발자로, PT. AKR Corporindo Tbk (60% - 자회사 PT Usaha Era Pratama Nusantara를 통해)와 PT Pelabuhan Indonesia (40% - 자회사 PT Berlian Jasa Terminal Indonesia를 통해) 간의 민관 파트너십으로 구성</p>'
            ],
            [
                'locale' => 'tw',
                'title' => 'PT Berkah Kawasan Manyar Sejahtera',
                'description' => '<p>總面積1761公頃的工業園區開發商，由PT. AKR Corporindo Tbk（60% - 通過其子公司PT Usaha Era Pratama Nusantara）和PT Pelabuhan Indonesia（40% - 通過其子公司PT Berlian Jasa Terminal Indonesia）組成的公私合作夥伴關係</p>'
            ],
        ];

        foreach ($content1_1Translations as $translation) {
            AboutUsContentDetailTranslation::create([
                'about_us_content_detail_id' => $content1_1->id,
                'locale' => $translation['locale'],
                'title' => $translation['title'],
                'description' => $translation['description']
            ]);
        }

        // Content Detail 1.2: PT Berlian Manyar Sejahtera
        $content1_2 = AboutUsContentDetail::create([
            'icon' => '0f44050b48bms.png',
            'category_id' => $category1->id
        ]);

        $content1_2Translations = [
            [
                'locale' => 'id',
                'title' => 'PT Berlian Manyar Sejahtera',
                'description' => '<p>Pengembang pelabuhan umum seluas 400 Ha, dibentuk sebagai kemitraan publik-swasta antara PT AKR Corporindo Tbk (40% - melalui anak perusahaannya, PT Usaha Era Pratama Nusantara) dan PT Pelabuhan Indonesia (60% - melalui anak perusahaannya PT Berlian Jasa Terminal Indonesia)</p>'
            ],
            [
                'locale' => 'en',
                'title' => 'PT Berlian Manyar Sejahtera',
                'description' => '<p>The developer of 400 Ha public port, formed as a public private partnership between PT AKR Corporindo Tbk (40% - through its subsidiary, PT Usaha Era Pratama Nusantara) and PT Pelabuhan Indonesia (60% - through its subsidiary PT Berlian Jasa Terminal Indonesia)</p>'
            ],
            [
                'locale' => 'zh',
                'title' => 'PT Berlian Manyar Sejahtera',
                'description' => '<p>400公顷公共港口的开发商，由PT AKR Corporindo Tbk（40% - 通过其子公司PT Usaha Era Pratama Nusantara）和PT Pelabuhan Indonesia（60% - 通过其子公司PT Berlian Jasa Terminal Indonesia）组成的公私合作伙伴关系</p>'
            ],
            [
                'locale' => 'ja',
                'title' => 'PT Berlian Manyar Sejahtera',
                'description' => '<p>400ヘクタールの公共港開発者。PT AKR Corporindo Tbk（40% - 子会社PT Usaha Era Pratama Nusantara経由）とPT Pelabuhan Indonesia（60% - 子会社PT Berlian Jasa Terminal Indonesia経由）の官民パートナーシップとして設立</p>'
            ],
            [
                'locale' => 'ko',
                'title' => 'PT Berlian Manyar Sejahtera',
                'description' => '<p>400헥타르 공공 항구 개발자로, PT AKR Corporindo Tbk (40% - 자회사 PT Usaha Era Pratama Nusantara를 통해)와 PT Pelabuhan Indonesia (60% - 자회사 PT Berlian Jasa Terminal Indonesia를 통해) 간의 민관 파트너십으로 구성</p>'
            ],
            [
                'locale' => 'tw',
                'title' => 'PT Berlian Manyar Sejahtera',
                'description' => '<p>400公頃公共港口的開發商，由PT AKR Corporindo Tbk（40% - 通過其子公司PT Usaha Era Pratama Nusantara）和PT Pelabuhan Indonesia（60% - 通過其子公司PT Berlian Jasa Terminal Indonesia）組成的公私合作夥伴關係</p>'
            ],
        ];

        foreach ($content1_2Translations as $translation) {
            AboutUsContentDetailTranslation::create([
                'about_us_content_detail_id' => $content1_2->id,
                'locale' => $translation['locale'],
                'title' => $translation['title'],
                'description' => $translation['description']
            ]);
        }

        // Content Detail 1.3: AKR GEM City
        $content1_3 = AboutUsContentDetail::create([
            'icon' => '0551ae292fakr land.png',
            'category_id' => $category1->id
        ]);

        $content1_3Translations = [
            [
                'locale' => 'id',
                'title' => 'AKR GEM City',
                'description' => '<p>Pengembang kawasan hunian dengan konsep kota mandiri seluas 800 Ha, merupakan anak perusahaan dari AKR Corporindo Tbk</p>'
            ],
            [
                'locale' => 'en',
                'title' => 'AKR GEM City',
                'description' => '<p>The developer of residential area with township concept of 800 Ha area, is a subsidiary of AKR Corporindo Tbk</p>'
            ],
            [
                'locale' => 'zh',
                'title' => 'AKR GEM City',
                'description' => '<p>800公顷城镇概念住宅区的开发商，是AKR Corporindo Tbk的子公司</p>'
            ],
            [
                'locale' => 'ja',
                'title' => 'AKR GEM City',
                'description' => '<p>800ヘクタールのタウンシップコンセプトの住宅地開発者、AKR Corporindo Tbkの子会社</p>'
            ],
            [
                'locale' => 'ko',
                'title' => 'AKR GEM City',
                'description' => '<p>800헥타르 면적의 타운십 개념 주거 지역 개발자로, AKR Corporindo Tbk의 자회사입니다</p>'
            ],
            [
                'locale' => 'tw',
                'title' => 'AKR GEM City',
                'description' => '<p>800公頃城鎮概念住宅區的開發商，是AKR Corporindo Tbk的子公司</p>'
            ],
        ];

        foreach ($content1_3Translations as $translation) {
            AboutUsContentDetailTranslation::create([
                'about_us_content_detail_id' => $content1_3->id,
                'locale' => $translation['locale'],
                'title' => $translation['title'],
                'description' => $translation['description']
            ]);
        }

        // ========== CATEGORY 2: About JIIPE Integrated Zone Shareholders ==========
        $category2 = AboutUsContentDetailCategories::create([]);

        $category2Translations = [
            ['locale' => 'id', 'name' => 'Tentang Pemegang Saham Zona Terintegrasi JIIPE'],
            ['locale' => 'en', 'name' => 'About JIIPE Integrated Zone Shareholders'],
            ['locale' => 'zh', 'name' => '关于JIIPE综合区股东'],
            ['locale' => 'ja', 'name' => 'JIIPE統合ゾーン株主について'],
            ['locale' => 'ko', 'name' => 'JIIPE 통합 구역 주주 소개'],
            ['locale' => 'tw', 'name' => '關於JIIPE綜合區股東'],
        ];

        foreach ($category2Translations as $translation) {
            AboutUsContentDetailCategoriesTranslation::create([
                'about_us_content_detail_category_id' => $category2->id,
                'locale' => $translation['locale'],
                'name' => $translation['name']
            ]);
        }

        // Content Detail 2.1: PT AKR Corporindo
        $content2_1 = AboutUsContentDetail::create([
            'icon' => 'f7af8cb6eclogo AKR Corp.png',
            'category_id' => $category2->id
        ]);

        $content2_1Translations = [
            [
                'locale' => 'id',
                'title' => 'PT AKR Corporindo',
                'description' => '<p>PT AKR Corporindo TBk adalah perusahaan solusi logistik dan rantai pasokan terintegrasi yang beroperasi dalam distribusi minyak bumi dan bahan kimia dasar, layanan logistik, manufaktur sorbitol dan bahan perekat, serta penambangan dan perdagangan batu bara. Perusahaan ini didirikan pada 28 November 1977 dengan nama PT Aneka Kimia Raya. Perusahaan menjadi perusahaan publik pada tahun 1994 dan kemudian mengubah namanya menjadi PT AKR Corporindo TBk pada tahun 2004.</p><p>Aset perusahaan yang luas meliputi pelabuhan laut dan pelabuhan sungai di Indonesia, terminal tangki untuk minyak bumi dan bahan kimia dasar, fasilitas manufaktur sorbitol dan bahan perekat, tongkang minyak bergerak sendiri, truk, gudang, fasilitas manufaktur sorbitol dan bahan perekat, dan aset lainnya.</p><p>Perusahaan adalah perusahaan swasta nasional pertama yang memasuki bisnis distribusi minyak bumi non-subsidi sejak tahun 2005. Perusahaan juga merupakan perusahaan swasta nasional pertama yang dipercaya oleh BPH Migas untuk mendistribusikan minyak bumi bersubsidi sejak tahun 2010. Mengingat infrastruktur perusahaan dan jaringan logistik yang luas, BPH Migas telah menugaskan perusahaan untuk mendistribusikan minyak bumi bersubsidi di berbagai wilayah di Indonesia.</p><p>Perusahaan menerima alokasi 640.000 KL minyak bumi bersubsidi untuk tahun 2014. Wilayah distribusi kini diperluas untuk mencakup kota-kota di provinsi Sumatera Utara, Lampung, Jakarta, Banten, Jawa Barat, Jawa Tengah, Yogyakarta, Jawa Timur, Bali, Kalimantan Barat, Kalimantan Selatan, Kalimantan Timur dan Sulawesi Selatan.</p>'
            ],
            [
                'locale' => 'en',
                'title' => 'PT AKR Corporindo',
                'description' => '<p>PT AKR Corporindo TBk is an integrated logistics and supply chain solutions company that operates in distribution of petroleum and basic chemicals, logistic services, manufacturing of sorbitol and adhesive materials, and also coal mining and trading. The company was established on November 28, 1977 under tha name of PT Aneka Kimia Raya. The company became a public listed company in 1994 and later changed its name to PT AKR Corporindo TBk in 2004.</p><p>The company\'s extensive assets include sea ports and river ports in Indonesia, tank terminals for petroleum and basic chemicals, manufacturing facilities of sorbitol and adhesive materials, self-propelled oil barges, trucks, warehouses, manufacturing facilities of sorbitol and adhesive materials, and other assets.</p><p>The company is the first national private company to enter the non-subsidized petroleum distribution business since 2005. The company is also the first national private company trusted by BPH Migas to distribute subsidized petroleum since 2010. Considering the company\'s infrastructure and extensive logistic network, BPH Migas has assigned the company to distribute subsidized petroleum in various regions in Indoneisa.</p><p>The Company received allocation of 640.000 KL of susidized petroleum for the year 2014. The area of distribution is now expanded to include cities in the province of North Sumatera, Lampung, Jakarta, Banten, West Java, Central Java, Yogyakarta, East Java, Bali, West Kalimantan, South Kalimantan, East Kalimantan and South Sulawesi.</p>'
            ],
            [
                'locale' => 'zh',
                'title' => 'PT AKR Corporindo',
                'description' => '<p>PT AKR Corporindo TBk是一家综合物流和供应链解决方案公司，经营石油和基础化学品分销、物流服务、山梨醇和粘合材料制造，以及煤炭开采和贸易。该公司于1977年11月28日以PT Aneka Kimia Raya的名称成立。该公司于1994年成为上市公司，后于2004年更名为PT AKR Corporindo TBk。</p><p>该公司的广泛资产包括印尼的海港和河港、石油和基础化学品的储罐码头、山梨醇和粘合材料的制造设施、自航式油驳船、卡车、仓库、山梨醇和粘合材料的制造设施以及其他资产。</p><p>该公司是自2005年以来第一家进入非补贴石油分销业务的国家私营公司。该公司也是自2010年以来第一家受BPH Migas信任分销补贴石油的国家私营公司。考虑到该公司的基础设施和广泛的物流网络，BPH Migas已指派该公司在印尼各地区分销补贴石油。</p><p>该公司获得2014年640,000千升补贴石油的分配。分销区域现已扩大到包括北苏门答腊、楠榜、雅加达、万丹、西爪哇、中爪哇、日惹、东爪哇、巴厘岛、西加里曼丹、南加里曼丹、东加里曼丹和南苏拉威西省的城市。</p>'
            ],
            [
                'locale' => 'ja',
                'title' => 'PT AKR Corporindo',
                'description' => '<p>PT AKR Corporindo TBkは、石油および基礎化学品の流通、物流サービス、ソルビトールおよび接着材料の製造、石炭採掘および取引を行う統合物流およびサプライチェーンソリューション企業です。同社は1977年11月28日にPT Aneka Kimia Rayaという名称で設立されました。同社は1994年に上場企業となり、2004年にPT AKR Corporindo TBkに社名を変更しました。</p><p>同社の広範な資産には、インドネシアの海港および河川港、石油および基礎化学品用のタンクターミナル、ソルビトールおよび接着材料の製造施設、自走式石油はしけ、トラック、倉庫、ソルビトールおよび接着材料の製造施設、その他の資産が含まれます。</p><p>同社は2005年以来、非補助金石油流通事業に参入した最初の国内民間企業です。同社はまた、2010年以来、BPH Migasから補助金石油の流通を信頼された最初の国内民間企業でもあります。同社のインフラと広範な物流ネットワークを考慮して、BPH Migasは同社にインドネシアの様々な地域で補助金石油を流通するよう任命しました。</p><p>同社は2014年に640,000KLの補助金石油の割り当てを受けました。流通エリアは現在、北スマトラ、ランプン、ジャカルタ、バンテン、西ジャワ、中部ジャワ、ジョグジャカルタ、東ジャワ、バリ、西カリマンタン、南カリマンタン、東カリマンタン、南スラウェシの各州の都市を含むように拡大されています。</p>'
            ],
            [
                'locale' => 'ko',
                'title' => 'PT AKR Corporindo',
                'description' => '<p>PT AKR Corporindo TBk는 석유 및 기초 화학 제품 유통, 물류 서비스, 소르비톨 및 접착제 제조, 석탄 채굴 및 거래를 운영하는 통합 물류 및 공급망 솔루션 회사입니다. 이 회사는 1977년 11월 28일 PT Aneka Kimia Raya라는 이름으로 설립되었습니다. 이 회사는 1994년에 상장 회사가 되었으며 2004년에 PT AKR Corporindo TBk로 사명을 변경했습니다.</p><p>이 회사의 광범위한 자산에는 인도네시아의 해항 및 강항, 석유 및 기초 화학 제품용 탱크 터미널, 소르비톨 및 접착제 제조 시설, 자주식 석유 바지선, 트럭, 창고, 소르비톨 및 접착제 제조 시설 및 기타 자산이 포함됩니다.</p><p>이 회사는 2005년 이후 비보조금 석유 유통 사업에 진입한 최초의 국내 민간 기업입니다. 이 회사는 또한 2010년 이후 BPH Migas로부터 보조금 석유 유통을 신뢰받은 최초의 국내 민간 기업이기도 합니다. 회사의 인프라와 광범위한 물류 네트워크를 고려하여 BPH Migas는 회사에 인도네시아의 다양한 지역에서 보조금 석유를 유통하도록 할당했습니다.</p><p>회사는 2014년에 640,000KL의 보조금 석유 할당을 받았습니다. 유통 지역은 현재 북수마트라, 람풍, 자카르타, 반텐, 서자바, 중부자바, 족자카르타, 동자바, 발리, 서칼리만탄, 남칼리만탄, 동칼리만탄 및 남술라웨시 지방의 도시를 포함하도록 확대되었습니다.</p>'
            ],
            [
                'locale' => 'tw',
                'title' => 'PT AKR Corporindo',
                'description' => '<p>PT AKR Corporindo TBk是一家綜合物流和供應鏈解決方案公司，經營石油和基礎化學品分銷、物流服務、山梨醇和粘合材料製造，以及煤炭開採和貿易。該公司於1977年11月28日以PT Aneka Kimia Raya的名稱成立。該公司於1994年成為上市公司，後於2004年更名為PT AKR Corporindo TBk。</p><p>該公司的廣泛資產包括印尼的海港和河港、石油和基礎化學品的儲罐碼頭、山梨醇和粘合材料的製造設施、自航式油駁船、卡車、倉庫、山梨醇和粘合材料的製造設施以及其他資產。</p><p>該公司是自2005年以來第一家進入非補貼石油分銷業務的國家私營公司。該公司也是自2010年以來第一家受BPH Migas信任分銷補貼石油的國家私營公司。考慮到該公司的基礎設施和廣泛的物流網絡，BPH Migas已指派該公司在印尼各地區分銷補貼石油。</p><p>該公司獲得2014年640,000千升補貼石油的分配。分銷區域現已擴大到包括北蘇門答臘、楠榜、雅加達、萬丹、西爪哇、中爪哇、日惹、東爪哇、峇里島、西加里曼丹、南加里曼丹、東加里曼丹和南蘇拉威西省的城市。</p>'
            ],
        ];

        foreach ($content2_1Translations as $translation) {
            AboutUsContentDetailTranslation::create([
                'about_us_content_detail_id' => $content2_1->id,
                'locale' => $translation['locale'],
                'title' => $translation['title'],
                'description' => $translation['description']
            ]);
        }

        // Content Detail 2.2: PT Pelabuhan Indonesia
        $content2_2 = AboutUsContentDetail::create([
            'icon' => 'cef383115blogo Pelindo.png',
            'category_id' => $category2->id
        ]);

        $content2_2Translations = [
            [
                'locale' => 'id',
                'title' => 'PT Pelabuhan Indonesia (Persero)',
                'description' => '<p>PT Pelabuhan Indonesia (Persero) adalah perusahaan milik negara yang bergerak di bidang transportasi. Perusahaan menjalankan bisnis intinya sebagai penyedia fasilitas layanan pelabuhan. Perusahaan memiliki peran kunci untuk memastikan keberlanjutan dan kelancaran transportasi laut. Dengan pengembangan infrastruktur transportasi yang berkelanjutan, perusahaan dapat mendorong dan merangsang ekonomi negara dan masyarakat.</p>'
            ],
            [
                'locale' => 'en',
                'title' => 'PT Pelabuhan Indonesia (Persero)',
                'description' => '<p>PT Pelabuhan Indonesia (Persero) is a state-owned company engaged in the transportation sector. The company runs its core business as a provider of port service facilities. The company has a key role to ensure the sustainability and smoothness of sea transportation. With the continuous development of transportation infrastructure, companies can encourage and stimulate the economy of the country and society.</p>'
            ],
            [
                'locale' => 'zh',
                'title' => 'PT Pelabuhan Indonesia (Persero)',
                'description' => '<p>PT Pelabuhan Indonesia (Persero) 是一家从事运输业的国有企业。该公司将其核心业务运营为港口服务设施的提供商。该公司在确保海上运输的可持续性和顺畅性方面发挥着关键作用。随着运输基础设施的持续发展，公司可以鼓励和刺激国家和社会的经济。</p>'
            ],
            [
                'locale' => 'ja',
                'title' => 'PT Pelabuhan Indonesia (Persero)',
                'description' => '<p>PT Pelabuhan Indonesia (Persero)は運輸部門に従事する国有企業です。同社は港湾サービス施設の提供者として中核事業を運営しています。同社は海上輸送の持続可能性と円滑性を確保する上で重要な役割を果たしています。輸送インフラの継続的な発展により、企業は国と社会の経済を促進し刺激することができます。</p>'
            ],
            [
                'locale' => 'ko',
                'title' => 'PT Pelabuhan Indonesia (Persero)',
                'description' => '<p>PT Pelabuhan Indonesia (Persero)는 운송 부문에 종사하는 국영 기업입니다. 이 회사는 항만 서비스 시설 제공자로서 핵심 사업을 운영합니다. 이 회사는 해상 운송의 지속 가능성과 원활함을 보장하는 데 핵심적인 역할을 합니다. 운송 인프라의 지속적인 개발을 통해 기업은 국가와 사회의 경제를 장려하고 자극할 수 있습니다.</p>'
            ],
            [
                'locale' => 'tw',
                'title' => 'PT Pelabuhan Indonesia (Persero)',
                'description' => '<p>PT Pelabuhan Indonesia (Persero) 是一家從事運輸業的國有企業。該公司將其核心業務運營為港口服務設施的提供商。該公司在確保海上運輸的可持續性和順暢性方面發揮著關鍵作用。隨著運輸基礎設施的持續發展，公司可以鼓勵和刺激國家和社會的經濟。</p>'
            ],
        ];

        foreach ($content2_2Translations as $translation) {
            AboutUsContentDetailTranslation::create([
                'about_us_content_detail_id' => $content2_2->id,
                'locale' => $translation['locale'],
                'title' => $translation['title'],
                'description' => $translation['description']
            ]);
        }

        $this->command->info('About Us Content Detail seeder completed successfully!');
    }
}
