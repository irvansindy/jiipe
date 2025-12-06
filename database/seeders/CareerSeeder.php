<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;
use App\Models\CareerHeader;
use App\Models\CareerHeaderTranslation;
use App\Models\CareerSection;
use App\Models\CareerSectionTranslation;
use App\Models\Factory;
use App\Models\MasterCompanyLocation;
use App\Models\MasterEducation;
use App\Models\MasterJobLevel;

class CareerSeeder extends Seeder
{
    public function run()
    {
        CareerHeaderTranslation::truncate();
        CareerHeader::truncate();
        CareerSectionTranslation::truncate();
        CareerSection::truncate();
        Career::truncate();

        // Seed Master Data first
        $this->seedMasterData();

        // Seed Career Header
        $this->seedCareerHeader();

        // Seed Career Section
        $this->seedCareerSection();

        // Seed Careers
        $this->seedCareers();
    }

    private function seedMasterData()
    {
        // Create Locations
        $locations = ['Gresik, Indonesia', 'Jakarta, Indonesia'];
        foreach ($locations as $location) {
            if (!MasterCompanyLocation::where('name', $location)->exists()) {
                MasterCompanyLocation::create(['name' => $location]);
            }
        }

        // Create Education Levels
        $educations = ['SMA/SMK', 'D3', 'S1', 'S2'];
        foreach ($educations as $education) {
            if (!MasterEducation::where('name', $education)->exists()) {
                MasterEducation::create(['name' => $education]);
            }
        }

        // // Create Job Levels
        // $jobLevels = [
        //     'Fresh Graduate',
        //     'Staff',
        //     'Supervisor',
        //     'Ass Manager',
        //     'Manager',
        //     'Senior Manager'
        // ];
        // foreach ($jobLevels as $level) {
        //     if (!MasterJobLevel::where('name', $level)->exists()) {
        //         MasterJobLevel::create(['name' => $level]);
        //     }
        // }
    }

    private function seedCareerHeader()
    {
        $careerHeader = CareerHeader::create([
            'image' => 'header_career.jpg'
        ]);

        $translations = [
            'en' => 'Career Opportunities',
            'id' => 'Peluang Karir',
        ];

        foreach ($translations as $locale => $title) {
            CareerHeaderTranslation::create([
                'career_header_id' => $careerHeader->id,
                'locale' => $locale,
                'title' => $title
            ]);
        }
    }

    private function seedCareerSection()
    {
        $careerSection = CareerSection::create([]);

        $translations = [
            'en' => [
                'title' => '<h2>Join us and grow your career</h2><h5><p>Find your suitable job vacancies and fill out the form.</p></h5>',
                'content' => 'We are always looking for talented individuals to join our team.'
            ],
            'id' => [
                'title' => '<h2>Bergabunglah dengan kami dan kembangkan karir Anda</h2><h5><p>Temukan lowongan pekerjaan yang sesuai dan isi formulir.</p></h5>',
                'content' => 'Kami selalu mencari individu berbakat untuk bergabung dengan tim kami.'
            ],
        ];

        foreach ($translations as $locale => $data) {
            CareerSectionTranslation::create([
                'career_section_id' => $careerSection->id,
                'locale' => $locale,
                'title' => $data['title'],
                'content' => $data['content']
            ]);
        }
    }

    private function seedCareers()
    {
        $factory = Factory::first();
        $location = MasterCompanyLocation::where('name', 'Gresik, Indonesia')->first();

        $careers = [
            [
                'position' => 'IT SUPPORT FOR AUTOGATE SYSTEM',
                'education' => 'S1',
                'job_level' => 'Staff',
                'min_experience' => '1-2 Years',
                'description' => 'Responsible for maintaining and supporting autogate systems.',
                'requirements' => 'Bachelor degree in Computer Science or related field. Experience with hardware and software troubleshooting.'
            ],
            [
                'position' => 'MAINTENANCE WTP WWTP',
                'education' => 'S1',
                'job_level' => 'Staff',
                'min_experience' => '3-5 Years',
                'description' => 'Maintain and operate Water Treatment Plant and Waste Water Treatment Plant.',
                'requirements' => 'Bachelor degree in Chemical Engineering or related field. Experience in WTP/WWTP operations.'
            ],
            [
                'position' => 'GAS OPERATION & MAINTENANCE (SHIFT LEADER)',
                'education' => 'S1',
                'job_level' => 'Supervisor',
                'min_experience' => '5-10 Years',
                'description' => 'Lead shift operations for gas facilities.',
                'requirements' => 'Bachelor degree in Mechanical Engineering. Strong leadership skills.'
            ],
            [
                'position' => 'MEP (Mechanical Electrical Plumbing)',
                'education' => 'S1',
                'job_level' => 'Ass Manager',
                'min_experience' => '> 10 Years',
                'description' => 'Oversee MEP systems and maintenance.',
                'requirements' => 'Bachelor degree in Mechanical or Electrical Engineering. Extensive experience in MEP.'
            ],
            [
                'position' => 'TRAINEE POWER PLANT',
                'education' => 'S1',
                'job_level' => 'Fresh Graduate',
                'min_experience' => '0 Years',
                'description' => 'Training program for power plant operations.',
                'requirements' => 'Fresh graduate with Bachelor degree in Electrical or Mechanical Engineering.'
            ],
            [
                'position' => 'EXTERNAL RELATION',
                'education' => 'S1',
                'job_level' => 'Ass Manager',
                'min_experience' => '5-10 Years',
                'description' => 'Manage external stakeholder relationships.',
                'requirements' => 'Bachelor degree in Communications or related field. Strong communication skills.'
            ],
            [
                'position' => 'RECRUITMENT',
                'education' => 'S1',
                'job_level' => 'Supervisor',
                'min_experience' => '3-5 Years',
                'description' => 'Handle recruitment processes and talent acquisition.',
                'requirements' => 'Bachelor degree in Psychology or HR Management. Experience in recruitment.'
            ],
            [
                'position' => 'SALES & MARKETING',
                'education' => 'S1',
                'job_level' => 'Manager',
                'min_experience' => '> 10 Years',
                'description' => 'Lead sales and marketing strategies.',
                'requirements' => 'Bachelor degree in Marketing or Business. Proven track record in sales.'
            ],
            [
                'position' => 'HEAD OF WATER TREATMENT PLANT & WASTE WATER TREATMENT PLANT',
                'education' => 'S1',
                'job_level' => 'Senior Manager',
                'min_experience' => '> 10 Years',
                'description' => 'Lead WTP and WWTP operations.',
                'requirements' => 'Bachelor degree in Chemical Engineering. Extensive management experience.'
            ],
            [
                'position' => 'WTP/WWTP OPERATION (OPERATIVE LEVEL)',
                'education' => 'S1',
                'job_level' => 'Fresh Graduate',
                'min_experience' => '0 Years',
                'description' => 'Operate WTP/WWTP facilities.',
                'requirements' => 'Fresh graduate with Bachelor degree in Chemical or Environmental Engineering.'
            ],
        ];

        foreach ($careers as $careerData) {
            $education = MasterEducation::where('name', $careerData['education'])->first();
            $jobLevel = MasterJobLevel::where('name', $careerData['job_level'])->first();

            Career::create([
                'position' => $careerData['position'],
                'factory_id' => 1,
                'location_id' => $location->id,
                'education_id' => $education->id,
                'job_level_id' => 1,
                'min_experience' => $careerData['min_experience'],
                'description' => $careerData['description'],
                'requirements' => $careerData['requirements'],
                'is_active' => true
            ]);
        }
    }
}