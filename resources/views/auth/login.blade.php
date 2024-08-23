@extends('layouts.app')

@section('content')

<div class="login-container">
    <h2 class="login-header">INICIO DE SESIÓN</h2>
    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf
        <div>
            <label for="email">
                <span><i class="fas fa-user"></i></span>
                Usuario
            </label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="password">
                <span><i class="fas fa-lock"></i></span>
                Contraseña
            </label>
            <input type="password" name="password" required>
        </div>
        <div class="login-button-container">
            <button type="submit">Acceder</button>
        </div>
    </form>
    <p class="login-footer">Universidad Patrimonial 2  <br>Tu universidad de confianza</p>
</div>

@endsection
