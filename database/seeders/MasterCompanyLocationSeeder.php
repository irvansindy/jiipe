<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterCompanyLocation;
class MasterCompanyLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterCompanyLocation::truncate();
        $data = [[
            'name' => 'Gresik',
            'created_at' => now()
        ], [
            'name' => 'Jakarta',
            'created_at' => now()
        ]];

        MasterCompanyLocation::insert($data);
    }
}
