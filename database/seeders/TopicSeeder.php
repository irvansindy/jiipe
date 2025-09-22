<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\TopicTranslation;
class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Topic::truncate();
        TopicTranslation::truncate();
        // Contoh data topik
        $topics = [
            [
                'translations' => [
                    'id' => 'Progres',
                    'en' => 'Progress',
                    'zh' => '进展',
                    'ja' => '進捗',
                    'ko' => '진행',
                    'tw' => '進度',
                ],
            ],
            [
                'translations' => [
                    'id' => 'Video',
                    'en' => 'Video',
                    'zh' => '视频',
                    'ja' => 'ビデオ',
                    'ko' => '비디오',
                    'tw' => '影片',
                ],
            ],
        ];

        foreach ($topics as $topicData) {
            $topic = Topic::create();

            foreach ($topicData['translations'] as $locale => $title) {
                TopicTranslation::create([
                    'topic_id' => $topic->id,
                    'locale'   => $locale,
                    'name'    => $title,
                ]);
            }
        }
    }
}
