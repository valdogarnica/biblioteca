@extends('layouts.auth-master')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('images/fondoLogin.jpg') }}'); /* Imagen de fondo */
            background-size: cover;
            background-position: center;
            font-family: 'Arial', sans-serif;
        }
        
        .login-container {
            width: 100%;
            height: calc(100vh - 160px); /* Ajusta la altura según las franjas superiores */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.9); /* Fondo blanco con opacidad */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 350px;
        }
        .login-box img {
            width: 120px;
            margin-bottom: 20px;
        }
        .login-box input {
            width: 100%;
            padding: 12px; /* Ajuste para mejor usabilidad */
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box; /* Asegura que el padding no desborde */
        }
        .login-box button {
            width: 100%;
            padding: 12px;
            background-color: #691C32; /* Color del botón */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            box-sizing: border-box; /* Para alinear con los inputs */
        }
        .login-box button:hover {
            background-color: #4e1324; /* Color al pasar el mouse */
        }
        .login-box a {
            display: block;
            margin-top: 10px;
            color: #691C32;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .login-box a:hover {
            text-decoration: underline;
        }
        /* Estilo para las validaciones */
        input:invalid {
            border-color: red;
        }
        input:valid {
            border-color: green;
        }
    </style>
</head>
<body>
    <br>
    <br>
    <div class="login-container">
        <div class="login-box">
            <img src="{{ asset('images/loboLogo.png') }}" alt="Mascota Lobos Blancos"> <!-- Imagen de la mascota -->
            <form method="post" action="{{ route('login.perform') }}" >
        
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                
                
                <h1 class="h3 mb-3 fw-normal">Login</h1>
        
                @include('layouts.partials.messages')
        
                <div class="form-group form-floating mb-3">
                    <input type="number" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
                    <label for="floatingName">Matricula</label>
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                
                <div class="form-group form-floating mb-3">
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                    <label for="floatingPassword">Password</label>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
        
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                <a href="/register">No tienes Cuenta?</a>
                @include('auth.partials.copy')
            </form>
        </div>
    </div>
</body>
</html>
@endsection