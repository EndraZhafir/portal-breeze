<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct($application)
    {
        $this->application = $application;
    }

    public function envelope(): Envelope
    {
        $status = $this->application->status;
        return new Envelope(
            subject: "Update Status Lamaran: {$this->application->job->title} - ($status)",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application_status',
            with: [
                'application' => $this->application,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
