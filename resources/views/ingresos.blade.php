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
    @if ($ingresos->isNotEmpty())
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle">Isbn</th>
                    <th class="text-center align-middle">Nombre</th>
                    <th class="text-center align-middle">cantidad</th>
                    <th class="text-center align-middle">Fecha Ingreso</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ingresos as $libro)
                    <tr>
                        <td class="text-center align-middle">{{ $libro->isbn }}</td>
                        <td class="text-center align-middle">{{ $libro->nombre_libro }}</td>
                        <td class="text-center align-middle">{{ $libro->cantidad }}</td>
                        <td class="text-center align-middle">{{ $libro->fecha_ingreso }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center">Sin Libros Registrados</p>
    @endif 
</body>
</html>
@endsection
