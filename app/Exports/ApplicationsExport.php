<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ApplicationsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected ?int $jobId;

    /**
     * @param int|null $jobId
     */
    public function __construct(?int $jobId = null)
    {
        $this->jobId = $jobId;
    }

    /**
     * Build the base query. We only select needed columns for performance.
     */
    public function query()
    {
        $query = Application::query()
            ->select(['id','user_id','job_id','status','created_at'])
            ->with([
                'user:id,name,email',
                'job:id,title,company'
            ]);

        if ($this->jobId) {
            $query->where('job_id', $this->jobId);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID Pelamar',
            'Nama Pelamar',
            'Email',
            'Lowongan Dilamar',
            'Perusahaan',
            'Status',
            'Tanggal Melamar',
        ];
    }

    public function map($application): array
    {
        return [
            $application->id,
            optional($application->user)->name ?? '-',
            optional($application->user)->email ?? '-',
            optional($application->job)->title ?? '-',
            optional($application->job)->company ?? '-',
            $application->status,
            $application->created_at?->format('Y-m-d H:i:s') ?? '-',
        ];
    }
}
