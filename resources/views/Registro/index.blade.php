@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .card {
        width: 18rem;
        /* Ancho de la card */
        height: 22rem;
        /* Alto de la card */
        margin: auto;
        /* Centrar la card */
    }

    .card-img-container {
        display: flex;
        justify-content: center;
        /* Centrar la imagen horizontalmente */
        align-items: center;
        height: 10rem;
        /* Altura del contenedor de la imagen */
    }

    .card-img-top {
        width: 50%;
        /* Ancho de la imagen */
        object-fit: cover;
        /* Ajusta la imagen para cubrir el área sin distorsión */
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* Espaciar el contenido de la card */
    }
</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <!-- Card para Alumno -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-img-container">
                        <img src="https://i.ibb.co/kS5zk2M/Whats-App-Image-2024-08-23-at-1-43-16-AM.jpg" class="card-img-top"
                            alt="Alumno">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Registrar Alumno</h5>
                        <p class="card-text">Formulario para registrar un nuevo alumno.</p>
                        <a href="{{ route('formulario.alumno') }}" class="btn btn-outline-primary">Registrar Alumno</a>
                    </div>
                </div>
            </div>

            <!-- Card para Docente -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-img-container">
                        <img src="https://i.ibb.co/W51cCsH/Whats-App-Image-2024-08-23-at-1-46-35-AM.jpg"
                            class="card-img-top" alt="Docente">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Registrar Docente</h5>
                        <p class="card-text">Formulario para registrar un nuevo docente.</p>
                        <a href="{{ route('formulario.docente') }}" class="btn btn-outline-primary">Registrar Docente</a>
                    </div>
                </div>
            </div>

            <!-- Card para Superadmin -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-img-container">
                        <img src="https://i.ibb.co/Jj3SYnx/Whats-App-Image-2024-08-23-at-1-51-36-AM.jpg"
                            class="card-img-top" alt="Superadmin">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Registrar Superadmin</h5>
                        <p class="card-text">Formulario para registrar un nuevo superadmin.</p>
                        <a href="{{ route('formulario.superadmin') }}" class="btn btn-outline-primary">Registrar
                            Superadmin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
