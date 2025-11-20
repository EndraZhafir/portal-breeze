<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobVacancy;

class JobVacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lowongan 1 - Backend Developer
        JobVacancy::updateOrCreate(
            ['title' => 'Backend Developer'],
            [
                'description'    => 'Backend Developer suatu web Laravel.',
                'location'       => 'Yogyakarta',
                'company'        => 'PT. Laravel',
                'logo'           => 'logos/Laravel.png',
                'salary'         => 5000000,
                'jenis_pekerjaan'=> 'Full-time',
            ]
        );

        // Lowongan 2 - Frontend Developer
        JobVacancy::updateOrCreate(
            ['title' => 'Frontend Developer'],
            [
                'description'    => 'Frontend Developer suatu web Laravel.',
                'location'       => 'Yogyakarta',
                'company'        => 'PT. Laravel',
                'logo'           => 'logos/Laravel.png',
                'salary'         => 5000000,
                'jenis_pekerjaan'=> 'Full-time',
            ]
        );
    }
}
