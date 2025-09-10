<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\NewsTranslation;
class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::truncate();
        NewsTranslation::truncate();
        $news =News::create([
            'thumbnail' => 'path/to/thumbnail.jpg',
            'is_published' => true,
        ]);
        
        // Data dummy untuk tiap bahasa
        $translations = [
            'id' => [
                'title'   => 'Judul Berita dalam Bahasa Indonesia',
                'content' => 'Konten berita dalam Bahasa Indonesia.',
            ],
            'en' => [
                'title'   => 'News Title in English',
                'content' => 'News content in English.',
            ],
            'zh' => [
                'title'   => '新闻标题（中文）',
                'content' => '新闻内容（中文）。',
            ],
            'ja' => [
                'title'   => 'ニュースのタイトル（日本語）',
                'content' => 'ニュースの内容（日本語）。',
            ],
            'ko' => [
                'title'   => '뉴스 제목 (한국어)',
                'content' => '뉴스 내용 (한국어).',
            ],
            'tw' => [
                'title'   => '新聞標題（繁體中文）',
                'content' => '新聞內容（繁體中文）。',
            ],
        ];

        // Insert ke NewsTranslation
        foreach ($translations as $locale => $data) {
            NewsTranslation::create([
                'news_id' => $news->id,
                'locale'  => $locale,
                'title'   => $data['title'],
                'content' => $data['content'],
                'quote'   => null, // Atau isi dengan data yang sesuai
            ]);
        }
    }
}
