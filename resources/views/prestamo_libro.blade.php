@extends('layouts.app-master')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Libros UPVT</title>
    <!-- Bootstrap 4 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-solicitar {
            background-color: #4caf50;
            color: white;
        }
        .btn-leer {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <!--nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/home">
                <img src="{{ asset('images/loboss.png') }}" alt="Logo">LOBOS BLANCOS UPVT
            </a>
        </div>
    </nav-->

    <!-- Main content -->
    <div class="container d-flex justify-content-center">
        <div class="card w-50">
            <div class="row g-0">
                <div class="col-md-4">
                    <img class="img-fluid rounded-start" src="{{ asset('storage/'. $libro->imagen) }}" alt="{{ $libro->nombre_libro }}">
                    @auth
                        Disponibles: {{$libro->existencia}}
                    @endauth
                    
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $libro->nombre_libro }}</h5>
                        <p class="card-text">Autor:
                            <ul>
                                @foreach ($autores as $autor)
                                    <li>{{ $autor->nombre_autor }} {{ $autor->apellido }}</li>
                                @endforeach
                                
                            </ul>
                        </p>
                        @auth
                        <div class="d-grid gap-3">
                            <a href="{{ asset('storage/'. $libro->libro_digital) }}">
                                <button class="btn btn-leer" type="button" >LEER</button>
                            </a>
                            
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-solicitar" data-toggle="modal" data-target="#solicitarLibro">
                                RESERVAR
                            </button>
                        </div>
                        @else
                            <a href="/login">
                                <button class="btn btn-solicitar">Iniciar Sesion</button>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <textarea class="form-control" placeholder="Descripción del libro xd">{{ $libro->descripcion }}</textarea>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="solicitarLibro" tabindex="-1" role="dialog" aria-labelledby="solicitarLibroTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Estas seguro de Reservar el Libro?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre_libro">Nombre Libro: {{ $libro->nombre_libro }}</label>
                        <br>
                        <label for="isbn">ISBN: {{ $libro->isbn }}</label>
                    </div>
                    <center>
                        <img src="{{ asset('images/pregunta.webp')}}" alt="" height="100" height="100">
                    </center>
                    
                    <div class="form-group">
                        <center> <label for="cantidad">Hora Para recoger su Libro</label></center>
                        <input class="form-control" type="number" name="hora" id="hora">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="reservar-btn" type="button" class="btn btn-primary">Reservar</button>
                </div>
            </div>
        </div>
    </div>
    @guest
        NO ESTAS AUTHENTICADO
    @endguest

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @auth
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Seleccionar el botón y asignarle la función
                document.getElementById('reservar-btn').addEventListener('click', function() {
                    let hora = document.getElementById('hora').value;
                    //console.log(hora);

                    if (hora > 4) {
                        Swal.fire({
                            icon: "error",
                            title: "Selecciona una Hora menor!",
                            text: "hora demaciado extendida, elige otra!",
                        });
                        return; // Para que no continúe si hay error
                    }

                    let libroId = {{ $libro->id_libro }}; // ID del libro
                    let user = {{auth()->user()->username}}
                    fetch(`/prestamo/libro/${libroId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            user: user,
                            hora: hora,
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        //alert(data.message); // Mostrar mensaje de éxito
                        Swal.fire({
                        title: "¡Exito!",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: "OK",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                cargar();
                                //Swal.fire("Saved!", "", "success");
                            } else if (result.isDenied) {
                                Swal.fire("Changes are not saved", "", "info");
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            });
            function cargar(){
                location.reload();
            }
        </script>
    @else
        <script>
            Swal.fire({
                    title: "No tienes Cuenta!",
                    text: 'Inicia Sesion Para reservar este Libro',
                    icon: "error",
                    confirmButtonText: "Iniciar Sesion",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //cargar();
                            window.location.href = "/login"; // Redirige al login si el usuario no está autenticado
                            //Swal.fire("Saved!", "", "success");
                        } else if (result.isDenied) {
                            Swal.fire("Changes are not saved", "", "info");
                        }
                    });
            
        </script>
    @endauth
    <!--script>
        async function horaLimite() {
            // Suponiendo que tienes el siguiente tiempo límite en horas (desde la base de datos)
            const horasLimite =  // ejemplo de tiempo límite

            // Calcular el tiempo límite exacto en base a la fecha actual del préstamo
            const fechaPrestamo =  // Fecha desde la base de datos
            const tiempoLimite = new Date(fechaPrestamo.getTime() + horasLimite * 60 * 60 * 1000);

            // Actualizar el contador cada segundo
            const intervalId = setInterval(() => {
                const ahora = new Date();
                const diferencia = tiempoLimite - ahora;

                if (diferencia > 0) {
                    // Calcular horas, minutos y segundos restantes
                    const horas = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
                    const segundos = Math.floor((diferencia % (1000 * 60)) / 1000);

                    // Mostrar el contador en el HTML
                    document.getElementById('contador').innerText = `${horas}h ${minutos}m ${segundos}s restantes para recoger el libro.`;
                } else {
                    // Tiempo agotado, cancelar la reserva
                    clearInterval(intervalId);
                    cancelarPrestamo();
                }
            }, 1000);

            // Función para cancelar el préstamo
            function cancelarPrestamo() {
                // Cambiar el estado del préstamo en la base de datos (mediante una petición al backend)
                fetch('/cancelar-prestamo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id_prestamo: 1, // id del préstamo
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    // Actualizar el estado del préstamo en la interfaz
                    document.getElementById('estado_prestamo').innerText = 'CANCELADO';
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }

    </script-->

    <!-- Bootstrap 4 JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    
</body>
</html>
@endsection