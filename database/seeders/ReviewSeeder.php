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
                'photo' => 'asset/testimonial/.tmb/thumb_db6ef-joko-widodo-169-1_adaptiveResize_100_100.png',
                'name' => 'Ir. H. Joko Widodo',
                'position' => 'President of the Republic of Indonesia',
                'is_active' => 1,
                'translations' => [
                    'en' => [
                        'description' => "I think this is a great example of an industrial estate. It has a power plant and is integrated with a seaport. It will be very efficient for export activity. The distance from the factories to the seaport is only around one kilometer, which means there is almost no transportation cost. This will let the goods that are produced at JIIPE will be able to compete with other countries."
                    ],
                    'id' => [
                        'description' => "Saya pikir ini adalah contoh kawasan industri yang bagus. Memiliki pembangkit listrik dan terintegrasi dengan pelabuhan. Ini akan sangat efisien untuk aktivitas ekspor. Jarak dari pabrik ke pelabuhan hanya sekitar satu kilometer, yang berarti hampir tidak ada biaya transportasi. Ini akan membuat barang yang diproduksi di JIIPE mampu bersaing dengan negara lain."
                    ],
                    'zh' => [
                        'description' => "我认为这是一个很好的工业区示例。它拥有发电厂，并与海港整合。这对出口活动来说非常有效率。从工厂到海港的距离仅约一公里，这意味着几乎没有运输成本。这将使JIIPE生产的商品能够与其他国家竞争。"
                    ],
                    'ja' => [
                        'description' => "これは工業団地の素晴らしい例だと思います。発電所を持ち、港と一体化しています。輸出活動に非常に効率的です。工場から港までの距離はわずか1キロメートルほどで、これは輸送コストがほとんどかからないことを意味します。これにより、JIIPEで生産される商品は他国と競争できるようになります。"
                    ],
                    'ko' => [
                        'description' => "이것은 산업단지의 훌륭한 예라고 생각합니다. 발전소를 가지고 있고 항구와 통합되어 있습니다. 수출 활동에 매우 효율적일 것입니다. 공장에서 항구까지의 거리가 약 1킬로미터에 불과하여 운송 비용이 거의 없습니다. 이를 통해 JIIPE에서 생산되는 상품이 다른 국가와 경쟁할 수 있게 될 것입니다."
                    ],
                    'tw' => [
                        'description' => "我認為這是一個很好的工業區示例。它擁有發電廠，並與海港整合。這對出口活動來說非常有效率。從工廠到海港的距離僅約一公里，這意味著幾乎沒有運輸成本。這將使JIIPE生產的商品能夠與其他國家競爭。"
                    ],
                ],
            ],
            [
                'photo' => 'asset/testimonial/.tmb/thumb_b090a-tony-wenas-presiden-direktur-p_adaptiveResize_100_100.png',
                'name' => 'Tony Wenas',
                'position' => 'President Director of PT Freeport Indonesia',
                'is_active' => 1,
                'translations' => [
                    'en' => [
                        'description' => "The reason we invest in JIIPE is about the land readiness. Then, licensing and administration issues, and also supporting facilities such as seaport, road, and laydown area. Of course this is also the economic consideration and the convenience and availability for our off takers."
                    ],
                    'id' => [
                        'description' => "Alasan kami berinvestasi di JIIPE adalah tentang kesiapan lahan. Kemudian, masalah perizinan dan administrasi, serta fasilitas pendukung seperti pelabuhan, jalan, dan area laydown. Tentunya ini juga pertimbangan ekonomi dan kenyamanan serta ketersediaan untuk off taker kami."
                    ],
                    // Tambahkan terjemahan lain
                ],
            ],
            [
                'photo' => 'asset/testimonial/.tmb/thumb_bca7d-airlanggaa-hartarto_adaptiveResize_100_100.jpg',
                'name' => 'Airlangga Hartarto',
                'position' => 'Coordinating Minister for Economic Affairs of Republic of Indonesia',
                'is_active' => 1,
                'translations' => [
                    'en' => [
                        'description' => "One of the SEZs that is expected to be the locomotive of Indonesia's economic recovery is the Gresik SEZ (JIIPE). An industrial area equipped with reliable and integrated infrastructure and superstructure such as a port, an environmentally friendly and innovative area towards the realization of a new industrial city."
                    ],
                    'id' => [
                        'description' => "Salah satu KEK yang diharapkan menjadi lokomotif pemulihan ekonomi Indonesia adalah KEK Gresik (JIIPE). Kawasan industri yang dilengkapi infrastruktur dan suprastruktur yang handal dan terintegrasi seperti pelabuhan, kawasan yang ramah lingkungan dan inovatif menuju terwujudnya kota industri baru."
                    ],
                    // Tambahkan terjemahan lain
                ],
            ],
            // Tambahkan review lainnya sesuai data di blade
        ];

        foreach ($reviews as $reviewData) {
            $review = Review::create([
                'photo' => $reviewData['photo'],
                'name' => $reviewData['name'],
                'position' => $reviewData['position'],
                'is_active' => $reviewData['is_active'],
            ]);

            foreach ($reviewData['translations'] as $locale => $trans) {
                ReviewTranslation::create([
                    'review_id' => $review->id,
                    'locale' => $locale,
                    'description' => $trans['description'],
                ]);
            }
        }
    }
}