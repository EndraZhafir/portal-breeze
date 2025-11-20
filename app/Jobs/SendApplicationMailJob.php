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
use App\Models\JobVacancy as Job;

class SendApplicationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $jobId;
    public $userId;

    /**
     * Create a new job instance.
     */
    public function __construct($job, $user)
    {
        $this->jobId = $job;
        $this->userId = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = User::find($this->userId);
        $job = Job::find($this->jobId);

        if (!$user || !$job) {
            return; // data hilang, jangan kirim email
        }

        Mail::to($user->email)->send(new JobAppliedMail($job, $user));
    }
}
