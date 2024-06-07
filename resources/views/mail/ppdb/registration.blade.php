<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Kredensial</title>
</head>

<body>
    <h1>Selamat! Anda telah berhasil mendaftar di Sekolah Kami.</h1>
    <h2 class="content-title">Pengumuman</h2>
    <strong>{{ $interview->title }}</strong> dilakukan secara <strong>{{ $interview->method }}</strong> pada tanggal
    <strong>{{ $interview->interview_date->format('d M Y') }}</strong>
    <p>
        {{ $interview->method === 'online' ? ($interview->link ? "Silakan akses wawancara online Anda di <a href='{$interview->link}'>tautan ini</a>." : 'Link belum dibuat oleh admin.') : '' }}
    </p>


    <p>Berikut adalah kredensial Anda:</p>
    <ul>
        <li>Email: {{ $student->email }}</li>
        <li>Password: {{ $password }}</li>
    </ul>
    <p>Harap simpan kredensial Anda dengan aman.</p>
    <p>Terima kasih telah mendaftar di Sekolah Kami.</p>
</body>

</html>
