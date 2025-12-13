<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUsContent;
use App\Models\AboutUsContentTranslation;
use Illuminate\Support\Facades\DB;

class AboutUsContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUsContentTranslation::truncate();
        AboutUsContent::truncate();

        // Content 1: JIIPE Contributions
        $content1 = AboutUsContent::create([
            'image' => 'oHRurlztpSwo_1765214335.jpg', // Sesuaikan dengan nama file yang ada
            'video_url' => 'https://www.youtube.com/watch?v=bPyOISQp_Mw',
        ]);

        $translations1 = [
            [
                'locale' => 'id',
                'title' => 'Kontribusi JIIPE',
                'subtitle' => 'Biaya logistik yang tinggi di Indonesia sebagai negara kepulauan berdampak pada harga barang yang beredar di pasar. Melalui konektivitas domestik dan internasional yang dikembangkan oleh kawasan terintegrasi JIIPE, para pelaku usaha dapat menghemat biaya tersebut dan menghasilkan barang dengan harga yang lebih kompetitif.',
                'content' => '<p>JIIPE adalah kawasan terintegrasi pertama di Indonesia, dengan luas total 3.000 hektar, terdiri dari kawasan industri, pelabuhan umum multifungsi, dan kota hunian. Berlokasi di Gresik, Provinsi Jawa Timur, JIIPE merupakan kawasan percontohan pengembangan industri di Indonesia.</p>
<p>Kawasan industri JIIPE seluas 1761 ha dengan fasilitas pelabuhan laut seluas 400 ha, serta hunian dengan konsep kota mandiri seluas 800 ha merupakan proyek kerjasama pemerintah swasta antara Pelabuhan Indonesia III (Pelindo III melalui anak perusahaannya PT Berlian Jasa Terminal Indonesia yang dikenal sebagai BJTI Port) dengan PT Aneka Kimia Raya Corporindo Tbk (AKR Corp melalui anak perusahaannya PT Usaha Era Pratama Nusantara).</p>
<p>Pelabuhan JIIPE adalah yang terdalam di Jawa Timur dengan kedalaman -16 LWS, 4 dermaga multifungsi dengan panjang sandar 6.200 meter, yang diharapkan mampu melayani kapal besar dengan muatan lebih dari 100.000 DWT. Akses internasional dan domestik diakomodasi dengan konektivitas laut, tol dan kereta api.</p>',
            ],
            [
                'locale' => 'en',
                'title' => 'JIIPE Contributions',
                'subtitle' => 'The high logistics costs in Indonesia as an archipelagic country have an effect on the price of goods circulating in the market. Through domestic and international connectivity developed by JIIPE integrated areas, actors can save these costs and produce goods at more competitive prices.',
                'content' => '<p>JIIPE is the first integrated area in Indonesia, with a total area of 3,000 hectares, consisting of industrial estates, multifunctional public ports, and residential cities. Located in Gresik, East Java province, JIIPE is a pilot area for industrial development in Indonesia.</p>
<p>JIIPE industrial area covering 1761 ha with sea port facilities in an area of 400 ha, and occupancy with the concept of an independent city in an area of 800 ha is a joint government private project between Pelabuhan Indonesia III (Pelindo III through its subsidiary PT Berlian Jasa Terminal Indonesia known as BJTI Port) with PT Aneka Kimia Raya Corporindo Tbk (AKR Corp through its subsidiary PT Usaha Era Pratama Nusantara).</p>
<p>JIIPE Port is the deepest in East Java with -16 LWS, 4 multifunction piers with 6,200 meters of berth, which are expected to be able to serve large vessels with loads of more than 100,000 DWT. International and domestic access is accommodated with sea, toll and train connectivity.</p>',
            ],
            [
                'locale' => 'zh',
                'title' => 'JIIPE 贡献',
                'subtitle' => '印度尼西亚作为群岛国家的高物流成本对市场上流通的商品价格产生影响。通过JIIPE综合区开发的国内和国际连接,参与者可以节省这些成本并以更具竞争力的价格生产商品。',
                'content' => '<p>JIIPE是印度尼西亚第一个综合区域,总面积3000公顷,由工业区、多功能公共港口和住宅城市组成。JIIPE位于东爪哇省格雷西克,是印度尼西亚工业发展的试点区域。</p>
<p>JIIPE工业区占地1761公顷,海港设施占地400公顷,独立城市概念的住宅区占地800公顷,是印度尼西亚港口三公司(Pelindo III通过其子公司PT Berlian Jasa Terminal Indonesia,即BJTI港口)与PT Aneka Kimia Raya Corporindo Tbk(AKR Corp通过其子公司PT Usaha Era Pratama Nusantara)之间的政府私营联合项目。</p>
<p>JIIPE港口是东爪哇最深的港口,深度为-16 LWS,拥有4个多功能码头,泊位长度为6200米,预计能够为载重超过100000 DWT的大型船舶提供服务。国际和国内通道通过海运、收费公路和铁路连接得到满足。</p>',
            ],
            [
                'locale' => 'ja',
                'title' => 'JIIPE の貢献',
                'subtitle' => '群島国家であるインドネシアの高い物流コストは、市場で流通する商品の価格に影響を与えています。JIIPE統合エリアが開発する国内外の接続性により、事業者はこれらのコストを節約し、より競争力のある価格で商品を生産できます。',
                'content' => '<p>JIIPEはインドネシア初の統合エリアで、総面積3,000ヘクタールで、工業団地、多機能公共港、住宅都市で構成されています。東ジャワ州グレシックに位置するJIIPEは、インドネシアにおける産業開発のパイロットエリアです。</p>
<p>1761ヘクタールをカバーするJIIPE工業地域には400ヘクタールの海港施設があり、800ヘクタールの独立都市のコンセプトを持つ居住区は、インドネシア港湾会社III(子会社PT Berlian Jasa Terminal Indonesia、通称BJTIポートを通じたPelindo III)とPT Aneka Kimia Raya Corporindo Tbk(子会社PT Usaha Era Pratama Nusantaraを通じたAKR Corp)の政府民間共同プロジェクトです。</p>
<p>JIIPEポートは東ジャワで最も深く、-16 LWSで、6,200メートルの岸壁を持つ4つの多機能埠頭があり、100,000 DWT以上の積載量を持つ大型船に対応できると期待されています。国際および国内のアクセスは、海上、有料道路、鉄道の接続性によって対応されています。</p>',
            ],
            [
                'locale' => 'ko',
                'title' => 'JIIPE 기여',
                'subtitle' => '군도 국가인 인도네시아의 높은 물류 비용은 시장에서 유통되는 상품 가격에 영향을 미칩니다. JIIPE 통합 지역이 개발한 국내 및 국제 연결성을 통해 사업자들은 이러한 비용을 절감하고 더 경쟁력 있는 가격으로 상품을 생산할 수 있습니다.',
                'content' => '<p>JIIPE는 인도네시아 최초의 통합 지역으로, 총 면적 3,000헥타르로 산업 단지, 다기능 공공 항구 및 주거 도시로 구성되어 있습니다. 동자바 주 그레식에 위치한 JIIPE는 인도네시아 산업 개발의 시범 지역입니다.</p>
<p>1761헥타르의 JIIPE 산업 지역에는 400헥타르의 해상 항구 시설이 있으며, 800헥타르의 독립 도시 개념을 갖춘 주거 지역은 인도네시아 항만공사 III(자회사 PT Berlian Jasa Terminal Indonesia, BJTI 포트로 알려진 Pelindo III)와 PT Aneka Kimia Raya Corporindo Tbk(자회사 PT Usaha Era Pratama Nusantara를 통한 AKR Corp) 간의 정부 민간 합작 프로젝트입니다.</p>
<p>JIIPE 포트는 동자바에서 가장 깊은 항구로 -16 LWS이며, 6,200미터의 접안 시설을 갖춘 4개의 다기능 부두가 있어 100,000 DWT 이상의 적재량을 가진 대형 선박을 수용할 수 있을 것으로 예상됩니다. 국제 및 국내 접근성은 해상, 유료 도로 및 철도 연결성으로 수용됩니다.</p>',
            ],
            [
                'locale' => 'tw',
                'title' => 'JIIPE 貢獻',
                'subtitle' => '印尼作為群島國家的高物流成本對市場上流通的商品價格產生影響。通過JIIPE綜合區開發的國內和國際連接,參與者可以節省這些成本並以更具競爭力的價格生產商品。',
                'content' => '<p>JIIPE是印尼第一個綜合區域,總面積3000公頃,由工業區、多功能公共港口和住宅城市組成。JIIPE位於東爪哇省格雷西克,是印尼工業發展的試點區域。</p>
<p>JIIPE工業區佔地1761公頃,海港設施佔地400公頃,獨立城市概念的住宅區佔地800公頃,是印尼港口三公司(Pelindo III通過其子公司PT Berlian Jasa Terminal Indonesia,即BJTI港口)與PT Aneka Kimia Raya Corporindo Tbk(AKR Corp通過其子公司PT Usaha Era Pratama Nusantara)之間的政府私營聯合項目。</p>
<p>JIIPE港口是東爪哇最深的港口,深度為-16 LWS,擁有4個多功能碼頭,泊位長度為6200米,預計能夠為載重超過100000 DWT的大型船舶提供服務。國際和國內通道通過海運、收費公路和鐵路連接得到滿足。</p>',
            ],
        ];

        foreach ($translations1 as $translation) {
            AboutUsContentTranslation::create([
                'about_us_content_id' => $content1->id,
                'locale' => $translation['locale'],
                'title' => $translation['title'],
                'subtitle' => $translation['subtitle'],
                'content' => $translation['content'],
            ]);
        }

        $this->command->info('About Us Content seeder completed successfully!');
    }
}
