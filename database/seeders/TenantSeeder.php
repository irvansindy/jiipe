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
            // ...tambahkan tenant lain sesuai array di blade
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
