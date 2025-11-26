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
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    public $jobVacancy;
    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct($jobVacancy, $user)
    {
        $this->jobVacancy = $jobVacancy;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new JobAppliedMail($this->jobVacancy, $this->user));
    }
}
