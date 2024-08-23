<!DOCTYPE html>
<html>

<head>
    <title>Bienvenido a la plataforma</title>
    <style>
        .card {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: Arial, sans-serif;
        }

        .card-img {
            width: 100%;
            border-radius: 5px 5px 0 0;
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .card-body h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .card-body p {
            font-size: 16px;
            color: #333;
        }

        .card-body .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
        }

        .card-body .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="card">
        <img src="https://i.ibb.co/NtNknrp/Whats-App-Image-2024-08-23-at-2-39-38-AM.jpg" alt="Bienvenido" class="card-img">
        <div class="card-body">
            <h2>¡Bienvenido, {{ $nombre }}!</h2>
            <p>Tu cuenta como {{ $rol }} ha sido creada exitosamente. Estamos emocionados de que te unas a
                nuestra plataforma.</p>
            <a href="{{ url('/') }}" class="btn">Ir a la plataforma</a>
        </div>
    </div>
</body>

</html>
