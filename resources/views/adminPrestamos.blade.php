@extends('layouts.app-admin')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="card-body">
        <div class="row">
            <center>
                <div class="col-md-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            Libros Prestados
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12 mx-auto">
                                    <div class="table-responsive">
                                        @if ($librosPrestados->isNotEmpty())
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center align-middle">Fecha Realizo Prestamo</th>
                                                        <th class="text-center align-middle">Fecha Estimada Entrega Libro</th>
                                                        <th class="text-center align-middle">Días Retrasado</th>
                                                        <th class="text-center align-middle">Adeudo</th>
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
                                                            <td class="text-center align-middle">{{ $libroPrestado->dias_retraso }}</td>
                                                            <td class="text-center align-middle">${{ number_format($libroPrestado->adeudo, 2) }}</td>
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

        function cargar(){
            location.reload();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
@endsection