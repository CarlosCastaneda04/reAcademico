<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de IP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            margin: 20px;
            overflow: hidden;
        }

        .card-img {
            width: 100%;
            height: auto;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }

        .btn-outline {
            display: inline-block;
            padding: 10px 20px;
            border: 2px solid #007bff;
            color: #007bff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-outline:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="card">
        <img src="https://i.ibb.co/nD2rqFS/Whats-App-Image-2024-08-23-at-5-06-39-AM.jpg" alt="Verificación de IP"
            class="card-img">
        <div class="card-body">
            <h2 class="card-title">Verificación de IP</h2>
            <p class="card-text">Hola {{ $nombre }},</p>
            <p class="card-text">Hemos detectado un intento de inicio de sesión desde una nueva IP: {{ $ip }}.
            </p>
            <p class="card-text">Si este inicio de sesión es tuyo, haz clic en el siguiente enlace para permitir el
                acceso desde esta IP:</p>
            <a href="{{ route('ip.verify', ['user' => $user->id, 'ip' => $ip]) }}" class="btn-outline">Permitir esta
                IP</a>
        </div>
    </div>
</body>

</html>
