<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobAppliedMail;

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
        $job = \App\Models\JobVacancy::find($this->jobId);
        $user = \App\Models\User::find($this->userId);
        \Log::info('SendApplicationMailJob', [
            'user_email' => $user ? $user->email : null,
            'job_title' => $job ? $job->title : null,
        ]);
        if ($job && $user) {
            Mail::to($user->email)->send(new JobAppliedMail($job, $user));
        }
    }
}
