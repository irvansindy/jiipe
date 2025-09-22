<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsCategories;
use App\Models\NewsCategoriesTranslation;

class NewsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NewsCategories::truncate();
        NewsCategoriesTranslation::truncate();

        $data_news = [
            [
                'translations' => [
                    ['locale' => 'id', 'name' => 'Berita'],
                    ['locale' => 'en', 'name' => 'News'],
                    ['locale' => 'zh', 'name' => '新闻'],
                    ['locale' => 'ja', 'name' => 'ニュース'],
                    ['locale' => 'ko', 'name' => '뉴스'],
                    ['locale' => 'tw', 'name' => '新聞'],
                ],
            ],
            [
                'translations' => [
                    ['locale' => 'id', 'name' => 'Acara'],
                    ['locale' => 'en', 'name' => 'Event'],
                    ['locale' => 'zh', 'name' => '活动'],
                    ['locale' => 'ja', 'name' => 'イベント'],
                    ['locale' => 'ko', 'name' => '이벤트'],
                    ['locale' => 'tw', 'name' => '活動'],
                ],
            ],
            [
                'translations' => [
                    ['locale' => 'id', 'name' => 'Progres'],
                    ['locale' => 'en', 'name' => 'Progress'],
                    ['locale' => 'zh', 'name' => '进展'],
                    ['locale' => 'ja', 'name' => '進捗'],
                    ['locale' => 'ko', 'name' => '진행'],
                    ['locale' => 'tw', 'name' => '進展'],
                ],
            ],
            [
                'translations' => [
                    ['locale' => 'id', 'name' => 'Artikel'],
                    ['locale' => 'en', 'name' => 'Articles'],
                    ['locale' => 'zh', 'name' => '文章'],
                    ['locale' => 'ja', 'name' => '記事'],
                    ['locale' => 'ko', 'name' => '기사'],
                    ['locale' => 'tw', 'name' => '文章'],
                ],
            ],
            [
                'translations' => [
                    ['locale' => 'id', 'name' => 'Fakta'],
                    ['locale' => 'en', 'name' => 'Fact'],
                    ['locale' => 'zh', 'name' => '事实'],
                    ['locale' => 'ja', 'name' => '事実'],
                    ['locale' => 'ko', 'name' => '사실'],
                    ['locale' => 'tw', 'name' => '事實'],
                ],
            ],
            [
                'translations' => [
                    ['locale' => 'id', 'name' => 'Glosarium'],
                    ['locale' => 'en', 'name' => 'Glossary'],
                    ['locale' => 'zh', 'name' => '词汇表'],
                    ['locale' => 'ja', 'name' => '用語集'],
                    ['locale' => 'ko', 'name' => '용어집'],
                    ['locale' => 'tw', 'name' => '詞彙表'],
                ],
            ],
        ];

        foreach ($data_news as $category) {
            $newsCategory = NewsCategories::create();
            foreach ($category['translations'] as $translation) {
                NewsCategoriesTranslation::create([
                    'news_category_id' => $newsCategory->id,
                    'locale' => $translation['locale'],
                    'name' => $translation['name'],
                ]);
            }
        }
    }
}
