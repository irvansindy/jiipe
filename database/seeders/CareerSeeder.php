<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table("careers")->delete();
        \DB::table("careers")->insert([
            [
                'position' => 'Software Engineer',
                'factory_id' => 1,
                'location_id' => 1,
                'education_id' => 1,
                'job_level_id' => 2,
                'range_salary' => '5000000-10000000',
                // 'minimum_education' => 'Bachelor',
                'minimum_experience' => '2 years',
                'description' => 'Responsible for developing and maintaining software applications.',
            ],
            [
                'position' => 'Data Analyst',
                'factory_id' => 2,
                'location_id' => 1,
                'education_id' => 1,
                'job_level_id' => 2,
                'range_salary' => '4000000-8000000',
                // 'minimum_education' => 'Bachelor',
                'minimum_experience' => '1 year',
                'description' => 'Analyze data and generate reports.',
            ],
            [
                'position' => 'Product Manager',
                'factory_id' => 1,
                'location_id' => 1,
                'education_id' => 2,
                'job_level_id' => 3,
                'range_salary' => '6000000-12000000',
                // 'minimum_education' => 'Master',
                'minimum_experience' => '5 years',
                'description' => 'Oversee product development and strategy.',
            ],
            [
                'position' => 'UX Designer',
                'factory_id' => 3,
                'location_id' => 1,
                'education_id' => 1,
                'job_level_id' => 2,
                'range_salary' => '5000000-9000000',
                // 'minimum_education' => 'Bachelor',
                'minimum_experience' => '3 years',
                'description' => 'Design user-friendly interfaces and experiences.',
            ],
        ]);
    }
}
