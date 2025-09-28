<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterEducation;
class MasterEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterEducation::truncate();
        $data = [
            [
                'name' => 'SMA/SMU/SMK',
                'created_at' => now()
            ],
            [
                'name' => 'D3',
                'created_at' => now()
            ],
            [
                'name' => 'S1',
                'created_at' => now()
            ],
            [
                'name' => 'S2',
                'created_at' => now()
            ],
        ];
        MasterEducation::insert($data);
    }
}
