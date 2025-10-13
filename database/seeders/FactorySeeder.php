<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Factory;
class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Factory::truncate();
        $factory = Factory::insert([
            [
                'name' => 'PT. Berkah Kawasan Manyar Sejahtera',
                'email' => 'info@jiipe.com',
                'phone' => '+6231 985 409 99',
                'address' => 'Jl. Raya Manyar Km. 11, Manyar-Gresik, East Java 61151',
                'map' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4708.47778390834!2d112.60630531539316!3d-7.086283609900546!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77fd91cbf94199%3A0x420bcb75aab89777!2sKawasan%20Industri%20JIIPE%20Gresik!5e0!3m2!1sid!2sid!4v1649750031552!5m2!1sid!2sid'
            ], [
                'name' => 'AKR Tower 25th Floor',
                'email' => 'info@jiipe.com',
                'phone'=> '+6221 256 745 62',
                'address' => 'Jl. Perjuangan No. 5 Kebon Jeruk, West Jakarta 11530',
                'map'=> 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4708.47778390834!2d112.60630531539316!3d-7.086283609900546!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77fd91cbf94199%3A0x420bcb75aab89777!2sKawasan%20Industri%20JIIPE%20Gresik!5e0!3m2!1sid!2sid!4v1649750031552!5m2!1sid!2sid'
            ]
    ]);
    }
}
