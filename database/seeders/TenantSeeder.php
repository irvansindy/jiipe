<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;
use App\Models\TenantTranslation;

class TenantSeeder extends Seeder
{
    public function run()
    {
        Tenant::truncate();
        TenantTranslation::truncate();

        $tenants = [
            [
                'logo' => '0df79-Xinyi Glass.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Xinyi Glass'],
                    'id' => ['name' => 'Xinyi Glass'],
                    'zh' => ['name' => '信义玻璃'],
                    'ja' => ['name' => 'シンイーグラス'],
                    'ko' => ['name' => '신이글라스'],
                    'tw' => ['name' => '信義玻璃'],
                ],
            ],
            [
                'logo' => '1cac5-Bank Indonesia.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Bank Indonesia'],
                    'id' => ['name' => 'Bank Indonesia'],
                    'zh' => ['name' => '印度尼西亚银行'],
                    'ja' => ['name' => 'インドネシア銀行'],
                    'ko' => ['name' => '인도네시아은행'],
                    'tw' => ['name' => '印尼銀行'],
                ],
            ],
            [
                'logo' => '3b87a-ambercycle.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Ambercycle'],
                    'id' => ['name' => 'Ambercycle'],
                    'zh' => ['name' => 'Ambercycle'],
                    'ja' => ['name' => 'アンバーサイクル'],
                    'ko' => ['name' => '앰버사이클'],
                    'tw' => ['name' => 'Ambercycle'],
                ],
            ],
            [
                'logo' => '4bf00-Sari_Roti-Rotinya_Indonesia.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Sari Roti - Indonesia\'s Bread'],
                    'id' => ['name' => 'Sari Roti - Rotinya Indonesia'],
                    'zh' => ['name' => 'Sari Roti - 印度尼西亚面包'],
                    'ja' => ['name' => 'サリロティ - インドネシアのパン'],
                    'ko' => ['name' => '사리로티 - 인도네시아의 빵'],
                    'tw' => ['name' => 'Sari Roti - 印尼麵包'],
                ],
            ],
            [
                'logo' => '4ea03-XYG.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'XYG'],
                    'id' => ['name' => 'XYG'],
                    'zh' => ['name' => 'XYG'],
                    'ja' => ['name' => 'XYG'],
                    'ko' => ['name' => 'XYG'],
                    'tw' => ['name' => 'XYG'],
                ],
            ],
            [
                'logo' => '4f05b-clariant.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Clariant'],
                    'id' => ['name' => 'Clariant'],
                    'zh' => ['name' => '科莱恩'],
                    'ja' => ['name' => 'クラリアント'],
                    'ko' => ['name' => '클라리안트'],
                    'tw' => ['name' => '科萊恩'],
                ],
            ],
            [
                'logo' => '5a7de-Sari Roti 2.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Sari Roti'],
                    'id' => ['name' => 'Sari Roti'],
                    'zh' => ['name' => 'Sari Roti'],
                    'ja' => ['name' => 'サリロティ'],
                    'ko' => ['name' => '사리로티'],
                    'tw' => ['name' => 'Sari Roti'],
                ],
            ],
            [
                'logo' => '5d0ed-logo-fullname.PNG',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Company Logo'],
                    'id' => ['name' => 'Logo Perusahaan'],
                    'zh' => ['name' => '公司标志'],
                    'ja' => ['name' => '会社ロゴ'],
                    'ko' => ['name' => '회사 로고'],
                    'tw' => ['name' => '公司標誌'],
                ],
            ],
            [
                'logo' => '6d10c-tirta bahagia.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Tirta Bahagia'],
                    'id' => ['name' => 'Tirta Bahagia'],
                    'zh' => ['name' => 'Tirta Bahagia'],
                    'ja' => ['name' => 'ティルタバハギア'],
                    'ko' => ['name' => '티르타 바하기아'],
                    'tw' => ['name' => 'Tirta Bahagia'],
                ],
            ],
            [
                'logo' => '7abab-hailiang英文LOGO.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Hailiang'],
                    'id' => ['name' => 'Hailiang'],
                    'zh' => ['name' => '海亮'],
                    'ja' => ['name' => 'ハイリアン'],
                    'ko' => ['name' => '하이량'],
                    'tw' => ['name' => '海亮'],
                ],
            ],
            [
                'logo' => '9efd6-PT Freeport Indonesia.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'PT Freeport Indonesia'],
                    'id' => ['name' => 'PT Freeport Indonesia'],
                    'zh' => ['name' => 'PT Freeport印度尼西亚'],
                    'ja' => ['name' => 'PTフリーポートインドネシア'],
                    'ko' => ['name' => 'PT 프리포트 인도네시아'],
                    'tw' => ['name' => 'PT Freeport印尼'],
                ],
            ],
            [
                'logo' => '29f31-hailiang英文LOGO.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Hailiang'],
                    'id' => ['name' => 'Hailiang'],
                    'zh' => ['name' => '海亮'],
                    'ja' => ['name' => 'ハイリアン'],
                    'ko' => ['name' => '하이량'],
                    'tw' => ['name' => '海亮'],
                ],
            ],
            [
                'logo' => '38d69-hailiang英文LOGO-1.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Hailiang'],
                    'id' => ['name' => 'Hailiang'],
                    'zh' => ['name' => '海亮'],
                    'ja' => ['name' => 'ハイリアン'],
                    'ko' => ['name' => '하이량'],
                    'tw' => ['name' => '海亮'],
                ],
            ],
            [
                'logo' => '41c8c-Freeport Indonesia.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Freeport Indonesia'],
                    'id' => ['name' => 'Freeport Indonesia'],
                    'zh' => ['name' => 'Freeport印度尼西亚'],
                    'ja' => ['name' => 'フリーポートインドネシア'],
                    'ko' => ['name' => '프리포트 인도네시아'],
                    'tw' => ['name' => 'Freeport印尼'],
                ],
            ],
            [
                'logo' => '46c37-Logo PCI.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'PCI'],
                    'id' => ['name' => 'PCI'],
                    'zh' => ['name' => 'PCI'],
                    'ja' => ['name' => 'PCI'],
                    'ko' => ['name' => 'PCI'],
                    'tw' => ['name' => 'PCI'],
                ],
            ],
            [
                'logo' => '46e69-19 - Hebang Biotechnology Indonesia.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Hebang Biotechnology Indonesia'],
                    'id' => ['name' => 'Hebang Biotechnology Indonesia'],
                    'zh' => ['name' => '和邦生物科技印度尼西亚'],
                    'ja' => ['name' => 'ヘバンバイオテクノロジーインドネシア'],
                    'ko' => ['name' => '허방 생명공학 인도네시아'],
                    'tw' => ['name' => '和邦生物科技印尼'],
                ],
            ],
            [
                'logo' => '49eea-hailiang英文LOGO.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Hailiang'],
                    'id' => ['name' => 'Hailiang'],
                    'zh' => ['name' => '海亮'],
                    'ja' => ['name' => 'ハイリアン'],
                    'ko' => ['name' => '하이량'],
                    'tw' => ['name' => '海亮'],
                ],
            ],
            [
                'logo' => '80ba7-waskita.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Waskita'],
                    'id' => ['name' => 'Waskita'],
                    'zh' => ['name' => 'Waskita'],
                    'ja' => ['name' => 'ワスキタ'],
                    'ko' => ['name' => '와스키타'],
                    'tw' => ['name' => 'Waskita'],
                ],
            ],
            [
                'logo' => '099f5-Bank Indonesia.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Bank Indonesia'],
                    'id' => ['name' => 'Bank Indonesia'],
                    'zh' => ['name' => '印度尼西亚银行'],
                    'ja' => ['name' => 'インドネシア銀行'],
                    'ko' => ['name' => '인도네시아은행'],
                    'tw' => ['name' => '印尼銀行'],
                ],
            ],
            [
                'logo' => '333d0-Hailiang.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Hailiang'],
                    'id' => ['name' => 'Hailiang'],
                    'zh' => ['name' => '海亮'],
                    'ja' => ['name' => 'ハイリアン'],
                    'ko' => ['name' => '하이량'],
                    'tw' => ['name' => '海亮'],
                ],
            ],
            [
                'logo' => '467c2-XINYI Glass logo.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Xinyi Glass'],
                    'id' => ['name' => 'Xinyi Glass'],
                    'zh' => ['name' => '信义玻璃'],
                    'ja' => ['name' => 'シンイーグラス'],
                    'ko' => ['name' => '신이글라스'],
                    'tw' => ['name' => '信義玻璃'],
                ],
            ],
            [
                'logo' => '682ef-hailiang.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'Hailiang'],
                    'id' => ['name' => 'Hailiang'],
                    'zh' => ['name' => '海亮'],
                    'ja' => ['name' => 'ハイリアン'],
                    'ko' => ['name' => '하이량'],
                    'tw' => ['name' => '海亮'],
                ],
            ],
            [
                'logo' => '0834f-BJTI.png',
                'is_active' => 1,
                'translations' => [
                    'en' => ['name' => 'BJTI'],
                    'id' => ['name' => 'BJTI'],
                    'zh' => ['name' => 'BJTI'],
                    'ja' => ['name' => 'BJTI'],
                    'ko' => ['name' => 'BJTI'],
                    'tw' => ['name' => 'BJTI'],
                ],
            ],
        ];

        foreach ($tenants as $tenantData) {
            $tenant = Tenant::create([
                'logo' => $tenantData['logo'],
                'is_active' => $tenantData['is_active'],
            ]);
            foreach ($tenantData['translations'] as $locale => $trans) {
                TenantTranslation::create([
                    'tenant_id' => $tenant->id,
                    'locale' => $locale,
                    'name' => $trans['name'],
                ]);
            }
        }
    }
}