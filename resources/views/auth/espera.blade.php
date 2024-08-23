@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Esperando Verificación de IP</h4>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://i.ibb.co/nD2rqFS/Whats-App-Image-2024-08-23-at-5-06-39-AM.jpg"
                            alt="Esperando Verificación" class="img-fluid mb-4">
                        <p class="lead">Hemos detectado un intento de inicio de sesión desde una nueva dirección IP.</p>
                        <p>Para tu seguridad, hemos enviado un correo electrónico para verificar este inicio de sesión.</p>
                        <p>Por favor, revisa tu bandeja de entrada y sigue las instrucciones para permitir el acceso desde
                            esta IP.</p>
                        <p>Una vez que hayas verificado, podrás continuar con el acceso a la plataforma.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary mt-3">Volver al inicio de sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
