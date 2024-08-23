<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro Académico</title>
    @vite('resources/css/styles.css')
</head>

<body>
    <nav class="navbar">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>

            @if (Auth::check())
                @if (Auth::user()->rol == 'Superadmin')
                    <li><a href="{{ route('register') }}">Registrar Usuario</a></li>
                    <li><a href="{{ route('materias') }}">Ver Materias</a></li>
                    <li><a href="{{ route('estadisticas') }}">Estadísticas</a></li>
                @elseif (Auth::user()->rol == 'Docente')
                    <li><a href="{{ route('docente.materias') }}">Mis Materias</a></li>
                    <li><a href="{{ route('estadisticas') }}">Estadísticas</a></li>
                @endif
            @endif
        </ul>

        <div class="user-role">
            @if (Auth::check())
                @if (Auth::user()->rol == 'Superadmin')
                    Superadmin
                @elseif (Auth::user()->rol == 'Docente')
                    Docente
                @elseif (Auth::user()->rol == 'Alumno')
                    Alumno
                @endif
            @endif
        </div>

        <div class="user-profile">
            @if (Auth::check())
                <span>{{ Auth::user()->nombre }}</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endif
        </div>
    </nav>

    <div class="container">
        @yield('content')
        @yield('scripts')

    </div>
</body>

</html>
