<!DOCTYPE html>
<html>
<head>
    <title>Registro Académico</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <ul>
            @if (Auth::check())
                <li><a href="{{ route('home') }}">Home</a></li>
                @if (Auth::user()->rol == 'Superadmin')
                    <li><a href="{{ route('register') }}">Registrar Usuario</a></li>
                    <li><a href="{{ route('materias') }}">Asignar Materias</a></li>
                @elseif (Auth::user()->rol == 'Docente')
                    <li><a href="{{ route('docente.materias') }}">Mis Materias</a></li>
                @elseif (Auth::user()->rol == 'Alumno')
                    <li><a href="{{ route('alumno.materias') }}">Mis Materias</a></li>
                @endif
                <li><a href="{{ route('logout') }}">Logout</a></li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
            @endif
        </ul>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
