@extends('layouts.app-master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mochila</title>
    <style>
        h1{
            color: green;
        }
    </style>
</head>
<body>
    <br>
    <center><h1>Mi Mochila</h1></center>
    <div class="card-body">
        <div class="row">
            <center>
                <div class="col-md-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            Libros Reservados
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-10 mx-auto">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-middle">Fecha Realize Prestamo</th>
                                                    <th class="text-center align-middle">Hora Limite</th>
                                                    <th class="text-center align-middle">Tiempo</th>
                                                    <th class="text-center align-middle">Nombre Libro</th>
                                                    <th class="text-center align-middle">Imagen</th>
                                                    <th class="text-center align-middle">Estado</th>
                                                    <th class="text-center align-middle">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mochila as $libro)
                                                    <tr>
                                                        <td class="text-center align-middle">{{ $libro->fecha_realiza_prestamo_completa }}</td>
                                                        <td class="text-center align-middle">{{ $libro->hora_limite_recoger_libro }}</td>
                                                        <td class="text-center align-middle" id="timer-{{ $libro->id_prestamo }}">Cargando...</td>
                                                        <td class="text-center align-middle">{{ $libro->nombre_libro }}</td>
                                                        <td class="text-center align-middle"><img src="{{ asset('storage/' . $libro->imagen) }}" alt="" width="100" height="100"></td>
                                                        <td class="text-center align-middle">{{ $libro->estado_prestamo }}</td>
                                                        <td class="text-center align-middle">
                                                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i> Cancelar Reserva</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </center>
        </div>
    </div>
    
    <div class="card-body">
        <div class="row">
            <center>
                <div class="col-md-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            Libros Obtenidos
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-10 mx-auto">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-middle">Nombre Libro</th>
                                                    <th class="text-center align-middle">Imagen</th>
                                                    <th class="text-center align-middle">Fecha Realize Prestamo</th>
                                                    <th class="text-center align-middle">Fecha Estimada Entrega del Libro</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($librosObtenidos as $obtenido)
                                                    <tr>
                                                        <td class="text-center align-middle">{{ $obtenido->nombre_libro }}</td>
                                                        <td class="text-center align-middle"><img src="{{ asset('storage/' . $obtenido->imagen) }}" alt="" width="100" height="100"></td>
                                                        <td class="text-center align-middle">{{ $obtenido->fecha_realiza_prestamo_completa }}</td>
                                                        <td class="text-center align-middle">{{ $obtenido->fecha_estimada_entrega }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </center>
        </div>
    </div>

    <script>
        // Lista de préstamos
        const prestamos = @json($mochila);
    
        // Función para iniciar los contadores
        function iniciarContadores() {
            prestamos.forEach(libro => {
                const fechaPrestamo = new Date(libro.fecha_realiza_prestamo_completa).getTime();
                const horasLimite = libro.hora_limite_recoger_libro;
                const tiempoLimite = fechaPrestamo + (horasLimite * 60 * 60 * 1000); // Convertir horas a milisegundos
    
                // Elemento del contador
                const countdownElement = document.getElementById(`timer-${libro.id_prestamo}`);
                const countdownFunction = setInterval(() => {
                    const now = new Date().getTime();
                    const distancia = tiempoLimite - now;
    
                    // Calcular horas, minutos y segundos
                    const horas = Math.floor((distancia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutos = Math.floor((distancia % (1000 * 60 * 60)) / (1000 * 60));
                    const segundos = Math.floor((distancia % (1000 * 60)) / 1000);
    
                    // Mostrar el resultado en el elemento correspondiente
                    if (distancia > 0) {
                        countdownElement.innerHTML = `${horas}h ${minutos}m ${segundos}s`;
                    } else {
                        clearInterval(countdownFunction);
                        countdownElement.innerHTML = "¡El préstamo ha expirado!";
                        cancelarReserva(libro.id_prestamo);
                    }
                }, 1000);
            });
        }
    
        // Función para cancelar la reserva
        function cancelarReserva(idPrestamo) {
            // Lógica para cancelar el préstamo (puedes implementar una llamada AJAX o redirigir)
            alert("Reserva con ID " + idPrestamo + " ha sido cancelada.");
            cancelar(idPrestamo);
            // Aquí puedes hacer la lógica para actualizar la base de datos si es necesario
        }
        function cancelar(idPrestamo) {
            // Hacer una llamada AJAX para cancelar la reserva
            fetch(`/cancelar-reserva/${idPrestamo}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Asegúrate de incluir el token CSRF
                }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                // Opcionalmente, podrías actualizar el estado de la UI o recargar la tabla
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

    
        // Iniciar los contadores al cargar la página
        window.onload = iniciarContadores;
    </script>
</body>
</html>
@endsection