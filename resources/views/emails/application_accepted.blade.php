@component('mail::message')
# Selamat!

Lamaran Anda untuk posisi **{{ $application->job->title }}** telah diterima.

Terima kasih sudah melamar di **{{ $application->job->company }}**.

Tunggu informasi selanjutnya dari tim HR kami.

@component('mail::button', ['url' => url('/')])
Kunjungi Portal
@endcomponent

Salam,
JobPortal
@endcomponent
