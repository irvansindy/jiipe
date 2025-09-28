<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate tables
        DB::table('menu_translations')->truncate();
        DB::table('menus')->truncate();
        DB::table('permissions')->truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Permission data
        $permissions = [
            ['id' => 1, 'name' => 'view_dashboard', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'view_general-settings', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'view_home-page', 'guard_name' => 'web'],
            ['id' => 7, 'name' => 'view_about-us', 'guard_name' => 'web'],
            ['id' => 11, 'name' => 'view_users', 'guard_name' => 'web'],
            ['id' => 15, 'name' => 'view_menu-permission', 'guard_name' => 'web'],
            ['id' => 19, 'name' => 'view_appointment', 'guard_name' => 'web'],
            ['id' => 20, 'name' => 'view_list-appointment', 'guard_name' => 'web'],
            ['id' => 24, 'name' => 'view_form-appointment', 'guard_name' => 'web'],
            ['id' => 28, 'name' => 'view_special-economic-zone', 'guard_name' => 'web'],
            ['id' => 29, 'name' => 'view_article-and-news', 'guard_name' => 'web'],
            ['id' => 30, 'name' => 'view_gallery', 'guard_name' => 'web'],
            ['id' => 31, 'name' => 'view_brochures', 'guard_name' => 'web'],
            ['id' => 32, 'name' => 'view_career', 'guard_name' => 'web'],
            ['id' => 33, 'name' => 'view_career-list', 'guard_name' => 'web'],
            ['id' => 37, 'name' => 'view_career-static', 'guard_name' => 'web'],
            ['id' => 41, 'name' => 'view_career-enquire', 'guard_name' => 'web'],
            ['id' => 45, 'name' => 'view_contact', 'guard_name' => 'web'],
            ['id' => 46, 'name' => 'view_contact-overview', 'guard_name' => 'web'],
            ['id' => 50, 'name' => 'view_contact-email', 'guard_name' => 'web'],
            ['id' => 54, 'name' => 'view_brochures-email', 'guard_name' => 'web'],
            ['id' => 58, 'name' => 'view_language', 'guard_name' => 'web'],
        ];

        $menus = [
            [
                'id' => 1,
                'name' => 'Dashboard',
                'url' => 'dashboard',
                'permission' => 'view_dashboard',
                'icon' => 'ti ti-dashboard',
                'type' => 'admin_side',
                'parent_id' => null,
                'order' => 1,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Dasbor'],
                    ['locale' => 'en', 'name' => 'Dashboard'],
                    ['locale' => 'tw', 'name' => '儀表板'],
                    ['locale' => 'ja', 'name' => 'ダッシュボード'],
                    ['locale' => 'zh', 'name' => '儀表板'],
                    ['locale' => 'ko', 'name' => '계기반'],
                ]
            ],
            [
                'id' => 2,
                'name' => 'General Settings',
                'url' => 'general-settings',
                'permission' => 'view_general-settings',
                'icon' => 'ti ti-settings',
                'type' => 'admin_side',
                'parent_id' => null,
                'order' => 2,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Pengaturan Umum'],
                    ['locale' => 'en', 'name' => 'General Settings'],
                    ['locale' => 'zh', 'name' => '常規設定'],
                    ['locale' => 'ja', 'name' => '一般設定'],
                    ['locale' => 'ko', 'name' => '일반 설정'],
                    ['locale' => 'tw', 'name' => '常規設定'],
                ]
            ],
            [
                'id' => 3,
                'name' => 'Home page',
                'url' => 'home-page',
                'permission' => 'view_home-page',
                'icon' => 'ti ti-home',
                'type' => 'admin_side',
                'parent_id' => 2,
                'order' => 1,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Beranda'],
                    ['locale' => 'en', 'name' => 'Home page'],
                    ['locale' => 'zh', 'name' => '首頁'],
                    ['locale' => 'ja', 'name' => 'ホームページ'],
                    ['locale' => 'ko', 'name' => '홈페이지'],
                    ['locale' => 'tw', 'name' => '首頁'],
                ]
            ],
            [
                'id' => 4,
                'name' => 'About Us',
                'url' => 'about-us',
                'permission' => 'view_about-us',
                'icon' => '#',
                'type' => 'admin_side',
                'parent_id' => 2,
                'order' => 2,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Tentang Kami'],
                    ['locale' => 'en', 'name' => 'About Us'],
                    ['locale' => 'zh', 'name' => '關於我們'],
                    ['locale' => 'ja', 'name' => '私たちについて'],
                    ['locale' => 'ko', 'name' => '회사 소개'],
                    ['locale' => 'tw', 'name' => '關於我們'],
                ]
            ],
            [
                'id' => 5,
                'name' => 'Users',
                'url' => 'users',
                'permission' => 'view_users',
                'icon' => '#',
                'type' => 'admin_side',
                'parent_id' => 2,
                'order' => 3,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Pengguna'],
                    ['locale' => 'en', 'name' => 'Users'],
                    ['locale' => 'zh', 'name' => '使用者'],
                    ['locale' => 'ja', 'name' => 'ユーザー'],
                    ['locale' => 'ko', 'name' => '사용자'],
                    ['locale' => 'tw', 'name' => '使用者'],
                ]
            ],
            [
                'id' => 6,
                'name' => 'Menu Permission',
                'url' => 'menu-permission',
                'permission' => 'view_menu-permission',
                'icon' => '#',
                'type' => 'admin_side',
                'parent_id' => 2,
                'order' => 4,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Izin Menu'],
                    ['locale' => 'en', 'name' => 'Menu Permission'],
                    ['locale' => 'zh', 'name' => '選單權限'],
                    ['locale' => 'ja', 'name' => 'メニュー権限'],
                    ['locale' => 'ko', 'name' => '메뉴 권한'],
                    ['locale' => 'tw', 'name' => '選單權限'],
                ]
            ],
            [
                'id' => 7,
                'name' => 'Appointment',
                'url' => 'appointment',
                'permission' => 'view_appointment',
                'icon' => 'ti ti-list',
                'type' => 'admin_side',
                'parent_id' => null,
                'order' => 3,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Janji Temu'],
                    ['locale' => 'en', 'name' => 'Appointment'],
                    ['locale' => 'zh', 'name' => '預約列表'],
                    ['locale' => 'ja', 'name' => '予定をリストアップする'],
                    ['locale' => 'ko', 'name' => '약속 목록'],
                    ['locale' => 'tw', 'name' => '預約列表'],
                ]
            ],
            [
                'id' => 8,
                'name' => 'List Appointment',
                'url' => 'list-appointment',
                'permission' => 'view_list-appointment',
                'icon' => '#',
                'type' => 'admin_side',
                'parent_id' => 7,
                'order' => 1,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Daftar Janji Temu'],
                    ['locale' => 'en', 'name' => 'List Appointment'],
                    ['locale' => 'zh', 'name' => '預約列表'],
                    ['locale' => 'ja', 'name' => '予定をリストアップする'],
                    ['locale' => 'ko', 'name' => '약속 목록'],
                    ['locale' => 'tw', 'name' => '預約列表'],
                ]
            ],
            [
                'id' => 9,
                'name' => 'Form Appointment',
                'url' => 'form-appointment',
                'permission' => 'view_form-appointment',
                'icon' => '#',
                'type' => 'admin_side',
                'parent_id' => 7,
                'order' => 2,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Formulir Janji Temu'],
                    ['locale' => 'en', 'name' => 'Form Appointment'],
                    ['locale' => 'zh', 'name' => '預約表格'],
                    ['locale' => 'ja', 'name' => '予約フォーム'],
                    ['locale' => 'ko', 'name' => '양식 약속'],
                    ['locale' => 'tw', 'name' => '預約表格'],
                ]
            ],
            [
                'id' => 10,
                'name' => 'Special Economic Zone',
                'url' => 'special-economic-zone',
                'permission' => 'view_special-economic-zone',
                'icon' => 'ti ti-building',
                'type' => 'admin_side',
                'parent_id' => null,
                'order' => 4,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Kawasan Ekonomi Khusus'],
                    ['locale' => 'en', 'name' => 'Special Economic Zone'],
                    ['locale' => 'zh', 'name' => '經濟特區'],
                    ['locale' => 'ja', 'name' => '経済特別区'],
                    ['locale' => 'ko', 'name' => '경제특구'],
                    ['locale' => 'tw', 'name' => '經濟特區'],
                ]
            ],
            [
                'id' => 11,
                'name' => 'Article and News',
                'url' => 'article-and-news',
                'permission' => 'view_article-and-news',
                'icon' => 'ti ti-book',
                'type' => 'admin_side',
                'parent_id' => null,
                'order' => 5,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Artikel dan Berita'],
                    ['locale' => 'en', 'name' => 'Article and News'],
                    ['locale' => 'zh', 'name' => '文章和新聞'],
                    ['locale' => 'ja', 'name' => '記事和新聞'],
                    ['locale' => 'ko', 'name' => '文章와 新聞'],
                    ['locale' => 'tw', 'name' => '文章和新聞'],
                ]
            ],
            [
                'id' => 12,
                'name' => 'Gallery',
                'url' => 'gallery',
                'permission' => 'view_gallery',
                'icon' => 'ti ti-photo',
                'type' => 'admin_side',
                'parent_id' => null,
                'order' => 6,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Galeri'],
                    ['locale' => 'en', 'name' => 'Gallery'],
                    ['locale' => 'zh', 'name' => '畫廊'],
                    ['locale' => 'ja', 'name' => 'ギャラリー'],
                    ['locale' => 'ko', 'name' => '갱도'],
                    ['locale' => 'tw', 'name' => '畫廊'],
                ]
            ],
            [
                'id' => 13,
                'name' => 'Brochures',
                'url' => 'brochures',
                'permission' => 'view_brochures',
                'icon' => 'ti ti-notebook',
                'type' => 'admin_side',
                'parent_id' => null,
                'order' => 7,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Brosur'],
                    ['locale' => 'en', 'name' => 'Brochures'],
                    ['locale' => 'zh', 'name' => '宣傳冊'],
                    ['locale' => 'ja', 'name' => 'パンフレット'],
                    ['locale' => 'ko', 'name' => '브로셔'],
                    ['locale' => 'tw', 'name' => '宣傳冊'],
                ]
            ],
            [
                'id' => 14,
                'name' => 'Career',
                'url' => 'career',
                'permission' => 'view_career',
                'icon' => 'ti ti-user-exclamation',
                'type' => 'admin_side',
                'parent_id' => null,
                'order' => 8,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Karir'],
                    ['locale' => 'en', 'name' => 'Career'],
                    ['locale' => 'zh', 'name' => '職業'],
                    ['locale' => 'ja', 'name' => 'キャリア'],
                    ['locale' => 'ko', 'name' => '직업'],
                    ['locale' => 'tw', 'name' => '職業'],
                ]
            ],
            [
                'id' => 15,
                'name' => 'Career List',
                'url' => 'career-list',
                'permission' => 'view_career-list',
                'icon' => '#',
                'type' => 'admin_side',
                'parent_id' => 14,
                'order' => 1,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Daftar Karir'],
                    ['locale' => 'en', 'name' => 'Career List'],
                    ['locale' => 'zh', 'name' => '職業清單'],
                    ['locale' => 'ja', 'name' => 'キャリアリスト'],
                    ['locale' => 'ko', 'name' => '경력 목록'],
                    ['locale' => 'tw', 'name' => '職業清單'],
                ]
            ],
            [
                'id' => 16,
                'name' => 'Career Static',
                'url' => 'career-static',
                'permission' => 'view_career-static',
                'icon' => '#',
                'type' => 'admin_side',
                'parent_id' => 14,
                'order' => 2,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Statis Karir'],
                    ['locale' => 'en', 'name' => 'Career Static'],
                    ['locale' => 'zh', 'name' => '職業靜態'],
                    ['locale' => 'ja', 'name' => 'キャリア静的'],
                    ['locale' => 'ko', 'name' => '경력 정적'],
                    ['locale' => 'tw', 'name' => '職業靜態'],
                ]
            ],
            [
                'id' => 17,
                'name' => 'Career Enquire',
                'url' => 'career-enquire',
                'permission' => 'view_career-enquire',
                'icon' => '#',
                'type' => 'admin_side',
                'parent_id' => 14,
                'order' => 3,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Pertanyaan Karir'],
                    ['locale' => 'en', 'name' => 'Career Enquire'],
                    ['locale' => 'zh', 'name' => '職業諮詢'],
                    ['locale' => 'ja', 'name' => 'キャリアのお問い合わせ'],
                    ['locale' => 'ko', 'name' => '채용문의'],
                    ['locale' => 'tw', 'name' => '職業諮詢'],
                ]
            ],
            [
                'id' => 18,
                'name' => 'Contact',
                'url' => 'contact',
                'permission' => 'view_contact',
                'icon' => 'ti ti-phone',
                'type' => 'admin_side',
                'parent_id' => null,
                'order' => 9,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Kontak'],
                    ['locale' => 'en', 'name' => 'Contact'],
                    ['locale' => 'zh', 'name' => '接觸'],
                    ['locale' => 'ja', 'name' => '接触'],
                    ['locale' => 'ko', 'name' => '연락하다'],
                    ['locale' => 'tw', 'name' => '接觸'],
                ]
            ],
            [
                'id' => 19,
                'name' => 'Contact Overview',
                'url' => 'contact-overview',
                'permission' => 'view_contact-overview',
                'icon' => '#',
                'type' => 'admin_side',
                'parent_id' => 18,
                'order' => 1,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Ikhtisar Kontak'],
                    ['locale' => 'en', 'name' => 'Contact Overview'],
                    ['locale' => 'zh', 'name' => '聯絡方式概覽'],
                    ['locale' => 'ja', 'name' => '連絡先の概要'],
                    ['locale' => 'ko', 'name' => '연락처 개요'],
                    ['locale' => 'tw', 'name' => '聯絡方式概覽'],
                ]
            ],
            [
                'id' => 20,
                'name' => 'Contact Email',
                'url' => 'contact-email',
                'permission' => 'view_contact-email',
                'icon' => '#',
                'type' => 'admin_side',
                'parent_id' => 18,
                'order' => 2,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Kontak Email'],
                    ['locale' => 'en', 'name' => 'Contact Email'],
                    ['locale' => 'zh', 'name' => '聯絡信箱'],
                    ['locale' => 'ja', 'name' => '連絡先メールアドレス'],
                    ['locale' => 'ko', 'name' => '연락처 이메일'],
                    ['locale' => 'tw', 'name' => '聯絡信箱'],
                ]
            ],
            [
                'id' => 21,
                'name' => 'Brochures Email',
                'url' => 'brochures-email',
                'permission' => 'view_brochures-email',
                'icon' => '#',
                'type' => 'admin_side',
                'parent_id' => 18,
                'order' => 3,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Email Brosur'],
                    ['locale' => 'en', 'name' => 'Brochures Email'],
                    ['locale' => 'zh', 'name' => '宣傳冊電子郵件'],
                    ['locale' => 'ja', 'name' => 'パンフレットの電子メール'],
                    ['locale' => 'ko', 'name' => '브로셔 이메일'],
                    ['locale' => 'tw', 'name' => '宣傳冊電子郵件'],
                ]
            ],
            [
                'id' => 22,
                'name' => 'Language',
                'url' => 'language',
                'permission' => 'view_language',
                'icon' => '#',
                'type' => 'admin_side',
                'parent_id' => 2,
                'order' => 5,
                'is_active' => 1,
                'translations' => [
                    ['locale' => 'id', 'name' => 'Bahasa'],
                    ['locale' => 'en', 'name' => 'Language'],
                    ['locale' => 'zh', 'name' => '語言'],
                    ['locale' => 'ja', 'name' => '言語'],
                    ['locale' => 'ko', 'name' => '언어'],
                    ['locale' => 'tw', 'name' => '語言'],
                ]
            ],
        ];

        // Insert permissions first
        foreach ($permissions as $permission) {
            $permission['created_at'] = now();
            $permission['updated_at'] = now();
            DB::table('permissions')->insert($permission);
        }

        // Insert menu data with timestamps
        foreach ($menus as $menuData) {
            $translations = $menuData['translations'];
            unset($menuData['translations']);
            
            // Add timestamps
            $menuData['created_at'] = now();
            $menuData['updated_at'] = now();
            
            // Insert menu
            DB::table('menus')->insert($menuData);
            
            // Insert translations
            foreach ($translations as $translation) {
                $translation['menu_id'] = $menuData['id'];
                $translation['created_at'] = now();
                $translation['updated_at'] = now();
                
                DB::table('menu_translations')->insert($translation);
            }
        }

        $this->command->info('Menu and Permission seeder completed successfully!');
    }
}
