<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterJobLevel;
class MasterJobLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterJobLevel::truncate();
        $data = [
            [
                'name' => 'Fresh Graduate',
                'created_at' => now()
            ],
            [
                'name' => 'Staff',
                'created_at' => now()
            ],
            [
                'name' => 'Supervisor',
                'created_at' => now()
            ],
            [
                'name' => 'Assistant Manager',
                'created_at' => now()
            ],
            [
                'name' => 'Manager',
                'created_at' => now()
            ],
            [
                'name' => 'Senior Manager',
                'created_at' => now()
            ],
            [
                'name' => 'General Manager',
                'created_at' => now()
            ],
        ];

        MasterJobLevel::insert($data);
    }
}
