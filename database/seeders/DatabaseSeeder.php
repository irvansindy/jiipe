<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LanguageSeeder::class,
            NewsCategoriesSeeder::class,
            NewsSeeder::class,
            TopicSeeder::class,
            ZoneClassSeeder::class,
            UsersSeeder::class,
            MenuSeeder::class,
            MasterCompanyLocationSeeder::class,
            MasterCompanySeeder::class,
            MasterEducationSeeder::class,
            MasterJobLevelSeeder::class,
            TopicSeeder::class,
            TenantSeeder::class,
            HomeSliderSeeder::class,
            CareerSeeder::class,
            AreaShowCaseSeeder::class,
            ZoneSeeder::class,
            VideoTourSeeder::class,
            ReviewSeeder::class,
            FrequentlyAskedQuestionsSeeder::class,
            CareerSeeder::class,
            GallerySeeder::class,
        ]);
    }
}
