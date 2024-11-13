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
    <center><h1>LIBROS DEVUELTOS</h1></center>
    <div class="card-body">
        <div class="row">
            <center>
                <div class="col-md-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            Libros Devueltos
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-10 mx-auto">
                                    <div class="table-responsive">
                                        @if ($librosDevueltos->isNotEmpty())
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center align-middle">Fecha Realizo Prestamo</th>
                                                        <th  class="text-center align-middle">fecha_devolucion</th>
                                                        <th class="text-center align-middle">matricula</th>
                                                        <th class="text-center align-middle"> Nombre</th>
                                                        <th class="text-center align-middle">Nombre Libro</th>
                                                        <th class="text-center align-middle">Isbn</th>
                                                        <th class="text-center align-middle">Cantidad</th>
                                                        <th class="text-center align-middle">Imagen</th>
                                                        <th class="text-center align-middle">Estado</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($librosDevueltos as $prestamo)
                                                        <tr>
                                                            <td class="text-center align-middle">{{ $prestamo->fecha_realiza_prestamo_completa }}</td>
                                                            <td class="text-center align-middle">{{ $prestamo->fecha_devolucion }}</td>
                                                            <td class="text-center align-middle">{{ $prestamo->username }}</td>
                                                            <td class="text-center align-middle">{{ $prestamo->name}}</td>
                                                            <td class="text-center align-middle">{{ $prestamo->nombre_libro }}</td>
                                                            <td class="text-center align-middle">{{ $prestamo->isbn }}</td>
                                                            <td class="text-center align-middle">1</td>
                                                            <td class="text-center align-middle"><img src="{{ asset('storage/' . $prestamo->imagen) }}" alt="" width="100" height="100"></td>
                                                            <td class="text-center align-middle">{{ $prestamo->estado_prestamo }}</td>
                                                            
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
</body>
</html>
@endsection