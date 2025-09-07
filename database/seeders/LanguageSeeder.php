<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;
class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::truncate();
        $languages = [
            [
                'locale' => 'id',
                'name' => 'Indonesian',
                'native' => 'Bahasa Indonesia',
                'regional' => 'id_ID',
                'script' => 'Latn',
            ],
            [
                'locale' => 'en',
                'name' => 'English',
                'native' => 'English',
                'regional' => 'en_GB',
                'script' => 'Latn',
            ],
            [
                'locale' => 'zh',
                'name' => 'Chinese',
                'native' => '中文',
                'regional' => 'zh_CN',
                'script' => 'Hans',
            ],
            [
                'locale' => 'ja',
                'name' => 'Japanese',
                'native' => '日本語',
                'regional' => 'ja_JP',
                'script' => 'Jpan',
            ],
            [
                'locale' => 'ko',
                'name' => 'Korean',
                'native' => '한국어',
                'regional' => 'ko_KR',
                'script' => 'Hang',
            ],
            [
                'locale' => 'tw',
                'name' => 'Taiwanese',
                'native' => '繁體中文',
                'regional' => 'zh_TW',
                'script' => 'Hant',
            ],
        ];

        foreach ($languages as $lang) {
            Language::updateOrCreate(
                ['locale' => $lang['locale']],
                $lang
            );
        }
    }
}
