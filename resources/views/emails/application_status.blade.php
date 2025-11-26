<!DOCTYPE html>
<html>
<head>
    <title>Update Status Lamaran</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">

    <h2>Halo, {{ $application->user->name }}!</h2>
    <p>Ada pembaruan status untuk lamaran pekerjaan yang Anda ajukan pada posisi:
        <strong>{{ $application->job->title }}</strong>.
    </p>
    <p>Status lamaran Anda saat ini adalah:</p>
    <h3 style="color: {{ $application->status == 'Accepted' ? 'green' : 'red' }};">
        {{ $application->status == 'Accepted' ? 'DITERIMA' : 'DITOLAK' }}
    </h3>
    @if ($application->status == 'Accepted')
        <p>Selamat! Silakan cek dashboard Anda untuk informasi langkah selanjutnya.</p>
    @else
        <p>Jangan berkecil hati, tetap semangat dan coba lamar di posisi lainnya.</p>
    @endif
    <br>
    <p>
        <a href="{{ route('dashboard') }}"
            style="background-color: #4F46E5; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Cek Dashboard
        </a>
    </p>
    <p>Terima kasih,<br>Tim HRD</p>

</body>
</html>