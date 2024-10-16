@extends('layouts.app-master')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <style>
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        /* Estilos del Banner */
        .header-banner {
            /* Reemplaza con tu imagen */
            background-image: url('../static/banner.jpg'); 
            background-size: cover;
            background-position: center;
            height: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .header-banner h1 {
            color: white;
            font-size: 48px;
            font-weight: 700;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            letter-spacing: 2px;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px 20px;
            border-radius: 10px;
        }
        
        /* Sección del carrusel */
        .carousel {
            max-width: 90%;
            margin: 30px auto;
            text-align: center;
        }
        
        .search-bar {
            /*background-image: url('https://via.placeholder.com/1500x500');  Cambia esta URL a tu imagen */
            background-image: url("{{ asset('images/upvt.png') }}");
            background-size: cover;
            background-position: center;
            height: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0.8;
            
            }
            .search-bar input {
            width: 50%;
            padding: 10px;
            border-radius: 50px;
            border: black;
            outline: none;
            }
            .search-bar button {
            margin-left: -50px;
            background-color: #b7c153;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            cursor: pointer;
            }
        
        /* Estilos de los libros */
        .carousel-content {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .book {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            max-width: 200px;
        }
        
        .book:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        
        .book img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        
        .book p {
            font-size: 16px;
            font-weight: 500;
            color: #333;
            text-align: center;
        }
        
        /* Paginación */
        .pagination {
            margin-top: 30px;
        }
        
        .pagination span {
            margin: 0 10px;
            font-size: 18px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .pagination span:hover {
            background-color: #0056b3;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .carousel-content {
                flex-direction: column;
                align-items: center;
            }
        
            .book {
                width: 90%;
                max-width: 300px;
            }
        
            .search-bar input {
                width: 80%;
            }
        }
    </style>
</head>
<body>
    
    <br>
    <!-- Search Bar -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Buscar Libro...">
        <button onclick="searchBook()">Buscar</button>
    </div>

    <!-- Books Section -->
    <section class="carousel">    
        <div class="carousel-content">
            @foreach($libros as $libro)
                <div class="book">
                    <a href="{{ route('libros.show', $libro->id_libro) }}">
                        <img src="{{ asset('storage/' . $libro->imagen) }}" alt="{{ $libro->nombre_libro }}" height="100" width="100">
                    </a>
                    <p class="card-text">{{ $libro->nombre_libro }}</p>
                    <button type="button" class="btn btn-primary">Ver</button>
                </div>
            @endforeach     
        </div>
    </section>
    

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        function searchBook() {
            let input = document.getElementById('searchInput').value;
            alert('Buscando libro: ' + input);
        }
    </script>
    <!--div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <p class="lead">Only authenticated users can access this section.</p>
        <a class="btn btn-lg btn-primary" href="https://codeanddeploy.com" role="button">View more tutorials here &raquo;</a>
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div-->
</body>
</html>
    
@endsection