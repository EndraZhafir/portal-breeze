<?php

namespace App\Imports;

use App\Models\JobVacancy as Job;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JobsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $jobType = $row['jenis_pekerjaan'] ?? null;
        if ($jobType) {
            $normalized = str_replace(['_', '  '], [' ', ' '], trim($jobType));
            $normalized = ucwords(strtolower($normalized));
            $normalized = str_replace(' ', '-', $normalized);
            if (!in_array($normalized, ['Full-time','Part-time'])) {
                $normalized = null;
            }
            $jobType = $normalized;
        }

        return new Job([
            'title' => $row['title'] ?? null,
            'description' => $row['description'] ?? null,
            'company' => $row['company'] ?? null,
            'location' => $row['location'] ?? null,
            'job_type' => $jobType,
            'salary' => $row['salary'] ?? null,
        ]);
    }
}
