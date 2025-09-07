<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuTranslation;
class MenuTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuTranslation::truncate();

        $menus = Menu::all();

        foreach ($menus as $menu) {
            foreach ($this->getTranslations($menu->name) as $locale => $translatedName) {
                MenuTranslation::create([
                    'menu_id' => $menu->id,
                    'locale'  => $locale,
                    'name'    => $translatedName,
                ]);
            }
        }
    }

    private function getTranslations(string $text): array
    {
        $dictionary = [
            'Dashboard' => [
                'id' => 'Dashboard',
                'en' => 'Dashboard',
                'zh' => '仪表板',
                'ja' => 'ダッシュボード',
                'ko' => '대시보드',
                'tw' => '儀表板',
            ],
            'Form Appointment' => [
                'id' => 'Form Appointment',
                'en' => 'Appointment Form',
                'zh' => '预约表单',
                'ja' => '予約フォーム',
                'ko' => '예약 양식',
                'tw' => '預約表單',
            ],
            'List Appointment' => [
                'id' => 'List Appointment',
                'en' => 'Appointment List',
                'zh' => '预约清单',
                'ja' => '予約一覧',
                'ko' => '예약 목록',
                'tw' => '預約清單',
            ],
            'Profile Company' => [
                'id' => 'Profile Company',
                'en' => 'Company Profile',
                'zh' => '公司简介',
                'ja' => '会社概要',
                'ko' => '회사 프로필',
                'tw' => '公司簡介',
            ],
            'Profile Overview' => [
                'id' => 'Profile Overview',
                'en' => 'Profile Overview',
                'zh' => '简介概览',
                'ja' => '概要',
                'ko' => '프로필 개요',
                'tw' => '簡介總覽',
            ],
            'Kawasan Ekonomi Khusus' => [
                'id' => 'Kawasan Ekonomi Khusus',
                'en' => 'Special Economic Zone',
                'zh' => '经济特区',
                'ja' => '経済特区',
                'ko' => '경제 특구',
                'tw' => '經濟特區',
            ],
            'Artikel & Berita' => [
                'id' => 'Artikel & Berita',
                'en' => 'Articles & News',
                'zh' => '文章与新闻',
                'ja' => '記事とニュース',
                'ko' => '기사 및 뉴스',
                'tw' => '文章與新聞',
            ],
            'Gallery' => [
                'id' => 'Gallery',
                'en' => 'Gallery',
                'zh' => '画廊',
                'ja' => 'ギャラリー',
                'ko' => '갤러리',
                'tw' => '畫廊',
            ],
            'Brochures' => [
                'id' => 'Brochures',
                'en' => 'Brochures',
                'zh' => '宣传册',
                'ja' => 'パンフレット',
                'ko' => '브로셔',
                'tw' => '宣傳冊',
            ],
            'Contact' => [
                'id' => 'Contact',
                'en' => 'Contact',
                'zh' => '联系',
                'ja' => 'お問い合わせ',
                'ko' => '연락처',
                'tw' => '聯繫',
            ],
            'Career' => [
                'id' => 'Career',
                'en' => 'Career',
                'zh' => '职业',
                'ja' => '採用情報',
                'ko' => '채용',
                'tw' => '職業',
            ],
            'General Setting' => [
                'id' => 'General Setting',
                'en' => 'General Setting',
                'zh' => '常规设置',
                'ja' => '一般設定',
                'ko' => '일반 설정',
                'tw' => '常規設定',
            ],
            'Language (Bahasa)' => [
                'id' => 'Language (Bahasa)',
                'en' => 'Language',
                'zh' => '语言',
                'ja' => '言語',
                'ko' => '언어',
                'tw' => '語言',
            ],
            'Logout' => [
                'id' => 'Logout',
                'en' => 'Logout',
                'zh' => '登出',
                'ja' => 'ログアウト',
                'ko' => '로그아웃',
                'tw' => '登出',
            ],
        ];

        return $dictionary[$text] ?? [
            'id' => $text,
            'en' => $text,
            'zh' => $text,
            'ja' => $text,
            'ko' => $text,
            'tw' => $text,
        ];
    }
}
