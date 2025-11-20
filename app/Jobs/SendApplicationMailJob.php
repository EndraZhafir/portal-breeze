<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobAppliedMail;
use App\Models\User;
use App\Models\JobVacancy;

class SendApplicationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $jobId;
    public $userId;

    /**
     * Create a new job instance.
     */
    public function __construct($jobId, $userId)
    {
        $this->jobId = $jobId;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = User::find($this->userId);
        $job = JobVacancy::find($this->jobId);

        if (!$user || !$job) {
            return;
        }

        Mail::to($user->email)->send(new JobAppliedMail($job, $user));
    }
}
