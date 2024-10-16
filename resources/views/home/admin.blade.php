@extends('layouts.app-admin')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <style>
        .left-panel, .right-panel {
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .left-panel {
            flex: 1;
            margin-right: 20px;
        }

        .right-panel {
            flex: 1;
            margin-right: 20px;
        }

        

        .calendar {
            width: 100%;
            max-width: 300px;
            border: 1px solid #ccc;
            border-collapse: collapse;
        }

        .calendar td {
            padding: 5px;
            border: 1px solid #ccc;
            text-align: center;
            cursor: pointer;
        }

        .calendar td:hover {
            background-color: #f0f0f0;
        }

        
        

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

    </style>
    
</head>
<body>
    <center><h1>Prestamos Pendientes</h1></center>
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
                                        @if ($prestamos->isNotEmpty())
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center align-middle">Fecha Realizo Prestamo</th>
                                                        <th class="text-center align-middle">matricula</th>
                                                        <th class="text-center align-middle"> Nombre</th>
                                                        <th class="text-center align-middle">Nombre Libro</th>
                                                        <th class="text-center align-middle">Isbn</th>
                                                        <th class="text-center align-middle">Cantidad</th>
                                                        <th class="text-center align-middle">Imagen</th>
                                                        <th class="text-center align-middle">Estado</th>
                                                        <th class="text-center align-middle">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($prestamos as $prestamo)
                                                        <tr>
                                                            <td class="text-center align-middle">{{ $prestamo->fecha_realiza_prestamo_completa }}</td>
                                                            <td class="text-center align-middle">{{ $prestamo->username }}</td>
                                                            <td class="text-center align-middle">{{ $prestamo->name}}</td>
                                                            <td class="text-center align-middle">{{ $prestamo->nombre_libro }}</td>
                                                            <td class="text-center align-middle">{{ $prestamo->isbn }}</td>
                                                            <td class="text-center align-middle">1</td>
                                                            <td class="text-center align-middle"><img src="{{ asset('storage/' . $prestamo->imagen) }}" alt="" width="100" height="100"></td>
                                                            <td class="text-center align-middle">{{ $prestamo->estado_prestamo }}</td>
                                                            <td class="text-center align-middle">
                                                                <button class="btn btn-success" onclick="prestarLibro({{$prestamo->id_prestamo}})">Si Prestar Libro</button>
                                                                <button class="btn btn-danger">No Prestar Libro</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p class="text-center">Ningun Alumno a Solicitado un Libro</p>
                                        @endif
                                            
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
                            Libros Prestamos
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-10 mx-auto">
                                    <div class="table-responsive">
                                        @if ($librosPrestados->isNotEmpty())
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center align-middle">Fecha Realizo Prestamo</th>
                                                        <th class="text-center align-middle">Fecha Estimada Entrega Libro</th>
                                                        <th class="text-center align-middle">Matricula</th>
                                                        <th class="text-center align-middle"> Nombre</th>
                                                        <th class="text-center align-middle">Nombre Libro</th>
                                                        <th class="text-center align-middle">Isbn</th>
                                                        <th class="text-center align-middle">Cantidad</th>
                                                        <th class="text-center align-middle">Imagen</th>
                                                        <th class="text-center align-middle">Estado</th>
                                                        <th class="text-center align-middle">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($librosPrestados as $libroPrestado)
                                                        <tr>
                                                            <td class="text-center align-middle">{{ $libroPrestado->fecha_realiza_prestamo_completa }}</td>
                                                            <td class="text-center align-middle">{{ $libroPrestado->fecha_estimada_entrega }}</td>
                                                            <td class="text-center align-middle">{{ $libroPrestado->username }}</td>
                                                            <td class="text-center align-middle">{{ $libroPrestado->name}}</td>
                                                            <td class="text-center align-middle">{{ $libroPrestado->nombre_libro }}</td>
                                                            <td class="text-center align-middle">{{ $libroPrestado->isbn }}</td>
                                                            <td class="text-center align-middle">1</td>
                                                            <td class="text-center align-middle"><img src="{{ asset('storage/' . $libroPrestado->imagen) }}" alt="" width="100" height="100"></td>
                                                            <td class="text-center align-middle">{{ $libroPrestado->estado_prestamo }}</td>
                                                            <td class="text-center align-middle">
                                                                <button class="btn btn-success" onclick="regresar({{$libroPrestado->id_prestamo}}, '{{ $libroPrestado->name }}')">Regresar Libro</button>
                                                                <!--button class="btn btn-danger">No Prestar Libro</button-->
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p class="text-center">Ningun Alumno tiene un Libro Prestado</p>
                                        @endif
                                            
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
        function regresar(idPrestamo, nombreAlumno) {
            //const idPrestamo = idPrestamo;
            const nombre = nombreAlumno;
            Swal.fire({
            title: `¿Estás seguro que el Alumno ${nombre} devolcio el Libro?`,
            text: "¡No podrás revertir esta acción!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, devolcio el libro",
            cancelButtonText: "Cancelar"
            }).then((result) => {
            if (result.isConfirmed) {
                // Aquí puedes agregar la lógica para marcar el libro como recogido
                //libroRecoger(idPrestamo);
                regresarLibro(idPrestamo);
                
                
            }
            });
        }

        function regresarLibro(idPrestamo){
            fetch(`/regresar/libro/${idPrestamo}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Necesario para la seguridad en Laravel
                },
                body: JSON.stringify({
                    devolvio_libro: true,
                    
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                    title: "¡Libro Devuleto Correctamente!",
                    text: "El estado del libro ha sido actualizado.",
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
                    
                } else {
                    Swal.fire({
                    title: "¡Error!",
                    text: "Hubo un error al devolver el Libro. Inténtalo de nuevo.",
                    icon: "error"
                    });
                    //alert("Hubo un error al marcar el libro. Inténtalo de nuevo.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Ocurrió un error. Inténtalo de nuevo.");
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ESTA FUNCION SIRVE PARA PRESTAR EL LIBRO, CUANDO HAY UNA SOLICITUD DE PRESTAMO PARA UN ALUMNO -->
    <script>
        function prestarLibro(idPrestamo) {
            // Confirmación de la acción
            //if (!confirm("¿Estás seguro de que quieres marcar el libro como recogido?")) {
            //    return;
            //}

            Swal.fire({
            title: "¿Estás seguro de que quieres marcar el libro como recogido?",
            text: "¡No podrás revertir esta acción!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, marcarlo como recogido",
            cancelButtonText: "Cancelar"
            }).then((result) => {
            if (result.isConfirmed) {
                // Aquí puedes agregar la lógica para marcar el libro como recogido
                libroRecoger(idPrestamo);
                
            }
            });
        }

        function libroRecoger(idPrestamo){
            // Realizar la solicitud fetch (AJAX) al controlador de Laravel
            fetch(`/prestamos/${idPrestamo}/recoger`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Necesario para la seguridad en Laravel
                },
                body: JSON.stringify({
                    recogio_libro: true
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                    title: "¡Libro recogido!",
                    text: "El estado del libro ha sido actualizado.",
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
                    
                } else {
                    Swal.fire({
                    title: "¡Error!",
                    text: "Hubo un error al marcar el libro. Inténtalo de nuevo.",
                    icon: "error"
                    });
                    //alert("Hubo un error al marcar el libro. Inténtalo de nuevo.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Ocurrió un error. Inténtalo de nuevo.");
            });
        }

        function cargar(){
            location.reload();
        }
    </script>


    
</body>
</html>
@endsection

