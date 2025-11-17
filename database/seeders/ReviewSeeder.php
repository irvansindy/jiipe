<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\ReviewTranslation;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        Review::truncate();
        ReviewTranslation::truncate();

        $reviews = [
            [
                'photo' => '/asset/testimonial/.tmb/thumb_db6ef-joko-widodo-169-1_adaptiveResize_100_100.png',
                'name' => 'Ir. H. Joko Widodo',
                'position' => 'President of the Republic of Indonesia',
                'translations' => [
                    'id' => 'Saya pikir ini adalah contoh yang bagus dari kawasan industri. Kawasan ini memiliki pembangkit listrik dan terintegrasi dengan pelabuhan. Ini akan sangat efisien untuk kegiatan ekspor. Jarak dari pabrik ke pelabuhan hanya sekitar satu kilometer, yang berarti hampir tidak ada biaya transportasi. Ini akan membuat barang yang diproduksi di JIIPE mampu bersaing dengan negara lain.',
                    'en' => 'I think this is a great example of an industrial estate. It has a power plant and is integrated with a seaport. It will be very efficient for export activity. The distance from the factories to the seaport is only around one kilometer, which means there is almost no transportation cost. This will let the goods that are produced at JIIPE will be able to compete with other countries.',
                    'zh' => '我认为这是工业区的一个很好的例子。它拥有发电厂，并与海港整合。这对出口活动非常有效。工厂到海港的距离只有约一公里，这意味着几乎没有运输成本。这将使在JIIPE生产的商品能够与其他国家竞争。',
                    'ja' => 'これは工業団地の素晴らしい例だと思います。発電所があり、港湾と統合されています。輸出活動に非常に効率的です。工場から港までの距離は約1キロメートルで、運送コストがほとんどかかりません。これにより、JIIPEで生産される商品は他国と競争できるようになります。',
                    'ko' => '저는 이것이 산업단지의 훌륭한 예라고 생각합니다. 발전소가 있고 항구와 통합되어 있습니다. 수출 활동에 매우 효율적일 것입니다. 공장에서 항구까지의 거리는 약 1킬로미터에 불과하므로 운송 비용이 거의 없습니다. 이를 통해 JIIPE에서 생산된 제품이 다른 국가와 경쟁할 수 있게 될 것입니다.',
                    'tw' => '我認為這是工業區的一個很好的例子。它擁有發電廠，並與海港整合。這對出口活動非常有效。工廠到海港的距離只有約一公里，這意味著幾乎沒有運輸成本。這將使在JIIPE生產的商品能夠與其他國家競爭。',
                ],
            ],
            [
                'photo' => '/asset/testimonial/.tmb/thumb_b090a-tony-wenas-presiden-direktur-p_adaptiveResize_100_100.png',
                'name' => 'Tony Wenas',
                'position' => 'President Director of PT Freeport Indonesia',
                'translations' => [
                    'id' => 'Alasan kami berinvestasi di JIIPE adalah tentang kesiapan lahan. Kemudian, masalah perizinan dan administrasi, dan juga fasilitas pendukung seperti pelabuhan, jalan, dan area laydown. Tentu saja ini juga pertimbangan ekonomis dan kemudahan serta ketersediaan untuk off taker kami.',
                    'en' => 'The reason we invest in JIIPE is about the land readiness. Then, licensing and administration issues, and also supporting facilities such as seaport, road, and laydown area. Of course this is also the economic consideration and the convenience and availability for our off takers.',
                    'zh' => '我们投资JIIPE的原因是土地准备就绪。然后是许可和行政问题，以及诸如海港、道路和堆场等配套设施。当然，这也是经济考虑以及为我们的客户提供的便利和可用性。',
                    'ja' => 'JIIPEに投資する理由は、土地の準備が整っていることです。次に、ライセンスと管理の問題、そして港湾、道路、レイダウンエリアなどの支援施設です。もちろん、これは経済的な考慮事項であり、オフテイカーにとっての利便性と可用性でもあります。',
                    'ko' => 'JIIPE에 투자하는 이유는 토지 준비 상태 때문입니다. 그 다음은 라이선스 및 행정 문제, 그리고 항구, 도로, 레이다운 지역과 같은 지원 시설입니다. 물론 이것은 경제적 고려 사항이자 우리 오프테이커를 위한 편의성과 가용성이기도 합니다.',
                    'tw' => '我們投資JIIPE的原因是土地準備就緒。然後是許可和行政問題，以及諸如海港、道路和堆場等配套設施。當然，這也是經濟考慮以及為我們的客戶提供的便利和可用性。',
                ],
            ],
            [
                'photo' => '/asset/testimonial/.tmb/thumb_bca7d-airlanggaa-hartarto_adaptiveResize_100_100.jpg',
                'name' => 'Airlangga Hartarto',
                'position' => 'Coordinating Minister for Economic Affairs of Republic of Indonesia',
                'translations' => [
                    'id' => 'Salah satu KEK yang diharapkan menjadi lokomotif pemulihan ekonomi Indonesia adalah KEK Gresik (JIIPE). Kawasan industri yang dilengkapi dengan infrastruktur dan suprastruktur yang handal dan terintegrasi seperti pelabuhan, kawasan yang ramah lingkungan dan inovatif menuju terwujudnya kota industri baru.',
                    'en' => 'One of the SEZs that is expected to be the locomotive of Indonesia\'s economic recovery is the Gresik SEZ (JIIPE). An industrial area equipped with reliable and integrated infrastructure and superstructure such as a port, an environmentally friendly and innovative area towards the realization of a new industrial city.',
                    'zh' => '预计将成为印度尼西亚经济复苏火车头的经济特区之一是格雷西克经济特区（JIIPE）。这是一个配备可靠和综合基础设施和上层建筑（如港口）的工业区，是一个环保和创新的区域，旨在实现新工业城市。',
                    'ja' => 'インドネシアの経済回復の機関車となることが期待されているSEZの1つは、グレシックSEZ（JIIPE）です。港湾などの信頼性が高く統合されたインフラストラクチャとスーパーストラクチャを備えた工業地域であり、新しい工業都市の実現に向けた環境に優しく革新的な地域です。',
                    'ko' => '인도네시아의 경제 회복의 기관차가 될 것으로 예상되는 경제특구 중 하나는 그레식 경제특구(JIIPE)입니다. 항구와 같은 신뢰할 수 있고 통합된 인프라와 상부 구조를 갖춘 산업 지역으로, 새로운 산업 도시 실현을 향한 환경 친화적이고 혁신적인 지역입니다.',
                    'tw' => '預計將成為印度尼西亞經濟復甦火車頭的經濟特區之一是格雷西克經濟特區（JIIPE）。這是一個配備可靠和綜合基礎設施和上層建築（如港口）的工業區，是一個環保和創新的區域，旨在實現新工業城市。',
                ],
            ],
            [
                'photo' => '/asset/testimonial/.tmb/thumb_2d278-haryanto-adikoesoemo_adaptiveResize_100_100.jpeg',
                'name' => 'Haryanto Adikoesoemo',
                'position' => 'President Director of AKR Corporindo',
                'translations' => [
                    'id' => 'Kami bersyukur dan bangga menjadi bagian dari program pemerintah dalam meningkatkan daya saing industri di Indonesia. Dengan berdirinya KEK Gresik JIIPE, kami yakin dapat memberikan kemudahan dalam berbisnis dan membantu industri untuk mengurangi biaya logistik dan mencapai efisiensi, sehingga Indonesia khususnya Jawa Timur dapat menjadi tujuan investasi yang menarik.',
                    'en' => 'We are grateful and proud to be part of the government\'s program in increasing industrial competitiveness in Indonesia. With the establishment of the JIIPE Gresik SEZ, we believe we can provide convenience in doing business and help industries to reduce logistics costs and achieve efficiency, so that Indonesia, especially East Java can be an attractive investment destination.',
                    'zh' => '我们很感激并自豪能够成为政府提高印度尼西亚工业竞争力计划的一部分。通过建立JIIPE格雷西克经济特区，我们相信我们可以为开展业务提供便利，并帮助行业降低物流成本并实现效率，使印度尼西亚，特别是东爪哇成为有吸引力的投资目的地。',
                    'ja' => 'インドネシアの産業競争力を高める政府のプログラムの一部となれることに感謝し、誇りに思っています。JIIPEグレシックSEZの設立により、ビジネスを行う上での利便性を提供し、産業が物流コストを削減し効率を達成するのを支援できると信じています。これにより、インドネシア、特に東ジャワが魅力的な投資先となることができます。',
                    'ko' => '인도네시아의 산업 경쟁력을 높이는 정부 프로그램의 일부가 되어 감사하고 자랑스럽습니다. JIIPE 그레식 경제특구의 설립으로 비즈니스 수행의 편의성을 제공하고 산업이 물류 비용을 줄이고 효율성을 달성하도록 도울 수 있다고 믿습니다. 이를 통해 인도네시아, 특히 동자바가 매력적인 투자 목적지가 될 수 있습니다.',
                    'tw' => '我們很感激並自豪能夠成為政府提高印度尼西亞工業競爭力計劃的一部分。通過建立JIIPE格雷西克經濟特區，我們相信我們可以為開展業務提供便利，並幫助行業降低物流成本並實現效率，使印度尼西亞，特別是東爪哇成為有吸引力的投資目的地。',
                ],
            ],
            [
                'photo' => '/asset/testimonial/.tmb/thumb_4c4d4-baahlil-lahadalia_adaptiveResize_100_100.jpg',
                'name' => 'Bahlil Lahadalia',
                'position' => 'Minister of Investment of Indonesia, (Former Head of BKPM)',
                'translations' => [
                    'id' => 'JIIPE adalah salah satu kawasan terdepan yang dapat ditawarkan kepada investor untuk berinvestasi di Indonesia. Keunggulan JIIPE adalah terintegrasi antara kawasan industri dan pelabuhan.',
                    'en' => 'JIIPE is one of the leading areas that can be offered to investors to invest in Indonesia. The advantage of JIIPE is that it is integrated between industrial estates and ports.',
                    'zh' => 'JIIPE是可以向投资者提供的在印度尼西亚投资的领先地区之一。JIIPE的优势在于工业区和港口之间的整合。',
                    'ja' => 'JIIPEは、インドネシアへの投資のために投資家に提供できる主要な地域の1つです。JIIPEの利点は、工業団地と港湾の間で統合されていることです。',
                    'ko' => 'JIIPE는 인도네시아에 투자할 투자자들에게 제공할 수 있는 주요 지역 중 하나입니다. JIIPE의 장점은 산업단지와 항구 간의 통합입니다.',
                    'tw' => 'JIIPE是可以向投資者提供的在印度尼西亞投資的領先地區之一。JIIPE的優勢在於工業區和港口之間的整合。',
                ],
            ],
            [
                'photo' => '/asset/testimonial/.tmb/thumb_330dc-boy-robyanto_adaptiveResize_100_100.png',
                'name' => 'Boy Robyanto',
                'position' => 'President Director of Pelindo III',
                'translations' => [
                    'id' => 'Lokasi JIIPE mudah diakses dan terintegrasi dengan pelabuhan, akses lokasi dekat dengan jalan tol Surabaya-Jakarta dan jalan nasional pantai utara, serta jalur kereta api Surabaya-Jakarta. Ini mendukung industri rantai pasokan yang berorientasi ekspor dan substitusi impor.',
                    'en' => 'The location of JIIPE is accessible and integrated with the port, location access is close to the Surabaya-Jakarta toll road and the north coast national road, as well as the Surabaya-Jakarta railway line. This supports the supply chain industry which is export-oriented and import substitution.',
                    'zh' => 'JIIPE的位置便于访问并与港口整合，位置接近泗水-雅加达收费公路和北海岸国道，以及泗水-雅加达铁路线。这支持以出口为导向和进口替代的供应链行业。',
                    'ja' => 'JIIPEの場所はアクセスしやすく、港湾と統合されており、スラバヤ-ジャカルタ有料道路、北海岸国道、スラバヤ-ジャカルタ鉄道線に近い場所にあります。これは、輸出志向と輸入代替のサプライチェーン産業を支援します。',
                    'ko' => 'JIIPE의 위치는 접근이 용이하고 항구와 통합되어 있으며, 수라바야-자카르타 유료 도로 및 북부 해안 국도, 수라바야-자카르타 철도 노선과 가깝습니다. 이는 수출 지향적이고 수입 대체 공급망 산업을 지원합니다.',
                    'tw' => 'JIIPE的位置便於訪問並與港口整合，位置接近泗水-雅加達收費公路和北海岸國道，以及泗水-雅加達鐵路線。這支持以出口為導向和進口替代的供應鏈行業。',
                ],
            ],
            [
                'photo' => '/asset/testimonial/.tmb/thumb_eb8f9-anthony-muki-tan_adaptiveResize_100_100.jpeg',
                'name' => 'Anthony Mukti Tan',
                'position' => 'President Director of PT Rodamas',
                'translations' => [
                    'id' => 'Saya bisa merasakan komitmen mereka dalam mewujudkan kawasan industri JIIPE dan membantu kesuksesan tenant mereka. Salah satunya adalah ketika Rodamas membeli lahan, JIIPE belum menjadi kawasan ekonomi khusus (KEK), tetapi sekarang kami mendapat bonus, JIIPE sudah menjadi KEK, dan kami bisa mendapat insentif dan fasilitas lainnya.',
                    'en' => 'I could feel their commitment in realizing JIIPE industrial estate and assisting the success of their tenants. One of which is when Rodamas purchased the land, JIIPE had not been a special economic zone (SEZ), but now we get the bonus, jiipe has already become sez, and we could get incentives and other facilities.',
                    'zh' => '我能感受到他们在实现JIIPE工业区和协助租户成功方面的承诺。其中之一是当Rodamas购买土地时，JIIPE尚未成为经济特区（SEZ），但现在我们得到了奖励，JIIPE已经成为经济特区，我们可以获得激励和其他设施。',
                    'ja' => 'JIIPE工業団地の実現とテナントの成功を支援することへの彼らのコミットメントを感じることができました。その1つは、Rodamasが土地を購入したとき、JIIPEはまだ経済特区（SEZ）ではありませんでしたが、今ではボーナスを得て、JIIPEはすでにSEZになり、インセンティブやその他の施設を得ることができます。',
                    'ko' => 'JIIPE 산업단지를 실현하고 임차인의 성공을 지원하는 그들의 약속을 느낄 수 있었습니다. 그 중 하나는 Rodamas가 토지를 구매했을 때 JIIPE는 아직 경제특구(SEZ)가 아니었지만 이제 우리는 보너스를 받았고 JIIPE는 이미 경제특구가 되었으며 인센티브 및 기타 시설을 얻을 수 있습니다.',
                    'tw' => '我能感受到他們在實現JIIPE工業區和協助租戶成功方面的承諾。其中之一是當Rodamas購買土地時，JIIPE尚未成為經濟特區（SEZ），但現在我們得到了獎勵，JIIPE已經成為經濟特區，我們可以獲得激勵和其他設施。',
                ],
            ],
            [
                'photo' => '/asset/testimonial/.tmb/thumb_048b2-wijaaya-haddi_adaptiveResize_100_100.jfif',
                'name' => 'Hadi Wijaya',
                'position' => 'Site Manager of Clariant Adsorbents, Gresik',
                'translations' => [
                    'id' => 'Keputusan untuk berinvestasi di JIIPE adalah keputusan yang mudah karena memiliki konsep terintegrasi dan menyediakan infrastruktur yang diperlukan untuk fasilitas industri dan logistik.',
                    'en' => 'The decision to invest in Jiipe was an easy one because it has an integrated concept and provides the necessary infrastructure for industry and logistics facilities.',
                    'zh' => '决定投资JIIPE是一个容易的决定，因为它具有综合概念，并为工业和物流设施提供必要的基础设施。',
                    'ja' => 'JIIPEへの投資を決定するのは簡単でした。統合されたコンセプトを持ち、産業および物流施設に必要なインフラストラクチャを提供しているためです。',
                    'ko' => 'JIIPE에 투자하기로 한 결정은 쉬운 결정이었습니다. 통합된 개념을 가지고 있으며 산업 및 물류 시설에 필요한 인프라를 제공하기 때문입니다.',
                    'tw' => '決定投資JIIPE是一個容易的決定，因為它具有綜合概念，並為工業和物流設施提供必要的基礎設施。',
                ],
            ],
            [
                'photo' => '/asset/testimonial/.tmb/thumb_0b240-1637035575_adaptiveResize_100_100.jpg',
                'name' => 'Hengky Pratoko',
                'position' => 'Head of Indonesia Logistic dan Forwarder Association, East Java',
                'translations' => [
                    'id' => 'JIIPE telah menjawab masalah perputaran logistik yang selama ini mengakibatkan biaya logistik tinggi. Kawasan JIIPE yang terintegrasi akan mempercepat perputaran dan mengurangi biaya logistik.',
                    'en' => 'Jiipe has answered the logistics turnover problem which has resulted in high logistics costs so far. The integrated Jiipe area will speed up turnover and reduce logistics costs.',
                    'zh' => 'JIIPE已经解决了迄今为止导致高物流成本的物流周转问题。综合的JIIPE区域将加快周转并降低物流成本。',
                    'ja' => 'JIIPEは、これまで高い物流コストをもたらしていた物流回転の問題を解決しました。統合されたJIIPE地域は、回転を加速し、物流コストを削減します。',
                    'ko' => 'JIIPE는 지금까지 높은 물류 비용을 초래한 물류 회전 문제를 해결했습니다. 통합된 JIIPE 지역은 회전을 가속화하고 물류 비용을 줄일 것입니다.',
                    'tw' => 'JIIPE已經解決了迄今為止導致高物流成本的物流周轉問題。綜合的JIIPE區域將加快周轉並降低物流成本。',
                ],
            ],
            [
                'photo' => '/asset/testimonial/.tmb/thumb_01e0a-doddy-zulferdi-1_adaptiveResize_100_100.jpg',
                'name' => 'Doddy Zulverdi',
                'position' => 'Head of Representative Bank Indonesia East Java Province',
                'translations' => [
                    'id' => 'Pertama, keputusan kami untuk menempatkan proyek manajemen uang Bank Indonesia di JIIPE menunjukkan betapa percayanya kami terhadap ketersediaan fasilitas serta keamanannya tentu saja.',
                    'en' => 'First off, our decision to locate Bank Indonesia\'s money management project at JIIPE shows how confident we are in the facility\'s availability as well as its security of course.',
                    'zh' => '首先，我们决定将印度尼西亚银行的资金管理项目设在JIIPE，这表明我们对该设施的可用性以及安全性充满信心。',
                    'ja' => 'まず、インドネシア銀行の資金管理プロジェクトをJIIPEに配置するという決定は、施設の可用性とセキュリティに対する私たちの自信を示しています。',
                    'ko' => '먼저, 인도네시아 은행의 자금 관리 프로젝트를 JIIPE에 배치하기로 한 우리의 결정은 시설의 가용성과 보안에 대한 우리의 자신감을 보여줍니다.',
                    'tw' => '首先，我們決定將印度尼西亞銀行的資金管理項目設在JIIPE，這表明我們對該設施的可用性以及安全性充滿信心。',
                ],
            ],
            [
                'photo' => '/asset/testimonial/.tmb/thumb_35f37-c2774_adaptiveResize_100_100.jpg',
                'name' => 'Michael Jiang',
                'position' => 'Executive Director PT Hailiang Nova Material Indonesia',
                'translations' => [
                    'id' => 'Kami telah membandingkan lima taman industri, kami sangat menyukai JIIPE dari segi lokasi, logistik, rantai pasokan, staf yang suportif, kondisi yang sangat nyaman untuk memulai konstruksi dalam proses persetujuan yang sangat cepat, kebijakan yang sangat menarik untuk insentif investasi dari luar negeri, dan kebijakan yang sangat baik seperti tax holiday, bebas pajak, bebas bea impor juga instrumen yang sangat kami dorong.',
                    'en' => 'We have compared five industrial parks, we really like JIIPE is location wise, logistic-wise, supply chain, supportive staff, very convenient condition to start the construction in real quick process for approval, very attractive policy for incentive for investment from overseas, and very good policy like tax holiday, tax-free, import duty-free also instruments we are highly encouraged.',
                    'zh' => '我们比较了五个工业园区，我们非常喜欢JIIPE的位置、物流、供应链、支持性员工、非常便利的条件以极快的审批流程开始建设、对海外投资的非常有吸引力的激励政策，以及非常好的政策，如免税期、免税、免进口税，这些工具让我们深受鼓舞。',
                    'ja' => '5つの工業団地を比較しましたが、JIIPEは立地、物流、サプライチェーン、サポートスタッフ、承認のための非常に迅速なプロセスで建設を開始するための非常に便利な条件、海外からの投資に対する非常に魅力的なインセンティブ政策、そしてタックスホリデー、免税、輸入関税免除などの非常に良い政策があり、私たちは大いに励まされています。',
                    'ko' => '우리는 다섯 개의 산업 단지를 비교했으며, JIIPE는 위치, 물류, 공급망, 지원 직원, 승인을 위한 매우 빠른 프로세스로 건설을 시작할 수 있는 매우 편리한 조건, 해외 투자에 대한 매우 매력적인 인센티브 정책, 그리고 세금 면제 기간, 면세, 수입 관세 면제와 같은 매우 좋은 정책이 있어 매우 고무적입니다.',
                    'tw' => '我們比較了五個工業園區，我們非常喜歡JIIPE的位置、物流、供應鏈、支持性員工、非常便利的條件以極快的審批流程開始建設、對海外投資的非常有吸引力的激勵政策，以及非常好的政策，如免稅期、免稅、免進口稅，這些工具讓我們深受鼓舞。',
                ],
            ],
        ];

        foreach ($reviews as $reviewData) {
            $review = Review::create([
                'photo' => $reviewData['photo'],
                'name' => $reviewData['name'],
                'position' => $reviewData['position'],
                'is_active' => true,
            ]);

            foreach ($reviewData['translations'] as $locale => $description) {
                ReviewTranslation::create([
                    'review_id' => $review->id,
                    'locale' => $locale,
                    'description' => $description,
                ]);
            }
        }
    }
}