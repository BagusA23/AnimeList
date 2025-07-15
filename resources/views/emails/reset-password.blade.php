<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <h2>Halo {{ $user->name }} 👋</h2>
    <p>Kami menerima permintaan untuk reset password akun kamu.</p>

    <p><a href="{{ $url }}" style="background-color:#1d4ed8; color:white; padding:10px 15px; text-decoration:none; border-radius:5px;">Reset Password Sekarang</a></p>

    <p>Link ini hanya berlaku selama 60 menit.</p>
    <p>Kalau kamu tidak merasa meminta reset password, abaikan email ini.</p>
    
    <p>Salam cerdas,</p>
    <p><b>💡 Tim SmartHome Bagus</b></p>
</body>
</html>
    