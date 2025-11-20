<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewApplicationNotification extends Notification
{
    use Queueable;

    public $application;

    /**
     * Create a new notification instance.
     */
    public function __construct($application)
    {
        $this->application = $application;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // mengirim notifikasi melalui email dan database
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // deklarasi direktori cv
        $cvUrl = url('storage/' . $this->application->cv);

        return (new MailMessage)
            ->subject('Lamaran Pekerjaan Baru Diterima')
            ->line('Ada lamaran pekerjaan baru untuk lowongan: ' . $this->application->job->title)
            ->line('Pelamar: ' . $this->application->user->name . ' (' . $this->application->user->email . ')')
            ->action('Lihat Lamaran', url('/applications'))

            // untuk download cv
            ->action('Download CV', $cvUrl);
    }

    // Ambil data notifikasi untuk disimpan di database
    public function toDatabase(object $notifiable)
    {
        return [
            'job_title' => $this->application->job->title,
            'user_name' => $this->application->user->name,
            'user_email' => $this->application->user->email,
            'cv' => $this->application->cv,
            'application_id' => $this->application->id,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}