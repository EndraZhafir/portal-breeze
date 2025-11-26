<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString; // <- Jangan lupa import ini

class NewApplicationNotification extends Notification
{
    use Queueable;

    public $application;

    public function __construct($application)
    {
        $this->application = $application;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // URL untuk download
        $cvUrl = route('download.cv', ['application' => $this->application->id]);

        return (new MailMessage)
            ->subject('Lamaran Baru Diterima')
            ->greeting('Halo Admin,')
            ->line('Ada lamaran baru untuk pekerjaan: ' . $this->application->job->title)
            ->line('Nama Pelamar: ' . $this->application->user->name)
            
            ->line(new HtmlString('Silakan unduh CV pelamar melalui link berikut: <br> 
                <a href="' . $cvUrl . '" style="color: #2563eb; text-decoration: underline;"><strong>Klik Disini untuk Download CV</strong></a>'))

            // Tombol Utama
            ->action('Lihat Detail Lamaran', route('applications.index'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'job_id' => $this->application->job->id,
            'job_title' => $this->application->job->title,
            'user_name' => $this->application->user->name,
            'message' => 'Pelamar baru: ' . $this->application->user->name . ' melamar untuk posisi ' . $this->application->job->title,
        ];
    }
}