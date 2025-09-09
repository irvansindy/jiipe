<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ZoneClass;
use App\Models\ZoneClassTranslation;
class ZoneClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zoneClasses = [
            [
                'translations' => [
                    'id' => 'Zona',
                    'en' => 'Zone',
                    'zh' => '区域',
                    'ja' => 'ゾーン',
                    'ko' => '존',
                    'tw' => '區域',
                ]
            ],
            [
                'translations' => [
                    'id' => 'Kawasan Ekonomi Khusus',
                    'en' => 'Special Economic Zone',
                    'zh' => '经济特区',
                    'ja' => '経済特区',
                    'ko' => '경제특구',
                    'tw' => '經濟特區',
                ]
            ],
        ];

        foreach ($zoneClasses as $zoneClassData) {
            $zoneClass = ZoneClass::create();

            foreach ($zoneClassData['translations'] as $locale => $name) {
                ZoneClassTranslation::create([
                    'zone_class_id' => $zoneClass->id,
                    'locale' => $locale,
                    'name' => $name,
                ]);
            }
        }
    }
}
