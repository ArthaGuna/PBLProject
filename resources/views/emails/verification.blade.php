<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
</head>
<body>
    <p>Hai {{ $name }},</p>

    <p>Terima kasih telah mendaftar di platform kami. Silakan gunakan kode verifikasi berikut untuk mengaktifkan akun Anda:</p>

    <div style="text-align: center; font-size: 20px;">
        <strong>{{ $verificationCode }}</strong>
    </div>

    <p>Jangan bagikan kode ini kepada siapa pun. Kode ini berlaku hingga {{ $expirationTime }}. Jika ada pertanyaan, hubungi kami di gerabahkuturan@gmail.com.</p>

    <br>
    <p style="text-align: center; font-size: 16px;">Thank You</p> <br>
    <p style="text-align: center;">Amerta Sedana</p>
    <p style="text-align: center;">Ikuti kami di <a href="https://instagram.com/amertasedana_kuturan" target="_blank">Instagram</a></p>
</body>
</html>
