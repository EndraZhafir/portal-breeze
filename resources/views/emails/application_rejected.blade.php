@component('mail::message')
# Maaf, lamaran Anda ditolak

Lamaran Anda untuk posisi **{{ $application->job->title }}** telah ditolak.

Terima kasih sudah melamar di **{{ $application->job->company }}**.

@component('mail::button', ['url' => url('/')])
Kunjungi Portal
@endcomponent

Salam,
JobPortal
@endcomponent
