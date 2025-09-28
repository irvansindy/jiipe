<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterCompany;
class MasterCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterCompany::truncate();
        MasterCompany::create([
            'name'=> 'PT BERKAH KAWASAN MANYAR SEJAHTERA',
            'created_at' => now()
        ]);
    }
}
