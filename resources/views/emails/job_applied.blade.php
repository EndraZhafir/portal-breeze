@component('mail::message')
# Lamaran Diterima

Halo **{{ $user->name }}**, 

Terima kasih telah melamar pekerjaan **{{ $job->title }}** di **{{ $job->company }}**.

Lamaran Anda telah kami terima dan sedang diproses oleh tim HR kami.

@component('mail::button', ['url' => url('/')])
Kunjungi Portal
@endcomponent

Salam,
JobPortal
@endcomponent